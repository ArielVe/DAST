<?php
ini_set('odbc.defaultlrl', 90000000);

$db_host = "kanino-pi.database.windows.net";
$db_name = "kanino";
$db_user = "TSI";
$db_pass = "SistemasInternet123";
$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

if(!$db = odbc_connect($dsn, $db_user, $db_pass)){
	echo "ERRO AO CONECTAR AO BANCO DE DADOS";
	die("ERRO");
}
?>