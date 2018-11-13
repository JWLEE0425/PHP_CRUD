<?php
session_start();
include('config.php');  // データベース連結
$con = db_con();

// sessionIDを取得。
$user_check=$_SESSION['login_user'];

$ses_sql=mysqli_query($con, "select nickname from user where id='".$user_check."' ");
$row=mysqli_fetch_array($ses_sql);

$login_session=$row['nickname'];

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Board index</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
	<title>black</title>
</head>

<body topmargin=0 leftmargin=0 text=#464646>
<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">ホムへ</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">ホム</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="write.php">アップロード</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">ログアウト</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
	<br><br>
	<!-- submitをクリック（アップロード）したら、write_ok.phpを実行。 -->
	<form action=write_ok.php method=post>
		<table width=580 border=0 cellpadding=3 cellspacing=3 align=center>
			<tr>
				<td width=60 align=left>名前</td>
				<!-- ログインした時のnickname（session名前）を上で表示。 -->
				<td align=left><INPUT type=text class="form-control" name=nickname size=60 maxlength=35 value="<?php print $login_session?>" readonly></td>
			</tr>
			<tr>
				<td width=60 align=left>題目</td>
				<td align=left><INPUT type=text class="form-control" name=title size=60 maxlength=35></td>
			</tr>
			<tr>
				<td width=60 align=left>内容</td>
				<td align=left><TEXTAREA name=content class="form-control" cols=60 rows=10></TEXTAREA></td>
			</tr>
			<tr>
				<td colspan=3>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=10 align=center>
				<INPUT type=submit class="btn btn-default login-popup-btn" value="アップロード">&nbsp;&nbsp;
				<INPUT type=reset class="btn btn-default login-popup-btn" value="クリーン"> &nbsp;&nbsp; 
				<INPUT type=button class="btn btn-default login-popup-btn" value="バック" onclick="history.back(-1)">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
</html>
