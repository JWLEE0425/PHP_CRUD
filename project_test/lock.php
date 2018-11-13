<?php
// session登録
session_start();

include('config.php'); //　データベースに連結
$con = db_con();
$user_check=$_SESSION['login_user']; //　sessionの名前を設定。

$ses_sql=mysqli_query($con, "select nickname from user where id='".$user_check."' "); //　sessionの名前はnicknameにする。
$row=mysqli_fetch_array($ses_sql); //　データベースで取得したnicknameを配列に。

$login_session=$row['nickname']; //　取得したnicknameをsessionの名前にする。

if(!isset($login_session)) { //　もしsessionがないなら、login.phpに。
    header("Location: login.php");
    session_destory();
}


?>