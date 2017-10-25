<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/estiloPI.css">
	<title>Categoria</title>
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
			
				Nome/Categoria: <input type="text" name="nomeCategoria"><br><br>
				Descrição: <input type="textarea" name="descCategoria"><br><br>
				<input type="submit" value="Gravar" name="btnGravar">
			
			</form>
		</div>
	</body>
</html>