<?php
session_start();
global $conn;
require_once 'connect.php';


$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$pass_conf = $_POST['pass_conf'];

if ($pass === $pass_conf) {

} else {
    $_SESSION["message"] =
        'Пароли не совпадают';
    header('Location: ../register.php ');
}

$pass = md5($pass);

$checkDouble = mysqli_query($conn, "SELECT * FROM `users` WHERE (`phone` = '$phone') OR
                                           (`email` = '$email') OR (`phone` = '$phone' AND `email` = '$email')");

if (mysqli_num_rows($checkDouble) > 0) {
    $_SESSION["message"] =
        'Пользователь c таким логином или паролем уже имеется';
    header('Location: ../register.php ');

} else {
    mysqli_query($conn,"INSERT INTO `users` (`name`, `phone`, `email`, `password`) 
VALUES 
    ('$name', '$phone', '$email', '$pass')");

    $_SESSION["message"] =
        'Регистрация успешна!';
    header('Location: ../index.php ');
}


