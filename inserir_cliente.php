<?php

include 'conexao.php';  // Inclui o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json; charset=utf-8'); // Define o cabeçalho correto

    // Verifica se o telefone foi informado
    if (!isset($_POST['Telefone'])) {
        echo json_encode(['error' => 'Telefone não informado']);
        exit();
    }

    $telefone = $_POST['Telefone'];

    // Verificar se já existe o telefone no banco
    $sql = "SELECT Telefone FROM clientes WHERE Telefone = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $telefone);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {  // Telefone já existe
        echo json_encode(['error' => 'CLIENTE JÁ CADASTRADO!']);
    } else {
        // Receber os dados do formulário
        $nome = $_POST['nome'];
        $dataNascimento = $_POST['DataNascimento'];
        $statusDoCliente = $_POST['statuscliente'];

        // Query de inserção no banco de dados
        $stmt = $conexao->prepare("INSERT INTO clientes (nome, DataNascimento, Telefone, statuscliente) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $dataNascimento, $telefone, $statusDoCliente);

        if ($stmt->execute()) {
            // Pega o último ID inserido e retorna como JSON
            $ultimo_id = $conexao->insert_id;
            echo json_encode(['id' => $ultimo_id]); // Retorna o ID em formato JSON
            exit();
        } else {
            echo json_encode(['error' => $stmt->error]); // Retorna o erro em formato JSON
        }
    }

    // Fechar a conexão
    $stmt->close();
    $conexao->close();
}
?>
