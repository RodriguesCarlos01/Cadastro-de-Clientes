<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meubanco";



// Criar a conexão
$conexao =  mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexao
if(!$conexao){
  die("Conexão falhou: " . mysqli_connect_error());
}

echo "Conexâo efetuada com sucesso!>>>>>>>>>>>>>>>> ";

?>
  
</body>
</html>



