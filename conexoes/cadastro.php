<?php
include_once("conexao.php");

$mensagem = ""; // Variável para armazenar a mensagem
$tipoAlerta = ""; // success ou danger

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['RegisNome'];
    $email = $_POST['RegisEmail'];
    $senha = $_POST['RegiSenha'];

    $sql_verifica = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexao, $sql_verifica);

    if (mysqli_num_rows($result) > 0) {
        $mensagem = "E-mail já está em uso.";
        $tipoAlerta = "danger";
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        if (mysqli_query($conexao, $sql)) {
            $mensagem = "Usuário cadastrado com sucesso!";
            $tipoAlerta = "success";
        } else {
            $mensagem = "Erro ao cadastrar: " . mysqli_error($conexao);
            $tipoAlerta = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2>Cadastro de Usuário</h2>

    <!-- Exibe a mensagem, se houver -->
    <?php if (!empty($mensagem)): ?>
        <div class="alert alert-<?php echo $tipoAlerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $mensagem; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="RegisNome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="RegisNome" required>
        </div>
        <div class="mb-3">
            <label for="RegisEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="RegisEmail" required>
        </div>
        <div class="mb-3">
            <label for="RegiSenha" class="form-label">Senha</label>
            <input type="password" class="form-control" name="RegiSenha" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
