<?php
include('lock.php');  // session登録
?>



<!DOCTYPE html>
<html lang="en">

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

  </head>

  <body>

	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    
      <div class="container">
        <!-- sessionの名前を上に表示 -->
       <a class="navbar-brand" href="index.php"><?php print $login_session?>&nbsp;様</a>
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
	<?php
    $con = db_con();
    $no = $_GET['no'];  // view.phpで設定したnoデーターをGET
    $sql = "select * from board where no='$no'";  // 修正する掲示物データーを取得。
    $result=mysqli_query($con, $sql);
    $row=mysqli_fetch_assoc($result);
    ?>	
    
    <!-- submit（修正）をクリックしたら、write_modify_ok.phpを実行。 -->
    <form action="write_modify_ok.php" method=post>
    
	<div class="container">
	
		<table width=90% border=0 cellpadding=3 cellspacing=3 align=center>
		<thead>
		
			<tr>
				<th scope='row'>名前</th>
				<td align=left><input type=text class="form-control" name=user size=60 maxlength=35 value="<?php echo $row['nickname']?>" readonly></td>
			</tr>
		</thead>
		<tbody>
		<tr>
				<th scope='row'>題目</th>
				<td><input type=text class="form-control" name=title size=60 maxlength=35 value="<?php echo $row['title']?>"></td>
			</tr>
			<tr>
				<th scope='row'>内容</th>
				<td><textarea class="form-control" name=content cols=60 rows=10><?php echo $row['content']?></textarea></td>
			</tr>
		</tbody>
			
		</table>
		<br>
		<div align="center">
			<a href="index.php"><input type=button class="btn btn-default login-popup-btn" value='リスト' ></a>&nbsp;&nbsp;
			<input type=submit class="btn btn-default login-popup-btn" value='修正' >&nbsp;&nbsp;
			<input type=button class="btn btn-default login-popup-btn" value='キャンセル'  onclick="history.back(-1)">&nbsp;&nbsp;
			
		</div>
		
    </div>
    <!-- 修正する掲示物のno設定 -->
    <input type=text name=no size=1 maxlength=1 value="<?php echo $row['no']?>" readonly>　
    </form>
	
  </body>

</html>
