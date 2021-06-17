<?php
session_start();
if (isset($_SESSION['log'])){
    header('Location:blog.php?id='.$_SESSION['token']);
}

require_once "code.php";

$token = 0;
if(isset ($_POST["log"])){
    $link = mysqli_connect('localhost','root','','blog');
    if($link == false){
    die ("Соединение не установлено");
} elseif ($link == true) {
    $login_ = $_POST['login'];
    $pass_ = encodeS($_POST['pass']);
    $query = "select * from `users` where `login` = '$login_' and password = '$pass_'";
    $result = mysqli_query($link, $query);
    $res = mysqli_fetch_array($result);
    $nums = mysqli_num_rows($result);
    if ($nums == 1){
        $_SESSION['token'] = $res['id_user'];
        $_SESSION['log'] = $res['login'];
        $_SESSION['pass'] = $res['password'];
        $_SESSION['image'] = $res['image'];
        $_SESSION['truename'] = $res['truename'];
        $_SESSION['status'] = $res['status'];
        $_SESSION['subs'] = $res['subs'];
        $_SESSION['followes'] = $res['followes'];
        $_SESSION['guest'] = $res['guest'];
        $_GET['id'] = $_SESSION['token'];
        header("Location: blog.php");
        exit();
    } elseif ($nums > 1) {echo "Неверное имя пользователя или пароль";}


}
}

if (isset ($_POST['reg'])){
    $link = mysqli_connect('localhost','root','','blog');
    $login_t = $_POST['login'];
    $pass_t = encodeS($_POST['pass']);
    $query = "insert into `users`(`users`.`login`,`users`.`password`) values ('$login_t','$pass_t')";
    $result = mysqli_query($link, $query) or die (mysqli_error($link));

    $query_catch = "select `id_user` from `users` where `login` = '$login_t'";
    $res_catch = mysqli_query($link,$query_catch);
    $res_catch_arr = mysqli_fetch_array($res_catch);
    $id = $res_catch_arr['id_user'];

    $userpath1 = "userdata/".$id."/profile";
    $userpath2 = "userdata/".$id."/posts";
    mkdir($userpath1, 0777, true);
    mkdir($userpath2, 0777, true);
}


?>

<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="auth_style.css">
</head>
<body>
<div>
    <p class="preview">Flight</p>
</div>
<div class="auth">
    <h1>Авторизация</h1>
    <form action="auth.php"  method="post">
        <div class="formmain">
        <input type="text" class="field_auth" name="login" required  placeholder='Логин'><br>
        <input type="password" class="field_auth" name="pass" required  placeholder='Пароль'><br>
        <input type="submit" id="vhod" class="btn_auth" name="log" value="Войти">
        <input type="submit" class="btn_auth" id="two" name="reg" value="Зарегистироваться">
        </div>
    </form>
</div>
<script src="js/jquery-3.5.0.min.js"></script>
</body>
</html>

