<?php
    include "../componets/connect.php";
    $name_en = $_GET['name_en'];
    $character = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `characters` WHERE `name_en`= '$name_en'"));
    $id = $character['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style_characters.css">
    <link rel="stylesheet" href="../../assets/image/characters/<?php echo $character['name_en']; ?>/map.css">
    <link rel="shortcut icon" href="../../assets/image/imgElem/ban.png" type="image/png">
    <title>Genshin Impact</title>

</head>
<body>

    <div class="bgImage <?php echo $character['element']; ?>"></div>

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

        <form class="search" method="post" action="../componets/search.php">
            <input class="search_text" name="search_text" placeholder="Поиск" type="search">
            <button class="search_submit" name="search_submit" type="submit"></button>
        </form>

    </header>



    <main class="content">
        
        <div class="banner">
            <div class="logo-banner">
                <div class="icon-character <?php echo $character['rare_character'].' '.$character['element'] ?>">
                    <img src="../../assets/image/characters/<?php echo $character['name_en'] ?>/<?php echo $character['name_en'] ?>.png" alt="#" class="icon-character-image">
                </div>
                <div class="character">
                    <div class="info-character">
                        <span class="name-character"><?php echo $character['name_ru'] ?></span>
                        <img src="../../assets/image/elements/<?php echo $character['element'] ?>.png" alt="#" class="element-character">
                    </div>
                    <div class="rare-character">
                        <?php
                        for($i = 0; $i < $character['rare']; $i++){
                        ?>
                        <img src="../../assets/image/imgElem/levelStar.png" alt="#">
                        <?php
                        }
                        ?>
                    </div>
                    <span class="region">Регион: <?php echo $character['region'] ?></span>
                </div>
            </div>
            <div class="description">
                <span class="name-section">Описание</span>
                <span class="description-info">
                    <?php echo $character['description'] ?>
                </span>
            </div>
        </div>


        <div class="gallery">
            <span class="name-section">Галерея</span>
            <div class="gallery-image">
                <?php
                $gallery = json_decode($character['gallery']);
                foreach($gallery as $image){
                ?>
                    <img src="../../<?php echo $image; ?>" alt="#">
                <?php
                }
                ?>
            </div>
        </div>


        <div class="skills">
            <span class="name-section">Таланты</span>
            <div class="skill">
                <?php
                $skills_icon = json_decode($character['skills_icon']);
                for($i = 0; $i < count($skills_icon); $i++){
                ?>
                <div class="skills-icon">
                    <img src="../../<?php echo $skills_icon[$i]; ?>" alt="#" class="skills-image">
                </div>
                <?php
                }
                ?>
            </div>

            <div class="skills-info">
                <?php
                    $skills_info = json_decode($character['skills_info']);
                    for($i = 0; $i < count($skills_info); $i++){
                ?>
                    <div class="skills-info-skill">
                    <?php
                    //Название блока и его подтип
                    if(count($skills_info[$i][0]) == 1){
                    ?>
                        <span class="skills-info-name"><?php echo $skills_info[$i][0][0]; ?></span>
                    <?php
                    }
                    elseif(count($skills_info[$i][0]) == 2){
                    ?>
                        <span class="skills-info-name"><?php echo $skills_info[$i][0][0]; ?></span>
                        <span class="skills-info-name-type"><?php echo $skills_info[$i][0][1]; ?></span>
                    <?php
                    }
                    elseif(count($skills_info[$i][0]) == 3){
                    ?>
                        <span class="skills-info-name"><?php echo $skills_info[$i][0][0]; ?></span>
                        <span class="skills-info-name-type"><?php echo $skills_info[$i][0][1]; ?></span>
                        <span class="skills-info-name-type-info"><?php echo $skills_info[$i][0][2]; ?></span>
                    <?php
                    }

                    //Описание навыка
                    for($j = 0; $j < count($skills_info[$i][1]); $j++){
                        if($skills_info[$i][1][$j][0] == 0){
                        ?>
                            <div class="skills-info-section">
                            <?php
                            for($n = 0; $n < count($skills_info[$i][1][$j][1]); $n++){
                            ?>
                                <span class="skills-info-section-text"><?php echo $skills_info[$i][1][$j][1][$n]; ?></span>
                            <?php
                            }
                            ?>
                            </div>
                        <?php
                        }
                        elseif($skills_info[$i][1][$j][0] == 1){
                        ?>
                            <div class="skills-info-section">
                                <span class="skills-info-name"><?php echo $skills_info[$i][1][$j][1]; ?></span>
                            <?php
                            for($n = 0; $n < count($skills_info[$i][1][$j][2]); $n++){
                            ?>
                                <span class="skills-info-section-text"><?php echo $skills_info[$i][1][$j][2][$n]; ?></span>
                            <?php
                            }
                            ?>
                            </div>
                        <?php
                        }
                        elseif($skills_info[$i][1][$j][0] == 2){
                        ?>
                            <div class="skills-info-section">
                                <span class="skills-info-name"><?php echo $skills_info[$i][1][$j][1]; ?></span>
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
                        elseif($skills_info[$i][1][$j][0] == 3){
                        ?>
                            <div class="skills-info-section">
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

                    //Комментарий
                    if(count($skills_info[$i]) == 3){
                    ?>
                        <div class="skills-info-section">
                            <span class="skills-info-section-text-comment"><?php echo $skills_info[$i][2]; ?></span>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>

        
        <div class="item-section">

            <div class="item-character">
                <span class="name-section">Материалы возвышения персонажа</span>
                <div class="item-character-section">
                    <?php
                    $item_character = json_decode($character['item_character']);
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
                                        <?php } ?>
                                        <span class="item-count-number"><?php echo $item_character[$i][1][$j][0]; ?></span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if($i != count($item_character) - 1){
                        ?>
                        <div class="line-skill"></div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="item-skills">
                <span class="name-section">Материалы возвышения талантов</span>
                <div class="item-character-section">
                    <?php
                    $item_skills = json_decode($character['item_skills']);
                    for($i = 0; $i < count($item_skills); $i++){
                    ?>
                        <div class="item-character-level">
                            <span class="level"><?php echo $item_skills[$i][0] ?></span>
                            <div class="items-level">
                                <?php
                                for($j = 0; $j < count($item_skills[$i][1]); $j++){
                                ?>
                                    <div class="item-count">
                                        <?php 
                                        if($item_skills[$i][1][$j][1] != ''){
                                        ?>
                                        <img src="../../<?php echo $item_skills[$i][1][$j][1] ?>" alt="#" class="item-count-image">
                                        <?php } ?>
                                        <span class="item-count-number"><?php echo $item_skills[$i][1][$j][0] ?></span>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if($i != count($item_skills) - 1){
                        ?>
                        <div class="line-skill"></div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>


        <div class="constellation">
            <span class="name-section">Созвездия</span>

            <?php
            $constellation = json_decode($character['constellation']);
            for($i = 0; $i < count($constellation); $i++){
            ?>
                <div class="constellation-section">
                    <div class="constellation-section-info-logo">
                        <img src="../../<?php echo $constellation[$i][0]; ?>" alt="#" class="constellation-section-info-image">
                        <span class="constellation-section-info-name"><?php echo $constellation[$i][1]; ?></span>
                    </div>
                    <?php
                    for($j = 0; $j < count($constellation[$i][2]); $j++){
                        if($constellation[$i][2][$j][0] == 0){
                        ?>
                            <div class="constellation-section-info">
                                <?php
                                for($n = 0; $n < count($constellation[$i][2][$j][1]); $n++){
                                ?>
                                    <span class="constellation-section-info-text"><?php echo $constellation[$i][2][$j][1][$n]; ?></span>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                        }
                        elseif($constellation[$i][2][$j][0] == 3){
                        ?>
                            <div class="constellation-section-info">
                                <span class="constellation-section-info-text">
                                    <ul>
                                    <?php
                                    for($n = 0; $n < count($constellation[$i][2][$j][1]); $n++){
                                    ?>
                                        <li><?php echo $constellation[$i][2][$j][1][$n]; ?></li>
                                    <?php
                                    }
                                    ?>
                                    </ul>
                                </span>
                            </div>
                        <?php
                        }
                    }
                    ?>
                </div>
                <?php
                if($i != count($constellation) - 1){
                ?>
                    <div class="line-constellation"></div>
                <?php
                }
            }
            ?>

        </div>


        <div class="recommendations">
            <span class="name-section">Рекомендации оружия и артефактов</span>

            <div class="recommendations-items">
                <span class="recommendations-items-title">Артефакты</span>
                <div class="recommendations-items-sets">

                <?php
                $recommendation_artifacts = mysqli_query($link, "SELECT *, artifacts.id as artifacts_id, artifacts.name as name1, artifacts2.id as artifacts2_id, artifacts.path as path1, artifacts.rare as rare1, artifacts.2 as 2_1, artifacts.4 as 4_1 FROM recommendation_artifacts INNER JOIN artifacts ON recommendation_artifacts.id_artifacts1 = artifacts.id INNER JOIN artifacts as artifacts2 ON recommendation_artifacts.id_artifacts2 = artifacts2.id WHERE recommendation_artifacts.id_characters='$id'");
                while($recommendations_artifact = mysqli_fetch_array($recommendation_artifacts)){
                    if($recommendations_artifact['count'] == 4){
                    ?>
                        <div class="recommendations-items-sets-set">
                            <div class="recommendations-items-sets-set-section">
                                <div class="recommendations-items-sets-set-section-image">
                                    <img src="../../<?php echo $recommendations_artifact['path']; ?>" alt="#" title="<?php echo $recommendations_artifact['name']; ?>" class="recommendations-items-sets-set-image <?php echo $recommendations_artifact['rare']; ?>">
                                    <span class="recommendations-items-sets-set-section-count"><?php echo $recommendations_artifact['count']; ?></span>
                                </div>
                            </div>
                            <div class="recommendations-items-sets-set-info">
                                <span class="recommendations-items-sets-set-info-name">Характеристики:</span>
                                <ul class="recommendations-items-sets-set-info-text">
                                    <li>2 предмета: <?php echo $recommendations_artifact['2']; ?></li>
                                    <li>4 предмета: <?php echo $recommendations_artifact['4']; ?></li>
                                </ul>
                            </div>
                        </div>
                    <?php
                    }
                    elseif($recommendations_artifact['count'] == 2){
                    ?>
                        <div class="recommendations-items-sets-set">
                            <div class="recommendations-items-sets-set-section">
                                <div class="recommendations-items-sets-set-section-image">
                                    <img src="../../<?php echo $recommendations_artifact['path']; ?>" alt="#" title="<?php echo $recommendations_artifact['name']; ?>" class="recommendations-items-sets-set-image <?php echo $recommendations_artifact['rare']; ?>">
                                    <span class="recommendations-items-sets-set-section-count"><?php echo $recommendations_artifact['count']; ?></span>
                                </div>
                                <div class="recommendations-items-sets-set-section-image">
                                    <img src="../../<?php echo $recommendations_artifact['path1']; ?>" alt="#" title="<?php echo $recommendations_artifact['name1']; ?>" class="recommendations-items-sets-set-image <?php echo $recommendations_artifact['rare1']; ?>">
                                    <span class="recommendations-items-sets-set-section-count"><?php echo $recommendations_artifact['count']; ?></span>
                                </div>
                            </div>
                            <div class="recommendations-items-sets-set-info">
                                <span class="recommendations-items-sets-set-info-name">Характеристики:</span>
                                <ul class="recommendations-items-sets-set-info-text">
                                    <li>2 <?php echo $recommendations_artifact['name']; ?>: <?php echo $recommendations_artifact['2']; ?></li>
                                    <li>2 <?php echo $recommendations_artifact['name1']; ?>: <?php echo $recommendations_artifact['2_1']; ?></li>
                                </ul>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>

                </div>
            </div>

            <div class="line-constellation"></div>

            <div class="recommendations-items">
                <span class="recommendations-items-title">Оружие</span>
                <div class="recommendations-items-weapons">
                    <?php
                    $recommendation_weapons = mysqli_query($link, "SELECT * FROM recommendation_weapons INNER JOIN weapons ON recommendation_weapons.id_weapons = weapons.id WHERE recommendation_weapons.id_characters='$id'");
                    while($recommendations_weapon = mysqli_fetch_array($recommendation_weapons)){
                    ?>
                        <div class="recommendations-items-weapons-weapon">
                            <div class="recommendations-items-weapons-weapon-header">
                                <img src="../../<?php echo $recommendations_weapon['path']; ?>" alt="#" class="recommendations-items-weapons-weapon-image <?php echo $recommendations_weapon['rare']; ?>">
                                <span class="recommendations-items-weapons-weapon-name"><?php echo $recommendations_weapon['name']; ?></span>
                            </div>
                            <span class="recommendations-items-weapons-weapon-info"><?php echo $recommendations_weapon['description']; ?></span>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </main>


    <div class="view-gallery">
        <?php
        $view_gallery = json_decode($character['gallery']);
        foreach($view_gallery as $image){
        ?>
            <img src="../../<?php echo $image; ?>" alt="#" class="image">
        <?php
        }
        ?>
    </div>


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
    <script src="../../assets/js/main_characters.js"></script>

</body>
</html>