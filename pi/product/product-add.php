<?php
session_start();
include('../db/bancodedados.php');

$nomeProduto = $_POST['nomeProduto'];
$descontoPromocao = $_POST['descontoPromocao'];
$precProduto = $_POST['precProduto'];
$descProduto = $_POST['descProduto'];
$idCategoria = $_POST['idCategoria'];
$idUsuario = $_SESSION['idUsuario'];
$qtdMinEstoque = $_POST['qtdMinEstoque'];

//Cadastrar Nova Categoria
try {
        if (isset($_FILES['imagem'])) {


            $foto = $_FILES['imagem'];
            $nome = $foto['name'];
            $tipo = $foto['type'];
            $tamanho = $foto['size'];

            $arquivo = $foto['tmp_name'];
            $imagem = fopen($arquivo, "r");
            $fileParaDB = fread($imagem, filesize($arquivo));

            if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)) {
                $_SESSION['erro'] = 'Imagem com o formato inválido';
                header('Location: index.php');
            }
			
			$instrucaoSQL = "INSERT INTO Produto (nomeProduto, descontoPromocao, precProduto, descProduto, idCategoria, idUsuario, ativoProduto, qtdMinEstoque, imagem) VALUES (?,?,?,?,?,?,?,?,?)";

            $nomeProduto = utf8_decode($nomeProduto);
            $descProduto = utf8_decode($descProduto);
            /*print_r($descontoPromocao);
            exit();*/
            $precProduto = number_format($precProduto,2, '.', '');
            $descontoPromocao = number_format($descontoPromocao,2, '.', '');
            $ativoProduto = isset($ativo) ? true : false;

			$params = array($nomeProduto, $descontoPromocao, $precProduto, $descProduto, $idCategoria, $idUsuario, $ativoProduto, $qtdMinEstoque,$fileParaDB);
			$consulta = odbc_prepare($db, $instrucaoSQL);
            odbc_execute($consulta, $params);

            print_r($consulta);
            /*exit();*/

       	    $rows_affected = odbc_num_rows($consulta);

            if($rows_affected > 0){
                $_SESSION['msg'] = 'Produto adicionado com sucesso';
                header('Location: index.php');
            }else{
                $_SESSION['erro'] = 'Erro ao adicionar o produto';
                header('Location: index.php');
            }
    							
	   }else{
            $_SESSION['erro'] = 'Selecione uma imagem';
            header('Location: index.php');
        }

} catch (Exception $e) {
    $_SESSION['erro'] = 'Erro ao criar um produto';
    header('Location: index.php');
}


?>

