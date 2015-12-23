<?php
require('dbconnect.php');
session_start();
//$_POST = array();


	//-----------ログインしている人のユーザー情報を取得-----------

	$_SESSION['id'] = 1;
	// echo $_SESSION['id'];
	// $member=array();
	if (isset($_SESSION['id'])){

		//ログインしている人のユーザー情報を取得
		$sql = sprintf('SELECT * FROM members WHERE id=%d',
				mysqli_real_escape_string($db, $_SESSION['id'])
				);

		$record = mysqli_query($db, $sql) or die(mysqli_error($db));

		$member = mysqli_fetch_assoc($record);

	}

	if (!empty($_POST)){

		//var_dump($_FILES['back_image']);
		if( isset($_FILES['back_picture'])){
		    if( $_FILES['back_picture']['error'] == UPLOAD_ERR_OK){
		      $tmp_name = $_FILES['back_picture']['tmp_name'];
		      $name     = $_FILES['back_picture']['name'];
		      $back_picture = date('YmdHis').$name;
		      move_uploaded_file($tmp_name, "./back_picture/".$back_picture );
		    }

		 }
		//var_dump($_FILES['back_image']);
		if( isset($_FILES['prof_picture'])){
		    if( $_FILES['prof_picture']['error'] == UPLOAD_ERR_OK){
		      $tmp_name = $_FILES['prof_picture']['tmp_name'];
		      $name     = $_FILES['prof_picture']['name'];
		      $prof_picture = date('YmdHis').$name;
		      move_uploaded_file($tmp_name, "./profile_picture/".$prof_picture );
		    }

		}
		// $fileName = $_FILES['back_image']['name'];
		// //$fileName = $_FILES['plof_image']['name'];
		// if (!empty($fileNam)){
		// 	$ext = substr($fileName,-3);
		// 	if ($ext != 'jpg' && $ext !='gif' && $ext !='png') {
		// 		$error['back_image']['name'] = 'type';
		// 	}
	 //     }   

	 //    if (empty($error)) {
			
		// 	$image = date('YmdHis').$_POST['back_image']['name'];
		// 	move_uploaded_file($_POST['back_image']['name'],'../back_picture/'.$image);
		// 	//サーバーに保存
		// 	$_SESSION['join'] = $_POST;
		// 	$_SESSION['join']['back_image'] = $image;
			
		// 	exit();
		// }

	  

	    if (empty($member)) {
		
	    } elseif (!empty($member)) {

//var_dump($_FILES);

	        $sql = sprintf('UPDATE members SET name="%s", prof_message="%s", prof_picture="%s", back_picture="%s", modified=NOW() WHERE id=%s',
	        // $this->plural_resource,
	        	$_POST['name'],
	        	$_POST['prof_message'],
	        	$prof_picture,
	        	$back_picture,
	            $member['id']
	        );
	        //echo $sql;
	        mysqli_query($db, $sql) or die(mysqli_error($db));
	        
	    }
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

    <title>Pigoetter</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/chart.js"></script>

    <!-- アコーディオン機能 -->
    <script>
	$(function(){
		$("#acMenu dt").on("click", function() {
			$(this).next().slideToggle();
		});
	});
	</script>


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
			          <a class="navbar-brand" href="https://suzuri.jp/nemuke/products" TARGET="_blank"><img src="assets/img/hato.jpg" width="70" height="70" ></a>
			        </div><!-- col-lg-4 -->
			    </div><!-- navbar-header -->

			    <div class="col-lg-4 centered">
			    	<h3>プロフィール編集</h3>
			    </div><!-- col-lg-4 centered -->

			    <div class="col-lg-4">
		        	<div class="button1">
			       		<a href="index.php"><button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						</button></a>
						<a href="favorite.php"><button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button></a>
						<a href="plofile.php"><button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						</button></a>
					</div>
				</div>

			</div><!-- row -->
		</div><!-- container -->
    </div><!--/.nav-collapse -->

	<div class="containerRe">
		<form action="" method="post" enctype="multipart/form-data">
		    <div class="row centered" style="margin-bottom: 50px;">
		    	<div>
		    		<span>背景画像</span>
		    	</div>
		    	<div>
			    	<img alt="" src="assets/img/hato2.jpg" width="100" height="100">
			    	<input type="file" name="back_picture" style="margin: 0 auto;">
		    	</div>
		    </div>

		    <div class="row centered" style="margin-bottom: 50px;">
		    	<div>
		    		<span>プロフィール画像</span>
		    	</div>
		    	<div>
		        	<img alt="" src="assets/img/hato2.jpg" width="100" height="100">
		        	<input type="file" name="prof_picture" style="margin: 0 auto;">
		    	</div>
		    </div>

		    <div class="row centered" style="margin-bottom: 50px;">
			    <div>
			    	<span>名前</span>
			    </div>
			    <div>
			    	<textarea name="name" ><?php //echo $_POST['name'];  ?></textarea>
			    </div>
			</div>

			<div class="row centered" style="margin-bottom: 10px;">
			    <div>
			    	<span>メッセージ</span>
			    </div>
			    <div>
			    	<textarea name="prof_message"><?php //echo $_POST['plof_message'];  ?></textarea>
			    </div>
			</div>
			<br />
			<div class="row centered">
			    <input type="submit" value="編集完了">
	    	</div><!-- row centered -->
		</form>

	</div><!-- containerRe -->

	<br />
	<br />


	    			
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