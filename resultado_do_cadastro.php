<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $cliente = mysqli_fetch_assoc($resultado);

        // Verifique se os nomes dos campos correspondem ao que está no banco de dados
        echo "<h1>Cliente Cadastrado</h1>";
        echo "Nome: " . ($cliente['NOME'] ?? 'Nome não disponível') . "<br>";
        echo "Data de Nascimento: " . ($cliente['DataNascimento'] ?? 'Data de Nascimento não disponível') . "<br>";
        echo "Telefone: " . ($cliente['Telefone'] ?? 'Telefone não disponível') . "<br>";
        echo "Status do Cliente: " . ($cliente['statuscliente'] ?? 'Status não disponível') . "<br>";
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não fornecido.";
}

mysqli_close($conexao);
?>