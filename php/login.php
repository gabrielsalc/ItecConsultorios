<?php
	ob_start();
	include_once ('../html/login.html');
    include_once('../php/funciones.php');
	//echo "<a id='ir-arriba' href='#back-top' class='go-top'><i class='fa fa-angle-up'></i></a>";
    $Conexion = conectar(); //Conexion$Conexion a la base de datos
	if (isset($_POST['documento'])) { //si existen los campos usuario y contraseña sigo
		$documento = $_POST['documento']; //usuario
		//$Password = $_POST['contraseña']; //contraseña
		$q_Paciente = "SELECT dni FROM estudios WHERE dni=$1"; //aqui debo hacer params
		$Paciente = pg_query_params($Conexion,$q_Paciente, array($documento)); //hago la consulta
		$Filas = pg_affected_rows($Paciente); //aqui saco la cantidad de resultados, deberia ser siempre 1

		if ($Filas >= 1) { //si me da un resultado entonces me voy a la siguiente pagina
			session_start();
			$Datos = pg_fetch_row($Paciente);
			$_SESSION['usuario'] = $_POST['documento'];
			header("Refresh:0, url='estudios.php'");
		}
		else{
				echo "<script>window.alert('No se encontraron estudios para ese numero de DNI')</script>";
			}
	}
	desconectar($Conexion);
?>