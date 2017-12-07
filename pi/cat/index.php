<?php
include('../db/bancodedados.php');
include('../auth/controle.php');

//Funcionalidade Gravar Categoria
if(isset($_POST['btnGravar'])){
	unset($_GET['cadastrar']);
	if(	!empty($_POST['nomeCategoria'])){
		
		$stmt = odbc_prepare($db, "	INSERT INTO Categoria
									(nomeCategoria,
									descCategoria)
									VALUES
									(?,?)");
		if(odbc_execute($stmt, array(	utf8_decode($_POST['nomeCategoria']),
										utf8_decode($_POST['descCategoria'])))){
			$msg = 'Categoria gravada com sucesso!';
		}else{
			$erro = 'Erro ao gravar Categoria';
		}
							
	}else{
		
		$erro = 'O campo: Nome 
					&eacute; obrigat&oacute;rio';
		
	}
}
//FIM Funcionalidade Gravar Categoria

//Funcionalidade Editar Categoria
if(isset($_POST['btnAtualizar'])){
	unset($_GET['editar']);
	if(	!empty($_POST['nomeCategoria'])){
		
		$stmt = odbc_prepare($db, "	UPDATE 
										Categoria
									SET 
										nomeCategoria = ?,
										descCategoria = ?
									WHERE
										idCategoria = ?");
									
		if(odbc_execute($stmt, array(	utf8_decode($_POST['nomeCategoria']),
										utf8_decode($_POST['descCategoria']),
										$_POST['idCategoria']))){
			$msg = 'Categoria atualizada com sucesso!';			
		}else{
			$erro = 'Erro ao atualizar Categoria';
		}								
							
	}else{
		
		$erro = 'O campo: Nome 
					&eacute; obrigat&oacute;rio';
		
	}
}
//FIM Funcionalidade Editar Categoria

//Funcionalidade Excluir
if(isset($_GET['excluir'])){
	if(is_numeric($_GET['excluir'])){
		
		if(odbc_exec($db, "	DELETE FROM 
								Categoria 
							WHERE
								idCategoria = {$_GET['excluir']}")){
			$msg = 'Categoria removida com sucesso';						
		}else{
			$erro = 'Erro ao excluir Categoria';
		}
		
	}else{
		$erro = 'C&oacute;digo inv&aacute;lido';
	}
}
//FIM Funcionalidade Excluir
//Funcionalidade Listar
$q = odbc_exec($db, '	SELECT 	idCategoria, nomeCategoria,
								descCategoria
						FROM 
								Categoria
						ORDER BY idCategoria DESC');

while($r = odbc_fetch_array($q)){
	
	$categorias[$r['idCategoria']] = $r;
	
}
//FIM Funcionalidade Listar

if(isset($_GET['cadastrar'])){//FORM Cadastrar

	include('template_cadastrar.php');
	
}elseif(isset($_GET['editar'])){//FORM Editar

	if(is_numeric($_GET['editar'])){
		$q = odbc_exec($db, "	SELECT 	idCategoria, nomeCategoria,
										descCategoria
								FROM Categoria 
								WHERE idCategoria = {$_GET['editar']}");
		$dados_categoria = odbc_fetch_array($q);
	}else{
		$erro = 'Código inválido';
	}

	include('template_editar.php');
	
}else{//FORM Listar

	include('template.php');
	
}
?>