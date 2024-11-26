<?php
require_once 'db_perguntas.php'; // Inclui a conexão com o banco de dados

$mensagem = null; // Variável para armazenar a mensagem de feedback
$error = false; // Variável para indicar se há erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_id'])) {
        // Exclui a pergunta
        $delete_id = filter_input(INPUT_POST, 'delete_id', FILTER_VALIDATE_INT);
        if ($delete_id) {
            try {
                $stmt = $pdo->prepare("DELETE FROM perguntas WHERE id = :id");
                $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
                $stmt->execute();
                $mensagem = "Pergunta excluída com sucesso!";
            } catch (PDOException $e) {
                $mensagem = "Erro ao excluir pergunta: " . $e->getMessage();
                $error = true;
            }
        } else {
            $mensagem = "ID inválido para exclusão.";
            $error = true;
        }
    } else {
        // Cadastra uma nova pergunta
        $texto = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
        $status = filter_var($_POST['status'] ?? false, FILTER_VALIDATE_BOOLEAN);

        if (!empty($texto) && strlen($texto) <= 255) { // Limite de caracteres
            try {
                $stmt = $pdo->prepare("INSERT INTO perguntas (texto, status) VALUES (:texto, :status)");
                $stmt->bindParam(':texto', $texto);
                $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
                $stmt->execute();
                $mensagem = "Pergunta cadastrada com sucesso!";
            } catch (PDOException $e) {
                $mensagem = "Erro ao cadastrar pergunta: " . $e->getMessage();
                $error = true;
            }
        } else {
            $mensagem = "O campo 'Texto da Pergunta' é obrigatório e deve ter no máximo 255 caracteres.";
            $error = true;
        }
    }
}

// Função para listar perguntas
function listarPerguntas($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM perguntas ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return [];
    }
}
?>
