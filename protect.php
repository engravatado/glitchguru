<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if(!isset($_SESSION['username'])){
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit(); // Garante que o script pare aqui
}
?>