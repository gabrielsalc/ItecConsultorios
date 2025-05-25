<?php
    if (php_sapi_name() !== 'cli') {
        http_response_code(403);
        exit('Acceso denegado.');
    }

    include_once('/var/www/itecconsultorios.com.ar/html/php/funciones.php');
    $conexion = conectar();
    $q_insert = "INSERT INTO cronjobs (mensaje) VALUES (CONCAT('Mensaje enviado con cronjob ', NOW()));";
    $insert = pg_query($conexion, $q_insert);

?>;