<?php
session_start();
require_once 'connect.php';
global $conn;
define('SMARTCAPTCHA_SERVER_KEY', 'ysc2_MH2TbsWWTbTyzTB4Vl5P5Gv1VNd76N1OMvnGTA3519540bcd');

function check_captcha($token)
{
    $ch = curl_init();
    $args = http_build_query([
        "secret" => SMARTCAPTCHA_SERVER_KEY,
        "token" => $token,
        "ip" => $_SERVER['REMOTE_ADDR'], // Нужно передать IP пользователя.
        // Как правильно получить IP зависит от вашего прокси.
    ]);
    curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);

    $server_output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
        return true;
    }
    $resp = json_decode($server_output);

    return $resp->status === "ok";
}

$token = $_POST['smart-token'];
if (check_captcha($token)) {
    $_SESSION['tok'] = true;
} else {
    $_SESSION['tok'] = false;
}

$login = $_POST['login'];

$pass = md5($_POST['pass']);


$check_user =  mysqli_query($conn, "SELECT * FROM `users` WHERE (`phone` = '$login' AND `password` = '$pass') 
                       OR (`email` = '$login' and `password` = '$pass')");

if ((mysqli_num_rows($check_user) > 0) && $_SESSION['tok']) {
    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "id" => $user["id"],
        "name" => $user["name"],
        "phone" => $user["phone"],
        "email" => $user["email"]

    ];

    header('Location: ../account.php');
    die();

} elseif ((mysqli_num_rows($check_user) > 0) && !$_SESSION['tok']){

    $_SESSION["message"] =
        'Подтвердите что вы не робот';
    header('Location: ../index.php ');
    die();

}

else {
    $_SESSION["message"] =
        'Неверный логин или пароль';
    header('Location: ../index.php ');
    die();
}

?>
