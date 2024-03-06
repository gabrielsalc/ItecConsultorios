<?php

	// $Env = parse_ini_file('.env');
	// $Host = $Env['HOST'];
	// $Port = $Env['PORT'];
	// $DBname = $Env['DBNAME'];
	// $User = $Env['USER'];
	// $Password = $Env['PASSWORD'];

	function conectar(){
		$env = file_get_contents('../php/.env');
		$lines = explode("\n",$env);
		
		foreach($lines as $line){
		  preg_match("/([^#]+)\=(.*)/",$line,$matches);
		  if(isset($matches[2])){
			putenv(trim($line));
		  }
		};
		$Host = getenv('HOST');
		$Port = getenv('PORT');
		$DBname = getenv('DBNAME');
		$User = getenv('USER');
		$Password = getenv('PASSWORD');

		$conexion = pg_connect("host=$Host port=$Port dbname=$DBname user=$User password=$Password");

		if ($conexion) {
			return $conexion;
		}
		else{
			echo "No se pudo establecer conexión con el servidor";
		}
	}

	function desconectar($conexion){
		$desconectar = pg_close($conexion);
		return $desconectar;
	}
?>