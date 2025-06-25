<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

include_once('../php/funciones.php');
$conexion = conectar();

$sql = "SELECT titulo, extens, archiv FROM estudiosarchivos WHERE idarchiv = $1";
$res = pg_query_params($conexion, $sql, [$id]);

if ($row = pg_fetch_assoc($res)) {
    $nombre = $row['titulo'];
    $ext = strtolower($row['extens']);

    if (strpos($row['archiv'], '\\x') === 0) {
        $contenido = hex2bin(substr($row['archiv'], 2));
    } else {
        $contenido = pg_unescape_bytea($row['archiv']);
    }

    switch ($ext) {
        case '.pdf':
            $mime = 'application/pdf';
            break;
        case '.jpg':
        case '.jpeg':
            $mime = 'image/jpeg';
            break;
        case '.png':
            $mime = 'image/png';
            break;
        case '.doc':
        case '.docx':
            $mime = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            break;
        case '.xls':
        case '.xlsx':
            $mime = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            break;
        default:
            $mime = 'application/octet-stream';
    }

    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    header("Content-Type: $mime");

    $inlineTypes = ['.pdf', '.jpg', '.jpeg', '.png'];
    if (in_array($ext, $inlineTypes)) {
        header("Content-Disposition: inline; filename=\"$nombre$ext\"");
    } else {
        header("Content-Disposition: attachment; filename=\"$nombre$ext\"");
    }

    echo $contenido;
} else {
    http_response_code(404);
    echo "Archivo no encontrado.";
}
pg_free_result($res);
desconectar($conexion);
?>
