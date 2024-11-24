<?php
require_once 'db_perguntas.php'; // Inclui a conexão com o banco de dados

$mensagem = null; // Variável para armazenar a mensagem de feedback

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza e valida os dados recebidos
    $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
    $status = isset($_POST['status']) ? true : false;

    if (!empty($texto)) {
        try {
            // Insere os dados na tabela "perguntas"
            $stmt = $pdo->prepare("INSERT INTO perguntas (texto, status) VALUES (:texto, :status)");
            $stmt->bindParam(':texto', $texto);
            $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
            $stmt->execute();

            $mensagem = "Pergunta cadastrada com sucesso!";
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar pergunta: " . $e->getMessage();
        }
    } else {
        $mensagem = "O campo 'Texto da Pergunta' é obrigatório.";
    }
}
?>
