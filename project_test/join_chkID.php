<?php
// 重複チェック
include ("config.php"); //　データベース連結
$con = db_con();


$id = $_GET['userid']; //　会員登録した時のIDをGET


$sql = "select count(*) from user where id='$id'";  // データベースで既にIDが登録してあるかどうかを探す。
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);  // データを配列にする。



// nickname 重複チェック
mysql_close($con);


?>

<script>
var row="<?=$row[0]?>";  //　配列の１番目

if(row==1) {  //　データベースに既にIDがあれば登録できない。
	parent.document.getElementById("chk_id").value="0";  //　重複なら、０(false)になる。
	parent.alert("このIDは既にありますので、他のIDを書いてください。");
} else {  //　データベースにIDがなかったら、登録できる。
 	parent.document.getElementById("chk_id").value="1";  //　重複がないなら、１(true)になる。
 	parent.alert("OK");
}
</script>