
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";



// Criar a conexão
$conexao =  mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexao
if (!$conexao) {
  die("Conexão falhou: " . mysqli_connect_error());
}

?>
  




