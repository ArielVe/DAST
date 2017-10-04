<?php

$db_host = "project02.database.windows.net";
$db_name = "project02";
$db_user = "srcosta3306";
//include('senha.php');//
$db_pass = "Stapler03*";
$dsn = "Driver={SQL Server};Server=$db_host;Port=1433;Database=$db_name;";

if(!$db = odbc_connect($dsn, $db_user, $db_pass)){

	echo "ERRO AO CONECTAR AO BANCO DE DADOS";
	exit();
}
?>