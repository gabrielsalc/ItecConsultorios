<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

include_once('../php/funciones.php');
$conexion = conectar();

$sql = "SELECT titulo, extens, archiv FROM estudiosarchivos WHERE idarchiv = $1";
$res = pg_query_params($conexion, $sql, [$id]);

if ($row = pg_fetch_assoc($res)) {
    $nombre = $row['titulo'];
    $ext = strtolower($row['extens']);
    $contenido = pg_unescape_bytea($row['archiv']);

    $mime = match ($ext) {
        '.pdf' => 'application/pdf',
        '.jpg', '.jpeg' => 'image/jpeg',
        '.png' => 'image/png',
        '.doc', '.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        '.xls', '.xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        default => 'application/octet-stream',
    };

    header("Content-Type: $mime");
    header("Content-Disposition: inline; filename=\"$nombre$ext\"");
    echo $contenido;
} else {
    http_response_code(404);
    echo "Archivo no encontrado.";
}
pg_free_result($res);
desconectar($conexion);
?>