<?php

    include_once('../php/funciones.php');
    session_start(); 					//inicio de sesiones//
	if (isset($_SESSION['usuario'])){   //si existe la sesion con el nombre de usuario entonces la pagina funciona//
        include_once('../html/estudios.html');
		$conexion=conectar();   //me conecto a la base de datos//
        $idpacien = $_SESSION['usuario'];
		$query1="SELECT idarchiv, titulo, archiv, extens FROM estudiosarchivos ea JOIN estudios e USING (idestudi) WHERE idpacien = '$idpacien'";   //creo un string//
		$resultado1 = pg_query($conexion,$query1); // ahora hago la consulta en la base de datos ya conectada, con el string query//
            //me da un array con los valores de la base de datos//

        while($data1 = pg_fetch_row($resultado1)){  //mientras haya informacion, me escribira los resultados//
            $id = $data1[0];	//declaro variable id por cada cancion, esta se escribe por lo que no importa que vaya cambiando//
            $img_bin = hex2bin(substr($data1[2], 2));
            if (($data1[3] == '.jpg') or ($data1[3] == '.png') or ($data1[3] == '.jpeg')) {
            $url = 'data:image/gif;base64,' . base64_encode($img_bin);  
            } else {
                $url = 'texto';
            }
            echo "<section><br><ul type='none'>
                <li class='list'>".$data1[1]."</li>
                <img src='$url' alt='estudio'>";
 
            $nombre = $_SESSION['usuario'];
            // $query2 = "SELECT * FROM usuarios WHERE nombre = '$nombre'"; //vuelvo a consultar, para que dependiendo del usuario, pueda o no 																modificar, para eso se puso el codigo promocional SuperUsuario//
            // $resultado2 = mysqli_query($conexion,$query2);
            // $data2 = mysqli_fetch_array($resultado2);
            // $master = $data2['master'];
            // if($master == 1){
            // 	echo "<li><a href='formulario_modificar.php?id=$id'>Modificar<img src='../img/edit_pencil.png' class='modificar' alt='lapiz modificador' tag='lapiz modificador'></a></li><li><a href='formulario_borrar.php?id=$id'>Borrar<img src='../img/trash_empty.png' class='borrar' alt='basurero borrador' tag='basurero borrador'></a><li></section>";
            // }
            // echo "</section>";
        }
    }
		pg_free_result($resultado1);

		desconectar($conexion);
?>