<?php
include 'conect.php';

// Verificar se o formulário de registro foi enviado
if (isset($_POST['signUp'])) {
    $nome = $_POST['nome']; 
    $email = $_POST['email']; 
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Verificar se a senha e a confirmação de senha são iguais
    if ($senha !== $confirmar_senha) {
        echo "A senha e a confirmação de senha não coincidem.";
        exit(); // Para o script aqui se as senhas não coincidirem
    }

    // Verificar se o email já existe
    $checkEmail = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmail);
    
    if ($result->num_rows > 0) {
        // Exibir mensagem de erro se o email já existir
        $errorMessage = "Endereço de email já existe!";
    } else {
        // Inserir o novo usuário no banco de dados
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$nome', '$email', '$senha')"; // Salvar a senha sem hash
        if ($conn->query($insertQuery) === TRUE) {
            // Redirecionar para a página de login após o cadastro bem-sucedido
            header("Location: login.php");
            exit();
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro-css.css">
    <style>
        .error-message {
            background-color: #ffcccc;
            color: #cc0000;
            border: 1px solid #cc0000;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
    <title>Register</title>
</head>
<body>
    <div class="warper">
        <form action="cadastro.php" method="POST">
            <div class="main-login">
                <div class="left-login">
                    <h1>Create an Account</h1>
                    <img src="assets/img/zumbi.svg" class="left-login-image" alt="signup">
                </div>
                <div class="right-login">
                    <div class="card-login">
                        <h1>Register</h1>
                        <?php
                        if(isset($errorMessage)) {
                               echo "<div class='error-message'>$errorMessage</div>";
                            }
                        ?>
                        <div class="textfield">
                            <label for="nome">Name</label>
                            <input type="text" name="nome" placeholder="Your Name" required>
                            <i class='bx bx-user'></i>
                        </div>
                        <div class="textfield">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Your Email" required>
                            <i class='bx bx-envelope'></i>
                        </div>
                        <div class="textfield">
                            <label for="senha">Password</label>
                            <input type="password" name="senha" placeholder="Password" required>
                        </div>
                        <div class="textfield">
                            <label for="confirmar_senha">Confirm your Password</label>
                            <input type="password" name="confirmar_senha" placeholder="Confirm your Password" required>
                        </div>
                        <button type="submit" name="signUp" class="btn-login">Register</button>
                        <div class="register-link">
                            <p>Already have an account? <a href="./login.php">Sign in</a></p> 
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
