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
				<li><a href="/user">Usuario</a></li> 
				<li><a id="cat" href="/cat">Categoria</a></li>  
				<li><a href="/product">Produto</a></li>  				
				<li><a href="/?logout=1">Sair</a></li> 
			</ul>
		</div>
		<div id="fundo">
			<div id="cor4"></div>
		</div>
		<div id="formulario">
			<form method="post">
			
				Nome/Categoria: <input type="text" 
						name="nomeCategoria"
						value="<?php echo $dados_categoria['nomeCategoria']; ?>">
				Descrição: <input type="textarea" 
						name="descCategoria"
						value="<?php echo $dados_categoria['descCategoria']; ?>">
				<input type="hidden" name="idCategoria" value="<?php echo $dados_categoria['idCategoria']; ?>">
				<input type="submit" value="Atualizar" name="btnAtualizar">
			
			</form>
		</div>
	</body>
</html>
		