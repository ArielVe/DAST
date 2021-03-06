<?php
session_start();
include('../db/bancodedados.php');

$idProduto = $_POST['idProduto'];
$nomeProduto = $_POST['nomeProduto'];
$descontoPromocao = $_POST['descontoPromocao'];
$precProduto = $_POST['precProduto'];
$descProduto = $_POST['descProduto'];
$idCategoria = $_POST['idCategoria'];
$idUsuario = $_SESSION['idUsuario'];
$qtdMinEstoque = $_POST['qtdMinEstoque'];
$ativoProduto = $_POST['ativoProduto'];

/*var_dump($_FILES['imagem']['size']>0);
    exit();*/
//Cadastrar Nova Categoria
try {
    if ($_FILES['imagem']['size']>0) {


        $foto = $_FILES['imagem'];
        $nome = $foto['name'];
        $tipo = $foto['type'];
        $tamanho = $foto['size'];

        $arquivo = $foto['tmp_name'];
        $imagem = fopen($arquivo, "r");
        $fileParaDB = fread($imagem, filesize($arquivo));

        if(!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo)) {
            $_SESSION['erro'] = 'Imagem com o formato inválido';
            //header('Location: /management-page-structure/product-management.php');
        }

        $instrucaoSQL = "UPDATE Produto SET nomeProduto = ?, descontoPromocao = ?,precProduto = ?,descProduto = ?,idCategoria = ?,idUsuario = ?,ativoProduto = ?,qtdMinEstoque = ?, imagem = ? WHERE idProduto = ?";

        $nomeProduto = utf8_decode($nomeProduto);
        $descProduto = utf8_decode($descProduto);
        $precProduto = number_format($precProduto,2, '.', '');
        $descontoPromocao = number_format($descontoPromocao,2, '.', '');
        $ativoProduto = ($ativoProduto=='Sim') ? 1 : 0;

        $params = array($nomeProduto, $descontoPromocao, $precProduto, $descProduto, $idCategoria, $idUsuario, $ativoProduto, $qtdMinEstoque,$fileParaDB,$idProduto);

        $consulta = odbc_prepare($db, $instrucaoSQL);
        $product = odbc_execute($consulta, $params);

        $rows_affected = odbc_num_rows($consulta);
        $odbc_error = str_replace('[Microsoft][ODBC SQL Server Driver][SQL Server]', '', odbc_errormsg($db));

        if($rows_affected > 0){
            if($odbc_error) {
                $_SESSION['erro'] = $odbc_error;
            } else {
                $_SESSION['msg'] = 'Produto editado com sucesso';
            }
            header('Location: index.php');
        }else{
            $_SESSION['erro'] = 'Erro ao adicionar o produto';
            header('Location: index.php');
        }

    }else{
		
        $instrucaoSQL = "UPDATE Produto SET nomeProduto = ?, descontoPromocao = ?,precProduto = ?,descProduto = ?,idCategoria = ?,idUsuario = ?,ativoProduto = ?,qtdMinEstoque = ? WHERE idProduto = ?";

        $nomeProduto = utf8_decode($nomeProduto);
        $descProduto = utf8_decode($descProduto);
        $precProduto = number_format($precProduto,2, '.', '');
        $descontoPromocao = number_format($descontoPromocao,2, '.', '');
        $ativoProduto = ($ativoProduto=='Sim') ? 1 : 0;

        $params = array($nomeProduto, $descontoPromocao, $precProduto, $descProduto, $idCategoria, $idUsuario, $ativoProduto, $qtdMinEstoque, $idProduto);

        $consulta = odbc_prepare($db, $instrucaoSQL);
        $product = odbc_execute($consulta, $params);

        $rows_affected = odbc_num_rows($consulta);

        if($rows_affected > 0){
            $_SESSION['msg'] = 'Produto editado com sucesso';
            header('Location: index.php');
        }else{
            $_SESSION['erro'] = 'Erro ao editar o produto';
            header('Location: index.php');
        }
    }

} catch (Exception $e) {
    $_SESSION['erro'] = 'Erro ao editar um produto';
    header('Location: index.php');
}


?>
