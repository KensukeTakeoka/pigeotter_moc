<?php
require('dbconnect.php');
session_start();


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
	// $_POST=$member;
	// var_dump($member);
	        // 	$_POST['name']=$member['name'];
        	// $_POST['plof_message']=$member['plof_message'];  
	// $_POST=$member;
	// echo $_POST['name'];
	// var_dump($_POST);
	//-----------ログインしている人のユーザー情報を取得-----------

        // $sql = sprintf('UPDATE members SET name="%s" message="%s", modified=NOW() WHERE id=%s',
        // // $this->plural_resource,
        // 	$member['name'],
        //     $member['plof_message'],
        //     $_SESSION['id']
        // );


            
	if (empty($member)) {
			// ページに初めて訪れた際
		// $blog_record = $this->show($id);
  //       $blog = mysqli_fetch_assoc($blog_record);

		// $return['name'] = $member;
  //       $return['plof_message'] = $member;

  //       return $return;



    } elseif (!empty($member)) {
    		// 情報を編集し送信した際
        // $id = array('id' => $id);
        // $blog = array_merge($id, $blog);

        // $Blog = new Blog($this->plural_resource);
        	// $_POST['name']=$member['name'];
        	// $_POST['plof_message']=$member['plof_message']; 
        	// $member['name']=$_POST['name'];
        	// $member['name']=$_POST['plof_message'];  

        $sql = sprintf('UPDATE members SET name="%s", plof_message="%s", modified=NOW() WHERE id=%s',
        // $this->plural_resource,
        	$_POST['name'],
        	$_POST['plof_message'],
            $member['id']
        );
        echo $sql;

        mysqli_query($db, $sql) or die(mysqli_error($db));

        // return $sql;

        // header("Location: plofile.php");
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

    <title>Pgoetter</title>

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
			        </div>
			    </div>

			    <div class="col-lg-4 centered">
			    	<h3>プロフィール編集</h3>
			    </div>

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

			</div>
		</div>
    </div><!--/.nav-collapse -->

	<div class="containerRe">
		<form action="" method="post">
		    <div class="row centered" style="margin-bottom: 50px;">
		    	<div>
		    		<span>背景画像</span>
		    	</div>
		    	<div>
			    	<img alt="" src="http://lorempixel.com/1000/400/people/1/" width="100" height="100">
			    	<input type="file" name="example1" style="margin: 0 auto;">
		    	</div>
		    </div>

		    <div class="row centered" style="margin-bottom: 50px;">
		    	<div>
		    		<span>プロフィール画像</span>
		    	</div>
		    	<div>
		        	<img alt="" src="http://lorempixel.com/200/200/people/1/" width="100" height="100">
		        	<input type="file" style="margin: 0 auto;">
		    	</div>
		    </div>

		    <div class="row centered" style="margin-bottom: 50px;">
			    <div>
			    	<span>名前</span>
			    </div>
			    <div>
			    	<textarea name="name"><?php echo $_POST['name'];  ?></textarea>
			    </div>
			</div>

			<div class="row centered" style="margin-bottom: 10px;">
			    <div>
			    	<span>メッセージ</span>
			    </div>
			    <div>
			    	<textarea name="plof_message"><?php echo $_POST['plof_message'];  ?></textarea>
			    </div>
			</div>
			<div class="row centered">
			    <input type="submit" value="編集完了">
	    	</div>
		</form>

	</div>


	    			
	<div id="f">
		<div class="container">
			<div class="row">
				<p>Crafted with <i class="fa fa-heart"></i> by BlackTie.co.</p>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/bootstrap.js"></script>
  </body>
</html>
