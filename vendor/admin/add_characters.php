<?php
include "../componets/connect.php";
if(!$_SESSION['admin']){
    header("location: authorization.php");
}
$items = mysqli_query($link, "SELECT * FROM `items`");
$artifacts = mysqli_query($link, "SELECT * FROM `artifacts`");
$weapons = mysqli_query($link, "SELECT * FROM `weapons`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin/style_add_characters.css">
    <link rel="shortcut icon" href="../../assets/image/imgElem/ban.png" type="image/png">
    <title>Genshin Impact</title>
</head>
<body>

    <div class="bgImage common"></div>



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

        <form method="post" class="content-form">

            <div class="banner">
                <div class="banner-header">
                    <div class="banner-header-icon-head">
                        <div class="banner-header-icon">+
                            <input type="file" name="icon" class="banner-header-icon-image" required>
                        </div>
                    </div>
                    <div class="banner-header-name">
                        <span class="banner-header-name-title">Имя персонажа</span>
                        <div class="banner-header-name-ru">
                            <span class="banner-header-name-ru-title">RU</span>
                            <input type="text" name="name_ru" class="banner-header-name-ru-value" required>
                        </div>
                        <div class="banner-header-name-en">
                            <span class="banner-header-name-en-title">EN</span>
                            <input type="text" name="name_en" class="banner-header-name-en-value" required>
                        </div>
                    </div>
                    <div class="banner-header-info">
                        <div class="banner-header-class">
                            <span class="banner-header-class-title">Класс:</span>
                            <select name="character_class" class="banner-header-class-value" required>
                                <option value="">Выберите</option>
                                <option value="one-handed_sword.png">Одноручник</option>
                                <option value="two-handed_sword.png">Двуручник</option>
                                <option value="catalyst.png">Катализатор</option>
                                <option value="archery.png">Лучник</option>
                                <option value="spear.png">Копейщик</option>
                            </select>
                        </div>

                        <div class="banner-header-info-line"></div>

                        <div class="banner-header-element">
                            <span class="banner-header-element-title">Элемент:</span>
                            <select name="character_element" class="banner-header-element-value" required>
                                <option value="">Выберите</option>
                                <option value="anemo">Анемо</option>
                                <option value="geo">Гео</option>
                                <option value="cryo">Крио</option>
                                <option value="pyro">Пиро</option>
                                <option value="electro">Электро</option>
                                <option value="hydro">Гидро</option>
                                <option value="dendro">Дендро</option>
                            </select>
                        </div>

                        <div class="banner-header-info-line"></div>

                        <div class="banner-header-rare">
                            <span class="banner-header-rare-title">Редкость:</span>
                            <select name="character_rare" class="banner-header-rare-value" required>
                                <option value="">Выберите</option>
                                <option value="star_4">4</option>
                                <option value="star_5">5</option>
                            </select>
                        </div>
                        
                        <div class="banner-header-info-line"></div>

                        <div class="banner-header-region">
                            <span class="banner-header-region-title">Регион:</span>
                            <select name="character_region" class="banner-header-region-value" required>
                                <option value="">Выберите</option>
                                <option value="Другой мир">Другой мир</option>
                                <option value="Мондштадт">Мондштадт</option>
                                <option value="Ли Юэ">Ли Юэ</option>
                                <option value="Инадзума">Инадзума</option>
                                <option value="Сумеру">Сумеру</option>
                                <option value="Фонтейн">Фонтейн</option>
                                <option value="Натлан">Натлан</option>
                                <option value="Снежная">Снежная</option>
                            </select>
                        </div>
                    </div>
                    <div class="banner-header-map">
                        <span class="banner-header-map-title"></span>
                        <div class="banner-header-map-icon">+
                            <input type="file" name="map" class="banner-header-map-icon-image" required>
                        </div>
                    </div>
                </div>
                <div class="banner-description">
                    <span class="banner-description-title">Описание</span>
                    <textarea name="character_description" class="banner-description-text" required></textarea>
                </div>
            </div>


            <div class="gallery">
                <span class="gallery-title">Галерея</span>
                <div class="gallery-icon">Добавить
                    <input type="file" name="gallery[]" class="gallery-icon-image" multiple accept=".jpg, .png, .jpeg" required>
                </div>
                <div class="gallery-line"></div>
                <div class="gallery-images">
                    <span class="gallery-images-title">Выбранные картинки</span>
                    <div class="gallery-images-section">

                    </div>
                </div>
            </div>


            <div class="skills">
                <span class="skills-title">Навыки</span>

                <input type="button" value="Добавить навык" class="skills-button">

                <div class="skills-line"></div>

                <div class="skills-section">

                </div>
            </div>


            <div class="item-section">
                <div class="item-character">
                    <span class="item-character-title">Материалы возвышения персонажа</span>
                    <div class="item-character-section">
                        <div class="item-character-level">
                            <span class="level">20</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">20000</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">1</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">3</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">3</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">40</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">40000</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">3</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">2</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">10</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">15</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                            </div>
                        </div>
                        
                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">50</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">60000</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">4</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">20</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">12</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                            </div>
                        </div>
                        
                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">60</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">80000</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">3</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">8</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">30</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">18</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                            </div>
                        </div>
                        
                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">70</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">100000</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">12</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">45</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">12</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                            </div>
                        </div>
                        
                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">80</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">120000</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">20</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">60</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">24</span>
                                    <input type="hidden" name="items_character[]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item-skills">
                    <span class="item-skills-title">Материалы возвышения талантов</span>
                    <div class="item-character-section">
                        <div class="item-character-level">
                            <span class="level">2</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">12500</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">3</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">3</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">17500</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">2</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">3</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">4</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">25000</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">4</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">4</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">5</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">30000</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">6</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">37500</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">9</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">9</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">7</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">120000</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">4</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">4</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">1</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">8</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">250000</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">6</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">1</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">9</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">450000</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">12</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">9</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">2</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>

                        <div class="line-items"></div>

                        <div class="item-character-level">
                            <span class="level">10</span>
                            <div class="items-level">
                                <div class="item-count">
                                    <span class="item-count-number">700000</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">16</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">12</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">2</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                                <div class="item-count">
                                    <span class="item-count-number">1</span>
                                    <input type="hidden" name="items_skills[]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="constellation">
                <span class="constellation-title">Созвездия</span>

                <div class="constellation-section">
                    <span class="constellation-section-title">Созвездие 1</span>
                    <div class="constellation-section-head">
                        <div class="constellation-section-head-image">+
                            <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon" required>
                        </div>
                        <div class="constellation-section-head-sectionName">
                            <span class="constellation-section-head-sectionName-title">Название:</span>
                            <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" required>
                        </div>
                    </div>
                    <div class="constellation-section-description">
                        <span class="constellation-section-description-title">Описание</span>
                        <div class="constellation-section-description-section">
                            <div class="constellation-section-description-section-text" contentEditable="true">
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div class="constellation-section-description-section-button">
                                <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/bold.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/italic.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="constellation-section-description-section-button-item">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="constellation-line"></div>

                <div class="constellation-section">
                    <span class="constellation-section-title">Созвездие 2</span>
                    <div class="constellation-section-head">
                        <div class="constellation-section-head-image">+
                            <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon" required>
                        </div>
                        <div class="constellation-section-head-sectionName">
                            <span class="constellation-section-head-sectionName-title">Название:</span>
                            <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" required>
                        </div>
                    </div>
                    <div class="constellation-section-description">
                        <span class="constellation-section-description-title">Описание</span>
                        <div class="constellation-section-description-section">
                            <div class="constellation-section-description-section-text" contentEditable="true">
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div class="constellation-section-description-section-button">
                                <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/bold.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/italic.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="constellation-section-description-section-button-item">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="constellation-line"></div>

                <div class="constellation-section">
                    <span class="constellation-section-title">Созвездие 3</span>
                    <div class="constellation-section-head">
                        <div class="constellation-section-head-image">+
                            <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon" required>
                        </div>
                        <div class="constellation-section-head-sectionName">
                            <span class="constellation-section-head-sectionName-title">Название:</span>
                            <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" required>
                        </div>
                    </div>
                    <div class="constellation-section-description">
                        <span class="constellation-section-description-title">Описание</span>
                        <div class="constellation-section-description-section">
                            <div class="constellation-section-description-section-text" contentEditable="true">
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div class="constellation-section-description-section-button">
                                <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/bold.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/italic.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="constellation-section-description-section-button-item">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="constellation-line"></div>

                <div class="constellation-section">
                    <span class="constellation-section-title">Созвездие 4</span>
                    <div class="constellation-section-head">
                        <div class="constellation-section-head-image">+
                            <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon" required>
                        </div>
                        <div class="constellation-section-head-sectionName">
                            <span class="constellation-section-head-sectionName-title">Название:</span>
                            <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" required>
                        </div>
                    </div>
                    <div class="constellation-section-description">
                        <span class="constellation-section-description-title">Описание</span>
                        <div class="constellation-section-description-section">
                            <div class="constellation-section-description-section-text" contentEditable="true">
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div class="constellation-section-description-section-button">
                                <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/bold.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/italic.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="constellation-section-description-section-button-item">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="constellation-line"></div>

                <div class="constellation-section">
                    <span class="constellation-section-title">Созвездие 5</span>
                    <div class="constellation-section-head">
                        <div class="constellation-section-head-image">+
                            <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon" required>
                        </div>
                        <div class="constellation-section-head-sectionName">
                            <span class="constellation-section-head-sectionName-title">Название:</span>
                            <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" required>
                        </div>
                    </div>
                    <div class="constellation-section-description">
                        <span class="constellation-section-description-title">Описание</span>
                        <div class="constellation-section-description-section">
                            <div class="constellation-section-description-section-text" contentEditable="true">
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div class="constellation-section-description-section-button">
                                <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/bold.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/italic.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="constellation-section-description-section-button-item">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="constellation-line"></div>

                <div class="constellation-section">
                    <span class="constellation-section-title">Созвездие 6</span>
                    <div class="constellation-section-head">
                        <div class="constellation-section-head-image">+
                            <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon" required>
                        </div>
                        <div class="constellation-section-head-sectionName">
                            <span class="constellation-section-head-sectionName-title">Название:</span>
                            <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" required>
                        </div>
                    </div>
                    <div class="constellation-section-description">
                        <span class="constellation-section-description-title">Описание</span>
                        <div class="constellation-section-description-section">
                            <div class="constellation-section-description-section-text" contentEditable="true">
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div class="constellation-section-description-section-button">
                                <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/bold.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/italic.svg" alt="#" class="constellation-section-description-section-button-item">
                                <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="constellation-section-description-section-button-item">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="recommendations">
                <span class="recommendations-title">Рекомендации оружия и артефактов</span>

                <div class="recommendations-section">
                    <span class="recommendations-section-title">Артефакты</span>
                    <div class="recommendations-section-choice-artifacts">
                        <input type="button" value="Выбрать" class="recommendations-section-choice-artifacts-button">
                        <div class="recommendations-section-choice-artifacts-type">
                            <span class="recommendations-section-choice-artifacts-type-value">2x2</span>
                            <div class="recommendations-section-choice-artifacts-type-line"></div>
                            <span class="recommendations-section-choice-artifacts-type-value">4</span>
                        </div>
                    </div>
                    <div class="recommendations-section-artifacts">

                    </div>
                </div>

                <div class="recommendations-line"></div>

                <div class="recommendations-section">
                    <span class="recommendations-section-title">Оружие</span>
                    <div class="recommendations-section-choice-weapons">
                        <input type="button" value="Выбрать" class="recommendations-section-choice-weapons-button">
                    </div>
                    <div class="recommendations-section-weapons">

                    </div>
                </div>
            </div>


            <div class="content-form-button">
                <a href="admin_characters.php" class="content-form-button-link">Назад</a>
                <input type="submit" name="save_button" class="content-form-button-save" value="Сохранить">
            </div>

        </form>

    </main>



    <div class="section-choice-skills">
        <input type="button" value="Закрыть" class="section-choice-skills-button">

        <div class="section-choice-skills-line"></div>

        <div class="section-choice-skills-skill">
            <span class="section-choice-skills-skill-item">обычная атака</span>
            <span class="section-choice-skills-skill-item">элементальный навык</span>
            <span class="section-choice-skills-skill-item">взрыв стихии</span>
            <span class="section-choice-skills-skill-item">пассивный талант</span>
            <span class="section-choice-skills-skill-item">другое</span>
        </div>
    </div>



    <div class="section-choice-items">
        <input type="button" value="Закрыть" class="section-choice-items-button">

        <div class="section-choice-items-line"></div>

        <div class="section-choice-items-images">
            <div class="section-choice-items-images-image"></div>
            <?php
            while($item = mysqli_fetch_array($items)){
            ?>
                <div class="section-choice-items-images-image">
                    <img src="<?php echo $item['path']; ?>" alt="#" class="section-choice-items-images-image-icon <?php echo $item['rare']; ?>">
                </div>
            <?php
            }
            ?>
        </div>
    </div>



    <div class="recommendations-section-choice-artifacts-items">
        <input type="button" value="Закрыть" class="recommendations-section-choice-artifacts-items-button">

        <div class="recommendations-line"></div>

        <div class="recommendations-section-choice-artifacts-items-section">
            <?php
                while($artifact = mysqli_fetch_array($artifacts)){
                ?>
                    <div class="recommendations-section-choice-artifacts-items-item" title="<?php echo $artifact['name']; ?>">
                        <input type="hidden" value="<?php echo $artifact['rare']; ?>">
                        <input type="hidden" value="<?php echo $artifact['id']; ?>">
                        <img src="../../<?php echo $artifact['path']; ?>" alt="#" class="recommendations-section-choice-artifacts-items-item-image <?php echo $artifact['rare']; ?>">
                    </div>
                <?php
                }
            ?>
        </div>
    </div>


            
    <div class="recommendations-section-choice-weapons-items">
        <input type="button" value="Закрыть" class="recommendations-section-choice-weapons-items-button">

        <div class="recommendations-line"></div>

        <div class="recommendations-section-choice-weapons-items-section">
            <?php
                while($weapon = mysqli_fetch_array($weapons)){
                ?>
                    <div class="recommendations-section-choice-weapons-items-item" title="<?php echo $weapon['name']; ?>">
                        <input type="hidden" name="name_weapons" value="<?php echo $weapon['name']; ?>">
                        <input type="hidden" name="rare_weapons" value="<?php echo $weapon['rare']; ?>">
                        <input type="hidden" name="class_weapons" value="<?php echo $weapon['class']; ?>">
                        <img src="../../<?php echo $weapon['path']; ?>" alt="#" class="recommendations-section-choice-weapons-items-item-image <?php echo $weapon['rare']; ?>">
                        <input type="checkbox" value="<?php echo $weapon['id']; ?>" name="recommendation_weapons[]" class="recommendations-section-choice-weapons-items-item-input">
                    </div>
                <?php
                }
            ?>
        </div>
    </div>



    <div class="message"></div>



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
    <script src="../../assets/js/admin/main_add_characters.js"></script>

</body>
</html>