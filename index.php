<?php
	
	//var_dump($_POST);
	session_start();
	require('dbconnect.php');
	
	//投稿を記録する
	if (!empty($_POST)) {
		//messageが入っているならば下記の処理を行う(入力されていたら)
		//var_dump($_POST['message']);
		if ($_POST['message'] != '') {
			$member['id']=1;

			$sql = sprintf('INSERT INTO posts SET member_id=%d, message="%s", reply_id=%d, created=NOW()',
				
				mysqli_real_escape_string($db, $member['id']),
				
				mysqli_real_escape_string($db, $_POST['message']),
				mysqli_real_escape_string($db, $_POST['reply_id'])
				);
			//var_dump($sql);
				mysqli_query($db, $sql) or die(mysqli_error($db));
			header('Location: index.php');
			exit();
		}
	}

	//投稿を取得する
	$sql = sprintf('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
	$posts = mysqli_query($db, $sql) or die (mysqli_error($db));


	// function htmlspecialchars($value){
	// 		//returnで戻り値（変換したい文字）を取り出す
	// 		return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
	// 	}
		
	//返信の場合
	// if (isset($_REQUEST['res'])) {
	// 	//delete_flagを入れないと全件表示してしまう
	// 	$sql = sprintf('SELECT m.name, m.picture, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=%d ORDER BY p.created DESC',
	// 	mysqli_real_escape_string($db, $_REQUEST['res'])
	// 	);
	// 	$record = mysqli_query($db, $sql) or die(mysqli_error($db));
	// 	$table = mysqli_fetch_assoc($record);
	// 	//返信用メッセージを作成している
	// 	$message = '@' .$table['name'] .' ' .$table['message'];
	// }
	
	
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





		<form method="post" action="">
			<div class="col-lg-4 centered">
			<div class="input-group">
			<textarea name="message" class="form-control" cols="50" rows=""></textarea>
			<input type="hidden" name="reply_id" value="<?php //echo htmlspecialchars($_REQUEST['res']); ?>" />
					    <!-- <textarea class="form-control" rows="" ></textarea> -->
					    <span class="input-group-btn">
					    	<button class="btn " type="submit" >Go!</button>
					    </span>
					</div><!-- /input-group -->
			    </div>
		</form>
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

	<?php while($post = mysqli_fetch_assoc($posts)): ?>
	<!-- <div id="green"> -->
		<div class="containerRe">
			<!-- <div style="margin-bottom: 15px;"> -->
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-3 centered">
						<img src="member_picture/<?php echo htmlspecialchars($post['picture']); ?>" width="100" height="100" alt="<?php //echo htmlspecialchars($post['name']); ?>" />
					</div>
					<div class="col-lg-5 centered">
					<span type="text" name="nickname" class="form-control"><p><?php echo htmlspecialchars($post['message']); ?></p>
						<p class="day"><?php //echo htmlspecialchars($post['id']); ?><?php //echo htmlspecialchars($post['created']); ?></p></span>	
	
	<?php //while($post = mysqli_fetch_assoc($posts)): ?>
					
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea class="form-control" rows="" ></textarea></dd>
								</dl>
							</div>
							<div class="col-lg-1 centered">
								<span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
						　
					</div>
					<div class="col-lg-2"></div>
				</div>
			<!-- </div> -->
	<?php endwhile; ?>				
	<?php //endwhile; ?>	

			<!-- <div style="margin-bottom: 15px;"> -->
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
			<!-- </div> -->


			<!-- <div style="margin-bottom: 15px;"> -->
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
			<!-- </div> -->


			<!-- <div style="margin-bottom: 15px;"> -->
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
			<!-- </div> -->


			<!-- <div style="margin-bottom: 15px;"> -->
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
			<!-- </div> -->


		</div>

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
