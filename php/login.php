<?php
	ob_start();
	include_once ('../html/login.html');
    include_once('../php/funciones.php');
	//echo "<a id='ir-arriba' href='#back-top' class='go-top'><i class='fa fa-angle-up'></i></a>";
    $Conexion = conectar(); //Conexion$Conexion a la base de datos
	if (isset($_POST['usuario']) && isset($_POST['contraseña'])) { //si existen los campos usuario y contraseña sigo
		$Usuario = $_POST['usuario']; //usuario
		$Password = $_POST['contraseña']; //contraseña
		$q_Paciente = "SELECT idpacien FROM pacientes WHERE nombreusuari=$1 AND passwo=$2"; //aqui debo hacer params
		$Paciente = pg_query_params($Conexion,$q_Paciente, array($Usuario, $Password)); //hago la consulta
		$Filas = pg_affected_rows($Paciente); //aqui saco la cantidad de resultados, deberia ser siempre 1

		if ($Filas == 1) { //si me da un resultado entonces me voy a la siguiente pagina
			session_start();
			$Datos = pg_fetch_row($Paciente);
			$_SESSION['usuario'] = $Datos[0];
			header("Refresh:0, url='estudios.php'");
		}
		else{
				echo "<script>window.alert('Usuario o contraseña incorrectos')</script>";
			}
	}
	desconectar($Conexion);
?>