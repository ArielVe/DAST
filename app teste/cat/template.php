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
			<a href="/menu" id="logo" src="./imagem/kaninologo.png"></a>
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
		<a id="novo" href="?cadastrar=1">Nova Categoria</a>
		<br>
		<?php
		if(isset($msg))
			echo "	<h2><br><center><b><font color='green'>
					$msg</font></b></center><br></h2>";
		
		if(isset($erro))
			echo "	<h2><br><center><b><font color='red'>
					$erro</font></b></center><br></h2>";
		?>
		<br>
		<div id="tabela">
			<table>
				<tr>
					<td>ID</td>
					<td>Nome/Categoria</td>
					<td>Descrição</td>
					<td>Editar</td>
					<td>Excluir</td>
				</tr>
				<?php
				foreach($categorias as $idCategoria => $dadosCategoria){
					
					echo "	<tr>
								<td>$idCategoria</td>
								<td>{$dadosCategoria['nomeCategoria']}</td>
								<td>{$dadosCategoria['descCategoria']}</td>
								<td><a href='?editar=$idCategoria'>E</a></td>
								<td><a href='?excluir=$idCategoria'>X</a></td>
							</tr>";
					
				}
				?>
			</table>
		</div>
	</body>
</html>