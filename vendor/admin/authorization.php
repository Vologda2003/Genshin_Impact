<?php
include "../componets/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin/style_auth.css">
    <link rel="shortcut icon" href="../../assets/image/imgElem/ban.png" type="image/png">
    <title>Genshin Impact</title>
</head>
<body>
    <main class="content">
        <div class="authorization">
            <form action="auth.php" method="post" class="authorization-form">
                <h1>Авторизация</h1>
                <div class="authorization-form-section">
                    <span>Логин:</span>
                    <input type="text" name="login" required>
                </div>
                <div class="authorization-form-section">
                    <span>Пароль:</span>
                    <input type="password" name="password" required>
                </div>
                <div class="authorization-form-button">
                    <input type="reset" value="Очистить форму">
                    <input type="submit" value="Войти" name="submit_auth">
                </div>
            </form>
            <div class="section-head">
                <a href="../../index.php">На главную</a>
            </div>
            <div class="message">
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
            </div>
        </div>
    </main>
</body>
</html>