<?php include('../db/bancodedados.php'); ?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/estiloPI.css">
	<title>Editar</title>
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
				<li><a id="user" href="../user">Usuario</a></li> 
				<li><a href="../cat">Categoria</a></li>  
				<li><a href="../product">Produto</a></li>  				
				<li><a href="/?logout=1">Sair</a></li> 
			</ul>
		</div>
		<div id="fundo">
			<div id="cor4"></div>
		</div>
		<div id="formulario">
			<form method="post" enctype="multipart/form-data">
                <label for="text" id="nome" name="nome">Nome</label>
				<input type="text" id="nome3" name="nomeProduto" value="<?php echo $dados_produto['nomeProduto']; ?>">
                <label for="text" id="preco" name="preco">Pre&ccedil;o</label>
				<input type="money_format" id="preco3" name="precProduto" value="<?php echo $dados_produto['precProduto']; ?>">
                <label for="text" id="ativo" name="ativo">Ativo</label>
				<input type="checkbox" id="ativo3" name="ativoProduto" <?php if($dados_produto['ativoProduto'] == 1) echo "checked"; ?>>
				<label for="text" id="desc">Descrição</label>
				<input type="textarea" id="desc3" name="descProduto" value="<?php echo $dados_produto['descProduto']; ?>">
				<label for="text" id="desconto" name="desconto">Desconto Promocional</label>
				<input type="money_format" id="desconto3" name="descontoPromo" value="<?php echo $dados_produto['descontoPromo']; ?>">		
				<label for="text" id="estoque" name="estoque">Quantidade em Estoque</label>
				<input type="number_format" id="estique3" name="qtdMinEstoque" value="<?php echo $dados_produto['qtdMinEstoque']; ?>">
				<label id="categoria">Categoria</label>
					<select><?php
															
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
													
											if ($dados_produto['idCategoria'] == $id) {
												echo "<option selected>$nome</option>";
											} else {
												echo "<option>$nome</option>";	
											}
										}
							?>				
					</select>	
				<label id="usuario">Editado por</label>
					<select><?php
								include('../db/bancodedados.php');
								
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
												
											if ($dados_produto['idUsuario'] == $id) {
												echo "<option selected>$nome</option>";
											} else {
												echo "<option>$nome</option>";	
											}
										}
							?>				
					</select>
				<label for="imagem" id="imagem" name="imagem">Imagem Produto</label>
				<input type="file" name="imagem" value="<?php echo $dados_produto['imagem']; ?>">	
				<input type="hidden" name="idProduto" value="<?php echo $dados_produto['idProduto']; ?>">
				<input type="submit" value="Atualizar" id="button" name="btnAtualizar">
			
			</form>
		</div>
	</body>
</html>
		