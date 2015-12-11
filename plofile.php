<?php
require('dbconnect.php');
session_start();

 // アクセスカウンタ１
$fp = @fopen("counter1.txt", "r+") or die("Counter Error");
 flock($fp, LOCK_EX);
 $count = fgets($fp);
 $count++;
 rewind($fp);
 fputs($fp, $count);
 fclose($fp);

		 $sql = sprintf('INSERT INTO members SET count=%d',
		 	mysqli_real_escape_string($db, $count)
					);

 		mysqli_query($db, $sql) or die(mysqli_error($db));

// echo $count;


 		$sql = sprintf('SELECT * FROM posts WHERE 1');
		$record = mysqli_query($db, $sql) or die(mysqli_error($db));
		$table = mysqli_fetch_assoc($record);

		$message = $table['message'];

		if($count % 3 == 0 ){ 
			echo $message;
		}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- カウンター -->
 	<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">

    <title>plofile</title>

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
    	<p>あなたは<?php  print $count; ?>羽目のハトです。</p>
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
					    <h3>Plofile</h3>		
					</div>
			        </div>
			    </div>
			    <div class="col-lg-4 centered">
			    </div>
			    <div class="col-lg-4">
		        	<div class="button1">
			       		<button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button>
						<button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						</button>
					</div>
				</div>

			</div>
		</div>
    </div><!--/.nav-collapse -->


	<div class="containerRe">
			<div style="margin-bottom: 15px;">
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-3 centered">
						<img src="assets/img/hato.jpg" width="100" height="100" alt="">
					</div>
					
					<div class="col-lg-5 centered">
						
						<span type="text" name="nickname" class="form-control">ここに投稿されたコメントが表示されます。</span>
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea class="form-control" rows=""><?php if($count % 3 == 0 ){ echo $message;} ?></textarea>
										<button class="
										btnr" type="button"  style="float:right;">Go!</button>
									</dd>
								</dl>
							</div>
							<div class="col-lg-1 centered">
								</span></span></span><span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
						
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
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea class="form-control" rows="" ></textarea></dd>
								</dl>
							</div>
							<div class="col-lg-1 centered">
								</span></span></span><span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
						
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
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea class="form-control" rows="" ></textarea></dd>
								</dl>
							</div>
							<div class="col-lg-1 centered">
								</span></span></span><span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
						
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
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea class="form-control" rows="" ></textarea></dd>
								</dl>
							</div>
							<div class="col-lg-1 centered">
								</span></span></span><span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
						
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
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea class="form-control" rows="" ></textarea></dd>
								</dl>
							</div>
							<div class="col-lg-1 centered">
								</span></span></span><span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
						
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>


		</div>

	</div>
	
	
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
