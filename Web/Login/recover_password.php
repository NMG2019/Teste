<?php

$servername = "MyWeb";
$users = "adm";
$password = "123";
$dbname = "MyWeb";

$conn = new mysqli($servername, $users, $password, $dbname);

if ($conn->connect_error) {
    die("". $conn->connect_error);
}

if ($_SERVER ["REQUEST_METHOD"] == "POST")
{ $correo = $_POST["email"];

    // Verificar se existe email 
    $sql = "SELECT id, usuario FROM users WHERE binary correo = '$correo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $users = $row["users"];
        $nombre = $row["nombre"];

        //Criar token para recuperar senha
        $token = md5(uniqid(rand(), true));

        //Atualizar o banco de senha
        $update_sql = "UPDATE usuario SET recovery_token = '$token' WHERE id = $user_id";
        $conn->query($update_sql);

        //Enviar email com link de recuperação
        $recovery_link = "localhost/reset_password_php?token=$token";
        $email_subject = "Recuperação de Senha";
        $email_body = "Olá $users,\n\n Para recuperar sua senha, clique no link a seguir:\n$recovery_link";

        echo "Um e-mail de recuperação foi enviado para o seu endereço de e-mail.";
    } else {
        echo "O endereço de e-mail não foi encontrado.";
    }

$conn->close();

}

?>