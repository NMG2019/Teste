<?php   

// Conexão com o database
$servername = "MyWeb";
$username = "users";
$password = "123";
$dbname = "MyWeb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET")  {
    $token = $_GET["token"];
}

// Verificar se existe o token na database

$sql = "SELECT id FROM users WHERE recovery_token = '$token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    //Exibir formulario de recuperar senha

    echo "<form action='reset_password_process.php' method='post'>";
    echo "<input type='hidden' name='token' value='$token'>";
    echo "<label for='Nova Senha'>Nova Senha:</label>";
    echo "<input type='Senha' name='new_password' required>";
    echo "<input type='Envio' value='Redefinir Senha'>";
    echo "</form>";
} else {
    echo "Token invalido ou expirado!";
} 

$conn->close();

?>