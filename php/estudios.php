<?php
include_once('../php/funciones.php');
session_start();

if (isset($_SESSION['usuario'])) {
    include_once('../html/estudios.html');
    $conexion = conectar();
    $documento = $_SESSION['usuario'];

    echo "<div id='titulo' class='flex-row container col-md-12 col-sm-12 paciente'>
            <h1>" . strtoupper($documento) . "</h1>
          </div>";

    $q_Estudios = "SELECT idestudi, descri, fecha FROM estudios WHERE dni = $documento ORDER BY fecha DESC";
    $Estudios = pg_query($conexion, $q_Estudios);

    if (pg_affected_rows($Estudios) > 0) {
        while ($Datos = pg_fetch_row($Estudios)) {
            $IdEstudi = $Datos[0];
            echo "<div class='flex-row container col-md-12 col-sm-12 estudio'>
                    <div class='encabezadoestudio'>
                        <h5>{$Datos[2]}</h5>
                        <h4>{$Datos[1]}</h4>
                    </div>
                    <div class='flex-row container col-md-12 col-sm-12 archivos'>";

            $q_Archivos = "SELECT idarchiv, titulo, extens FROM estudiosarchivos WHERE idestudi = '$IdEstudi'";
            $Archivos = pg_query($conexion, $q_Archivos);

            if (pg_affected_rows($Archivos) > 0) {
                while ($Archivo = pg_fetch_row($Archivos)) {
                    $idarchiv = $Archivo[0];
                    $titulo = htmlspecialchars($Archivo[1], ENT_QUOTES);
                    $extens = strtolower($Archivo[2]);

                    echo "<div class='archivo-item mb-2'>
                            <button class='btn btn-outline-primary' onclick=\"vistaPreviaArchivo($idarchiv, '$titulo', '$extens')\">
                                $titulo <i class='fa-solid fa-eye'></i>
                            </button>
                          </div>";
                }
            }

            pg_free_result($Archivos);
            echo "</div></div>";
        }

        pg_free_result($Estudios);
    } else {
        include_once('../html/sinresultados.html');
    }

    desconectar($conexion);
} else {
    header("Refresh:0.5, url='../index.php'");
}
?>