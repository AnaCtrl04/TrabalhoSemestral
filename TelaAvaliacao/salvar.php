<?php
// Configurações do banco de dados
$host = 'localhost'; // Endereço do servidor do banco de dados
$dbname = 'HospitalRegional'; // Nome do banco de dados
$user = 'postgres'; // Usuário do banco de dados
$password = '123456'; // Senha do banco de dados

try {
    // Conexão com o banco de dados
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca a pergunta com status = true
    $query = "SELECT id, texto FROM perguntas WHERE status = true LIMIT 1";
    $stmt = $conn->query($query);

    // Verifica se a consulta foi executada corretamente
    if ($stmt === false) {
        throw new Exception("Erro ao executar a consulta de perguntas.");
    }

    $pergunta = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se foi encontrada uma pergunta
    if (!$pergunta) {
        die("Nenhuma pergunta disponível no momento. Verifique se existem registros com 'status = true' na tabela.");
    }

    // Exibe a pergunta para depuração (remova isso em produção)
    echo htmlspecialchars($pergunta['texto'], ENT_QUOTES, 'UTF-8');

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Captura os dados enviados pelo formulário
        $resposta = filter_input(INPUT_POST, 'resposta', FILTER_VALIDATE_INT);
        $feedback = filter_input(INPUT_POST, 'feedback', FILTER_SANITIZE_STRING);

        // Parâmetros adicionais
        $id_setor = 1; // Defina o ID do setor (valor de exemplo)
        $id_pergunta = $pergunta['id']; // Usa o ID da pergunta obtida
        $id_dispositivo = 1; // Exemplo de ID do dispositivo
        $data_hora = date('Y-m-d H:i:s'); // Data e hora atual

        // Verifica se a resposta foi fornecida
        if ($resposta !== false) {
            // Query para inserir os dados
            $sql = "INSERT INTO avaliacoes (id_setor, id_pergunta, id_dispositivo, resposta, feedback, data_hora) 
                    VALUES (:id_setor, :id_pergunta, :id_dispositivo, :resposta, :feedback, :data_hora)";
            $stmt = $conn->prepare($sql);

            // Executa a query com os valores capturados
            $stmt->execute([
                ':id_setor' => $id_setor,
                ':id_pergunta' => $id_pergunta,
                ':id_dispositivo' => $id_dispositivo,
                ':resposta' => $resposta,
                ':feedback' => $feedback ?: null, // Insere NULL caso o feedback esteja vazio
                ':data_hora' => $data_hora,
            ]);

            // Redireciona ou exibe mensagem de sucesso
            header("Location: TelaAgradecimento.html");
            exit; // Garante que nenhum outro código seja executado
            
        } else {
            echo "Erro: Resposta inválida.";
        }
    }
} catch (PDOException $e) {
    // Exibe mensagem de erro
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
} catch (Exception $e) {
    // Captura outros erros
    echo "Erro: " . $e->getMessage();
}
?>
