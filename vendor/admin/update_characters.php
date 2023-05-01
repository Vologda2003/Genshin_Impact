<?php
include "../componets/connect.php";
if(!$_SESSION['admin']){
    header("location: authorization.php");
}
$id = $_GET['id'];
$character = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `characters` WHERE `id`='$id'"));
$gallery = json_decode($character['gallery']);
$skills_icon = json_decode($character['skills_icon']);
$skills_info = json_decode($character['skills_info']);
$item_character = json_decode($character['item_character']);
$item_skills = json_decode($character['item_skills']);
$constellation = json_decode($character['constellation']);
$items = mysqli_query($link, "SELECT * FROM `items` ORDER BY rare");
$artifacts = mysqli_query($link, "SELECT * FROM `artifacts` ORDER BY rare");
$weapons = mysqli_query($link, "SELECT * FROM `weapons` ORDER BY rare");
$recommendation_artifacts = mysqli_query($link, "SELECT *, artifacts.id as artifacts_id, artifacts.name as name1, artifacts2.id as artifacts2_id, artifacts.path as path1, artifacts.rare as rare1, artifacts.2 as 2_1, artifacts.4 as 4_1 FROM recommendation_artifacts INNER JOIN artifacts ON recommendation_artifacts.id_artifacts1 = artifacts.id INNER JOIN artifacts as artifacts2 ON recommendation_artifacts.id_artifacts2 = artifacts2.id WHERE recommendation_artifacts.id_characters='$id'");
$recommendation_weapons_db = mysqli_query($link, "SELECT * FROM recommendation_weapons INNER JOIN weapons ON recommendation_weapons.id_weapons = weapons.id WHERE recommendation_weapons.id_characters='$id'");
for ($recommendation_weapons = []; $recommendations_weapon = mysqli_fetch_array($recommendation_weapons_db); $recommendation_weapons[] = $recommendations_weapon);
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

    <div class="bgImage common" style="background-image: url(../../assets/image/imgElem/<?php echo $character['element']; ?>.jpg);"></div>



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
                <input type="hidden" name="id" value="<?php echo $character['id']; ?>">
                <div class="banner-header">
                    <div class="banner-header-icon-head <?php if($character['rare_character'] == 'star_4'){echo "star_4";} elseif($character['rare_character'] == 'star_5'){echo "star_5";} ?>">
                        <div class="banner-header-icon" style="background-image: url(../../assets/image/characters/<?php echo $character['name_en'] ?>/<?php echo $character['name_en'] ?>.png);">+
                            <input type="hidden" name="icon_path" value="../../assets/image/characters/<?php echo $character['name_en'] ?>/<?php echo $character['name_en'] ?>.png">
                            <input type="file" name="icon" class="banner-header-icon-image">
                        </div>
                    </div>
                    <div class="banner-header-name">
                        <span class="banner-header-name-title">Имя персонажа</span>
                        <div class="banner-header-name-ru">
                            <span class="banner-header-name-ru-title">RU</span>
                            <input type="text" name="name_ru" class="banner-header-name-ru-value" value="<?php echo $character['name_ru']; ?>" required>
                        </div>
                        <div class="banner-header-name-en">
                            <span class="banner-header-name-en-title">EN</span>
                            <input type="text" name="name_en" class="banner-header-name-en-value" value="<?php echo $character['name_en']; ?>" required>
                        </div>
                    </div>
                    <div class="banner-header-info">
                        <div class="banner-header-class">
                            <span class="banner-header-class-title">Класс:</span>
                            <select name="character_class" class="banner-header-class-value" required>
                                <option value="">Выберите</option>
                                <option <?php if(strpos($character['weapon'], "one-handed_sword.png")){echo "selected";} ?> value="one-handed_sword.png">Одноручник</option>
                                <option <?php if(strpos($character['weapon'], "two-handed_sword.png")){echo "selected";} ?> value="two-handed_sword.png">Двуручник</option>
                                <option <?php if(strpos($character['weapon'], "catalyst.png")){echo "selected";} ?> value="catalyst.png">Катализатор</option>
                                <option <?php if(strpos($character['weapon'], "archery.png")){echo "selected";} ?> value="archery.png">Лучник</option>
                                <option <?php if(strpos($character['weapon'], "spear.png")){echo "selected";} ?> value="spear.png">Копейщик</option>
                            </select>
                        </div>

                        <div class="banner-header-info-line"></div>

                        <div class="banner-header-element">
                            <span class="banner-header-element-title">Элемент:</span>
                            <select name="character_element" class="banner-header-element-value" required>
                                <option value="">Выберите</option>
                                <option <?php if($character['element'] == 'anemo'){echo "selected";} ?> value="anemo">Анемо</option>
                                <option <?php if($character['element'] == 'geo'){echo "selected";} ?> value="geo">Гео</option>
                                <option <?php if($character['element'] == 'cryo'){echo "selected";} ?> value="cryo">Крио</option>
                                <option <?php if($character['element'] == 'pyro'){echo "selected";} ?> value="pyro">Пиро</option>
                                <option <?php if($character['element'] == 'electro'){echo "selected";} ?> value="electro">Электро</option>
                                <option <?php if($character['element'] == 'hydro'){echo "selected";} ?> value="hydro">Гидро</option>
                                <option <?php if($character['element'] == 'dendro'){echo "selected";} ?> value="dendro">Дендро</option>
                            </select>
                        </div>

                        <div class="banner-header-info-line"></div>

                        <div class="banner-header-rare">
                            <span class="banner-header-rare-title">Редкость:</span>
                            <select name="character_rare" class="banner-header-rare-value" required>
                                <option value="">Выберите</option>
                                <option <?php if($character['rare_character'] == 'star_4'){echo "selected";} ?> value="star_4">4</option>
                                <option <?php if($character['rare_character'] == 'star_5'){echo "selected";} ?> value="star_5">5</option>
                            </select>
                        </div>
                        
                        <div class="banner-header-info-line"></div>

                        <div class="banner-header-region">
                            <span class="banner-header-region-title">Регион:</span>
                            <select name="character_region" class="banner-header-region-value" required>
                                <option value="">Выберите</option>
                                <option <?php if($character['region'] == 'Другой мир'){echo "selected";} ?> value="Другой мир">Другой мир</option>
                                <option <?php if($character['region'] == 'Мондштадт'){echo "selected";} ?> value="Мондштадт">Мондштадт</option>
                                <option <?php if($character['region'] == 'Ли Юэ'){echo "selected";} ?> value="Ли Юэ">Ли Юэ</option>
                                <option <?php if($character['region'] == 'Инадзума'){echo "selected";} ?> value="Инадзума">Инадзума</option>
                                <option <?php if($character['region'] == 'Сумеру'){echo "selected";} ?> value="Сумеру">Сумеру</option>
                                <option <?php if($character['region'] == 'Фонтейн'){echo "selected";} ?> value="Фонтейн">Фонтейн</option>
                                <option <?php if($character['region'] == 'Натлан'){echo "selected";} ?> value="Натлан">Натлан</option>
                                <option <?php if($character['region'] == 'Снежная'){echo "selected";} ?> value="Снежная">Снежная</option>
                            </select>
                        </div>
                    </div>
                    <div class="banner-header-map">
                        <span class="banner-header-map-title"></span>
                        <div class="banner-header-map-icon" style="background-image: url(../../assets/image/characters/<?php echo $character['name_en'] ?>/map.png);">+
                            <input type="hidden" name="map_path" value="../../assets/image/characters/<?php echo $character['name_en'] ?>/map.png">
                            <input type="file" name="map" class="banner-header-map-icon-image">
                        </div>
                    </div>
                </div>
                <div class="banner-description">
                    <span class="banner-description-title">Описание</span>
                    <textarea name="character_description" class="banner-description-text" required><?php echo $character['description'];?></textarea>
                </div>
            </div>


            <div class="gallery">
                <span class="gallery-title">Галерея</span>
                <div class="gallery-icon">Добавить
                    <input type="file" name="gallery[]" class="gallery-icon-image" multiple accept=".jpg, .png, .jpeg">
                </div>
                <div class="gallery-line"></div>
                <div class="gallery-images-last">
                    <span class="gallery-images-last-title">Ранее выбранные картинки</span>
                    <input type="hidden" name="gallery_image_last" value='<?php echo $character['gallery']; ?>'>
                    <div class="gallery-images-last-section">
                        <?php
                            if(count($gallery) > 0){
                                for($i = 0; $i < count($gallery); $i++){
                                    ?>
                                    <img src="../../<?php echo $gallery[$i]; ?>" alt="#" class="gallery-images-last-image">
                                    <?php
                                }
                            }
                        ?>
                    </div>
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
                    <?php
                    for($i = 0; $i < count($skills_info); $i++){
                        ?>
                        <div class="skills-section-skill">
                            <span class="skills-section-title"><?php if(!isset($skills_info[$i][0][1])){ echo 'Обычная атака'; }else{ echo mb_strtoupper(mb_substr($skills_info[$i][0][1], 0, 1)).mb_substr($skills_info[$i][0][1], 1); } ?></span>
                            <div class="skills-section-head">
                                <div class="skills-section-head-image" style="background-image: url(../../<?php echo $skills_icon[$i]; ?>);">+
                                    <input type="hidden" name="path_icon_skills[]" value="<?php echo $skills_icon[$i]; ?>">
                                    <input type="file" name="icon_skills[]" class="skills-section-head-image-icon">
                                </div>
                                <div class="skills-section-head-sectionName">
                                    <div class="skills-section-head-sectionName-row">
                                        <span class="skills-section-head-sectionName-row-title">Название:</span>
                                        <input type="text" name="name_skills" class="skills-section-head-sectionName-row-name" value="<?php echo $skills_info[$i][0][0]; ?>" required>
                                    </div>
                                    <?php
                                    if($skills_info[$i][0][1] == 'пассивный талант'){
                                        ?>
                                        <div class="skills-section-head-sectionName-row">
                                            <span class="skills-section-head-sectionName-row-title">Открытие:</span>
                                            <select name="passive_skills" class="skills-section-head-sectionName-row-openSkills" required>
                                                <option value="">Выберите</option>
                                                <option <?php if($skills_info[$i][0][2] == 'разблокируется на 1 уровне возвышения'){echo "selected";} ?> value="разблокируется на 1 уровне возвышения">разблокируется на 1 уровне возвышения</option>
                                                <option <?php if($skills_info[$i][0][2] == 'разблокируется на 4 уровне возвышения'){echo "selected";} ?> value="разблокируется на 4 уровне возвышения">разблокируется на 4 уровне возвышения</option>
                                                <option <?php if($skills_info[$i][0][2] == 'разблокируется автоматически'){echo "selected";} ?> value="разблокируется автоматически">разблокируется автоматически</option>
                                            </select>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="skills-section-description">
                                <span class="skills-section-description-title">Описание</span>
                                <div class="skills-section-description-section">
                                    <div class="skills-section-description-section-text" contentEditable="true">
                                        <?php
                                        for($j = 0; $j < count($skills_info[$i][1]); $j++){
                                            if($skills_info[$i][1][$j][0] === 0){
                                                if(count($skills_info[$i][1][$j][1]) === 0){
                                                    ?>
                                                    <div>
                                                        <br>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                ?>
                                                    <div>
                                                        <?php
                                                        for($n = 0; $n < count($skills_info[$i][1][$j][1]); $n++){
                                                            echo $skills_info[$i][1][$j][1][$n];
                                                            if($n != count($skills_info[$i][1][$j][1]) - 1){
                                                            ?>
                                                            <br>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                <?php
                                                }
                                            }
                                            elseif($skills_info[$i][1][$j][0] === 1){
                                            ?>
                                                <div>
                                                    <b><?php echo $skills_info[$i][1][$j][1]; ?></b><br>
                                                <?php
                                                for($n = 0; $n < count($skills_info[$i][1][$j][2]); $n++){
                                                ?>
                                                    <?php echo $skills_info[$i][1][$j][2][$n]; 
                                                    if($n != count($skills_info[$i][1][$j][2]) - 1){
                                                        ?>
                                                        <br>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </div>
                                            <?php
                                            }
                                            elseif($skills_info[$i][1][$j][0] === 2){
                                            ?>
                                                <div>
                                                    <b><?php echo $skills_info[$i][1][$j][1]; ?></b><br>
                                                    <ul>
                                                    <?php
                                                    for($n = 0; $n < count($skills_info[$i][1][$j][2]); $n++){
                                                    ?>
                                                        <li><?php echo $skills_info[$i][1][$j][2][$n]; ?></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    </ul>
                                                </div>
                                            <?php
                                            }
                                            elseif($skills_info[$i][1][$j][0] === 3){
                                            ?>
                                                <div>
                                                    <ul>
                                                    <?php
                                                    for($n = 0; $n < count($skills_info[$i][1][$j][1]); $n++){
                                                    ?>
                                                        <li><?php echo $skills_info[$i][1][$j][1][$n]; ?></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    </ul>
                                                </div>
                                            <?php
                                            }
                                        }
                                        if(count($skills_info[$i]) == 3){
                                            ?>
                                            <div>
                                                <i><?php echo $skills_info[$i][2]; ?></i>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="skills-section-description-section-button">
                                        <img src="../../assets/image/imgElem/list_ul.svg" alt="#" class="skills-section-description-section-button-item">
                                        <img src="../../assets/image/imgElem/bold.svg" alt="#" class="skills-section-description-section-button-item">
                                        <img src="../../assets/image/imgElem/italic.svg" alt="#" class="skills-section-description-section-button-item">
                                        <img src="../../assets/image/imgElem/paragraph.svg" alt="#" class="skills-section-description-section-button-item">
                                    </div>
                                </div>
                            </div>
                            <span class="skills-section-skill-close">X</span>
                        </div>
                        <?php
                        if(count($skills_info) > 1 && $i != count($skills_info) - 1){
                            ?>
                            <div class="skills-section-line"></div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>


            <div class="item-section">
                <div class="item-character">
                    <span class="item-character-title">Материалы возвышения персонажа</span>
                    <div class="item-character-section">
                        <?php
                        for($i = 0; $i < count($item_character); $i++){
                        ?>
                        <div class="item-character-level">
                            <span class="level"><?php echo $item_character[$i][0]; ?></span>
                            <div class="items-level">
                                <?php
                                for($j = 0; $j < count($item_character[$i][1]); $j++){
                                ?>
                                <div class="item-count">
                                    <?php 
                                    if($item_character[$i][1][$j][1] != ''){
                                    ?>
                                        <img src="../../<?php echo $item_character[$i][1][$j][1]; ?>" alt="#" class="item-count-image">
                                    <?php 
                                    } 
                                    ?>
                                    <span class="item-count-number"><?php echo $item_character[$i][1][$j][0]; ?></span>
                                    <input type="hidden" value="<?php echo $item_character[$i][1][$j][1]; ?>" name="items_character[]">
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                            if($i !== count($item_character) - 1){
                            ?>
                            <div class="line-items"></div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="item-skills">
                    <span class="item-skills-title">Материалы возвышения талантов</span>
                    <div class="item-character-section">
                        <?php
                        for($i = 0; $i < count($item_skills); $i++){
                        ?>
                        <div class="item-character-level">
                            <span class="level"><?php echo $item_skills[$i][0]; ?></span>
                            <div class="items-level">
                                <?php
                                for($j = 0; $j < count($item_skills[$i][1]); $j++){
                                ?>
                                <div class="item-count">
                                    <?php 
                                    if($item_skills[$i][1][$j][1] != ''){
                                    ?>
                                        <img src="../../<?php echo $item_skills[$i][1][$j][1]; ?>" alt="#" class="item-count-image">
                                    <?php 
                                    } 
                                    ?>
                                    <span class="item-count-number"><?php echo $item_skills[$i][1][$j][0] ?></span>
                                    <input type="hidden" value="<?php echo $item_skills[$i][1][$j][1]; ?>" name="items_character[]">
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                            if($i !== count($item_skills) - 1){
                            ?>
                            <div class="line-items"></div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="constellation">
                <span class="constellation-title">Созвездия</span>

                <?php
                for($i = 0; $i < count($constellation); $i++){
                ?>

                    <div class="constellation-section">
                        <span class="constellation-section-title">Созвездие <?php echo $i + 1; ?></span>
                        <div class="constellation-section-head">
                            <div class="constellation-section-head-image" style="background-image: url(../../<?php echo $constellation[$i][0]; ?>);">+
                                <input type="hidden" name="icon_constellation_path[]" value="<?php echo $constellation[$i][0]; ?>">
                                <input type="file" name="icon_constellation[]" class="constellation-section-head-image-icon">
                            </div>
                            <div class="constellation-section-head-sectionName">
                                <span class="constellation-section-head-sectionName-title">Название:</span>
                                <input type="text" name="name_constellation[]" class="constellation-section-head-sectionName-name" value="<?php echo $constellation[$i][1]; ?>" required>
                            </div>
                        </div>
                        <div class="constellation-section-description">
                            <span class="constellation-section-description-title">Описание</span>
                            <div class="constellation-section-description-section">
                                <div class="constellation-section-description-section-text" contentEditable="true">
                                    <?php
                                    for($j = 0; $j < count($constellation[$i][2]); $j++){
                                        if($constellation[$i][2][$j][0] === 0){
                                            if(count($constellation[$i][2][$j][1]) === 0){
                                                ?>
                                                <div>
                                                    <br>
                                                </div>
                                                <?php
                                            }
                                            else{
                                            ?>
                                                <div>
                                                    <?php
                                                    for($n = 0; $n < count($constellation[$i][2][$j][1]); $n++){
                                                        echo $constellation[$i][2][$j][1][$n];
                                                        if($n != count($constellation[$i][2][$j][1]) - 1){
                                                        ?>
                                                        <br>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            <?php
                                            }
                                        }
                                        elseif($constellation[$i][2][$j][0] === 1){
                                        ?>
                                            <div>
                                                <b><?php echo $constellation[$i][2][$j][1]; ?></b><br>
                                            <?php
                                            for($n = 0; $n < count($constellation[$i][2][$j][2]); $n++){
                                            ?>
                                                <?php echo $constellation[$i][2][$j][2][$n];
                                                if($n != count($constellation[$i][2][$j][2]) - 1){
                                                    ?>
                                                    <br>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </div>
                                        <?php
                                        }
                                        elseif($constellation[$i][2][$j][0] === 2){
                                        ?>
                                            <div>
                                                <b><?php echo $constellation[$i][2][$j][1]; ?></b><br>
                                                <ul>
                                                <?php
                                                for($n = 0; $n < count($constellation[$i][2][$j][2]); $n++){
                                                ?>
                                                    <li><?php echo $constellation[$i][2][$j][2][$n]; ?></li>
                                                <?php
                                                }
                                                ?>
                                                </ul>
                                            </div>
                                        <?php
                                        }
                                        elseif($constellation[$i][2][$j][0] === 3){
                                        ?>
                                            <div>
                                                <ul>
                                                <?php
                                                for($n = 0; $n < count($constellation[$i][2][$j][1]); $n++){
                                                ?>
                                                    <li><?php echo $constellation[$i][2][$j][1][$n]; ?></li>
                                                <?php
                                                }
                                                ?>
                                                </ul>
                                            </div>
                                        <?php
                                        }
                                    }
                                    ?>
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

                    <?php
                    if($i != count($constellation) - 1){
                    ?>
                        <div class="constellation-line"></div>
                    <?php
                    }
                }
                ?>
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
                        <?php
                        while($recommendations_artifact = mysqli_fetch_array($recommendation_artifacts)){
                            if($recommendations_artifact['count'] == 4){
                                ?>
                                <div class="recommendations-section-artifacts-type">
                                    <span class="recommendations-section-artifacts-type-image-delete" onclick="delete_type_choice(this)">X</span>
                                    <div class="recommendations-section-artifacts-type-image" onclick="display_choice_artifacts(this)">
                                        <input type="hidden" name="id_artifacts[]" value="<?php echo $recommendations_artifact['id']; ?>">
                                        <div class="recommendations-section-artifacts-type-image-add">+</div>
                                        <span class="recommendations-section-artifacts-type-image-count"><?php echo $recommendations_artifact['count']; ?></span>
                                        <img src="../../<?php echo $recommendations_artifact['path']; ?>" alt="#" class="recommendations-section-artifacts-type-image-icon <?php echo $recommendations_artifact['rare']; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                            elseif($recommendations_artifact['count'] == 2){
                                ?>
                                <div class="recommendations-section-artifacts-type">
                                    <span class="recommendations-section-artifacts-type-image-delete" onclick="delete_type_choice(this)">X</span>
                                    <div class="recommendations-section-artifacts-type-image" onclick="display_choice_artifacts(this)">
                                        <input type="hidden" name="id_artifacts[]" value="<?php echo $recommendations_artifact['id_artifacts1']; ?>">
                                        <div class="recommendations-section-artifacts-type-image-add">+</div>
                                        <span class="recommendations-section-artifacts-type-image-count"><?php echo $recommendations_artifact['count']; ?></span>
                                        <img src="../../<?php echo $recommendations_artifact['path1']; ?>" alt="#" class="recommendations-section-artifacts-type-image-icon <?php echo $recommendations_artifact['rare1']; ?>">
                                    </div>
                                    <div class="recommendations-section-artifacts-type-image" onclick="display_choice_artifacts(this)">
                                        <input type="hidden" name="id_artifacts[]" value="<?php echo $recommendations_artifact['id_artifacts2']; ?>">
                                        <div class="recommendations-section-artifacts-type-image-add">+</div>
                                        <span class="recommendations-section-artifacts-type-image-count"><?php echo $recommendations_artifact['count']; ?></span>
                                        <img src="../../<?php echo $recommendations_artifact['path']; ?>" alt="#" class="recommendations-section-artifacts-type-image-icon <?php echo $recommendations_artifact['rare']; ?>">
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
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
                <input type="submit" name="save_update_button" class="content-form-button-save" value="Сохранить">
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
                    <img src="../../<?php echo $item['path']; ?>" alt="#" class="section-choice-items-images-image-icon <?php echo $item['rare']; ?>">
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
                    <div class="recommendations-section-choice-weapons-items-item <?php if(!strpos($character['weapon'], $weapon['class'])){echo "hide-weapons";} if(in_array($weapon['id'], array_column($recommendation_weapons, 'id'))){echo "active-choice-weapons";} ?>" title="<?php echo $weapon['name']; ?>">
                        <input type="hidden" value="<?php echo $weapon['name']; ?>">
                        <input type="hidden" value="<?php echo $weapon['rare']; ?>">
                        <input type="hidden" name="class_weapons" value="<?php echo $weapon['class']; ?>">
                        <img src="../../<?php echo $weapon['path']; ?>" alt="#" class="recommendations-section-choice-weapons-items-item-image <?php echo $weapon['rare']; ?>">
                        <input type="checkbox" value="<?php echo $weapon['id']; ?>" name="recommendation_weapons[]" class="recommendations-section-choice-weapons-items-item-input" <?php if(in_array($weapon['id'], array_column($recommendation_weapons, 'id'))){echo "checked";} ?>>
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
    <script src="../../assets/js/admin/main_update_characters.js"></script>

</body>
</html>