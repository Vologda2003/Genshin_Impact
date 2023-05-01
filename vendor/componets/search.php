<?php 
    include "connect.php";
    if(isset($_POST['search_submit'])){
        $name = $_POST['search_text'];
        $characters = mysqli_query($link, "SELECT * FROM `characters` WHERE LOCATE('$name', name_en) OR LOCATE('$name', name_ru)");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/image/imgElem/ban.png" type="image/png">
    <title>Genshin Impact</title>

</head>
<body>

    <header>

            <div class="logo_block">
                <a href="../../index.php">
                    <img class="logo" src="../../assets/image/imgElem/logo.png" alt="#">
                </a>
            </div>

            <div class="visibility_header">
                <svg class="show" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 11H4C3.4 11 3 11.4 3 12C3 12.6 3.4 13 4 13H20C20.6 13 21 12.6 21 12C21 11.4 20.6 11 20 11ZM4 8H20C20.6 8 21 7.6 21 7C21 6.4 20.6 6 20 6H4C3.4 6 3 6.4 3 7C3 7.6 3.4 8 4 8ZM20 16H4C3.4 16 3 16.4 3 17C3 17.6 3.4 18 4 18H20C20.6 18 21 17.6 21 17C21 16.4 20.6 16 20 16Z" fill="black"/>
                </svg>
                <svg class="hide" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.4 12L19.7 5.7C20.1 5.3 20.1 4.7 19.7 4.3C19.3 3.9 18.7 3.9 18.3 4.3L12 10.6L5.7 4.3C5.3 3.9 4.7 3.9 4.3 4.3C3.9 4.7 3.9 5.3 4.3 5.7L10.6 12L4.3 18.3C4.1 18.5 4 18.7 4 19C4 19.6 4.4 20 5 20C5.3 20 5.5 19.9 5.7 19.7L12 13.4L18.3 19.7C18.5 19.9 18.7 20 19 20C19.3 20 19.5 19.9 19.7 19.7C20.1 19.3 20.1 18.7 19.7 18.3L13.4 12Z" fill="black"/>
                </svg>
            </div>

            <a href="info.php" class="info">О нас</a>

            <form class="search" method="post" action="search.php">
                <input class="search_text" name="search_text" placeholder="Поиск" type="search">
                <button class="search_submit" name="search_submit" type="submit"></button>
            </form>

    </header>



    <main class="content">

        <?php 
        while($character = mysqli_fetch_array($characters)){
        ?>
        <div class="character <?php echo $character['element'] ?>">
            <a href="../characters/characters.php?name_en=<?php echo $character['name_en']; ?>">
                <img src="../../assets/image/characters/<?php echo $character['name_en'] ?>/<?php echo $character['name_en']; ?>.png" alt="#">
            </a>
            <a class="name" href="../characters/characters.php?name_en=<?php echo $character['name_en']; ?>"><?php echo $character['name_ru']; ?></a>
            <div class="star">
                <?php 
                for($i = 0; $i < $character['rare']; $i++){
                ?> 
                <img src="../../assets/image/imgElem/levelStar.png" alt="#">
                <?php 
                }
                ?>
            </div>
            <div class="items">
                <img src="../../<?php echo $character['weapon']; ?>" alt="#" class="weapon">
                <div class="item_element">
                    <img src="../../assets/image/elements/<?php echo $character['element']; ?>.png" alt="#">
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    </main>



    <footer>

        <div class="logo_block_footer">
            <a href="../../index.php">
                <img class="logo_footer" src="../../assets/image/imgElem/logo.png" alt="#">
            </a>
        </div>

        <a href="info.php" class="info_footer">О нас</a>

        <p>Автор сайта не несёт ответственности за его содержимое ©2022</p>

    </footer>

    <script src="../../assets/js/jquery-3.6.0.js"></script>
    <script src="../../assets/js/main_info.js"></script>

</body>
</html>