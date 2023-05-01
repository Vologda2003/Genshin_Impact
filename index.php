<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/image/imgElem/ban.png" type="image/png">
    <title>Genshin Impact</title>

</head>
<body>

    <header>
        <div class="head-header">
            <a href="index.php">
                <img class="logo" src="assets/image/imgElem/logo.png" alt="#">
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
        
        <span class="title_filter">Фильтр</span>

        <a href="vendor/componets/info.php" class="info">О нас</a>

        <form class="search" method="post" action="vendor/componets/search.php">
            <input class="search_text" name="search_text" placeholder="Поиск" type="search">
            <button class="search_submit" name="search_submit" type="submit"></button>
        </form>
    </header>



    <main class="content">

        <div class="character geo">
            <a href="vendor/characters/characters.php?name_en=Noelle">
                <img src="assets/image/characters/Noelle/Noelle.png" alt="#">
            </a>
            <a class="name" href="vendor/characters/characters.php?name_en=Noelle">Ноэлль</a>
            <div class="star">
                <img src="assets/image/imgElem/levelStar.png" alt="#">
                <img src="assets/image/imgElem/levelStar.png" alt="#">
                <img src="assets/image/imgElem/levelStar.png" alt="#">
                <img src="assets/image/imgElem/levelStar.png" alt="#">
            </div>
            <div class="items">
                <img src="assets/image/weapons/two-handed_sword.png" alt="#" class="weapon">
                <div class="item_element">
                    <img src="assets/image/elements/geo.png" alt="#">
                </div>
            </div>
        </div>
        
    </main>



    <footer>

        <div class="logo_block_footer">
            <a href="index.php">
                <img class="logo_footer" src="assets/image/imgElem/logo.png" alt="#">
            </a>
        </div>

        <a href="vendor/componets/info.php" class="info_footer">О нас</a>

        <p>Автор сайта не несёт ответственности за его содержимое ©2022</p>

    </footer>



    <div class="filter_block">
        <img src="assets/image/imgElem/close.svg" alt="#" class="close_filter">
        <form class="filter" id="filter">

            <div class="block_elements">
                <span class="name_block">Элемент</span>
                <div class="elements" class="elements_section">
                    <input type="checkbox" name="elements[]" id="anemo" value="anemo">
                    <label for="anemo" class="elements_section">
                        <img src="assets/image/elements/anemo.png" alt="#">
                    </label>

                    <input type="checkbox" name="elements[]" id="geo" value="geo">
                    <label for="geo" class="elements_section">
                        <img src="assets/image/elements/geo.png" alt="#">
                    </label>

                    <input type="checkbox" name="elements[]" id="pyro" value="pyro">
                    <label for="pyro" class="elements_section">
                        <img src="assets/image/elements/pyro.png" alt="#">
                    </label>

                    <input type="checkbox" name="elements[]" id="cryo" value="cryo">
                    <label for="cryo" class="elements_section">
                        <img src="assets/image/elements/cryo.png" alt="#">
                    </label>

                    <input type="checkbox" name="elements[]" id="electro" value="electro">
                    <label for="electro" class="elements_section">
                        <img src="assets/image/elements/electro.png" alt="#">
                    </label>

                    <input type="checkbox" name="elements[]" id="hydro" value="hydro">
                    <label for="hydro" class="elements_section">
                        <img src="assets/image/elements/hydro.png" alt="#">
                    </label>

                    <input type="checkbox" name="elements[]" id="dendro" value="dendro">
                    <label for="dendro" class="elements_section">
                        <img src="assets/image/elements/dendro.png" alt="#">
                    </label>
                </div>
            </div>

            <div class="block_rare">
                <span class="name_block">Редкость</span>
                <div class="rare_section">
                    <input type="radio" name="rare" id="one" class="rare" value="1">
                    <label for="one" class="rare-image">
                        <img src="assets/image/imgElem/levelStar.png" alt="#">
                    </label>

                    <input type="radio" name="rare" id="two" class="rare" value="2">
                    <label for="two" class="rare-image">
                        <img src="assets/image/imgElem/levelStar.png" alt="#">
                    </label>

                    <input type="radio" name="rare" id="three" class="rare" value="3">
                    <label for="three" class="rare-image">
                        <img src="assets/image/imgElem/levelStar.png" alt="#">
                    </label>

                    <input type="radio" name="rare" id="four" class="rare" value="4">
                    <label for="four" class="rare-image">
                        <img src="assets/image/imgElem/levelStar.png" alt="#">
                    </label>

                    <input type="radio" name="rare" id="five" class="rare" value="5">
                    <label for="five" class="rare-image">
                        <img src="assets/image/imgElem/levelStar.png" alt="#">
                    </label>
                </div>
            </div>

            <div class="btn_filter">
                <input type="submit" value="ОК" class="submit_filter" name="submit_filter">
                <input type="reset" value="Сброс" class="reset_filter" name="reset_filter">
            </div>

        </form>
    </div>

    <script src="assets/js/jquery-3.6.0.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>