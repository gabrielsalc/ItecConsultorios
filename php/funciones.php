<?php

 function conectar()
 {
 	$conexion = pg_connect('host=149.50.130.238 port=5432 dbname=itec user=postgres password=1@RaspayG4n4@93');

 	if ($conexion) {
 		return $conexion;
 	}
 	else{
 		echo "error de conexion";
 	}
 }

 function desconectar($conexion){
 	$desconectar = pg_close($conexion);
 	return $desconectar;
 }
?>