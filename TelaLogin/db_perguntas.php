<?php
$host = "localhost";
$dbname = "HospitalRegional";
$user = "postgres";
$password = "123456";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados. Detalhes: " . $e->getMessage());
}
?>
