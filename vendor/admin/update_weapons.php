<?php
    include "../componets/connect.php";
    if(!$_SESSION['admin']){
        header("location: authorization.php");
    }

    $id = $_GET['id'];
    $weapon = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `weapons` WHERE `id`='$id'"));

    if(isset($_POST["weapons_submit"])){
        $name = trim($_POST['weapons_name']);
        $rare = trim($_POST['weapons_rare']);
        $class = trim($_POST['weapons_class']);
        $info1 = 'Основная характеристика: '.trim($_POST['weapons_info'][0]);
        $info2 = 'Второстепенная характеристика: '.trim($_POST['weapons_info'][1]);
        $info3 = 'Пассивная способность: '.trim($_POST['weapons_info'][2]);
        $path_weapon = $_POST['path_weapon'];
        if(mb_substr($info1, -1) != '.'){
            $info1 .= '.';
        }
        if(mb_substr($info2, -1) != '.'){
            $info2 .= '.';
        }
        if(mb_substr($info3, -1) != '.'){
            $info3 .= '.';
        }
        $description = $info1.' '.$info2.' '.$info3;
        if(!$_FILES["weapons_image"]["tmp_name"]){
            mysqli_query($link, "UPDATE `weapons` SET `name` = '$name', `rare` = '$rare', `path` = '$path_weapon', `class`='$class', `description`= '$description' WHERE `id` = '$id'");
        }
        else{
            $path = 'assets/image/weapons/'.basename($_FILES['weapons_image']["name"]);
            unlink('../../'.$path_weapon);
            move_uploaded_file($_FILES["weapons_image"]["tmp_name"], '../../'.$path);
            mysqli_query($link, "UPDATE `weapons` SET `name` = '$name', `rare` = '$rare', `path` = '$path', `class`='$class', `description`= '$description' WHERE `id` = '$id'");
        }
        header("location: admin_weapons.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin/style_admin_weapons.css">
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
        <div class="weapons-section">
            <form action="" method="post" class="weapons-form-add" enctype="multipart/form-data">
                <h2>Изменение</h2>
                <div class="weapons-form-add-header">
                    <div class="weapons-form-add-header-logo <?php echo $weapon['rare']; ?>">
                        <div class="weapons-form-add-header-logo-icon" style="background-image: url(../../<?php echo $weapon['path']; ?>);">+
                            <input type="file" name="weapons_image" class="weapons-form-add-header-logo-icon-image" accept=".jpg, .png, .jpeg">
                        </div>
                    </div>
                    <input type="hidden" name="path_weapon" value="<?php echo $weapon['path']; ?>" required>
                    <div class="weapons-form-add-header-info">
                        <span class="weapons-form-add-header-info-title">Название:</span>
                        <input type="text" name="weapons_name" class="weapons-form-add-header-info-name" required value="<?php echo $weapon['name']; ?>">
                    </div>
                    <div class="weapons-form-add-header-info">
                        <span class="weapons-form-add-header-info-title">Редкость:</span>
                        <select name="weapons_rare" class="weapons-form-add-header-info-name" required>
                            <option value="">Выберите</option>
                            <option <?php if($weapon['rare'] == 'star_5'){echo "selected";} ?> value="star_5">5</option>
                            <option <?php if($weapon['rare'] == 'star_4'){echo "selected";} ?> value="star_4">4</option>
                            <option <?php if($weapon['rare'] == 'star_3'){echo "selected";} ?> value="star_3">3</option>
                            <option <?php if($weapon['rare'] == 'star_2'){echo "selected";} ?> value="star_2">2</option>
                            <option <?php if($weapon['rare'] == 'star_1'){echo "selected";} ?> value="star_1">1</option>
                        </select>
                    </div>
                    <div class="weapons-form-add-header-info">
                        <span class="weapons-form-add-header-info-title">Класс:</span>
                        <select name="weapons_class" class="weapons-form-add-header-info-name" required>
                            <option value="">Выберите</option>
                            <option <?php if($weapon['class'] == 'one-handed_sword'){echo "selected";} ?> value="one-handed_sword">Одноручное</option>
                            <option <?php if($weapon['class'] == 'two-handed_sword'){echo "selected";} ?> value="two-handed_sword">Двуручное</option>
                            <option <?php if($weapon['class'] == 'catalyst'){echo "selected";} ?> value="catalyst">Катализатор</option>
                            <option <?php if($weapon['class'] == 'archery'){echo "selected";} ?> value="archery">Лук</option>
                            <option <?php if($weapon['class'] == 'spear'){echo "selected";} ?> value="spear">Копьё</option>
                        </select>
                    </div>
                </div>
                <div class="weapons-form-add-info">
                    <div class="weapons-form-add-info-section">
                        <span class="weapons-form-add-info-section-name">Основная характеристика</span>
                        <textarea name="weapons_info[]" class="weapons-form-add-info-section-text" required><?php echo substr($weapon['description'], strlen('Основная характеристика: '), strpos($weapon['description'], ' Второстепенная характеристика:') - strlen('Основная характеристика: ')); ?></textarea>
                    </div>
                    <div class="weapons-form-add-info-section">
                        <span class="weapons-form-add-info-section-name">Второстепенная характеристика</span>
                        <textarea name="weapons_info[]" class="weapons-form-add-info-section-text" required><?php echo substr($weapon['description'], strpos($weapon['description'], 'Второстепенная характеристика:') + strlen('Второстепенная характеристика: '), (strpos($weapon['description'], ' Пассивная способность:') - strpos($weapon['description'], 'Второстепенная характеристика:') - strlen('Второстепенная характеристика: '))); ?></textarea>
                    </div>
                    <div class="weapons-form-add-info-section">
                        <span class="weapons-form-add-info-section-name">Пассивная способность</span>
                        <textarea name="weapons_info[]" class="weapons-form-add-info-section-text" required><?php echo substr($weapon['description'], strpos($weapon['description'], 'Пассивная способность:') + strlen('Пассивная способность: ')); ?></textarea>
                    </div>
                </div>
                <div class="weapons-form-add-button">
                    <input type="reset" value="Вернуть первоначальное">
                    <input type="submit" value="Обновить" name="weapons_submit">
                </div>
                <div class="repeal-section">
                    <a href="admin_weapons.php" class="repeal">Назад</a>
                </div>
            </form>
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
    <script type="text/javascript">
        var path = "<?php echo $weapon['path']; ?>";
        var rare_weapons = "<?php echo $weapon['rare']; ?>";
    </script>
    <script src="../../assets/js/admin/main_admin_weapons.js"></script>

</body>
</html>