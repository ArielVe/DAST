<?php

//adiciona a data de hoje - Olá, hoje é 24/10/2017
echo "Olá, hoje é ".(new \DateTime())->format('d/m/Y');
?>


<?php
//paginaçao - DEV MEDIA
//primeiro crealizar a conexão com o banco de dados
$conn = mysql_connect("host","usuario","senha");
$db = mysql_select_db("bancodedados");
?>

<?php
//criar a clausula de SQL que deve ser executada
$busca="SELECT * FROM tabelax";
?>

<?php
//total de itens por página
$total_reg = "10"; //número de registros por página
?>
<?php
//se a página não for especificada a variavel "pagina" tomará o valor 1, para não aparecer a página 0 no início
$pagina=$_GET['pagina'];
if(!$pagina){
	$pc="1";
} else{
	$pc=$pagina;
}
?>

<?php
//determinar o valor inicialdas buscas limitadas
$inicio = $pc - 1;
$inicio = $inicio * $total_reg;
?>
<?php
//selecionar os dados e exibir paginação
$limite= mysql_query("busca LIMIT $inicio, $total_reg");
$todos=mysql_query("$busca");

$tr = mysql_num_rows($todos); // verifica o número total de registros
$tp = $tr / $total_reg; // verifica o número total de páginas

// vamos criar a visualização
  while ($dados = mysql_fetch_array($limite)) {
  $nome = $dados["nome"];
  echo "Nome: $nome<br>";
  }

  // agora vamos criar os botões "Anterior e próximo"
  $anterior = $pc -1;
  $proximo = $pc +1;
  if ($pc>1) {
  echo " <a href='?pagina=$anterior'><- Anterior</a> ";
  }
  echo "|";
  if ($pc<$tp) {
  echo " <a href='?pagina=$proximo'>Próxima -></a>";
  }
  //precisa fazer adaptação ao nosso modelo, depois da criação do banco de dados de produtos.
?>



