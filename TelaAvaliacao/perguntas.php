<?php
// perguntas.php

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'HospitalRegional';
$user = 'postgres';
$password = '123456';

try {
    // Conexão com o banco de dados
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca a pergunta com status = true
    $query = "SELECT id, texto FROM perguntas WHERE status = true LIMIT 1";
    $stmt = $conn->query($query);

    // Retorna a pergunta encontrada
    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se nenhuma pergunta for encontrada
    if (!$pergunta) {
        $pergunta = ['texto' => 'Nenhuma pergunta disponível no momento.'];
    }
} catch (PDOException $e) {
    // Em caso de erro, exibe uma mensagem
    $pergunta = ['texto' => 'Erro ao carregar a pergunta: ' . $e->getMessage()];
}
?>
