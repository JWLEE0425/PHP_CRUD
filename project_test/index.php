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

    <title>index</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
      　     <!-- sessionの名前を上で表示（ログインした人のnickname） -->
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

    <!-- Page Content -->
    <div class="container">
	<br>

	
	<br>
	<div class="jumbotron">
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th> no </th>
              <th> 題目 </th>
              <th> 名前 </th>
              <th> 時間 </th>
            </tr>
          </thead>
          <tbody>
		  <?php
          $con = db_con();
          $sql = "select * from board order by no desc";  //　データベースでデータを取得して、'no'基準で逆順並べ
          $result = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_assoc($result)) {  // 　取得したデーターをレコードにする。
          ?>
		  <tr>
		  <!--  題目、名前、時間の情報を画面に出す。-->
		  <th scope='row'><?php echo $row['no']?></th>
		  <td class="title"><a href="./view.php?no=<?php echo $row['no']?>"><?php echo $row['title']?></a></td>　<!-- view.phpでGETできる為の no設定 -->
		  <td><?php echo $row['nickname']?></td>
		  <td><?php echo $row['date']?></td>
		  </tr>

		  <?php 
          }
          
          /*　
           *   掲示物が全部無くなったら、noが０になります。
           *  その後、掲示物を登録したら、最初の掲示物noは１になります。
           */
          $sql = "select count(*) from board"; //　掲示物数をcountします。
          $result = mysqli_query($con, $sql);
          $count_row = mysqli_fetch_array($result);
          
          if($count_row[0] == 0) {  //　掲示物数が０なら、noデーター（ noはAUTO_INCREMENTです。）を０にする。
              $sql = "alter table board AUTO_INCREMENT=0";
              $result = mysqli_query($con, $sql);
          }
          mysqli_close($con);
          ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>
    <!-- /.container -->
	


  </body>

</html>
