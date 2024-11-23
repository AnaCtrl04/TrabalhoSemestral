<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'HospitalRegional');
define('DB_USER', 'postgres');
define('DB_PASS', '123456');

// Função para conexão com o banco
function dbConnect() {
    try {
        return new PDO('pgsql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());}
}