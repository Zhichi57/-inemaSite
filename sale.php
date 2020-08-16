<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Кинотеатр У Арчи</title>
    <link rel="stylesheet" type="text/css" href="styles/style2.css">
</head>
<body>
<script type="text/javascript">
    function loadPrint() {
      window.print();
    }
</script>
<?php

$mysqli = new mysqli('localhost', 'admin', '1234', 'laba_bd');
if (mysqli_connect_errno()) {
    echo "Подключение невозможно: " . mysqli_connect_error();
}


$id = $_GET['id'];
$seat = $_GET['seat'];
$now_date = date("d.m.Y");
$now_time = date("H:i");


$select_description = mysqli_query($mysqli, "SELECT * FROM `film` WHERE `id`=$id");
        while ($row = $select_description->fetch_assoc()) {
            $name = $row['name'];

        }

?>
<div style="width: 300px; height: 150px; border:1px solid;">
<span class="name_cinema">Кинотеатр У Арчи</span> <br>
<?php
echo "<span style='font-size: 20px'>$name</span> <br>Дата: <span class=\"var\">$now_date</span><br>Время: <span class=\"var\">$now_time</span><br>Ряд:<span class=\"var\">$seat[0]</span> 
 Место:<span class=\"var\">$seat[1]</span> <br> Цена:<span class=\"var\"> 250</span> р.";
?>
</div>
<button id="btn" onclick="loadPrint()">
    <img src="media/printer.png" width="40" alt="" style="vertical-align:middle"">
    Напечатать
</button>

</body>
</html>
