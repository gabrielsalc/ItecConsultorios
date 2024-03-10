<?php

    include_once('../php/funciones.php');
    session_start(); 					//inicio de sesiones//
	if (isset($_SESSION['usuario'])){   //si existe la sesion con el nombre de usuario entonces la pagina funciona//
        include_once('../html/estudios.html');
		$conexion = conectar();   //me conecto a la base de datos//
        $idpacien = $_SESSION['usuario'];
        $nombre = $_SESSION['usuario'];
        $q_Pacien = "SELECT pacien FROM pacientes WHERE idpacien = '$idpacien'";
        $Paciente = pg_fetch_row(pg_query($conexion, $q_Pacien));
        echo    "<div id='titulo' class='flex-row container col-md-12 col-sm-12 paciente'>
                    <h1>".strtoupper($Paciente[0])."</h1>
                </div>";
        $q_Estudios = "SELECT idestudi, descri, fecha FROM estudios WHERE idpacien = '$idpacien' ORDER BY fecha DESC";
        $Estudios = pg_query($conexion, $q_Estudios);
        $Filas = pg_affected_rows($Estudios);
        if ($Filas > 0){   
            While($Datos = pg_fetch_row($Estudios)){
                $IdEstudi = $Datos[0];
                echo "<div id='divestudio' class='flex-row container col-md-12 col-sm-12 estudio'>
                        <div id='paciente' class='encabezadoestudio'>
                            <h5>".$Datos[2]."</h5>
                            <h4>".$Datos[1]."</h4> 
                        </div>
                        <div id='divarchivos' class='flex-row container col-md-12 col-sm-12 archivos'>";
                $q_Archivos = "SELECT idarchiv, titulo, archiv, extens FROM estudiosarchivos ea WHERE idestudi = '$IdEstudi'";
                $Archivos = pg_query($conexion,$q_Archivos);
                $FilasArchivos = pg_affected_rows($Archivos);
                if ($FilasArchivos > 0){
                    while($DatosArchiv = pg_fetch_row($Archivos)){  //mientras haya informacion, me escribira los resultados//
                        $id = $DatosArchiv[0];	
                        $Archivo = hex2bin(substr($DatosArchiv[2], 2));
                        if (($DatosArchiv[3] == '.jpg') or ($DatosArchiv[3] == '.png') or ($DatosArchiv[3] == '.jpeg')) {
                            $Url = 'data:image/gif;base64,' . base64_encode($Archivo);  
                            echo "<div id='fotos' class='item flex-row container col-md-12 col-sm-12'>
                                    <img class='img-responsive fotoarchivo' src='$Url' alt='estudio'></img>
                                    <a class='btn btn-lg btn-default smoothScroll wow fadeInUp archivo' href='$Url' download='$DatosArchiv[1]' target='blank'>$DatosArchiv[1] <i class='fa-regular fa-images'></i> <i class='fa-solid fa-download'></i></a>
                                 </div>";
                        } else {
                            $Archivo = hex2bin(substr($DatosArchiv[2], 2));
                            //$Archivo = pg_escape_bytea($DatosArchiv[2]);
                            //$Url = 'data:file;base64,' . base64_encode($Archivo); 
                            $Url = 'data:file;base64,' . base64_encode($Archivo);
                            if (($DatosArchiv[3] == '.docx') or ($DatosArchiv[3] == '.doc') or ($DatosArchiv[3] == '.txt')) {
                                $Icono = "<i class='fa-regular fa-file-word'></i>";    
                            }
                            else
                            if (($DatosArchiv[3] == '.xlsx') or ($DatosArchiv[3] == '.xls')) {
                                $Icono = "<i class='fa-solid fa-table'></i>";    
                            }
                            else
                            if (($DatosArchiv[3] == '.pdf')) {
                                $Icono = "<i class='fa-regular fa-file-pdf'></i>";    
                            }
                            else
                            if (($DatosArchiv[3] == '.ppt') or ($DatosArchiv[3] == '.pptx')) {
                                $Icono = "<i class='fa-regular fa-file-powerpoint'></i>";    
                            }
                            else{
                                $Icono = "<i class='fa-regular fa-file'></i>";    
                            }
                            //echo $Url;
                            echo "<div>
                                 <a class='btn btn-lg btn-default smoothScroll wow fadeInUp archivo' href='$Url' download='$DatosArchiv[1]' target='blank'>$DatosArchiv[1] &nbsp; $Icono <i class='fa-solid fa-download'></i></a>
                                 </div>";
                        }
                    
                    }
                    echo "</div></div>";

                }
                else{
                    echo "</div></div>";
                }
                pg_free_result($Archivos);
            }
            echo "</div></section>";
		}
        else{

            Include_once('../html/sinresultados.html');
        }  //creo un string//
		
            //me da un array con los valores de la base de datos//

        pg_free_result($Estudios);
        desconectar($conexion);

    }
    else{
        header("Refresh:0.5, url='../index.php'");    
    }

?>