<?php
include('../db/bancodedados.php');
include('../auth/controle.php');

//Funcionalidade Gravar Cadastro
if(isset($_POST['btnGravar'])){
	unset($_GET['cadastrar']);
	if(	!empty($_POST['loginUsuario']) &&
		!empty($_POST['nomeUsuario']) &&
		!empty($_POST['senhaUsuario'])){

		$_POST['usuarioAtivo'] = isset($_POST['usuarioAtivo']) ? true : false;

		$stmt = odbc_prepare($db, "INSERT INTO Usuario
									(loginUsuario,
									nomeUsuario,
									senhaUsuario,
									tipoPerfil,
									usuarioAtivo)
									VALUES
									(?,?,?,?,?)");
		if(odbc_execute($stmt, array(	utf8_decode($_POST['loginUsuario']),
										utf8_decode($_POST['nomeUsuario']),
										$_POST['senhaUsuario'],
										$_POST['tipoPerfil'],
										$_POST['usuarioAtivo']))){
			$msg = 'Usuário gravado com sucesso!';
		}else{
			$erro = 'Erro ao gravar o usuário';
		}

	}else{

		$erro = 'Os campos: Login, Nome e Senha s&atilde;o obrigat&oacute;rios';

	}
}
//FIM Funcionalidade Gravar Cadastro

//Funcionalidade Editar Cadastro
if(isset($_POST['btnAtualizar'])){
	unset($_GET['editar']);
	if(	!empty($_POST['loginUsuario']) &&
		!empty($_POST['nomeUsuario'])){

		$_POST['usuarioAtivo'] =
			isset($_POST['usuarioAtivo']) ? true : false;

		$odbcUser = odbc_prepare($db, "	UPDATE 
										Usuario
									SET 
										loginUsuario = ?,
										nomeUsuario = ?,
										tipoPerfil = ?,
										usuarioAtivo = ?
									WHERE
										idUsuario = ?");
		$userUpdate = odbc_execute($odbcUser, array(
			utf8_decode($_POST['loginUsuario']),
			utf8_decode($_POST['nomeUsuario']),
			$_POST['tipoPerfil'],
			$_POST['usuarioAtivo'],
			$_POST['idUsuario'])
		);
		if(	!empty($_POST['senhaUsuario']) ){
			$odbcSenha = odbc_prepare($db, "	UPDATE 
											Usuario
										SET 
											senhaUsuario = ?
										WHERE
											idUsuario = ?");

			$userSenha = odbc_execute($odbcSenha, array(
				$_POST['senhaUsuario'],
				$_POST['idUsuario'])
			);
		}

		if($userUpdate){
			$msg = 'Usu&aacute;rio atualizado com sucesso!';
		}else{
			$erro = 'Erro ao atualizar o usu&aacute;rio';
		}

	}else{

		$erro = 'Os campos: Login, Nome e Senha s&atilde;o obrigat&oacute;rios';

	}
}
//FIM Funcionalidade Editar Cadastro

//Funcionalidade Excluir
if(isset($_GET['excluir'])){
	if(is_numeric($_GET['excluir'])){

		if(odbc_exec($db, "	DELETE FROM 
								Usuario 
							WHERE
								idUsuario = {$_GET['excluir']}")){
			$msg = 'Usu&aacute;rio removido com sucesso';
		}else{
			$erro = 'Erro ao excluir o usu&aacute;rio';
		}

	}else{
		$erro = 'C&oacute;digo inv&aacute;lido';
	}
}
//FIM Funcionalidade Excluir
//Funcionalidade Listar
$q = odbc_exec($db, '	SELECT 	idUsuario, loginUsuario,
								nomeUsuario, tipoPerfil, 
								usuarioAtivo
						FROM 
								Usuario
						ORDER BY idUsuario DESC');

while($r = odbc_fetch_array($q)){

	$usuarios[$r['idUsuario']] = $r;

}
//FIM Funcionalidade Listar

if(isset($_GET['cadastrar'])){//FORM Cadastrar

	include('template_cadastrar.php');

}elseif(isset($_GET['editar'])){//FORM Editar

	if(is_numeric($_GET['editar'])){
		$q = odbc_exec($db, "	SELECT 	idUsuario, loginUsuario,
										nomeUsuario, tipoPerfil, 
										usuarioAtivo
								FROM Usuario 
								WHERE idUsuario = {$_GET['editar']}");
		$dados_usuario = odbc_fetch_array($q);
	}else{
		$erro = 'Código inválido';
	}

	include('template_editar.php');

}else{//FORM Listar

	include('template.php');

}
?>