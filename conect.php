<?php
$servername = "localhost";
$username = "root"; // padrão do XAMPP
$password = ""; // padrão do XAMPP
$dbname = "glitchguru"; // nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
