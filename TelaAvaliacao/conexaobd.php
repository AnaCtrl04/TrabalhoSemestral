<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');      // Endereço do servidor do banco
define('DB_NAME', 'HospitalRegional'); // Nome do banco de dados
define('DB_USER', 'postgres');      // Usuário do banco de dados
define('DB_PASS', '123456');        // Senha do banco de dados

function dbConnect() {
    try {
        // Conexão utilizando o driver PDO para PostgreSQL
        $pdo = new PDO(
            'pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME, 
            DB_USER, 
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lança exceções em caso de erro
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Define o modo de retorno padrão para associações
            ]
        );
        return $pdo;
    } catch (PDOException $e) {
        // Termina o script e exibe mensagem de erro
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}
?>
