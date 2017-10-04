<html>
	<body>
		<br><br>
		<center>
		<form method="post">
			<?php
			if(isset($registro_para_editar)){
				echo "Editar o Nome: 
						<input 	type='text'
							name='nome_editar' 
							value='".utf8_encode($registro_para_editar['nome'])."'> 
						<input type='hidden' name='codigo' 
							value='{$registro_para_editar['codigo']}'>
						<input type='submit' value='Gravar'>";
			}else{
				echo 'Nome: <input type="text" name="nome"> 
					  <input type="submit" value="Enviar">';
			}
			?>
		</form>
		<br><br>

		<?php
		if(isset($str_nome)){
			echo "Nome enviado: $str_nome";			
		}
		?>
		<br><br>
		<h1>Nomes Gravados</h1>
		<br><br>
		<?php
		if(isset($apagar_msg)){
			echo "<b>$apagar_msg</b>";			
		}
		?>
		<table>
		<tr>
			<td>Código</td>
			<td>Nome</td>
			<td>Editar</td>
			<td>Apagar</td>
		</tr>
		<?php
		foreach($array_nomes as $num => $nome){
			
			echo "<tr>
					<td>$num</td>
					<td>$nome</td>
					<td><a href='?editar=$num'>e</a></td>
					<td><a href='?apagar=$num'>X</a></td>
				  </tr>";
			
		}
		?>
		</table>
		</center>
	</body>
</html>
