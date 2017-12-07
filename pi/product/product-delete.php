<?php
session_start();
include('../db/bancodedados.php');

$id = $_POST['id'];

try {

    unset($deletar);
    $instrucaoSQL = "DELETE FROM Produto WHERE idProduto = ?";
    $params = array( $id );
    $consulta = odbc_prepare($db, $instrucaoSQL);
    $product = odbc_execute($consulta, $params);
    $rows_affected = odbc_num_rows($consulta);

    if($rows_affected > 0){
        $_SESSION['msg'] = 'Produto deletado com sucesso';
		header('Location: index.php');
        
    }else{
        $_SESSION['erro'] = 'Erro ao deletar o produto';
		header('Location: index.php');
    }

} catch (Exception $e) {
    die($e);
    $_SESSION['erro'] = 'Erro ao deletar o produto';
	header('Location: index.php');
}
?>
