<?php
// Inclui a conexão com o banco de dados
include 'conexao.php';

// Verifica se o ID foi passado na URL
if (isset($_GET['id'])) {
    // Sanitiza a entrada pra evitar injeção SQL
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Cria a query SQL para buscar os dados do cliente
    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se encontrou o cliente
    if (mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_assoc($resultado);

        //Exibe os dados do cliente, tratando valores nulos ou ausentes
        echo "<h1>Cliente Cadastrado</h1>";
        echo "Nome: " . $cliente['NOME'] ?? 'Nome não disponível' . "<br>";
        echo "CPF: " . $cliente['pessoaFJ'] ?? 'CPF não disponível' . "<br>";
        echo "Status do Cliente: " . $cliente['statuscliente'] ?? 'Status não disponível' . "<br>";
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não fornecido.";
}

// Fecha a conexão com o banco
mysqli_close($conexao);
