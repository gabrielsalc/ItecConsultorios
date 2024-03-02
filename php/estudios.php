<?php

    include_once('../php/funciones.php');
    session_start(); 					//inicio de sesiones//
	if (isset($_SESSION['usuario'])){   //si existe la sesion con el nombre de usuario entonces la pagina funciona//
        include_once('../html/estudios.html');
		$conexion = conectar();   //me conecto a la base de datos//
        $idpacien = $_SESSION['usuario'];
        $q_Pacien = "SELECT pacien FROM pacientes WHERE idpacien = '$idpacien'";
        $Paciente = pg_fetch_row(pg_query($conexion, $q_Pacien));
        echo "<section class='paciente'>
             <h1>".strtoupper($Paciente[0])."</h1></section>";
        $q_Estudios = "SELECT idestudi, descri, fecha FROM estudios WHERE idpacien = '$idpacien' ORDER BY fecha DESC";
        $Estudios = pg_query($conexion, $q_Estudios);
        While($Datos = pg_fetch_row($Estudios)){
            $IdEstudi = $Datos[0];
            echo "<section class='estudio'>
                  <div class='encabezadoestudio'>
                  <h2>".$Datos[2]."</h2>
                  <h3>".$Datos[1]."</h3> 
                  </div>
                  <div>";
            $q_Archivos = "SELECT idarchiv, titulo, archiv, extens FROM estudiosarchivos ea WHERE idestudi = '$IdEstudi'";
            $Archivos = pg_query($conexion,$q_Archivos); // ahora hago la consulta en la base de datos ya conectada, con el string query//

            while($DatosArchiv = pg_fetch_row($Archivos)){  //mientras haya informacion, me escribira los resultados//
                $id = $DatosArchiv[0];	//declaro variable id por cada cancion, esta se escribe por lo que no importa que vaya cambiando//
                $Archivo = hex2bin(substr($DatosArchiv[2], 2));
                if (($DatosArchiv[3] == '.jpg') or ($DatosArchiv[3] == '.png') or ($DatosArchiv[3] == '.jpeg')) {
                    $Url = 'data:image/gif;base64,' . base64_encode($Archivo);  
                    echo "<section><ul type='none'>
                        <li class='list'>".$DatosArchiv[1]."</li>
                        <img class='fotoarchivo' src='$Url' alt='estudio'></section><div></section>";
                } else {
                    $Url = $DatosArchiv[2];
                    echo $Url;
                    echo "<section><ul type='none'>
                          <li class='list'>".$DatosArchiv[1]."</li>
                          <a href='".$Url."'>Archivo</a></section><div></section>";
                }
                
     
                $nombre = $_SESSION['usuario'];
            }
        }
		   //creo un string//
		
            //me da un array con los valores de la base de datos//
        pg_free_result($Archivos);
        pg_free_result($Estudios);
        desconectar($conexion);

    }
    else{
        header("Refresh:0.5, url='../index.php'");    
    }

?>