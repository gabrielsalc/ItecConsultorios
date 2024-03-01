<?php
    include_once('../php/funciones.php');
    include_once('../html/login.html');
    $conexion=conectar();
	if (isset($_POST['usuario']) && isset($_POST['contraseña'])) {
		$usuario=$_POST['usuario'];
		$contraseña = $_POST['contraseña'];
		$pregunta="SELECT idpacien FROM pacientes WHERE nombreusuari='$usuario' AND passwo='$contraseña'";
		$responde=pg_query($conexion,$pregunta);
		$recFilas=pg_affected_rows($responde);

		if ($recFilas = 1) {
			session_start();
			$_SESSION['usuario'] = pg_fetch_result(pg_query($conexion,$pregunta), 0,0);
			header("Refresh:0.5, url='estudios.php'");
		}
			else{
				$resultado=pg_query($conexion,$pregunta);
					echo "<script>window.alert('Usuario o contraseña incorrectos')</script>";
				}
		}
	desconectar($conexion);
?>