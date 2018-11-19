<?php
include('lock.php');  // session登録
$con = db_con();

/* 페이징 시작 */
if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {    
    $page = 1;    
}
$sql = 'select count(*) as cnt from board order by no desc';
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$allPost = $row['cnt']; //전체 게시글의 수
$onePage = 5; // 한 페이지에 보여줄 게시글의 수.
$allPage = ceil($allPost / $onePage); //전체 페이지의 수

if($page < 1 || ($allPage && $page > $allPage)) {
?>
<script>
	alert("존재하지 않는 페이지입니다.");
	history.back();
</script>
<?php
    exit;
}

$oneSection = 10; //한번에 보여줄 총 페이지 개수
$currentSection = ceil($page / $oneSection); //현재 섹션
$allSection = ceil($allPage / $oneSection); //전체 섹션의 수
$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

if($currentSection == $allSection) {
    $lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
} else {
    $lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
}
$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

$paging = '<ul class="pagination">'; // 페이징을 저장할 변수

//처음 버튼을 생성
$paging .= '<li class="page page_start">
            <a class="page-link" href="./index.php?page=1" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
            </a></li>';


for($i = $firstPage; $i <= $lastPage; $i++) {
    if($i == $page) {
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

// 끝 버튼을 생성
$paging .= '<li class="page page_end">
            <a class="page-link" href="./index.php?page=' . $allPage . '" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
            </a></li>';

$paging .= '</ul>';

	
/* 페이징 끝 */
$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문
$sql = 'select * from board order by no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
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
        width: 150px;
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
	
    </div>
    </div>
	
	<!-- /.container -->
	


  </body>

</html>
