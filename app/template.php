<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/estiloPI.css">
<title>Login</title>
</head>
<body>
	<div id="cor1">	
		<h1>Pet Shop</h1>
		<h2>O lugar ideal para seu amiguinho!</h2>
	</div>
	<div id="img">
		<a href="template.php"><img id="logo" src="imagem/kaninologo.png"></a>
	</div>
	<div id="cor2"></div>
	<div id="fundo">
		<div id="cor3"></div>
		<div id="cor4"></div>
		<img id="pet" src="imagem/pets.png">
		<img id="gato" src="imagem/gat.png">
	</div> 
	<h1>Login</h1>
	<div id="boxlogin">
		<div id="borda"></div>
		<div id="campos">
			<form method="POST">
				<label for="text" id="login">Login</label>
				<input type="text" id="login2" name="login" placeholder="Login...">
				<label for="text" id="senha">Senha</label>
				<input type="password" id="senha2" name="senha" placeholder="Senha...">
				<input type="submit" value="Entrar" id="button">
				<?php
				if(isset($msg)){
					echo "<center><b>$msg</b></center>";					
				}
				?>
			</form>
		</div>
	</div>
</body>
</html>