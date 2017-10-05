<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="estiloPI.css">
<title>Login</title>
</head>
<body>
	<div id="cor1"></div>
	<div id="cor2"></div>
	<h1>Login</h1>
	<div id="boxlogin">
		<div id="borda1"></div>
		<div id="borda2"></div>
		<div id="borda3">
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
		<div id="borda4"></div>
		<div id="borda5"></div>
		<div id="img">
			<img id="logo" src="LogoFoxtrot.jpg">
		</div>
	</div>
</body>
<footer>
	<div id="cor3"></div>
	<div id="cor4"></div>
</footer>
</html>