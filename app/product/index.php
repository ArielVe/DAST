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
        <li><a href="/?logout=1">Sair</a></li>
        <li>
            <div class="input-group input-group-lg">
                <input id="filtro" type="text" class="form-control" placeholder="Digite um produto" aria-label="Username" aria-describedby="sizing-addon1" style="width: auto;">
            </div>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <div class="row">

        <?php include('../db/bancodedadosSQLServer.php');
        session_start();
        $msg = $_SESSION['msg'];
        $erro = $_SESSION['erro'];

        if (isset($msg)) {
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
        if (isset($erro)) {
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
            $instrucaoSQL = "SELECT idProduto, nomeProduto, descontoPromocao, precProduto, descProduto, idCategoria, idUsuario, ativoProduto, qtdMinEstoque, imagem FROM  Produto";
            $consulta = sqlsrv_query($conn, $instrucaoSQL);
            $numRegistros = sqlsrv_num_rows($consulta);

        } catch (Exception $e) {
            die($e);
        }
        $i= 0;
        while ($produtos = sqlsrv_fetch_array($consulta, SQLSRV_FETCH_NUMERIC)) {

            ob_start();
            ob_flush();
            flush();

            $produtos[1] = utf8_encode((empty($produtos[1])) ? "Sem dados" : $produtos[1]);
            $produtos[2] = utf8_encode((empty($produtos[2])) ? "Sem dados" : $produtos[2]);
            $produtos[4] = utf8_encode((empty($produtos[4])) ? "Sem dados" : $produtos[4]);
            $produtos[2] = number_format($produtos[2],2, '.', '');
            $produtos[3] = number_format($produtos[3],2, '.', '');
            $produtos[7] = ($produtos[7] == 1) ? "Sim" : "Não";
            $image64 = $produtos[9];
            $image64 = base64_encode($image64);
            $image64 = "<img src=\"data:image/jpeg;base64," . $image64 . "\">";
            $i++;
            ?>

            <div class="col-md-4 box-info">
                <div class="card">
                    <div class="card-image">
                        <?php echo $image64; ?>
                        <span class="card-title box-info--text"> <?php echo $produtos[1]; ?> </span>
                    </div>

                    <div class="card-content">

                        <div class="input-group">
                            <span class="input-group-addon"><span>ID Produto</span></span>
                            <input type="text" value="<?php echo $produtos[0]; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span>Preço</span></span>
                            <input type="text" value="<?php echo $produtos[3]; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><span>Desconto</span></span>
                            <input type="text" value="<?php echo $produtos[2]; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span>Estoque</span></span>
                            <input type="text" value="<?php echo $produtos[8]; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><span>Ativo/Desativo</span></span>
                            <input type="text" value="<?php echo $produtos[7]; ?>" class="form-control" aria-hidden="true" readonly="readonly">
                        </div>

                        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="right" data-content="<?php echo $produtos[4]; ?>">
                            Descrição
                        </button>
                    </div>

                    <div class="card-action">
                        <a data-toggle="modal" data-target="#produtoUpdateModal<?php echo $i;?>" data-id="<?= $dataUpdate = $produtos; ?>"  href="template.php" target="new_blank">EDITAR</a>
                        <form method="post">
                            <button type="submit" class='body-project--formbutton' value="<?= $produtos[0]; ?>" name="id" formaction="product-delete.php" target="new_blank" style="color: #d9534f;">DELETAR</button>
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
                                    <div class="modal-body">
                                        <form method="POST">

                                            <div class="form-group">
                                                <label for="recipient-name" class="form-control-label">ID:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?= $dataUpdate[0]; ?>" name="idProduto" placeholder='EX: Produto Exemplo'>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name" class="form-control-label">Nome:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?= $dataUpdate[1]; ?>" name="nomeProduto" placeholder='EX: Produto Exemplo'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Desconto Promoção:</label>
                                                <input type="number" step="any" class="form-control" id="recipient-name" value="<?= $dataUpdate[2]; ?>" name="descontoPromocao" placeholder='EX: 1.00'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Preço:</label>
                                                <input type="number" step="any" class="form-control" id="recipient-name" value="<?= $dataUpdate[3]; ?>" name="precProduto" placeholder='EX: 1.00'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Descrição:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?= $dataUpdate[4]; ?>" name="descProduto" placeholder='EX: Descrição para o produto'>
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Categoria:</label>
                                                <select id="recipient-name"  name="idCategoria">
                                                    <option value="">Escolha</option>
                                                    <?php
                                                    $c = sqlsrv_query($conn, 'SELECT idCategoria, nomeCategoria FROM Categoria');
                                                    while($cat = sqlsrv_fetch_array($c)){
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
                                                <label for="message-text" class="form-control-label">Ativo/Desativado:</label>
                                                <input type="text" class="form-control" id="recipient-name" value="<?= $dataUpdate[7]; ?>" name="ativoProduto">
                                            </div>

                                            <div class="form-group">
                                                <label for="message-text" class="form-control-label">Estoque:</label>
                                                <input type="number" class="form-control" id="recipient-name" value="<?= $dataUpdate[8]; ?>" name="qtdMinEstoque" placeholder='EX: 4'>
                                            </div>

                                            <div class="input-group input-file" name="Fichier1">
                                                <input type="file" class="form-control" name="imagem"/>
                                                <span class="input-group-btn"> </span>
                                            </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <input type="submit" class="btn btn-danger" value="Editar" name="btnGravar"   formaction='../code/produto/product-update.php'>
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


                        <div class="form-group">
                            <label for="recipient-name" class="form-control-label">Nome:</label>
                            <input type="text" class="form-control" id="recipient-name" name="nomeProduto" placeholder='EX: Produto Exemplo'>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Desconto Promoção:</label>
                            <input type="number" step="any" class="form-control" id="recipient-name" name="descontoPromocao"placeholder='EX: 1.00'>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Preço:</label>
                            <input type="number" step="any" class="form-control" id="recipient-name" name="precProduto" placeholder='EX: 1.00'>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Descrição:</label>
                            <input type="text" class="form-control" id="recipient-name" name="descProduto" placeholder='EX: Descrição para o produto'>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Categoria:</label>
                            <select id="recipient-name"  name="idCategoria">
                                <option value="">Escolha</option>
                                <?php
                                $c = sqlsrv_query($conn, 'SELECT idCategoria, nomeCategoria FROM Categoria');
                                while($cat = sqlsrv_fetch_array($c)){
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
                            <label for="message-text" class="form-control-label">Usuário:</label>
                            <input type="text" class="form-control" id="recipient-name" value="1" name="idUsuario">
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="form-control-label">Estoque:</label>
                            <input type="number" class="form-control" id="recipient-name" name="qtdMinEstoque" placeholder='EX: 4'>
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
