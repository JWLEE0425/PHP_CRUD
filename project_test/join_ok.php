<?php
//　会員登録の確認
include ("config.php");
$con = db_con();

//　join.phpのtextboxで入力したデータを取得。
$id = $_POST['user_id'];
$pw = $_POST['password'];
$pw2 = $_POST['password2'];
$nickname = $_POST['nickname'];
$chkid = $_POST['chk_id'];
$chknickname = $_POST['chk_nickname'];

if (!$id || ! $pw || ! $pw2 || ! $nickname) { //　join.phpのtextboxが空白なら確認のお知らせ。
    echo "<script>alert('空白を確認してください。');history.back();</script>";
}

else if ($chkid == 0 || $chknickname == 0) { //　重複チェック（join_chk.phpでチェックをして１(true)になったら通過できる。）
    echo "<script>alert('重複の確認してください。');history.back();</script>";
}

else if ($pw != $pw2) { //　2番目のパスワードが違ったら、確認のお知らせ。
    echo "<script>alert('パスワードが違います。');history.back();</script>";
}

else {
    $sql = "insert into user(id, pw, nickname) values('$id', '$pw', '$nickname')"; //　データベースにid, pw, nicknameを登録。
    $result = mysqli_query($con, $sql);
    echo "<script>alert('登録成功！');</script>"; //　登録に成功したら成功をお知らせ。
    echo "<meta http-equiv='refresh' content='1; URL=login.php'>"; //　登録した後、ログイン画面に。
}






?>