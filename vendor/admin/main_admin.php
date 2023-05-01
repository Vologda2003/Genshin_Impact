<?php
include "../componets/connect.php";
if(!$_SESSION['admin']){
    header("location: authorization.php");
}
else{
    
    //ОРУЖИЕ

    if(isset($_POST['weapons_submit'])){
        $path = 'assets/image/weapons/'.basename($_FILES['weapons_image']["name"]);
        $name = trim($_POST['weapons_name']);
        $rare = trim($_POST['weapons_rare']);
        $class = trim($_POST['weapons_class']);
        $info1 = 'Основная характеристика: '.trim($_POST['weapons_info'][0]);
        $info2 = 'Второстепенная характеристика: '.trim($_POST['weapons_info'][1]);
        $info3 = 'Пассивная способность: '.trim($_POST['weapons_info'][2]);
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
        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `weapons` WHERE `name`='$name' AND `path`='$path' AND `class`='$class'")) == 0){
            move_uploaded_file($_FILES["weapons_image"]["tmp_name"], '../../'.$path);
            if(mysqli_query($link, "INSERT INTO `weapons`(`name`, `rare`, `path`, `class`, `description`) VALUES ('$name', '$rare', '$path', '$class', '$description')")){
                $_SESSION['message'] = ['message_open', 'Оружие добавлено'];
            }
            else{
                $_SESSION['message'] = ['message_open', 'Ошибка при добавлении'];
            }
        }
        else{
            $_SESSION['message'] = ['message_open', 'Такое оружие существует'];
        }
        header("location: admin_weapons.php");
    }

    if(isset($_POST['weapons_delete'])){
        $id_weapon = $_POST['id_weapon'];
        unlink('../../'.$_POST['path_weapon']);
        mysqli_query($link, "DELETE FROM `weapons` WHERE `id`= '$id_weapon'");
        header("location: admin_weapons.php");
    }


    //АРТЕФАКТЫ

    if(isset($_POST['artifacts_submit'])){
        $path = 'assets/image/artifacts/'.basename($_FILES['artifacts_image']["name"]);
        $name = trim($_POST['artifacts_name']);
        $rare = trim($_POST['artifacts_rare']);
        $info1 = trim($_POST['artifacts_info'][0]);
        $info2 = trim($_POST['artifacts_info'][1]);
        if(mb_substr($info1, -1) != '.'){
            $info1 .= '.';
        }
        if(mb_substr($info2, -1) != '.'){
            $info2 .= '.';
        }
        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `artifacts` WHERE `name`='$name' AND `path`='$path'")) == 0){
            move_uploaded_file($_FILES["artifacts_image"]["tmp_name"], '../../'.$path);
            if(mysqli_query($link, "INSERT INTO `artifacts`(`name`, `path`, `rare`, `2`, `4`) VALUES ('$name', '$path', '$rare', '$info1', '$info2')")){
                $_SESSION['message'] = ['message_open', 'Артефакт добавлен'];
            }
            else{
                $_SESSION['message'] = ['message_open', 'Ошибка при добавлении'];
            }
        }
        else{
            $_SESSION['message'] = ['message_open', 'Такой артефакт существует'];
        }
        header("location: admin_artifacts.php");
    }

    if(isset($_POST['artifacts_delete'])){
        $id_artifact = $_POST['id_artifact'];
        unlink('../../'.$_POST['path_artifact']);
        mysqli_query($link, "DELETE FROM `artifacts` WHERE `id`= '$id_artifact'");
        header("location: admin_artifacts.php");
    }


    //ПРЕДМЕТЫ

    if(isset($_POST['items_submit'])){
        $path = 'assets/image/items/'.basename($_FILES['items_image']["name"]);
        $rare = trim($_POST['items_rare']);
        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `items` WHERE `path`='$path'")) == 0){
            move_uploaded_file($_FILES["items_image"]["tmp_name"], '../../'.$path);
            if(mysqli_query($link, "INSERT INTO `items`(`path`, `rare`) VALUES ('$path', '$rare')")){
                $_SESSION['message'] = ['message_open', 'Предмет добавлен'];
            }
            else{
                $_SESSION['message'] = ['message_open', 'Ошибка'];
            }
        }
        else{
            $_SESSION['message'] = ['message_open', 'Такой предмет существует'];
        }
        header("location: admin_items.php");
    }

    if(isset($_POST['items_delete'])){
        $id_items = $_POST['id_items'];
        unlink('../../'.$_POST['path_items']);
        mysqli_query($link, "DELETE FROM `items` WHERE `id`= '$id_items'");
        header("location: admin_items.php");
    }


    //ПЕРСОНАЖИ

    if(isset($_POST['save_character'])){
        $name_ru = $_POST['name_ru'];
        $name_en = $_POST['name_en'];
        $weapon = "assets/image/weapons/".$_POST['weapon'];
        $element = $_POST['element'];
        $skills_element = "skills-$element";
        $rare = null;
        if($_POST['rare_character'] == "star_5"){
            $rare = 5;
        }
        elseif ($_POST['rare_character'] == "star_4") {
            $rare = 4;
        }
        $rare_character = $_POST['rare_character'];
        $region = $_POST['region'];
        $description = $_POST['description'];
        $skills_info = $_POST['skills_info'];
        $item_character = $_POST['item_character'];
        $item_skills = $_POST['item_skills'];
        $constellation = $_POST['constellation'];
        $recommendation_artifacts = json_decode($_POST['recommendation_artifacts']);
        $recommendation_weapons = json_decode($_POST['recommendation_weapons']);

        $gallery = [];
        $skills_icon = [];

        $path = 'assets/image/characters/'.$name_en;

        if(!is_dir('../../'.$path)) {
            mkdir('../../'.$path);
        }
        if(!is_dir('../../'.$path.'/Talents')) {
            mkdir('../../'.$path.'/Talents');
        }
        if(!is_dir('../../'.$path.'/Constellation')) {
            mkdir('../../'.$path.'/Constellation');
        }

        if(!empty($_FILES['icon'])){
            $type = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            if(!move_uploaded_file($_FILES['icon']['tmp_name'], '../../'.$path."/".$name_en.".".$type)){
                echo "Ошибка при загрузки ".basename($_FILES['icon']['name']);
            }
        }

        if(!empty($_FILES['map'])){
            if(!move_uploaded_file($_FILES['map']['tmp_name'], '../../'.$path."/".basename($_FILES['map']['name']))){
                echo "Ошибка при загрузки ".basename($_FILES['map']['name']);
            }
            else{
                $map = ".banner{\n\tbackground: url(map.png) no-repeat;\n\tbackground-size: cover;\n}";
                file_put_contents("'../../'.$path/map.css", $map);
            }
        }

        if(!empty($_FILES['gallery'])){
            for($i = 0; $i < count($_FILES['gallery']['name']); $i++){
                if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i], '../../'.$path."/".basename($_FILES['gallery']['name'][$i]))){
                    $gallery[] = $path."/".basename($_FILES['gallery']['name'][$i]);
                }
                else{
                    echo "Ошибка при загрузки ".basename($_FILES['gallery']['name'][$i]);
                }
            }
        }

        if(!empty($_FILES['skills_icon'])){
            for($i = 0; $i < count($_FILES['skills_icon']['name']); $i++){
                if(move_uploaded_file($_FILES['skills_icon']['tmp_name'][$i], '../../'.$path."/Talents/".basename($_FILES['skills_icon']['name'][$i]))){
                    $skills_icon[] = $path."/Talents/".basename($_FILES['skills_icon']['name'][$i]);
                }
                else{
                    echo "Ошибка при загрузки ".basename($_FILES['skills_icon']['name'][$i]);
                }
            }
        }

        if(!empty($_FILES['constellation_icon'])){
            for($i = 0; $i < count($_FILES['constellation_icon']['name']); $i++){
                if(!move_uploaded_file($_FILES['constellation_icon']['tmp_name'][$i], '../../'.$path."/Constellation/".basename($_FILES['constellation_icon']['name'][$i]))){
                    echo "Ошибка при загрузки ".basename($_FILES['constellation_icon']['name'][$i]);
                }
            }
        }

        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `characters` WHERE `name_en`='$name_en'")) == 0){
            if(mysqli_query($link, "INSERT INTO `characters`(`name_en`, `name_ru`, `element`, `rare`, `rare_character`, `weapon`, `region`, `description`, `gallery`, `skills_element`, `skills_icon`, `skills_info`, `item_character`, `item_skills`, `constellation`) VALUES ('$name_en', '$name_ru', '$element', '$rare', '$rare_character', '$weapon', '$region', '$description', '".json_encode($gallery, JSON_UNESCAPED_UNICODE)."', '$skills_element', '".json_encode($skills_icon, JSON_UNESCAPED_UNICODE)."', '$skills_info', '$item_character', '$item_skills', '$constellation')")){
                echo "Успешно";
                $character = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM `characters` WHERE `name_en`='$name_en'"));
                if(count($recommendation_artifacts) > 0){
                    foreach ($recommendation_artifacts as $artifact) {
                        mysqli_query($link, "INSERT INTO `recommendation_artifacts`(`id_characters`, `count`, `id_artifacts1`, `id_artifacts2`) VALUES ('{$character['id']}', '{$artifact[0]}', '{$artifact[1]}', '{$artifact[2]}')");
                    } 
                }
                if(count($recommendation_weapons) > 0){
                    foreach ($recommendation_weapons as $weapon_id) {
                        mysqli_query($link, "INSERT INTO `recommendation_weapons`(`id_characters`, `id_weapons`) VALUES ('{$character['id']}', '$weapon_id')");
                    }
                }
            }
            else{
                echo "Ошибка при добавлении персонажа";
            }
        }
        else{
            echo "Такой персонаж уже есть";
        }
    }

    if(isset($_POST['characters_delete'])){
        function deleteCharacters($characters_remove){
            $files = array_diff(scandir($characters_remove), array('.', '..'));
            foreach($files as $file){
                if(is_dir($characters_remove.'/'.$file)){
                    deleteCharacters($characters_remove.'/'.$file);
                }
                else{
                    unlink($characters_remove.'/'.$file);
                }
            }
            rmdir($characters_remove);
        }
        $id_characters = $_POST['id_characters'];
        $path = '../../assets/image/characters/'.$_POST['name_characters'];
        deleteCharacters($path);
        mysqli_query($link, "DELETE FROM `characters` WHERE `id`= '$id_characters'");
        header("location: admin_characters.php");
    }

    if(isset($_POST['save_update_button'])){
        $id = $_POST['id'];
        $name_ru = $_POST['name_ru'];
        $name_en = $_POST['name_en'];
        $weapon = "assets/image/weapons/".$_POST['weapon'];
        $element = $_POST['element'];
        $skills_element = "skills-$element";
        $rare = null;
        if($_POST['rare_character'] == "star_5"){
            $rare = 5;
        }
        elseif ($_POST['rare_character'] == "star_4") {
            $rare = 4;
        }
        $rare_character = $_POST['rare_character'];
        $region = $_POST['region'];
        $description = $_POST['description'];
        $skills_info = $_POST['skills_info'];
        $item_character = $_POST['item_character'];
        $item_skills = $_POST['item_skills'];
        $constellation = $_POST['constellation'];
        $recommendations_a = json_decode($_POST['recommendation_artifacts']);
        $recommendations_w = json_decode($_POST['recommendation_weapons']);

        $gallery = [];
        $skills_icon = [];

        $gallery_last = json_decode($_POST['gallery_last']);
        $gallery_images_last = json_decode($_POST['gallery_images_last']);

        $path = 'assets/image/characters/'.$name_en;

        if(!is_dir('../../'.$path)) {
            mkdir('../../'.$path);
        }
        if(!is_dir('../../'.$path.'/Talents')) {
            mkdir('../../'.$path.'/Talents');
        }
        if(!is_dir('../../'.$path.'/Constellation')) {
            mkdir('../../'.$path.'/Constellation');
        }

        if(!empty($_FILES['icon'])){
            $type = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            if(!move_uploaded_file($_FILES['icon']['tmp_name'], '../../'.$path."/".$name_en.".".$type)){
                echo "Ошибка при загрузки ".basename($_FILES['icon']['name']);
            }
        }

        if(!empty($_FILES['map'])){
            if(!move_uploaded_file($_FILES['map']['tmp_name'], '../../'.$path."/".basename($_FILES['map']['name']))){
                echo "Ошибка при загрузки ".basename($_FILES['map']['name']);
            }
        }

        if(!empty($_FILES['gallery']['name'])){
            for($i = 0; $i < count($gallery_images_last); $i++){
                unlink('../../'.$gallery_images_last[$i]);
            }
            for($i = 0; $i < count($_FILES['gallery']['name']); $i++){
                if(move_uploaded_file($_FILES['gallery']['tmp_name'][$i], '../../'.$path."/".basename($_FILES['gallery']['name'][$i]))){
                    $gallery[] = $path."/".basename($_FILES['gallery']['name'][$i]);
                }
                else{
                    echo "Ошибка при загрузки ".basename($_FILES['gallery']['name'][$i]);
                }
            }
        }
        else{
            for($i = 0; $i < count($gallery_images_last); $i++){
                if(in_array($gallery_images_last[$i], $gallery_last)){
                    $gallery[] = $gallery_images_last[$i];
                }
                else{
                    unlink('../../'.$gallery_images_last[$i]);
                }
            }
        }

        if(!empty($_FILES['skills_icon'])){
            $skills_icon = $_POST['path_icon_skills'];
            for($i = 0; $i < count($_FILES['skills_icon']['name']); $i++){
                if($_POST['skills_icon_delete'][$i] != ""){
                    unlink('../../'.$_POST['skills_icon_delete'][$i]);
                }
                if(move_uploaded_file($_FILES['skills_icon']['tmp_name'][$i], '../../'.$path."/Talents/".basename($_FILES['skills_icon']['name'][$i]))){
                    $skills_icon[$_POST['number_icon'][$i]] = '../../'.$path."/Talents/".basename($_FILES['skills_icon']['name'][$i]);
                }
                else{
                    echo "Ошибка при загрузки ".basename($_FILES['skills_icon']['name'][$i]);
                }
            }
        }
        else{
            $skills_icon = $_POST['path_icon_skills'];
        }


        if(!empty($_FILES['constellation_icon'])){
            for($i = 0; $i < count($_FILES['constellation_icon']['name']); $i++){
                if($_POST['constellation_icon_delete'][$i] != ""){
                    unlink('../../'.$_POST['constellation_icon_delete'][$i]);
                }
                if(!move_uploaded_file($_FILES['constellation_icon']['tmp_name'][$i], '../../'.$path."/Constellation/".basename($_FILES['constellation_icon']['name'][$i]))){
                    echo "Ошибка при загрузки ".basename($_FILES['constellation_icon']['name'][$i]);
                }
            }
        }

        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `characters` WHERE `name_en`='$name_en'")) > 0){
            if(mysqli_query($link, "UPDATE `characters` SET `name_en`='$name_en', `name_ru`='$name_ru', `element`='$element', `rare`='$rare', `rare_character`='$rare_character', `weapon`='$weapon', `region`='$region', `description`='$description', `gallery`='".json_encode($gallery, JSON_UNESCAPED_UNICODE)."', `skills_element`='$skills_element', `skills_icon`='".json_encode($skills_icon, JSON_UNESCAPED_UNICODE)."', `skills_info`='$skills_info', `item_character`='$item_character', `item_skills`='$item_skills', `constellation`='$constellation' WHERE `id`='$id'")){
                echo "Успешно";

                // Добавление рекомендаций артефактов
                $recommendation_artifacts = mysqli_query($link, "SELECT * FROM `recommendation_artifacts` WHERE `id_characters`='$id'");
                if(mysqli_num_rows($recommendation_artifacts) > 0){
                    while($recommendation_artifact = mysqli_fetch_array($recommendation_artifacts)){
                        if(array_search($recommendation_artifact['count'], array_column($recommendations_a, '0')) !== array_search($recommendation_artifact['id_artifacts1'], array_column($recommendations_a, '1')) && array_search($recommendation_artifact['count'], array_column($recommendations_a, '0')) !== array_search($recommendation_artifact['id_artifacts2'], array_column($recommendations_a, '2'))){
                            mysqli_query($link, "DELETE FROM `recommendation_artifacts` WHERE `id`= '{$recommendation_artifact['id']}'");
                        }
                    }
                }
                if(count($recommendations_a) > 0){
                    foreach ($recommendations_a as $artifact) {
                        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `recommendation_artifacts` WHERE `id_characters`='$id' AND `count`='{$artifact[0]}' AND `id_artifacts1`='{$artifact[1]}' AND `id_artifacts2`='{$artifact[2]}'")) === 0){
                            mysqli_query($link, "INSERT INTO `recommendation_artifacts`(`id_characters`, `count`, `id_artifacts1`, `id_artifacts2`) VALUES ('$id', '{$artifact[0]}', '{$artifact[1]}', '{$artifact[2]}')");
                        }
                    } 
                }

                // Добавление рекомендаций оружия
                $recommendation_weapons = mysqli_query($link, "SELECT * FROM `recommendation_weapons` WHERE `id_characters`='$id'");
                if(mysqli_num_rows($recommendation_weapons) > 0){
                    while($recommendation_weapon = mysqli_fetch_array($recommendation_weapons)){
                        if(!in_array($recommendation_weapon['id_weapons'], $recommendations_w)){
                            mysqli_query($link, "DELETE FROM `recommendation_weapons` WHERE `id`= '{$recommendation_weapon['id']}'");
                        }
                    }
                }
                if(count($recommendations_w) > 0){
                    foreach ($recommendations_w as $weapon) {
                        if(mysqli_num_rows(mysqli_query($link, "SELECT * FROM `recommendation_weapons` WHERE `id_characters`='$id' AND `id_weapons`='$weapon'")) === 0){
                            mysqli_query($link, "INSERT INTO `recommendation_weapons`(`id_characters`, `id_weapons`) VALUES ('$id', '$weapon')");
                        }
                    } 
                }
            }
            else{
                echo "Ошибка при обновления персонажа";
            }
        }
        else{
            echo "Такой персонаж не существует";
        }
    }

}