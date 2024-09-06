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
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
<form action="vendor/signup.php" method="POST">
  <label>Имя</label>
  <input type="text" name="name" placeholder="Введите Ваше имя">
  <label>Телефон</label>
  <input type="tel" name="phone"  placeholder="Номер Вашего телефона">
  <label>Почта</label>
  <input type="email" name="email" placeholder="Адрес почты">
  <label>Пароль</label>
  <input type="password" name="pass" placeholder="Секретный пароль">
    <label>Подтверждение паролья</label>
    <input type="password" name="pass_conf" placeholder="Секретный пароль еще раз">
<button type="submit">Зарегистрироваться</button>
    <p>
    У вас уже есть аккаунт -  <a href="/">Войти</a>
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
