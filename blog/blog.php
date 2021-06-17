<?php
session_start();/*
header("refresh:1");*/
if (isset($_POST["exit"]))
{
    session_destroy();
    header("Location: auth.php");
    exit();
}

if($_POST['guest']){
    header("location: auth.php");
    exit();
}

$current_blog = 0;

if(!isset($_SESSION['log'])){
    $_SESSION['token'] = 0;
    $start = 0;
    $current_blog = $start;
}
if (isset($_SESSION['log'])){
 $current_blog = $_SESSION['token'];
}
if(isset($_GET['id'])){
    $current_blog = $_GET['id'];
}
$token_main = $_SESSION['token'];
$link = mysqli_connect('localhost','root','','blog') or die ("Соединение не установлено");
$query_main = "select * from `users` where id_user = '$current_blog'";
$result_main_first = mysqli_query($link,$query_main);
$result_main = mysqli_fetch_array($result_main_first);


if(isset($_POST["change_btn"])){
    $user = $_POST["us"];
    $truename = $_POST['truename'];
    $status = $_POST['status'];
    if ($_POST['check'] == true){
        $guest = 1;
    } else $guest = 0;
    $query = "UPDATE `users` SET `login` = '$user', `truename` = '$truename', `status` = '$status', `guest` = '$guest'
 WHERE `users`.`id_user` = '$token_main'";
    $result = mysqli_query($link,$query) or die(mysqli_error($link));
    if($_FILES['file']['size'] > 0){
        $path = 'userdata/'.$token_main.'/profile/';
        if (!@copy($_FILES['file']['tmp_name'], $path . $_FILES['file']['name']));
        $image = $_FILES['file']['name'];
        $query = "UPDATE `users` SET `image`='$image' WHERE `users`.`id_user` = '$token_main'";
        $result = mysqli_query($link,$query);
    }
    $query_time = "select * from `users` where `id_user` = '$token_main'";
    $res2 = mysqli_fetch_array(mysqli_query($link,$query_time));
    $_SESSION['log'] = $res2['login'];
    $_SESSION['truename'] = $res2['truename'];
    $_SESSION['status'] = $res2['status'];
    $_SESSION['image'] = $res2['image'];
    $_SESSION['guest'] = $res2['guest'];
    header("Location: blog.php");
}


if (isset($_POST['header1'])){
 $GET['id'] = $_SESSION['token'];
}

$j = 0;
if (isset($_POST['header3'])){
    $j = 1;
}

$checkSub = mysqli_num_rows(mysqli_query($link, "select * from subs where `name1` = '$token_main' and `name2` = '$current_blog'"));

?>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>
        Flight
    </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="color: black">
</div>
<header id="top" class="header_main">
    <form action="blog.php" method="post">
        <button type="submit" name="header3" id="header3" hidden></button>
        <div class="header_row">
            <label for="header1" class="header_obj" id="first">
                <div ><div><img src="img/home.png" width="50px" height="50px"><p style="margin: 0">Мой блог</p></div></div>
            </label>
            <button type="submit" name="header1" id="header1" hidden></button>

            <div class="header_obj" id="second">
                <p style="font-family: font2; font-size: 250%;margin: 0; margin-top: 10px">Flight</p>
            </div>

            <label for="header3" class="header_obj" id="third">
                <div><div><img src="img/lenta.png" width="50px" height="50px"><p style="margin: 0">Лента</p></div></div>
            </label>
        </div>
    </form>
