<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/estiloPI.css">
	<title>Produto</title>
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
				<li><a href="../menu">Voltar</a></li>
				<li><a href="../user">Usuario</a></li> 
				<li><a href="../cat">Categoria</a></li>  
				<li><a id="user" href="../product">Produto</a></li>  				
				<li><a href="/?logout=1">Sair</a></li> 
			</ul>
		</div>
		<div id="fundo">
			<div id="cor4"></div>
		</div>
		<a id="novo" href="?cadastrar=1">Novo Produto</a>
		<br>
		<div>
			<form method="GET" enctype="multipart/form-data">
				<input type="text" name="buscar" id="buscar" placeholder="Buscar...">
				<input type="submit" id="consulta" value="Buscar">
			</form>
		</div>
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
					<td>Categoria</td>
					<td>Nome</td>
					<td>Pre&ccedil;o</td>
					<td>Ativo</td>
					<td>Descri&ccedil;&atilde;o</td>
					<td>Desconto</td>
					<td>QTD Estoque</td>
					<td>Editado por</td>					
					<td>Imagem</td>
					<td>Editar</td>
					<td>Excluir</td>
				</tr>
				<?php

				foreach($produtos as $idProduto => $dadosProduto){

					$imagem = $dadosProduto['imagem'];
					$imagem = base64_encode($imagem);
					$imagem = "<img src=\"data:image/jpeg;base64,".$imagem."\">";
					
					$q = odbc_exec($db, 'SELECT idCategoria, 
												nomeCategoria 
										 FROM 
												Categoria');
														
							$info_categoria = array();
								
							while ($resultado = odbc_fetch_array($q)) {
								$resultado['nomeCategoria'] = utf8_decode($resultado['nomeCategoria']);
								$info_categoria[$resultado['idCategoria']] = $resultado['nomeCategoria'];	
							}

							foreach ($info_categoria as $id => $nome) {		
								$cate = "$nome";					
							}

							$q = odbc_exec($db, 'SELECT idUsuario, 
														nomeUsuario 
										 		FROM 
														Usuario');
														
							$info_usuario = array();
								
							while ($resultado = odbc_fetch_array($q)) {
								$resultado['nomeUsuario'] = utf8_decode($resultado['nomeUsuario']);
								$info_usuario[$resultado['idUsuario']] = $resultado['nomeUsuario'];	
							}

							foreach ($info_usuario as $id => $nome) {		
								$use = "$nome";					
							}

						echo "	<tr>
									<td>$idProduto</td>
									<td>$cate</td>
									<td>{$dadosProduto['nomeProduto']}</td>
									<td>{$dadosProduto['precProduto']}</td>
									<td>{$dadosProduto['ativoProduto']}</td>
									<td>{$dadosProduto['descProduto']}</td>
									<td>{$dadosProduto['descontoPromo']}</td>
									<td>{$dadosProduto['qtdMinEstoque']}</td>
									<td>$use</td>
									<td id='lista'>$imagem</td>
									<td><a href='?editar=$idProduto'>E</a></td>
									<td><a href='?excluir=$idProduto'>X</a></td>
								</tr>";
					
				}
				?>
			</table>
		</div>
	</body>
</html>
		