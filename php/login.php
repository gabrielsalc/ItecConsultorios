<?php
    include_once('../php/funciones.php');
    include_once('../html/login.html');
    $Conexion = conectar(); //Conexion$Conexion a la base de datos
	if (isset($_POST['usuario']) && isset($_POST['contraseña'])) { //si existen los campos usuario y contraseña sigo
		$Usuario = $_POST['usuario']; //usuario
		$Password = $_POST['contraseña']; //contraseña
		$q_Paciente = "SELECT idpacien FROM pacientes WHERE nombreusuari='$Usuario' AND passwo='$Password'"; //aqui debo hacer un bind params
		$Paciente = pg_query($Conexion,$q_Paciente); //hago la consulta
		$Filas = pg_affected_rows($Paciente); //aqui saco la cantidad de resultados, deberia ser siempre 1

		if ($Filas == 1) { //si me da un resultado entonces me voy a la siguiente pagina
			session_start();
			$Datos = pg_fetch_row($Paciente);
			$_SESSION['usuario'] = $Datos[0];
			header("Refresh:0.5, url='estudios.php'");
		}
		else{
				echo "<script>window.alert('Usuario o contraseña incorrectos')</script>";
			}
	}
	desconectar($Conexion);
?>