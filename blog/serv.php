<?php
session_start();
$token = $_SESSION['token'];
$link = mysqli_connect("localhost","root","","blog");
if (isset($_POST['text'])){
$log = $_SESSION['log'];
$message = $_POST['text'];
$time = date("d.m.Y в H:i");
$query_otpr = "insert into `posts`(`id_author`,`message`,`time`) VALUES ('$token','$message','$time')";
$result_otpr = mysqli_query($link,$query_otpr)or die(mysqli_error($link));

$query_last_post = "select max(`id_post`) as `post` from `posts` where `id_author` = '$token'";
$res_last_post = mysqli_fetch_array(mysqli_query($link,$query_last_post));
$last_post = $res_last_post['post'];

if( isset( $_POST['my_file_upload'] ) ){
    $mime = array_pop(explode(".", $_FILES[0]['name']));
    if ($mime == "jpg" || $mime == "png" || $mime == "jpeg") {
        $uploaddir = 'userdata/' . $token . '/posts';
        $files = $_FILES;
        $done_files = array();
        foreach ($files as $file) {
            $file['name'] = "pic" . $last_post . ".png";
            $file_name = $file['name'];
            if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
                $done_files[] = realpath("$uploaddir/$file_name");
            }
            $query_img = "update `posts` set `image_post` = '$file_name' where `id_post` = '$last_post'";
            $res_img = mysqli_query($link,$query_img) or die(mysqli_error($link));
        }
    }
}
$query_add = "select * from `posts` join `users` on `posts`.`id_author` = `users`.`id_user` where `id_author` = '$token' ORDER BY `id_post` DESC LIMIT 1";
$res_add = mysqli_fetch_array(mysqli_query($link,$query_add));
$res1_m = $res_add['id_author'];
$res2_m = $res_add['image_post'];
$path = "userdata/$res1_m/posts/$res2_m";
?>
<div class="message">
    <div class="ms1 ms">
        <h2>@<?php echo $res_add['login']?></h2>
        <img src="<?php echo "userdata/".$res_add['id_user']."/profile/".$res_add['image']?>" class="pic_mes">
        <p class="pub"><?php echo $res_add['time']?></p>
        <p hidden><?php echo $res_add['id_post']?></p>
    </div>
    <div class="ms2 ms">
        <p><?php echo $res_add['message']?></p>
        <img src="<?php if($res2_m == "404"){echo "img/404.png";} else echo $path?>" class="post_pic">
    </div>
    <div class="buttons">
        <button type="button" class="button bt
        <?php
        $par = $res_add['id_post'];
        $resPar = mysqli_num_rows(mysqli_query($link,"select * from `likes` where `id_post` = '$par'"));
        if($resPar > 0){echo "b1active";} else {echo "b1";}?>
         like" id="b1">
            <p hidden class="numPostLike"><?php echo $res_add['id_post']?></p>
            <p hidden class="userPost"><?php echo $_SESSION['token']?></p>
        </button>
        <button type="button" class="button bt" id="b2">
            <p hidden class="numPost"><?php echo $res_add['id_post']?></p>
            <p hidden class="picPost"><?php if($res2_m == "404"){echo "img/404.png";} else echo $path?></p>
            <p hidden class="textPost"><?php echo $res_add['message']?></p>
        </button>
        <button type="button" class="button bt" id="b3">
            <p hidden class="numPost"><?php echo $res_add['id_post']?></p>
        </button>
        <div class="liked"><p style="margin: 0">...</p>
            <p hidden class="ld"><?php echo $res_add['id_post']?></p>
            </div>
    </div>
</div>
    <br>
<?php } ?>

<?php
if(isset($_POST['textVal'])){
    $id = $_POST['id'];
    $text = $_POST['textVal'];
    $queryChange = "update `posts` set `message` = '$text' where `id_post` = '$id'";
    $resChange = mysqli_query($link, $queryChange);
    if(isset($_FILES[0]['name'])){
    $mime2 = array_pop(explode(".",$_FILES[0]['name']));
    if ($mime2 == "jpg" || $mime2 == "png" || $mime2 == "jpeg") {
        $uploaddir = 'userdata/' . $token . '/posts';
        $files = $_FILES;
        $done_files = array();
        foreach ($files as $file) {
            $file['name'] = "pic" . $id . ".png";
            $file_name = $file['name'];

            if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
                $done_files[] = realpath("$uploaddir/$file_name");
            }
            $queryChangePost = "update `posts` set `image_post` = '$file_name' where `id_post` = '$id'";
            $resChange = mysqli_query($link, $queryChangePost);
            }
        }
    }
}

if(isset($_POST['id_p'])){
    echo $_POST['id_p'];
    $id2 = $_POST['id_p'];
    $resdel = mysqli_query($link, "delete from `posts` where `id_post` = '$id2'");
}

if(isset($_POST['user']) && isset($_POST['blog'])){
    $user = $_POST['user'];
    $blog = $_POST['blog'];
    $resSub = mysqli_query($link, "insert into `subs`(`name1`,`name2`) values ('$user','$blog')") or die(mysqli_error($link));
    $resUPD1 = mysqli_query($link, "update `users` set subs = subs + 1 where `id_user` = '$user'") or die(mysqli_error($link));
    $resUPD2 = mysqli_query($link, "update `users` set followes = followes + 1 where `id_user` = '$blog'") or die(mysqli_error($link));
}

if(isset($_POST['userO']) && isset($_POST['blogO'])){
    $user = $_POST['userO'];
    $blog = $_POST['blogO'];
    $resSub = mysqli_query($link, "delete from `subs` where `name1` = '$user' and `name2` = '$blog'") or die(mysqli_error($link));
    $resUPD1 = mysqli_query($link, "update `users` set subs = subs - 1 where `id_user` = '$user'") or die(mysqli_error($link));
    $resUPD2 = mysqli_query($link, "update `users` set followes = followes - 1 where `id_user` = '$blog'") or die(mysqli_error($link));
}

if(isset($_POST['numPost'])){
    $num = $_POST['numPost'];
    $usr = $_POST['userPost'];
    $resLike = mysqli_query(mysqli_query($link,"insert into `likes`(`id_post`,`id_name`) values ('$num','$usr')"));
}

if(isset($_POST['numPostO'])){
    $numO = $_POST['numPostO'];
    $usrO = $_POST['userPostO'];
    $resLikeO = mysqli_query(mysqli_query($link,"delete from `likes` where `id_post` = '$numO' and `id_name` = '$usrO'"));
}

if (isset($_POST['p'])) {
    $p = $_POST['p'];
    $queryp = "select max(id_like) as `like` from `likes`";
    $ff = mysqli_fetch_array(mysqli_query($link, $queryp));
    $check = $ff['like'];
    echo "<div id='removeto'>";
    $it = 0;
    for ($i = 0;$i<=$check;$i++){
        $king = "select * from `likes` join `users` on `likes`.`id_name` = `users`.`id_user` where `id_like` = '$i' and `id_post` = '$p'";
        $voper = mysqli_query($link, $king);
        $volere = mysqli_fetch_array($voper);
        $kk = mysqli_num_rows($voper);

        if ($kk == 0) {}else{
            $it += 1;
        ?>

            <p>@<?php echo $volere['login'];?></p>
<?php
    }
}?>
<p>Понравилось <?php echo $it?> людям</p>
<?php
echo "</div>";}
?>
