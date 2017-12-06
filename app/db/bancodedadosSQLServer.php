<?php
$dbhost = "dastmaster.database.windows.net";
$db = "dast";
$user = "dast";
$password = "Ariel85391990";
$conninfo = array("Database" => $db, "UID" => $user, "PWD" => $password);

if (!$conn = sqlsrv_connect($dbhost, $conninfo)) {
    die("Erro ao conectar ao banco de dados");
}
?>
