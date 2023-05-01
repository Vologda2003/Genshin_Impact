<?php
include "../componets/connect.php";
if(!$_SESSION['admin']){
    header("location: authorization.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin/style_admin_characters.css">
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

        <a href="../componets/info.php" class="info">О нас</a>

        <a href="admin.php" class="admin">admin</a>

        <form class="search" method="post" action="../componets/search.php">
            <input class="search_text" name="search_text" placeholder="Поиск" type="search">
            <button class="search_submit" name="search_submit" type="submit"></button>
        </form>

    </header>



    <main class="content">
        <div class="characters">
            <div class="characters-section">
                <h2>Добавление персонажа</h2>
                <a href="add_characters.php" class="link-add-characters">Добавить</a>
            </div>

            <div class="characters-section-line"></div>

            <div class="characters-section">
                <h2>Персонажи</h2>
                <div class="characters-all">
                    <div class="characters-all-filter">
                        <div class="characters-all-filter-rare">
                            <div class="characters-all-filter-rare-item">
                                <input type="radio" id="all_star" name="rare" value="" class="characters-all-filter-rare-item-value" checked>
                                <label for="all_star" class="characters-all-filter-rare-item-text active-filter-rare">Все</label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-rare-item">
                                <input type="radio" id="star_4" name="rare" value="star_4" class="characters-all-filter-rare-item-value">
                                <label for="star_4" class="characters-all-filter-rare-item-text">
                                    <span>4</span>
                                    <img src="../../assets/image/imgElem/star.svg" alt="#">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-rare-item">
                                <input type="radio" id="star_5" name="rare" value="star_5" class="characters-all-filter-rare-item-value">
                                <label for="star_5" class="characters-all-filter-rare-item-text">
                                    <span>5</span>
                                    <img src="../../assets/image/imgElem/star.svg" alt="#">
                                </label>
                            </div>
                        </div>

                        <div class="characters-all-filter-element">
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="all_element" name="element" value="" class="characters-all-filter-element-item-value" checked>
                                <label for="all_element" class="characters-all-filter-element-item-image active-filter-element">Все</label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="anemo" name="element" value="anemo" class="characters-all-filter-element-item-value">
                                <label for="anemo" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/anemo.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="geo" name="element" value="geo" class="characters-all-filter-element-item-value">
                                <label for="geo" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/geo.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="pyro" name="element" value="pyro" class="characters-all-filter-element-item-value">
                                <label for="pyro" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/pyro.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="cryo" name="element" value="cryo" class="characters-all-filter-element-item-value">
                                <label for="cryo" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/cryo.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="electro" name="element" value="electro" class="characters-all-filter-element-item-value">
                                <label for="electro" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/electro.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="hydro" name="element" value="hydro" class="characters-all-filter-element-item-value">
                                <label for="hydro" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/hydro.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                            <div class="characters-all-filter-rare-line"></div>
                            <div class="characters-all-filter-element-item">
                                <input type="radio" id="dendro" name="element" value="dendro" class="characters-all-filter-element-item-value">
                                <label for="dendro" class="characters-all-filter-element-item-image">
                                    <img src="../../assets/image/elements/dendro.png" alt="#" class="characters-all-filter-element-item-image-icon">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="characters-all-section">
                        <?php
                        $characters = mysqli_query($link, "SELECT * FROM `characters` ORDER BY name_ru");
                        if(mysqli_num_rows($characters) > 0){
                            while($character = mysqli_fetch_array($characters)){
                        ?>
                            <div class="characters-all-section-character <?php echo $character['element']; ?>">
                                <img src="../../assets/image/characters/<?php echo $character['name_en']; ?>/<?php echo $character['name_en']; ?>.png" alt="#" class="characters-all-section-character-icon">
                                <span class="characters-all-section-character-name"><?php echo $character['name_ru']; ?></span>
                                <div class="characters-all-section-character-rare">
                                    <?php
                                    for($i = 0; $i < $character['rare']; $i++){
                                    ?>
                                    <img src="../../assets/image/imgElem/levelStar.png" alt="#" class="characters-all-section-character-rare-star">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <input type="hidden" value="<?php echo $character['rare_character']; ?>">
                                <div class="characters-all-section-info">
                                    <img src="../../<?php echo $character['weapon']; ?>" alt="#" class="characters-all-section-character-info-weapon">
                                    <img src="../../assets/image/elements/<?php echo $character['element']; ?>.png" alt="#" class="characters-all-section-character-info-element">
                                </div>
                                <div class="characters-all-section-button">
                                    <form action="main_admin.php" method="post">
                                        <input type="hidden" name="id_characters" value="<?php echo $character['id']; ?>">
                                        <input type="hidden" name="name_characters" value="<?php echo $character['name_en']; ?>">
                                        <input type="submit" name="characters_delete" class="characters_delete" value="Удалить">
                                    </form>
                                    <a href="update_characters.php?id=<?php echo $character['id']; ?>" class="characters_update">Редактировать</a>
                                </div>
                            </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="logo_block_footer">
            <a href="../../index.php">
                <img class="logo_footer" src="../../assets/image/imgElem/logo.png" alt="#">
            </a>
        </div>

        <a href="../componets/info.php" class="info_footer">О нас</a>

        <p>Автор сайта не несёт ответственности за его содержимое ©2022</p>
    </footer>



    <script src="../../assets/js/jquery-3.6.0.js"></script>
    <script src="../../assets/js/admin/main_admin_characters.js"></script>

</body>
</html>