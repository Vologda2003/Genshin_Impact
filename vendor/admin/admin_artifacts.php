<?php
    include "../componets/connect.php";
    if(!$_SESSION['admin']){
        header("location: authorization.php");
    }
    $artifacts = mysqli_query($link, "SELECT * FROM `artifacts`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/admin/style_admin_artifacts.css">
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
        <div class="artifacts-section">
            <form action="main_admin.php" method="post" class="artifacts-form-add" enctype="multipart/form-data">
                <h2>Добавление артефактов</h2>
                <div class="artifacts-form-add-header">
                    <div class="artifacts-form-add-header-logo">
                        <div class="artifacts-form-add-header-logo-icon">+
                            <input type="file" name="artifacts_image" class="artifacts-form-add-header-logo-icon-image" accept=".jpg, .png, .jpeg" required>
                        </div>
                    </div>
                    <div class="artifacts-form-add-header-info">
                        <span class="artifacts-form-add-header-info-title">Название:</span>
                        <input type="text" name="artifacts_name" class="artifacts-form-add-header-info-name" required>
                    </div>
                    <div class="artifacts-form-add-header-info">
                        <span class="artifacts-form-add-header-info-title">Редкость:</span>
                        <select name="artifacts_rare" class="artifacts-form-add-header-info-name" required>
                            <option value="">Выберите</option>
                            <option value="star_5">5</option>
                            <option value="star_4">4</option>
                            <option value="star_3">3</option>
                        </select>
                    </div>
                </div>
                <div class="artifacts-form-add-info">
                    <div class="artifacts-form-add-info-section">
                        <span class="artifacts-form-add-info-section-name">2 предмета</span>
                        <textarea name="artifacts_info[]" class="artifacts-form-add-info-section-text" required></textarea>
                    </div>
                    <div class="artifacts-form-add-info-section">
                        <span class="artifacts-form-add-info-section-name">4 предмета</span>
                        <textarea name="artifacts_info[]" class="artifacts-form-add-info-section-text" required></textarea>
                    </div>
                </div>
                <div class="artifacts-form-add-button">
                    <input type="reset" value="Очистить форму">
                    <input type="submit" value="Добавить" name="artifacts_submit">
                </div>
            </form>
            <div class="message <?php echo $_SESSION['message'][0]; ?>">
                <?php
                    echo $_SESSION['message'][1];
                    unset($_SESSION['message']);
                ?>
            </div>
        </div>

        <div class="artifacts-section-line"></div>

        <div class="artifacts-section">
            <h2>Артефакты</h2>
            <div class="artifacts-section-filter">
                <span class="artifacts-section-filter-item active_filter">Все</span>
                <div class="artifacts-section-filter-line"></div>
                <span class="artifacts-section-filter-item">1 <img src="../../assets/image/imgElem/star.svg" alt="#"></span>
                <div class="artifacts-section-filter-line"></div>
                <span class="artifacts-section-filter-item">2 <img src="../../assets/image/imgElem/star.svg" alt="#"></span>
                <div class="artifacts-section-filter-line"></div>
                <span class="artifacts-section-filter-item">3 <img src="../../assets/image/imgElem/star.svg" alt="#"></span>
                <div class="artifacts-section-filter-line"></div>
                <span class="artifacts-section-filter-item">4 <img src="../../assets/image/imgElem/star.svg" alt="#"></span>
                <div class="artifacts-section-filter-line"></div>
                <span class="artifacts-section-filter-item">5 <img src="../../assets/image/imgElem/star.svg" alt="#"></span>
            </div>
            <div class="artifacts-section-all">
                <?php
                if(mysqli_num_rows($artifacts) > 0){
                    while($artifact = mysqli_fetch_array($artifacts)){
                    ?>
                        <div class="artifacts-section-all-artifact">
                            <div class="artifacts-section-all-artifact-head">
                                <img src="../../<?php echo $artifact['path']; ?>" alt="#" class="artifacts-section-all-artifact-head-image <?php echo $artifact['rare']; ?>">
                                <span class="artifacts-section-all-artifact-head-name"><?php echo $artifact['name']; ?></span>
                            </div>
                            <div class="artifacts-section-all-artifact-info">
                                <span class="artifacts-section-all-artifact-info-text">2 предмета: <?php echo $artifact['2']; ?></span>
                                <span class="artifacts-section-all-artifact-info-text">4 предмета: <?php echo $artifact['4']; ?></span>
                            </div>
                            <div class="artifacts-section-all-artifact-button">
                                <form action="main_admin.php" method="post">
                                    <input type="hidden" name="id_artifact" value="<?php echo $artifact['id']; ?>">
                                    <input type="hidden" name="path_artifact" value="<?php echo $artifact['path']; ?>">
                                    <input type="submit" name="artifacts_delete" class="artifacts_delete" value="Удалить">
                                </form>
                                <a href="update_artifacts.php?id=<?php echo $artifact['id']; ?>" class="artifacts_update">Редактировать</a>
                            </div>
                        </div>
                    <?php
                    }
                }
                ?>
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
    <script type="text/javascript">
        var path = "none";
        var rare_artifacts = "";
    </script>
    <script src="../../assets/js/admin/main_admin_artifacts.js"></script>

</body>
</html>