<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style_info.css">
    <link rel="shortcut icon" href="../../assets/image/imgElem/ban.png" type="image/png">
    <title>Genshin Impact</title>

</head>

<body>

    <header>

        <div class="head-header">
            <a href="../../index.php">
                <img class="logo" src="../../assets/image/imgElem/logo.png" alt="#">
            </a>

            <div class="visibility_header">
                <svg class="show" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 11H4C3.4 11 3 11.4 3 12C3 12.6 3.4 13 4 13H20C20.6 13 21 12.6 21 12C21 11.4 20.6 11 20 11ZM4 8H20C20.6 8 21 7.6 21 7C21 6.4 20.6 6 20 6H4C3.4 6 3 6.4 3 7C3 7.6 3.4 8 4 8ZM20 16H4C3.4 16 3 16.4 3 17C3 17.6 3.4 18 4 18H20C20.6 18 21 17.6 21 17C21 16.4 20.6 16 20 16Z" fill="black"/>
                </svg>
                <svg class="hide" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.4 12L19.7 5.7C20.1 5.3 20.1 4.7 19.7 4.3C19.3 3.9 18.7 3.9 18.3 4.3L12 10.6L5.7 4.3C5.3 3.9 4.7 3.9 4.3 4.3C3.9 4.7 3.9 5.3 4.3 5.7L10.6 12L4.3 18.3C4.1 18.5 4 18.7 4 19C4 19.6 4.4 20 5 20C5.3 20 5.5 19.9 5.7 19.7L12 13.4L18.3 19.7C18.5 19.9 18.7 20 19 20C19.3 20 19.5 19.9 19.7 19.7C20.1 19.3 20.1 18.7 19.7 18.3L13.4 12Z" fill="black"/>
                </svg>
            </div>
        </div>

        <a href="info.php" class="info">О нас</a>

        <form class="search" method="post" action="search.php">
            <input class="search_text" name="search_text" placeholder="Поиск" type="search">
            <button class="search_submit" name="search_submit" type="submit"></button>
        </form>

    </header>



    <main class="content">
        <div class="info-text">
            <span class="info-text-name">Сайт создан для просмотра информации о персонажах и для помощи прокачивания персонажей в игре «Genshin Impact»</span>
            <span class="info-text-name">Здесь вы сможете:</span>
            <ul>
                <li>Узнать краткую информацию о персонажах</li>
                <li>Посмотреть картинки персонажа</li>
                <li>Узнать информацию о талантах персонажей</li>
                <li>Узнать информацию о пассивных талантов персонажей</li>
                <li>Узнать какие материалы нужны для возвышения персонажей</li>
                <li>Узнать какие материалы нужны для возвышения талантов</li>
                <li>Узнать какие у персонажах есть созвездия и их описания</li>
                <li>Узнать рекомендации оружия и артефактов для персонажей</li>
            </ul>
            <span class="gallery-name">Галерея</span>
            <div class="gallery">
                <img src="../../assets/image/gallery/anemo.jpg" alt="#">
                <img src="../../assets/image/gallery/geo.jpg" alt="#">
                <img src="../../assets/image/gallery/cryo.jpg" alt="#">
                <img src="../../assets/image/gallery/pyro.jpg" alt="#">
                <img src="../../assets/image/gallery/electro.jpg" alt="#">
                <img src="../../assets/image/gallery/hydro.jpg" alt="#">
                <img src="../../assets/image/gallery/dendro.jpg" alt="#">
            </div>
            <div>
                <a href="https://genshin.hoyoverse.com/ru/home" target="_blank" class="link">Официальный сайт «Genshin Impact»</a>
            </div>
        </div>
    </main>



    <div class="view-gallery">
        <img src="../../assets/image/gallery/anemo.jpg" alt="#" class="image">
        <img src="../../assets/image/gallery/geo.jpg" alt="#" class="image">
        <img src="../../assets/image/gallery/cryo.jpg" alt="#" class="image">
        <img src="../../assets/image/gallery/pyro.jpg" alt="#" class="image">
        <img src="../../assets/image/gallery/electro.jpg" alt="#" class="image">
        <img src="../../assets/image/gallery/hydro.jpg" alt="#" class="image">
        <img src="../../assets/image/gallery/dendro.jpg" alt="#" class="image">
    </div>



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