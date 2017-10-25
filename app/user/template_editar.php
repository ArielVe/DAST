<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/estiloPI.css">
	<title>Menu</title>
</head>
	<body> 
		<div id="cor1">
			<h1>Pet Shop</h1>
			<h2>O lugar ideal para seu amiguinho!</h2>
		</div>
		<div id="img">
			<a href="/menu" id="logo" src="/imagem/kaninologo.png"></a>
		</div>
		<div id="cor2">
			<ul>
				<li><a href="/menu">Voltar</a></li>
				<li><a id="user" href="/user">Usuario</a></li> 
				<li><a href="/cat">Categoria</a></li>  
				<li><a href="/product">Produto</a></li>  				
				<li><a href="/?logout=1">Sair</a></li> 
			</ul>
		</div>
		<div id="fundo">
			<div id="cor4"></div>
		</div>
		<div id="formulario">
			<form method="post">
			
				Login: <input type="text" 
						name="loginUsuario"
						value="<?php echo $dados_usuario['loginUsuario']; ?>"><br><br>
				Senha: <input type="password" name="senhaUsuario"><br><br>
				Nome: <input type="text" 
						name="nomeUsuario"
						value="<?php echo $dados_usuario['nomeUsuario']; ?>"><br><br>
				Perfil: <select name="tipoPerfil">
							<option value="">Escolha</option>
							<option value="A" 
							<?php if($dados_usuario['tipoPerfil'] == 'A') echo "selected"; ?>>Administrador</option>
							<option value="C"
							<?php if($dados_usuario['tipoPerfil'] == 'C') echo "selected"; ?>>Colaborador</option>
						</select><br><br>
				Ativo: <input type="checkbox" name="usuarioAtivo" 
						<?php if($dados_usuario['usuarioAtivo'] == 1) echo "checked"; ?>><br><br>
				<input type="hidden" name="idUsuario" value="<?php echo $dados_usuario['idUsuario']; ?>">
				<input type="submit" value="Atualizar" name="btnAtualizar">
			
			</form>
		</div>
	</body>
</html>
		