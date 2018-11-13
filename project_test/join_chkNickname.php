<?php
// 重複チェック
include ("config.php"); //　データベース連結
$con = db_con();


$nickname = $_GET['nickname']; //　会員登録した時のnicknameをGET


$sql = "select count(*) from user where nickname='$nickname'";  // データベースで既にnicknameが登録してあるかどうかを探す。
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);  // データを配列にする。



// nickname 重複チェック
mysql_close($con);


?>

<script>
var row="<?=$row[0]?>";  //　配列の１番目

if(row==1) {  //　データベースに既にnicknameがあれば登録できない。
	parent.document.getElementById("chk_nickname").value="0";  //　重複なら、０(false)になる。
	parent.alert("このNicknameは既にありますので、他のNicknameを書いてください。");
} else {  //　データベースにIDがなかったら、登録できる。
 	parent.document.getElementById("chk_nickname").value="1";  //　重複がないなら、１(true)になる。
 	parent.alert("OK");
}
</script>