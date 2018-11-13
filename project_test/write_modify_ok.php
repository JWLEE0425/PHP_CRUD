<?php
include ("config.php");
$con = db_con();

$no =$_POST['no'];  // write_modify.phpで設定したno取得。

// 修正した題目と内容データーを取得。
$title = $_POST['title'];  
$content = $_POST['content'];

// 題目と内容を変更。
$sql = "update board set content='$content', title='$title' where no = '$no'";
$result = mysqli_query($con, $sql);
echo "<meta http-equiv='refresh' content='0; URL=index.php'>";
?>