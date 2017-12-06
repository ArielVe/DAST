<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/estiloPI.css">
	<title>Cadastrar</title>
</head>
	<body> 
		<div id="cor1">
			<h1>Pet Shop</h1>
			<h2>O lugar ideal para seu amiguinho!</h2>
		</div>
		<div id="img">
			<a href="/menu" id="logo" src="./imagem/kaninologo.png"></a>
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
				<label for="text" id="login" name="login">Login</label>
				<input type="text" id="login3" name="loginUsuario">
                <label for="text" id="senha" name="senha">Senha</label>
				<input type="password" id="senha3" name="senhaUsuario">
                <label for="text" id="nome" name="nome">Nome</label>
				<input type="text" id="nome3" name="nomeUsuario">
                <label for="text" id="perfil" name="perfil">Perfil</label>
					<select id="perfil3" name="tipoPerfil">
						<option value="">Escolha</option>
						<option value="A">Administrador</option>
						<option value="C">Colaborador</option>
					</select>
                <label for="text" id="ativo" name="ativo">Ativo</label>
				<input type="checkbox" id="ativo3" name="usuarioAtivo">
				<input type="submit" value="Gravar" id="button" name="btnGravar">
			
			</form>
		</div>
	</body>
</html>