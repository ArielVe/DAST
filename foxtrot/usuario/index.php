<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('bancodedados.php');

if(isset($_POST['nome'])){
	
	$str_nome = $_POST['nome'];
	
	$nome_iso = utf8_decode($_POST['nome']);
    
	$stmt = odbc_prepare($db, '	INSERT INTO 
									tb_teste (nome) 
								VALUES 
									(?)');	
	odbc_execute($stmt, array($nome_iso));
				
}

//Consulta para Apagar
if(isset($_GET['apagar'])){
	
	if(is_numeric($_GET['apagar'])){
		
		if(odbc_exec($db, "	DELETE 
							FROM 
								tb_teste 
							WHERE 
								codigo = {$_GET['apagar']}")){
									
			$apagar_msg = 'Registro apagado com sucesso!';						
		}else{
			$apagar_msg = 'Erro ao apagar o registro';
		}
		
	}
	
}

//Consulta UPDATE
if(isset($_POST['nome_editar'])){
	
	$nome = utf8_decode($_POST['nome_editar']);
	$codigo = $_POST['codigo'];
	
	$stmt = odbc_prepare($db, '	UPDATE 
									tb_teste 
								SET
									nome = ?
								WHERE
									codigo = ?');	
	odbc_execute($stmt, array($nome, $codigo));
	
	if(isset($_GET['editar']))
		unset($_GET['editar']);
	
}

//Lógica para mostrar o form para editar
if(isset($_GET['editar'])){
	
	if(is_numeric($_GET['editar'])){
		
		$query = odbc_exec($db, 'SELECT 
									codigo, nome 
								FROM 
									tb_teste
								WHERE 
									codigo = '.$_GET['editar']);
		$registro_para_editar = odbc_fetch_array($query);
		
	}
}

//Consulta para Listar	
$array_nomes = array();
	
$query = odbc_exec($db, 'SELECT codigo, nome FROM tb_teste');

while($registro = odbc_fetch_array($query)){

	$array_nomes[$registro['codigo']] = utf8_encode($registro['nome']);
	
}

include('template.php');

?>