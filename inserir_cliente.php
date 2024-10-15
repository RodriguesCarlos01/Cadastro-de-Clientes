<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

include 'conexao.php';  // Inclui o arquivo de conexão.

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Verificar se já existe
    $pessoaFJ = $_POST['pessoaFJ'];
    $pessoaFJ = mysqli_real_escape_string($conexao, $pessoaFJ);
    $sql = "SELECT pessoaFJ FROM meubanco.clientes WHERE pessoaFJ='$pessoaFJ'";
    $retorno = mysqli_query($conexao,$sql); 

    if(mysqli_num_rows($retorno)>0){   // Aqui estou verificando se ja exite o cpf nos cadastros
        echo"CPF JÁ CADASTRADO!<br>";
    }else{
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $pessoaFJ = $_POST['pessoaFJ'];
    $statusDoCliente = $_POST['statuscliente'];


    // Query de inserção no banco de dados
    $stmt = $conexao->prepare("INSERT INTO clientes ( nome, pessoaFJ, statuscliente) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sss", $nome, $pessoaFJ, $statusDoCliente); // "sss" significa que são três strings
      
    if ($stmt->execute()){
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Error ao cadastrar usuário: " . mysqli_connect_error($conexao);
    }
      
    // Fechar a conexão
    $stmt->close();
    $conexao->close();

    }

    
}
?>
    
</body>
</html>


    
