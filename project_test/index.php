<?php
include('lock.php');  // session登録
$con = db_con();

if(isset($_GET['see'])) {  // 検索するコラム
    $searchColumn = $_GET['see'];
} else {
    $see = 5;
}


// 検索
if(isset($_GET['searchColumn'])) {  // 検索するコラム
    $searchColumn = $_GET['searchColumn'];
}

if(isset($_GET['searchText'])) {  // 検索する内容
    $searchText = $_GET['searchText'];
}


if(isset($searchColumn) && isset($searchText)) {  // likeを使って選択したコラムと内容が含まれている掲示物を探す。
    $searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';
} else {
    $searchSql = '';  // 何も選択しなかったら、空白
}

// ページング
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {    
    $page = 1;    
}
$sql = 'select count(*) as cnt from board' . $searchSql;  //　boardテーブルの個数をcountする
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$allPost = $row['cnt'];  //　全体掲示物の数
$onePage = $see;  //　1ページに見せる掲示物の数
$allPage = ceil($allPost / $onePage);  //　全体ページの数

if($page < 1 || ($page > $allPage)) {  //　存在しないページを入力する場合
?>
<script>
	alert("存在しないページです。");
	history.back();
</script>
<?php
    exit;
}

$oneSection = 3;  //　一度に見せる総ページ個数
$currentSection = ceil($page / $oneSection);  //　現在のセクション
$allSection = ceil($allPage / $oneSection);  //　全体セクションの数
$firstPage = ($currentSection * $oneSection) - ($oneSection - 1);  //　現在のセクションの初めてページ

if($currentSection == $allSection) {
    $lastPage = $allPage; //　現在のセクションが最後のセクションならば$allPageが最後のページになります。
} else {
    $lastPage = $currentSection * $oneSection; //　現在のセクションの最後のページ
}
$paging = '<ul class="pagination">'; //　ページングを保存する変数

$prevPage = (($currentSection - 1) * $oneSection);  //　以前のページに行く
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1);  //　次のページに行く


//　初めのボタン
$paging .= '<li class="page page_start">
            <a class="page-link" href="./index.php?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
            </a></li>';

$paging .= '<li class="page">
            <a class="page-link" href="./index.php?page=' . $prevPage . '">
            <span aria-hidden="true"><</span>
            <span class="sr-only">Previous</span>
            </a></li>';

for($i = $firstPage; $i <= $lastPage; $i++) {
    
    if($i == $page) {  //　現在選択したボタン
        $paging .= '<li class="page active">
                    <a class="page-link" href="./index.php?page=' . $i . '"><span style="font-weight:bold">' . $i . '
                    </span>
                    </a></li>';
    } else {
        $paging .= '<li class="page">
                    <a class="page-link" href="./index.php?page=' . $i . '">' . $i . '
                    </a></li>';
    }
}

$paging .= '<li class="page">
            <a class="page-link" href="./index.php?page=' . $nextPage . '">
            <span aria-hidden="true">></span>
            <span class="sr-only">Previous</span>
            </a></li>';

//　終わりのボタン
$paging .= '<li class="page page_end">
            <a class="page-link" href="./index.php?page=' . $allPage . '" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
            </a></li>';

$paging .= '</ul>';

$currentLimit = ($onePage * $page) - $onePage;  //　何回目の文から持ってくるのかをきめる。
$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage;  //　limit sql
$sql = 'select * from board' . $searchSql .' order by no desc' . $sqlLimit;  //　$currentLimitの個数を持ってきます。
$result = mysqli_query($con, $sql);


?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>index</title>
    <style type="text/css">

    
    ul.pagination {
        width: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    th {
        width: 10px;
    }
    td.title {
        width: 200px;
    }
    td.nickname {
        width: 50px;
    }
    td.time {
        width: 100px;
    }
    
    </style>

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
      
      <form action="index.php" method="post" align="right">
	  <div class="form-group">
	  	<select name="see" class="btn btn-default login-popup-btn">
			<option value='3'>３個</option>
			<option value='5' selected>５個</option>
			<option value='10'>10個</option>
	  	</select>
	  </div>
	  </form>	
	  
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
          while ($row = mysqli_fetch_assoc($result)) {  // 　取得したデーターをレコードにする。
          ?>
		  <tr>
		  <!--  題目、名前、時間の情報を画面に出す。-->
		  <th scope='row'><?php echo $row['no']?></th>
		  <td class="title"><a href="./view.php?no=<?php echo $row['no']?>"><?php echo $row['title']?></a></td>　<!-- view.phpでGETできる為の no設定 -->
		  <td class="nickname"><?php echo $row['nickname']?></td>
		  <td class="time"><?php echo $row['date']?></td>
		  </tr>

		  <?php 
          }
          
          /*　
                    *   掲示物が全部無くなったら、noが０になる。
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
        <br>
        <div class="paging">
		<?php echo $paging ?>
		</div>
      </div>
	  <br>
	  <div class="searchBox">
	  
	  <form class="form-inline" action="./index.php" method="get">
	  <div class="form-group">
	  	<select name="searchColumn" class="btn btn-default login-popup-btn">
			<option value="title">題目</option>
			<option value="content">内容</option>
			<option value="nickname">名前</option>
	  	</select>&nbsp;&nbsp;
	  <input type="text" class="form-control" style="width:300px" name="searchText" >&nbsp;&nbsp;
	  <button type="submit" class="btn btn-default login-popup-btn">検索</button>
	  </div>
	  </form>	
	  </div>
	 
    </div>
    </div>
	
	<!-- /.container -->
	


  </body>

</html>