</header>
<?php
if($current_blog == 0){
    echo "<div class='message guest'> <br><p>Вы не вошли, и вам будут недоступны некоторые блоги, <br>
                                         так как их авторы поставили запрет на просмотр гостям.</p>
 <form action='blog.php' method='post'><input type='submit' class='button' value='Войти' name='guest'> </form> <br></div> ";
} else {
$query_download = "select * from `users` where id_user = '$current_blog'";
$result_download = mysqli_query($link,$query_download);
$array_download = mysqli_fetch_array($result_download);
?>
<aside class="aside2" >
    <h3 style=" margin-left: 8px; text-align: center">@<?php echo $array_download["login"]?></h3>
    <img src="<?php echo "userdata/".$current_blog."/profile/".$array_download["image"]?>" alt="Изображение не выбрано" width="200px" height="200px">
    <div style="margin-left: 8px"><p class="asp">Настоящее имя: <p class="asp"><?php echo $array_download["truename"]?></p></p></div>
    <div style="margin-left: 8px"><p class="asp">Статус: <p class="asp"><?php echo $array_download["status"]?></p></p></div>
    <div style="margin-left: 8px"><p class="asp" >Подписчики: <p class="asp" id="fols"><?php echo $array_download["followes"]?></p></p></div>
    <div style="margin-left: 8px"><p class="asp" >Подписки: <p class="asp id="sbs"><?php echo $array_download["subs"]?></p></p></div>
    <form style="text-align: center; margin-bottom: 5px" action='blog.php' method='post'>
        <button type='button' class="button" id="mbtn" name='change'>Изменить</button>
        <button type='submit' class="button" name='exit'>Выйти</button>
    </form>
    <button type='button' class="button btnSub" id="btnSub" name='sub'>
        <p id="btnP">Подписаться</p>
    <p id="user" hidden><?php echo $token_main?></p>
    <p id="curBlog" hidden><?php echo $current_blog?></p>
    </button>
</aside>



<aside class="aside1">
    <h2 style="text-align: center; margin-top: 5px; margin-bottom: 0px; margin-right: 5px; margin-left: 5px">Пользователи:</h2>
    <?php
    $res_check=mysqli_fetch_array(mysqli_query($link,"select max(`id_user`) as `user` from `users`"));
    for ($i = 1;$i <= $res_check['user'];$i++) {
        $query_subs = "select * from `users` where `id_user` = '$i'";
        if($result_check = mysqli_num_rows(mysqli_query($link,$query_subs)) > 0){
            $result_subs = mysqli_fetch_array(mysqli_query($link,$query_subs));
            $time_path = "userdata/".$i."/profile/".$result_subs["image"];
    ?>
    <div class='lineAside'>
        <img src='<?php if ($result_subs['image'] == 404){echo "img/404.png";} else {echo "userdata/".$i."/profile/".$result_subs['image'];}?>'
             width='55px' height='55px' style='border-radius: 30px; margin-left: 5px; margin-right: 5px'>
        <div >
            <p style='margin: 0' ><?php echo $result_subs['login'];?></p>
        <p style="display: none" class="loginName"><?php echo $result_subs['id_user']?></p>
            <p style='font-size: 14px; margin-top: 0px;margin-bottom: 0px'><?php echo $result_subs['truename'];?></p>
        <p style='font-size: 12px; margin-top: 0px;margin-bottom: 0px; '><i><?php echo $result_subs['status'];?></i></p>
        </div>
    </div>
    <?php if ($result_subs['id_user'] !== $res_check['user']){echo "<hr>";}}} ?>
</aside>

<?php
    if ($result_main['guest'] == 1 && !isset($_SESSION['log'])){echo "<div class='message guest'><br><p>Пользователь ограничил доступ к воему блогу.</p><br></div>";}
    else {
?>



<div id="newpost" class="post">
    <form method="post" action="blog.php" style="padding-top: 3px" id="post" name="formpost" enctype="multipart/form-data">
        <h2 style="margin-bottom: 5px; margin-top: 5px; color: white">Новая запись:</h2>
        <textarea  required class="text" placeholder='Текст сообщения...' name='text' id="text"></textarea>  <br>
        <label for="postfile"><div class="postfile">Выберите изображение</div></label>
        <input type="file" name="postfile" id="postfile" class="post_img" accept=".jpg, .png, .jpeg">
        <button type='submit' class="public" id="public" name='Otpr'>Опубликовать</button>
    </form>
</div>
<br id="wrap">

<p class="noMessage">Здесь пока нет ни одной записи.</p>
<div class="blogMain">
<?php
if (isset($_POST['header3'])){
    $res_ult = mysqli_num_rows(mysqli_query($link,"select * from `subs` where `name1` = '$token_main' order by `name2` asc "));
    $res_prom = mysqli_fetch_all(mysqli_query($link,"select * from `subs` where `name1` = '$token_main' order by `name2` asc "));
    $arr = [];
    for($i = 0; $i < $res_ult; $i++) {
        $arr[$i] = $res_prom[$i][2];
    }
    $query_nums_mes = "SELECT max(id_post) as `maxpost` FROM `posts`" or die ("Соединение не установлено");
    $result_nums_mes = mysqli_query($link,$query_nums_mes);
    $rr = mysqli_fetch_array($result_nums_mes);
    $nums_mes = $rr['maxpost'];
    $query_mes = "select * from `posts` join `users` on `posts`.`id_author` = `users`.`id_user` where (";
    foreach ($arr as $item){
     $query_mes = $query_mes."id_author = ".$item." or ";
    }
    $query_mes = substr($query_mes, 0, -3);
    $query_mes2 = $query_mes.")";
} else {

$query_nums_mes = "SELECT max(id_post) as `maxpost` FROM `posts` where `id_author` = '$current_blog'" or die ("Соединение не установлено");
$result_nums_mes = mysqli_query($link,$query_nums_mes);
$rr = mysqli_fetch_array($result_nums_mes);
$nums_mes = $rr['maxpost'];}


for ($i = $nums_mes;$i >= 1;$i--){
    if (isset($_POST['header3'])){
        $query_mes = $query_mes2." and `id_post` = $i";
    } else {
        $query_mes = "select * from `posts` join `users` on `posts`.`id_author` = `users`.`id_user` where `id_post`= '$i' and `id_user` = '$current_blog'";
    }
    $result_mes = mysqli_query($link,$query_mes);
    $result_mes_array = mysqli_fetch_assoc($result_mes);
    $check = mysqli_num_rows($result_mes);
    if ($check == 1) {

        $res1_m = $result_mes_array['id_author'];
        $res2_m = $result_mes_array['image_post'];
        $path = "userdata/$res1_m/posts/$res2_m";
    ?>
<div class='message'>
<div class='ms1 ms'>
<h2>@<?php echo $result_mes_array['login']?></h2>
<img src='<?php echo "userdata/".$result_mes_array['id_user']."/profile/".$result_mes_array['image']?>' class='pic_mes'>
    <p class="pub"><?php echo $result_mes_array['time']?></p>
</div>
<div class='ms2 ms'>
    <p><?php echo $result_mes_array['message']?></p>
    <img src="<?php if($res2_m == "404"){echo "img/404.png";} else echo $path?>" class="post_pic">
</div>
    <div class="buttons">
        <button type="button" class="button bt
        <?php
        $par = $result_mes_array['id_post'];
        $resPar = mysqli_num_rows(mysqli_query($link,"select * from `likes` where `id_post` = '$par' and `id_name` = $token_main"));
        if($resPar > 0){echo "b1active";} else {echo "b1";}?>
         like" id="b1">
            <p hidden class="numPostLike"><?php echo $result_mes_array['id_post']?></p>
            <p hidden class="userPost"><?php echo $_SESSION['token']?></p>
        </button>
        <button type="button" class="button bt b2" id="b2">
            <p hidden class="numPost"><?php echo $result_mes_array['id_post']?></p>
            <p hidden class="picPost"><?php if($res2_m == "404"){echo "img/404.png";} else echo $path?></p>
            <p hidden class="textPost"><?php echo $result_mes_array['message']?></p>
        </button>
        <button type="button" class="button bt b3" id="b3">
            <p hidden class="numPost"><?php echo $result_mes_array['id_post']?></p>
        </button>
        <div class="liked"><p style="margin: 0">...</p>
        <p hidden class="ld"><?php echo $result_mes_array['id_post']?></p>
        </div>
    </div>
</div>
<br>


<?php
}}
?>
<?php echo "</div>";?>
</div>


<div class="up">
    <a style="display: block; text-align: center;" href="#top">
    <img src="img/arrowup.png" id="arrowup" width="100px" height="100px" alt>
    </a>
</div>

        <div class="fullBack">
            <div class="modal">
                <div style="margin-right: 5px">
                    <span class="close">&times;</span>
                </div>
                <form action="blog.php" method="post" enctype="multipart/form-data">
                    <div class="field_modal">
                        <label for="file"><p style="margin-bottom: 2px"> Аватарка: </p><img src="<?php echo "userdata/".$current_blog."/profile/".$result_main["image"]?>" name="img" alt="Изображение не выбрано" class="pic" style="

        width: 200px; height: 200px; margin: 5px"></label>
                        <br>
                        <input name="file"  type="file"  accept=".jpg, .png, .jpeg">
                    </div>

                    <div class="field_modal">
                        <p style="margin-bottom: 2px"> Имя пользователя: </p>
                        <input class="ipt" name="us" type="text" value="<?php echo $_SESSION["log"]?>">
                    </div>

                    <div class="field_modal">
                        <p style="margin-bottom: 2px"> Настоящее имя: </p>
                        <input class="ipt" name="truename" type="text" value="<?php echo $_SESSION["truename"]?>">
                    </div>

                    <div class="field_modal">
                        <p style="margin-bottom: 2px"> Статус: </p>
                        <input class="ipt status" name="status" type="text" value="<?php echo $_SESSION["status"]?>">
                    </div>

                    <div>
                        <label for="check" style="color: darkgrey">Запретить просмотр гостям</label>
                        <input name="check" type="checkbox" <?php if($_SESSION['guest'] == 1){echo "checked";}?>>
                    </div>
                    <button type="submit" class="modal_button" name="change_btn"><p>Изменить</p></button>
                </form>
            </div>
        </div>

        <div class="fullback2">
            <div class="modal2">
                <p id="mostId" hidden></p>
                <div style="margin-right: 5px">
                    <span class="red">Редактировать сообщение</span>
                    <span class="close2">&times;</span>
                </div>
                <form id="formChangePost">
                <p>Сообщение:</p>
                <textarea required class="text" placeholder='Текст сообщения...' id="text2" value=></textarea>
                <p>Изображение: <label for="mesFile" class="mesFile" id="changePicMes">Изменить/Загрузить изображение</label></p>
                <img id="imgPost">
                <br>
                <input type="file" id="mesFile" accept=".jpg, .png, .jpeg">
                <button type="button" class="button changePost" id="changePost">Применить изменения</button>
                </form>
            </div>
        </div>

        <div class="fullback3">
            <div class="modal3">
                <div style="margin-right: 5px">
                    <span class="close3">&times;</span>
                </div>
                <span class="red">Оценили: </span>
                <div class="content" id="content">

                </div>
            </div>
        </div>


<?php }}?>

