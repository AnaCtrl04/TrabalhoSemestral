<?php
// Configuração de conexão com o banco de dados
$host = 'localhost'; // Altere conforme necessário
$port = '5432'; // Porta padrão do PostgreSQL
$dbname = 'HospitalRegional'; // Substitua pelo nome do banco
$user = 'postgres'; // Substitua pelo usuário do banco
$password = '123456'; // Substitua pela senha do banco

// Cria a conexão com o banco de dados
try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Processa os dados enviados pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $resposta = $_POST['resposta'];
    $feedback = $_POST['feedback'] ?? '';

    // Define valores fixos para id_dispositivo, id_pergunta e id_setor
    // (Esses valores podem ser ajustados de acordo com o contexto do seu sistema)
    $id_dispositivo = 1; // Substitua pelo ID do dispositivo correto
    $id_pergunta = 1;    // Substitua pelo ID da pergunta correta
    $id_setor = 1;       // Substitua pelo ID do setor correto

    // Define o timestamp atual
    $data_hora = date('Y-m-d H:i:s');

    // Insere os dados na tabela tbavaliacao
    $sql = "INSERT INTO tbavaliacao (id_dispositivo, id_pergunta, id_setor, resposta, feedback, data_hora) 
            VALUES (:id_dispositivo, :id_pergunta, :id_setor, :resposta, :feedback, :data_hora)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_dispositivo', $id_dispositivo, PDO::PARAM_INT);
        $stmt->bindParam(':id_pergunta', $id_pergunta, PDO::PARAM_INT);
        $stmt->bindParam(':id_setor', $id_setor, PDO::PARAM_INT);
        $stmt->bindParam(':resposta', $resposta, PDO::PARAM_INT);
        $stmt->bindParam(':feedback', $feedback, PDO::PARAM_STR);
        $stmt->bindParam(':data_hora', $data_hora);

        $stmt->execute();

        echo "Avaliação salva com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao salvar a avaliação: " . $e->getMessage();
    }
}
?>
