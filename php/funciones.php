<?php
/*
 * Conexión a la base de datos.
 *
 * Las credenciales se leen de un archivo .env que está FUERA de la carpeta
 * pública del sitio, para que nadie pueda descargarlo desde el navegador.
 *
 * Dónde se busca el .env, en este orden:
 *   1. La ruta de la variable de entorno ITEC_ENV_FILE, si está definida.
 *   2. Dos carpetas arriba de este archivo. En el servidor:
 *        /var/www/iteccardiologia.com.ar/html/php/funciones.php
 *        →  /var/www/iteccardiologia.com.ar/.env
 *
 * Formato del .env (una variable por línea):
 *   HOST=localhost
 *   PORT=5432
 *   DBNAME=itec
 *   USER=...
 *   PASSWORD=...
 */

function leerEnv() {
	static $env = null;
	if ($env !== null) {
		return $env;
	}

	$ruta = getenv('ITEC_ENV_FILE');
	if (!$ruta) {
		$ruta = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
	}

	$env = [];
	if (!is_readable($ruta)) {
		error_log("ITEC: no se encontró el archivo de configuración en $ruta");
		return $env;
	}

	foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
		$linea = trim($linea);
		if ($linea === '' || $linea[0] === '#' || strpos($linea, '=') === false) {
			continue;
		}
		list($clave, $valor) = explode('=', $linea, 2);
		$valor = trim($valor);
		// Permite valores entre comillas: PASSWORD="abc"
		if (strlen($valor) >= 2 && ($valor[0] === '"' || $valor[0] === "'") && substr($valor, -1) === $valor[0]) {
			$valor = substr($valor, 1, -1);
		}
		$env[trim($clave)] = $valor;
	}
	return $env;
}

function conectar() {
	$env = leerEnv();

	// Cada valor va entre comillas simples para que caracteres como @ o espacios no rompan la conexión
	$q = function ($v) { return "'" . addcslashes((string) $v, "'\\") . "'"; };

	$cadena = 'host=' . $q($env['HOST'] ?? 'localhost')
		. ' port=' . $q($env['PORT'] ?? '5432')
		. ' dbname=' . $q($env['DBNAME'] ?? '')
		. ' user=' . $q($env['USER'] ?? '')
		. ' password=' . $q($env['PASSWORD'] ?? '');

	$conexion = @pg_connect($cadena);

	if ($conexion) {
		return $conexion;
	}

	error_log('ITEC: no se pudo conectar a la base de datos');
	echo "No se pudo establecer conexión con el servidor";
	return false;
}

function desconectar($conexion) {
	if (!$conexion) {
		return false;
	}
	return pg_close($conexion);
}
?>
