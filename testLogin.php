<?php
include_once('conect.php');

session_start();

if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['passwords'])){
    $username = $_POST['username'];
    $password = $_POST['passwords'];

    $sql = "SELECT * FROM users WHERE name = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['username'] = $username;
        header('Location: homepage.php');
        exit();
    } else {
        $_SESSION['error'] = 'Credenciais inválidas. Por favor, verifique seu nome de usuário e senha.';
        header('Location: login.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Por favor, preencha todos os campos.';
    header('Location: login.php');
    exit();
}
?>
