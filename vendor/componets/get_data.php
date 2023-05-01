<?php
    include "connect.php";

    $elements = $_POST['elements'];
    if(!empty($elements)){
        $in = "'".join("', '", $elements)."'";
    }
    $rare = $_POST['rare'];
    if(!empty($elements) && empty($rare)){
        $characters = mysqli_query($link, "SELECT * FROM `characters` WHERE `element` NOT IN ($in) ORDER BY name_ru");
    }
    elseif (empty($elements) && !empty($rare)) {
        $characters = mysqli_query($link, "SELECT * FROM `characters` WHERE `rare`= '$rare' ORDER BY name_ru");
    }
    elseif (!empty($rare) && !empty($elements)) {
        $characters = mysqli_query($link, "SELECT * FROM `characters` WHERE `rare`= '$rare' AND `element` NOT IN ($in) ORDER BY name_ru");
    }
    else{
        $characters = mysqli_query($link, 'SELECT * FROM `characters` ORDER BY name_ru');
    }

    if(!empty($characters)){
        for ($data = []; $character = mysqli_fetch_assoc($characters); $data[] = $character);
    }
    else{
        $data = [];
    }

    echo json_encode($data);