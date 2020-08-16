<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Кинотеатр У Арчи</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">

    <script type= "text/javascript">
        function goToPage()
        {
            document.location.href = 'http://practice.ru/'


        }
    </script>

</head>

<?php
$mysqli = new mysqli('localhost', 'admin', '1234', 'laba_bd');
if (mysqli_connect_errno()) {
    echo "Подключение невозможно: " . mysqli_connect_error();
}


?>

<body>
<form method="post">
    <?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        //echo $id;
        $select_description = mysqli_query($mysqli, "SELECT * FROM `film` WHERE `id`=$id");
        while ($row = $select_description->fetch_assoc()) {
            $str = $row['description'];
            echo "<textarea name='discription' cols=\"30\" rows=\"4\">$str</textarea>";
        }
    }
    ?>
    <br>

   <input type="submit" id="idedit" name="edit" value="Отправить" >

</form>

<?php
if($_POST['edit'])
{
    if($_POST['discription'])
    {
        $send_textarea = strip_tags($_POST['discription']);
        $update_description = mysqli_query($mysqli, "UPDATE film SET description='$send_textarea' WHERE id=$id");
        echo "<br>";
        if ($update_description === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $mysqli->error;
        }
        echo "<br>";
    }
    else

    {
        $send_textarea = 'отправлено пустое поле...';
    }
}
//echo $send_textarea ;
?>

</body>
