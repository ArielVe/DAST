<?php
include('../db/bancodedados.php');
include('../auth/controle.php');
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estiloPI.css">
    <title>Produto</title>
</head>
<body>
<div id="cor1">
    <h1>Pet Shop</h1>
    <h2>O lugar ideal para seu amiguinho!</h2>
</div>

<div id="img">
    <a href="/menu"><img id="logo" src="../imagem/kaninologo.png"></a>
</div>
<div id="cor2">
    <ul>
        <li><a href="../menu">Voltar</a></li>
        <li><a href="../user">Usuario</a></li>
        <li><a href="../cat">Categoria</a></li>
        <li><a id="prodt" href="../product">Produto</a></li>
        <li><a href="../?logout=1">Sair</a></li>
        <li>
            <div class="input-group input-group-lg">
                <input id="filtro" type="text" class="form-control" placeholder="Digite um produto" aria-label="Username" aria-describedby="sizing-addon1" style="width: auto;">
            </div>
        </li>
    </ul>
</div>

<div class="container">
    <div class="row">

        <?php
        $msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : false;
        $erro = isset($_SESSION['erro']) ? $_SESSION['erro'] : false;

        if ($msg) {
            echo "
                <div class='container' style='display: flex; justify-content: space-around;'>
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\" style='display: flex; height: 51px; width: auto;'> $msg
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                </div>
            ";
            unset($_SESSION['msg']);
            unset($msg);
        }
        if ($erro) {
            echo "
                <div class='container' style='display: flex; justify-content: space-around;'>
                    <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\" style='display: flex; height: 51px; width: auto;'> $erro
                        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                            <span aria-hidden=\"true\">&times;</span>
                        </button>
                    </div>
                </div>
            ";
            unset($_SESSION['erro']);
            unset($erro);
        }
        try {
            $consulta = odbc_exec($db, "SELECT idProduto, nomeProduto, descontoPromocao, precProduto, descProduto, idCategoria, idUsuario, ativoProduto, qtdMinEstoque, imagem FROM  Produto ORDER BY idProduto DESC");
            $numRegistros = odbc_num_rows($consulta);

        } catch (Exception $e) {
            die($e);
        }
        $i= 0;

        while ($produtos = odbc_fetch_array($consulta)) {
            ob_start();
            ob_flush();
            flush();
            $produtos['nomeProduto'] = utf8_encode((empty($produtos['nomeProduto'])) ? "Sem dados" : $produtos['nomeProduto']);
            $produtos['descProduto'] = utf8_encode((empty($produtos['descProduto'])) ? "Sem dados" : $produtos['descProduto']);
            $produtos['descontoPromocao'] = number_format($produtos['descontoPromocao'], 2, '.', '');
            $produtos['precProduto'] = number_format($produtos['precProduto'], 2, '.', '');
            $produtos['ativoProduto'] = ($produtos['ativoProduto'] == 1) ? "Sim" : "Não";
            $image64 = $produtos['imagem'];
            $image64 = base64_encode($image64);
            $image64 = "<img height=\"300\" width=\"auto\" src=\"data:image/jpeg;base64," . $image64 . "\">";
            $i++;
            ?>

            <div class="col-md-4 box-info">
                <div class="card">
                    <div class="card-image">
                        <?php echo $image64; ?>
                        <span class="card-title box-info--text"> <?php echo $produtos['nomeProduto']; ?> </span>
                    </div>

                    <div class="card-content">

                        <div class="input-group">
                            <span class="input-group-addon"><span>ID Produto</span></span>
                            <input type="text" value="<?php echo $produtos['idProduto']; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span>Preço</span></span>
                            <input type="text" value="<?php echo $produtos['precProduto']; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><span>Desconto</span></span>
                            <input type="text" value="<?php echo $produtos['descontoPromocao']; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span>Estoque</span></span>
                            <input type="text" value="<?php echo $produtos['qtdMinEstoque']; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span>Ativo/Desativo</span></span>
                            <input type="text" value="<?php echo $produtos['ativoProduto']; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo $produtos['descProduto']; ?>">
                            Descrição
                        </button>
                    </div>

                    <div class="card-action">
                        <?php $dataUpdate = $produtos; ?>
                        <a data-toggle="modal" data-target="#produtoUpdateModal<?php echo $i;?>" data-id="<?php echo $produtos['idProduto']; ?>" target="new_blank">EDITAR</a>
                        <form method="post">
                            <button type="submit" class='body-project--formbutton' value="<?php echo $produtos['idProduto']; ?>" name="id" formaction="product-delete.php" target="new_blank" style="color: #d9534f;">DELETAR</button>
                        </form>
                    </div>

                    <div class="row">
                        <div class="modal fade" id="produtoUpdateModal<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Produto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" class="form-control" id="recipient-name" value="<?php echo $produtos['idProduto']; ?>" name="idProduto" placeholder='EX: Produto Exemplo'>

                                            <div class="form-group">
                                                <label for="recipient-name" class="form-control-label">Nome:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?php echo $produtos['nomeProduto']; ?>" name="nomeProduto" placeholder='EX: Produto Exemplo'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Desconto Promoção:</label>
                                                <input type="number" step="any" class="form-control" id="recipient-name" value="<?php echo $produtos['descontoPromocao']; ?>" name="descontoPromocao" placeholder='EX: 1.00'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Preço:</label>
                                                <input type="number" step="any" class="form-control" id="recipient-name" value="<?php echo $produtos['precProduto']; ?>" name="precProduto" placeholder='EX: 1.00'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Descrição:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?php echo $produtos['descProduto']; ?>" name="descProduto" placeholder='EX: Descrição para o produto'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Categoria:</label>
                                                <select id="recipient-name" name="idCategoria" required="">
                                                    <option value="">Escolha</option>
                                                    <?php
                                                    $c = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
                                                    while($cat = odbc_fetch_array($c)){
                                                        $cat['nomeCategoria'] = utf8_encode($cat['nomeCategoria']);
                                                        $categorias[$cat['idCategoria']] = $cat;
                                                    }
                                                    foreach ($categorias as $idCategoria => $dadosCategoria) {
                                                        $utf_nomeCategoria = $dadosCategoria['nomeCategoria'];
                                                        $catSelecionada = $produtos['idCategoria']==$idCategoria ? 'selected' : '';
                                                        echo "<option value='$idCategoria' $catSelecionada>$utf_nomeCategoria</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Ativo/Desativado:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?php echo $produtos['ativoProduto']; ?>" name="ativoProduto">
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Estoque:</label>
                                                <input type="number" class="form-control" id="recipient-name" value="<?php echo $produtos['qtdMinEstoque']; ?>" name="qtdMinEstoque" placeholder='EX: 4'>
                                            </div>

                                            <div class="input-group input-file" name="Fichier1">
                                                <input type="file" class="form-control" name="imagem"/>
                                                <span class="input-group-btn"> </span>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <input type="submit" class="btn btn-danger" value="Editar" name="btnGravar" formaction='product-update.php'>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <?php
        }
        ?>
    </div>
</div>

<button id="novo" class='btn btn-danger' type='submit' data-toggle="modal" data-target="#produtoModal">Novo Produto</button>
<br>

<div class="row">
    <div class="modal fade" id="produtoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <?php
                        $userSession = $_SESSION['idUsuario'];
                        $user = odbc_exec($db, "SELECT idUsuario FROM Usuario WHERE idUsuario = $userSession");
                        $userId = odbc_fetch_array($user)['idUsuario'];

                        ?>
                        <input type="hidden" value="<?php echo $userId;?>" name="idUsuario">

                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Nome: </label>
                            <input type="text" class="form-control" id="recipient-name" name="nomeProduto" placeholder='EX: Produto Exemplo' value="BLALALA">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Desconto Promoção:</label>
                            <input type="number" step="any" class="form-control" id="recipient-name" name="descontoPromocao" placeholder='EX: 1.00' value="1">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Preço:</label>
                            <input type="number" step="any" class="form-control" id="recipient-name" name="precProduto" placeholder='EX: 1.00' value="21">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Descrição:</label>
                            <input type="text" class="form-control" id="recipient-name" name="descProduto" placeholder='EX: Descrição para o produto' value="BLALALA">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Categoria:</label>
                            <select id="recipient-name"  name="idCategoria">
                                <option value="">Escolha</option>
                                <?php
                                $c = odbc_exec($db, "SELECT idCategoria, nomeCategoria FROM Categoria");
                                while($cat = odbc_fetch_array($c)){
                                    $cat['nomeCategoria'] = utf8_encode($cat['nomeCategoria']);
                                    $categorias[$cat['idCategoria']] = $cat;
                                }
                                foreach ($categorias as $idCategoria => $dadosCategoria) {
                                    $utf_nomeCategoria = $dadosCategoria['nomeCategoria'];
                                    echo "<option value='$idCategoria'>$utf_nomeCategoria</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Estoque:</label>
                            <input type="number" class="form-control" id="recipient-name" name="qtdMinEstoque" placeholder='EX: 4' value="1">
                        </div>

                        <div class="input-group input-file" name="Fichier1">
                            <input type="file" class="form-control" name="imagem"/>
                            <span class="input-group-btn"> </span>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <input type="submit" class="btn btn-danger" style="background-color: #FFEA00" value="Adicionar novo produto"
                                   name="btnGravar" formaction='product-add.php'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../lib/bootstrap/js/jquery-3.2.1.min.js"></script>
<script src="../lib/bootstrap/js/tether.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/main.js"></script>

</body>
</html>
