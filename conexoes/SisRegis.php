<?php 
include_once("conexao.php");

$nome = $_POST ['RegisNome'];
$email = $_POST ['RegisEmail'];
$senha = $_POST ['RegiSenha'];


$sql_verifica = "SELECT * FROM usuarios WHERE email = '$email'";
$result = mysqli_query($conexao, $sql_verifica);

if (mysqli_num_rows($result)> 0 ){
    echo "E-mail ja está em uso.";
} else {
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')"; 
    if (mysqli_query($conexao, $sql)) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar" . mysqli_error($conexao);
    }
}
?>