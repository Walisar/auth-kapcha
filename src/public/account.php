<?php
session_start();
require_once 'vendor/connect.php';
global $conn;

if (empty($_SESSION['user']['id'])){
    header('Location: index.php');
    die();
}

$id = $_SESSION['user']['id'];
$result = mysqli_query($conn,"SELECT * FROM user WHERE `id` = '" . $id . "' LIMIT 1");
//$user = mysqli_fetch_assoc($result);

if (count($_POST)) {
   $name = $_POST['name'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = md5($_POST['password']) ?? null;

    mysqli_query($conn,"UPDATE `users` 
SET `name` = '$name',
 `phone` = '$phone',
  `email` = '$email',
   `password` = '$password' 
   WHERE `id` = '$id'");
    header('Location: account.php');
    exit;
}


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form class="form-horizontal" role="form" method="POST" action="">
    <input type="hidden" name="act" value="profile"/>
<div class="row">
    <label class="sr-only" for="text">Name</label>
    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                <textarea name="name" class="form-control" id="text"
                          placeholder="Text" required autofocus rows="3"><?=
                     $_SESSION['user']['name']?></textarea>
            </div>


<div class="row">
    <label class="sr-only" for="text">phone</label>
    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
    <textarea name="phone" class="form-control" id="text"
              placeholder="Text" required autofocus rows="3"><?=$_SESSION['user']['phone']?></textarea>
</div>

<div class="row">
    <label class="sr-only" for="text">email</label>
    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
    <textarea name="email" class="form-control" id="text"
              placeholder="Text" required autofocus rows="3"><?=$_SESSION['user']['email']?></textarea>
</div>

<div class="row">
    <label class="sr-only" for="text">password</label>
    <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
    <textarea name="password" class="form-control" id="text"
              placeholder="Text" required autofocus rows="3"></textarea>
</div>

<button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Save</button>

<a href="vendor/logout.php" class="logout">exit</a>
</form>
</body>
</html>


