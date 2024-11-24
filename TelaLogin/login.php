<?php
// Configurações de conexão com o banco de dados
$host = "localhost";          // Endereço do servidor
$port = "5432";               // Porta padrão do PostgreSQL
$dbname = "HospitalRegional"; // Nome do banco de dados
$user = "postgres";           // Nome de usuário do banco
$password = "123456";         // Senha do banco

// Conexão com o banco de dados
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Processa o login quando o formulário é enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    try {
        // Verifica o e-mail no banco de dados
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // E-mail encontrado
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha está armazenada como texto simples
            if (!password_verify($senha, $usuario['senha']) && strlen($usuario['senha']) < 60) {
                // A senha está em texto simples (ou hash diferente), atualiza para hash seguro
                $hashSenha = password_hash($usuario['senha'], PASSWORD_DEFAULT);
                $updateQuery = "UPDATE usuarios SET senha = :hashSenha WHERE email = :email";
                $updateStmt = $pdo->prepare($updateQuery);
                $updateStmt->bindParam(':hashSenha', $hashSenha);
                $updateStmt->bindParam(':email', $email);
                $updateStmt->execute();
                $usuario['senha'] = $hashSenha;
            }

            // Verifica novamente a senha após a atualização
            if (password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido, redireciona para a tela inicial
                header("Location: tela_inicial.html");
exit();
            } else {
                echo "<p style='color: red;'>Informações incorretas: senha inválida.</p>";
            }
        } else {
            // E-mail não encontrado
            echo "<p style='color: red;'>Informações incorretas: e-mail não cadastrado.</p>";
        }
    } catch (PDOException $e) {
        die("Erro ao verificar as credenciais: " . $e->getMessage());
    }
}
?>
