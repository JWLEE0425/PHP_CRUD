<?php
include("config.php"); //　データベース連結
$con = db_con();
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") { //　リクエストがPOSTである場合実行。
    $myusername = $_POST['user_id']; //　textboxに入力したデーターを取得。
    $mypassword = $_POST['password'];
    $sql = "select nickname from user where id='$myusername' and pw='$mypassword'"; //　入力したIDとパスワードに当たるnicknameを探す。
    $result = mysqli_query($con, $sql);
    $count=mysqli_num_rows($result); //　探したnicknameをcountする。
    if($count == 1) { //　nicknameがあったら、ログイン成功。
        $_SESSION['login_user']=$myusername;
        header("location: index.php");
    }
    
    else { //　nicknameがなかったら、データベースにない情報やIDとパスワードが間違ったのでログイン失敗。
        echo "<script>alert('IDやパスワードが間違えます。');</script>";
    }
}

mysqli_close($con);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
	<title>ログイン</title>

  </head>
  
  <body>
<br>
	<h2 align='center'>PHP</h2>
	<br><br>
	<div class="login-popup-wrap new_login_popup" align="center">
		<div class="login-popup-heading text-center">
			<h4>
				<i class="fa fa-lock" aria-hidden="true"></i> ログイン
			</h4>
		</div>
		<form action="" method="post" align="center">
			<br>
			<div class="form-group" align="center">
				<input type="text" class="form-control" id="user_id" style="width: 20%" placeholder="ID" name="user_id">
			</div>
			<div class="form-group" align="center">
				<input type="password" class="form-control" id="password" style="width: 20%" placeholder="Password" name="password">
			</div>
			
			<button type="submit" class="btn btn-default login-popup-btn" name="submit" value="1">ログイン</button>
			<a href="join.php"><button type="button" class="btn btn-default login-popup-btn" name="submit" value="1">会員登録</button></a>
		</form>
	</div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>