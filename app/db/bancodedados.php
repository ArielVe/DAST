<?php
$db_host = "dastmaster.database.windows.net";
$db_name = "dast";
$db_user = "dast";
$db_pass = "Ariel85391990";
$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";


if(!$db = odbc_connect($dsn, $db_user, $db_pass)){
	echo "ERRO AO CONECTAR AO BANCO DE DADOS";
	die("ERRO");
}
?>