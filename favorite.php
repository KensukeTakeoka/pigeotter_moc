<?php
session_start();
require('dbconnect.php');
// var_dump($_SESSION);
// 必ずあとで消す！！！！！！！！！！！
$_SESSION['id']=1;
if(isset($_SESSION['id'])) {
	// $id = $_REQUEST['id'];
	//投稿を検査する
	$sql = sprintf('SELECT * FROM `posts` inner join `favorite` on `posts`.id = `favorite`.post_id where`favorite`.`member_id`=186');
	$favorite_posts = mysqli_query($db, $sql) or die(mysqli_error($db));
	// $table = mysqli_fetch_assoc($favorite_post);
	//var_dump($table);
	// if ($table['member_id'] == $_SESSION['id']) {
	// 	//削除
	// 	//$sql = sprintf('DELETE FROM posts WHERE id=%d', mysqli_real_escape_string($db, $id));
	// 	$sql = sprintf('UPDATE posts SET flag=1 WHERE id=%d', mysqli_real_escape_string($db, $id));
	// 	mysqli_query($db, $sql) or die(mysqli_error($db));
	// }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pigeotter</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/chart.js"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top">
    	<div class="container">
	      	<div class="row">
	      		<div class="col-lg-4">
			        <div class="navbar-header">
			        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			        </button>
			        <div id="favo">
					    <h3>Favorite</h3>		
					</div>
			        </div>
			    </div>

			    <div class="col-lg-2 centered">
			    </div>

			    <div class="col-lg-6">
		        	<div class="button1">
			       		<button type="button" class="btn btn-default btn-lg" onclick="location.href='index.php'">
						  <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-lg" onclick="location.href='favorite.php'">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-lg" onclick="location.href='profile.php'">
						  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-lg" onclick="location.href='logout.php'">
  							<span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
						</button>
					</div>
				</div>

			</div>
		</div>
    </div><!--/.nav-collapse -->



	<!-- <div id="green"> -->
		<div class="containerRe">
			<!-- <div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						<span type="text" name="nickname" class="form-control">ここに投稿されたコメントが表示されます。</span>
						<span class="glyphicon glyphicon-share-alt"><span>　　</span></span></span><span class="glyphicon glyphicon-thumbs-up"></span>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div> -->
			
			<?php
				while ($favorite_post = mysqli_fetch_assoc($favorite_posts)): 
      				//配列として1データずつ追加保存
      				// echo $favorite_post['message'];
      			?>
      			<div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						<span type="text" name="nickname" class="form-control"><?php echo $favorite_post['message'];?></span>
						<span class="glyphicon glyphicon-share-alt"></span><span>　　</span><span class="glyphicon glyphicon-star-empty"></span>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>
			<?php
    			endwhile;
    		?>

			<!-- <div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						<span type="text" name="nickname" class="form-control">ここに投稿されたコメントが表示されます。</span>
						<span class="glyphicon glyphicon-share-alt"></span><span>　　</span><span class="glyphicon glyphicon-thumbs-up"></span>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>

			<div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						<span type="text" name="nickname" class="form-control">ここに投稿されたコメントが表示されます。</span>
						<span class="glyphicon glyphicon-share-alt"></span><span>　　</span><span class="glyphicon glyphicon-thumbs-up"></span>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>

			<div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						<span type="text" name="nickname" class="form-control">ここに投稿されたコメントが表示されます。</span>
						<span class="glyphicon glyphicon-share-alt"></span><span>　　</span><span class="glyphicon glyphicon-thumbs-up"></span>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>

			<div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>

					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						<span type="text" name="nickname" class="form-control">ここに投稿されたコメントが表示されます。</span>
						<span class="glyphicon glyphicon-share-alt"></span><span>　　</span><span class="glyphicon glyphicon-thumbs-up"></span>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>

		</div> -->

	<!-- </div> -->
	
	
	<div id="f">
		<div class="container">
			<div class="row">
				<p>Copyright © Pigeotter 2015. All Rights Reserved</p>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
