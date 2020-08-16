<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Кинотеатр У Арчи</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body onload="editSvg()">
<script src="js/timer.js"></script>
<?php

$mysqli = new mysqli('localhost', 'admin', '1234', 'laba_bd');
if (mysqli_connect_errno()) {
    echo "Подключение невозможно: " . mysqli_connect_error();
}
printf("Изначальная кодировка: %s\n", $mysqli->character_set_name());
require_once "blocks/head.php";
require_once "blocks/menu.php";

?>
<div class="main inline">

    <?php
    if(isset($_GET['film'])) {
        ?>
    <div class="menu">
        <?php
        require_once "blocks/film_menu.php";
        ?>
    </div>

    <?php
        if(isset($_GET['film']) AND isset($_GET['id'])) {
            ?>
            <div class="content">
                <?php
                $id = $_GET['id'];
                $select_photo=mysqli_query($mysqli,"SELECT * FROM `film_photo` WHERE `id`=$id");
                while( $row = $select_photo->fetch_assoc() ){
                    $path=$row['path'];
                    echo "<img src=\"$path\" width=\"190px\" align=\"left\" hspace=\"20\" vspace=\"5\">";
                }


                //echo file_get_contents("film_info/" . $name . ".txt");
                $select_description=mysqli_query($mysqli,"SELECT * FROM `film` WHERE `id`=$id");
                while( $row = $select_description->fetch_assoc() ) {
                    echo $row['description'];
                }

                 $select_kp=mysqli_query($mysqli,"SELECT * FROM `film_kp` WHERE `id`=$id");
                 while( $row = $select_kp->fetch_assoc() ){
                        echo "<br>".$row['link'];
                }

                ?>

                <br>
                <button id="btn_modal_window" onclick="editSvg()">Купить билеты</button>
                <div id="my_modal" class="modal">
                    <div class="modal_content">
                        <span class="close_modal_window">×</span>
                        <object id="svg" data="schema.svg" type="image/svg+xml"></object>
                    </div>
                </div>

                <?php
                 if ($_SESSION["role"]=="administrator"){
                     ?>
                <form method="GET" name="filter" action="http://practice.ru/edit.php">
                    <?php
                    echo "<input type='submit' name=\"id\" value=\"$id\">"
                    ?>
                </form>
                     <?php
                 }
                     ?>
            </div>

            <?php
        }
        ?>
        <?php
    } else{
    ?>
    <div class="content_no_menu">
        <?php
        if (isset($_GET['info'])) {
            $info = $_GET['info'];
            $select_info=mysqli_query($mysqli,"SELECT * FROM `info` WHERE `metka`='$info'");
            while( $row = $select_info->fetch_assoc() ) {
                echo $row['text'];
            }

        } else {?>
            <span>Главная страница</span>
            <br>
            До открытия кинотеатров:
            <br>
            <div id="timer">
                <script src="js/timer.js"></script>
            </div>
            <br>

        <?php
        }
        }
        ?>


<script>
    var modal = document.getElementById("my_modal");
    var btn = document.getElementById("btn_modal_window");
    var span = document.getElementsByClassName("close_modal_window")[0];



    btn.onclick = function () {
        modal.style.display = "block";



    }

    span.onclick = function () {
        modal.style.display = "none";

    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";

        }
    }
</script>

        <script type="text/javascript">
        function editSvg(){

            function $_GET(key) {
                var p = window.location.search;
                p = p.match(new RegExp(key + '=([^&=]+)'));
                return p ? p[1] : false;
            }


            let svg = document.getElementById('svg');
            let scd = svg.contentDocument;
            scd.getElementById("SVGRoot").setAttribute("filmid",$_GET('id'));
            
           // alert(root);
}
    </script>
    </div>
<?php
require_once "blocks/footer.php";
?>
</body>
</html>