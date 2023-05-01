<?php
include "../componets/connect.php";
if(isset($_POST['submit_auth'])){
    $login = trim($_POST['login']);
    $password = md5(trim($_POST['password']));
    $admin  = mysqli_query($link, "SELECT * FROM `admins` WHERE `login`= '$login' AND `password`= '$password'");
    if(mysqli_num_rows($admin) > 0){
        $_SESSION['admin'] = $login;
        header("location: admin.php");
    }
    else{
        $_SESSION['message'] = 'Неверно введен логин или пароль';
        header("location: authorization.php");
    }
}