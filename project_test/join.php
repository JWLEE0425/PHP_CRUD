<script>
function check(){  //重複チェック
	document.getElementById("chk_id2").value=0;  //　重複チェックをしなかったので、基本は０(false)。
	var id = document.getElementById("user_id").value;  //　会員登録する時のIDをもらう。
  
  	if(id == "") { //　IDを書いてなかったら、チェックができません。
  		alert("IDを書いてください。");
  		exit;
  	}
  
  	ifrm1.location.href="join_chk.php?userid="+id; //　join_chk.phpがGETできるIDを設定。
 }

</script>

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
	<title>JOIN</title>
  </head>

<body>
<br>
	<!--　submitをクリックしたら、join_ok.phpを実行。　-->
	<form action=join_ok.php method=post name=frmjoin>
		<table cellpadding=5 cellspacing=5 align=center style="width: 30%">
			<tr>
				<td colspan=2 align=center><h4>会員登録</h4></td>
			</tr>
			<tr>
				<td colspan=2> 
					<input type="text" class="form-control" id="user_id" placeholder="ID" name="user_id" maxlength=15>
					<input type=button value="重複チェック" onclick="check()">
				</td>
  				<td><input type=hidden id="chk_id2" name=chk_id2 value="0"></td>
			</tr>
			<tr>
				<td><input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength=20></td>
			</tr>
			<tr>
				<td><input type="password" class="form-control" id="password2" placeholder="Confirm Password" name="password2" maxlength=20></td>
			</tr>
			<tr>
				<td><input type="text" class="form-control" id="nickname" placeholder="nickname" name="nickname" maxlength=20></td>
			</tr>
			<tr><td colspan=3>&nbsp;</td></tr>
			<tr>
				<td colspan=3 align=center>
				<input type=submit class="btn btn-default login-popup-btn" value="登録">&nbsp;&nbsp;
				<input type=reset class="btn btn-default login-popup-btn" value="クリーン">&nbsp;&nbsp; 
				<a href=login.php><input type=button class="btn btn-default login-popup-btn" value="キャンセル"></a>
				</td>
			</tr>
		</table>
		<br>
		
	</form>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<iframe src="" id="ifrm1" scrolling=no frameborder=no width=0 height=0 name="ifrm1"></iframe>
</body>
</html>
