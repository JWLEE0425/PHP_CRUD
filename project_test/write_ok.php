<?php
include('config.php');  // データベース連結
$con=db_con();
session_start();

// write.phpで入力した名前、題目、内容を取得。
$title = $_POST['title'];
$nickname = $_POST['nickname'];
$content = $_POST['content'];

if(!$title || !$content){  // 題目、内容が空白ならチェックをお知らせ。
    echo "<script>alert('空白をチェックしてください。');history.back();</script>";
}
else {  // boardテーブルに名前、題目、内容データーを入れる。
    $sql = "insert into board(title, nickname, content) value ( '$title', '$nickname', '$content' )";
    $result = mysqli_query( $con, $sql );
}


?>
<!--終わったら、index.phpに戻る。 --> 
<meta http-equiv='refresh' content="0; url='http://localhost:81/project_test/index.php'">