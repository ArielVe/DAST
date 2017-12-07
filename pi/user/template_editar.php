<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/estiloPI.css">
	<title>Editar</title>
</head>
	<body> 
		<div id="cor1">
			<h1>Pet Shop</h1>
			<h2>O lugar ideal para seu amiguinho!</h2>
		</div>
		<div id="img">
			<a href="/menu"><img id="logo" src="../imagem/kaninologo.png"></a>
		</div>
		<div id="cor2">
			<ul>
				<li><a href="../menu">Voltar</a></li>
				<li><a id="user" href="../user">Usuario</a></li> 
				<li><a href="../cat">Categoria</a></li>  
				<li><a href="../product">Produto</a></li>  				
				<li><a href="../?logout=1">Sair</a></li> 
			</ul>
		</div>
		<div id="fundo">
			<div id="cor4"></div>
		</div>
		<div id="formulario">
			<form method="post">
				<label for="text" id="login" name="login">Login</label>
				<input type="text" id="login3" name="loginUsuario" value="<?php echo utf8_encode($dados_usuario['loginUsuario']); ?>">
                <label for="text" id="senha" name="senha">Senha</label>
				<input type="password" id="senha3" name="senhaUsuario">
                <label for="text" id="nome" name="nome">Nome</label>
				<input type="text" id="nome3" name="nomeUsuario" value="<?php echo utf8_encode($dados_usuario['nomeUsuario']); ?>">
                <label for="text" id="perfil" name="perfil">Perfil</label>
					<select id="perfil3" name="tipoPerfil">
						<option value="">Escolha</option>
						<option value="A" 
						<?php if($dados_usuario['tipoPerfil'] == 'A') echo "selected"; ?>>Administrador</option>
						<option value="C"
						<?php if($dados_usuario['tipoPerfil'] == 'C') echo "selected"; ?>>Colaborador</option>
					</select>
                <label for="text" id="ativo" name="ativo">Ativo</label>
				<input type="checkbox" id="ativo3" name="usuarioAtivo" 
					<?php if($dados_usuario['usuarioAtivo'] == 1) echo "checked"; ?>>
				<input type="hidden" name="idUsuario" value="<?php echo $dados_usuario['idUsuario']; ?>">
				<input type="submit" value="Atualizar" id="button" name="btnAtualizar">
			
			</form>
		</div>
	</body>
</html>
		