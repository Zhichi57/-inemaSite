<div class="head"><a href="../index.php">Кинотеатр У Арчи</a></div>

<?php
require "password.php";

$mysqli = new mysqli('localhost', 'admin', '1234', 'laba_bd');
if (mysqli_connect_errno()) {
    echo "Подключение невозможно: " . mysqli_connect_error();
}

if( isset( $_POST['send'] ) )
{
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $passwordHash = password_hash($pass,  PASSWORD_BCRYPT );


    $select_users=mysqli_query($mysqli,"SELECT * FROM `users` WHERE `email`='$email'");
    while( $row = $select_users->fetch_assoc() ){
        $pass_bd=$row['pass'];
        $role=$row['role'];
    }

    if ($pass_bd==NULL){
        $insert_user=mysqli_query($mysqli,"INSERT INTO `users` VALUES ('$email','$passwordHash','user')");
        echo 'Регистрация прошла успешно <br>';
        $_SESSION["email"]=$email;
        $_SESSION["success"]="yes";
        $_SESSION["role"]="user";

    }
    else{
        if (password_verify($pass, $pass_bd)) {
            echo 'Пароль правильный! <br>';
            $_SESSION["email"]=$email;
            $_SESSION["success"]="yes";
            $_SESSION["role"]=$role;
        } else {
            echo 'Пароль неправильный.<br>';
        }
    }
}

$status=($_SESSION["success"]);


if (isset($_SESSION["success"])) {
        echo "Вы вошли как: ".$_SESSION["email"]."<br>";
          if ($_SESSION["role"] =="user"){

              echo "Ваша роль: Пользователь";
          }
          if ($_SESSION["role"]=="administrator"){
              echo "Ваша роль: Админ";
              ?>
              <form action="#" class="rights" method="post">
    <input type="email" name="email_rights" placeholder="E-Mail"/>
    <button type="submit" name="appoint" onClick="window.location.reload( true );">Выдать права</button>
    <?php
if( isset( $_POST['appoint'] ) )
{
     $email_rights=$_POST['email_rights'];

     $update_rights = mysqli_query($mysqli, "UPDATE users SET role='administrator' WHERE email='$email_rights'");
        echo "<br>";
        if ($update_rights === TRUE) {
            echo "Права успешно выданы";
        } else {
            echo "Ошибка" . $mysqli->error;
        }
}
          }

        ?>
    <form method="POST">
        <input type="submit" name="exit" onClick="window.location.reload( true );" value="Выход" />
    </form>
    <?php
    if( isset( $_POST['exit'] ) )
    {
        session_destroy();
    }
    }
    else{
        echo "Вы не залогинениы <br>";
        ?>
Авторизация
<form action="#" class="form" method="post">
    <input type="email" name="email" placeholder="E-Mail" required />
    <input type="password" name="pass" placeholder="Пароль" required />
    <button type="submit" name="send" onClick="window.location.reload( true );">Отправить</button>
</form>
<?php
    }
?>