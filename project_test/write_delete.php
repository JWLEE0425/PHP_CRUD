<?php
include('config.php');  // session登録
$con = db_con();


$no = $_GET['no'];  // view.phpで設定したno取得。

// GETしたnoに当たるデーターを消す。
$sql = "delete from board where no='$no';";
$result = mysqli_query($con, $sql);

echo "<meta http-equiv='refresh' content='0; URL=index.php'>";  // index.phpに戻る。
?>