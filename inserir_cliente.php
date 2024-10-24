<?php

include 'conexao.php';  // Inclui o arquivo de conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar se já existe o CPF no banco
    $pessoaFJ = $_POST['pessoaFJ'];

    $sql = "SELECT pessoaFJ FROM clientes WHERE pessoaFJ = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $pessoaFJ);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {  // CPF já existe
        echo "CPF JÁ CADASTRADO!<br>";
    } else {
        // Receber os dados do formulário
        $nome = $_POST['nome'];
        $statusDoCliente = $_POST['statuscliente'];

        // Query de inserção no banco de dados
        $stmt = $conexao->prepare("INSERT INTO clientes (nome, pessoaFJ, statuscliente) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $pessoaFJ, $statusDoCliente);

        if ($stmt->execute()) {
            // Pega o último ID inserido e redireciona para a página de resultado
            $ultimo_id = $conexao->insert_id;
            echo json_encode(['id' => $ultimo_id]); // Retorna o ID em formato JSON
            exit();
        } else {
            echo json_encode(['error' => $stmt->error]); // Retorna o erro em formato JSON
        }

        // Fechar a conexão
        $stmt->close();
        $conexao->close();
    }
}
?>