<script src="js/jquery-3.5.0.min.js"></script>
<script type="text/javascript">
    var p1 = <?php echo $_SESSION['token']?>;
    var p2 = <?php echo $current_blog?>;
    var button1 = document.getElementsByClassName('button')[0];
    var button2 = document.getElementsByClassName('button')[1];
    var post = document.getElementsByClassName('post')[0];
    var wrap = document.getElementById('wrap');
    var bt2 = $('.b2');
    var bt3 = $('.b3');
    var len = bt2.length;
    if (p1 == 0){
        var d = document.getElementById('btnSub');
        d.style.display = "none";
    }
    if (p1 !== p2){
        button1.style.display = "none";
        button2.style.display = "none";
        post.style.display = "none";
        wrap.style.display = "none";
        for (let i = 0; i<len; i++) {
            bt2[i].style.display = "none";
            bt3[i].style.display = "none";
        }

    }
    if (p1 == p2){
        $('.btnSub')[0].style.display = "none";
    }
    var checkSub = <?php echo $checkSub?>;
    if (checkSub == 0){
        $('#btnSub').removeClass('btnFol');
        $('#btnSub').addClass('btnSub');
        $('#btnP').text('Подписаться');
    } else
    if (checkSub > 0){
        $('#btnSub').removeClass('btnSub');
        $('#btnSub').addClass('btnFol');
        $('#btnP').text('Отписаться');
    }
    var j = <?php echo $j?>;
    console.log(j);
    if (j == 1){
        let v = document.getElementById('newpost');
        let w = document.getElementById('wrap');
        v.style.display = "none";
        w.style.display = "none";
    }

</script>
<script type="text/javascript" src="js/modal.js"></script>
<script type="text/javascript" src="js/arrow.js"></script>
<script type="text/javascript" src="js/style.js"></script>
<script src="js/jquery_main.js"></script>
<script src="ajax.js">

</script>
</body>
</html>