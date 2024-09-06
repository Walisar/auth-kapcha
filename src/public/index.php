<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация и регистрация</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" async defer></script>
</head>
<body>

<form  action="vendor/login.php" method="POST">
    <label>Телефон или Почта</label>
    <input  name="login" placeholder="Номер Вашего телефона или адрес почты">
    <label>Пароль</label>
     <input type="password"  name="pass" placeholder="Секретный пароль">
    <div
            id="captcha-container"
            class="smart-captcha"
            data-sitekey="ysc1_MH2TbsWWTbTyzTB4Vl5Pd2i00HkbyA9ndKyj9bROe23fd4f8"
            data-hl="en"
            data-callback="callback"
    ></div>
    <button type="submit">Войти</button>
    <p>
        У вас нет аккаунта? -  <a href="register.php">Зарегистрируйтесь</a>
    </p>
    <?php
    if ($_SESSION["message"]) {
        echo '<p class="message">' . $_SESSION["message"] . '<p>';
    }
    unset($_SESSION["message"]);
    ?>


</form>


</body>
</html>

<?php
/*
<label>Имя</label>
    <input type="text" placeholder="Введите Ваше имя">
    <label>Телефон</label>
    <input type="tel"  placeholder="Номер Вашего телефона">
    <label>Почта</label>
    <input type="email" placeholder="Адрес почты">
    <label>Пароль</label>
     <input type="password" placeholder="Секретный пароль">
    <button>NEXT</button>
*/