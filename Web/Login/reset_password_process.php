<?php  
//Conexão com database

$servername = "localhost";
$username = "users";
$password = "123";
$dbname = "MyWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na Conexão". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET")  {
    $token = $_GET["token"];
    $new_password = password_hash($_POST["Nova Senha"], PASSWORD_DEFAULT);

    // Atualizar a senha e remover token
    $update_sql = "UPDATE users FROM password ='$new_password', recovery_token = NULL WHERE recovery_token = '$token'";
    $conn->query($update_sql);

    echo "Senha redefinida com sucesso!";
}

$conn->close();

?>