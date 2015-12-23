<?php
require('dbconnect.php');
session_start();

	 // -----------アクセスカウンタ１-----------
	$fp = @fopen("counter1.txt", "r+") or die("Counter Error");
	flock($fp, LOCK_EX);
	$count = fgets($fp);
	$count++;
	rewind($fp);
	fputs($fp, $count);
	fclose($fp);
	//------------アクセスカウンタ１ end-----------



	//-----------ログインしている人のユーザー情報を取得-----------

	// $_SESSION['id'] = 1;
	// echo $_SESSION['id'];
	if (isset($_SESSION['id'])){

		//ログインしている人のユーザー情報を取得
		$sql = sprintf('SELECT * FROM members WHERE id=%d',
				mysqli_real_escape_string($db, $_SESSION['id'])
				);

		$record = mysqli_query($db, $sql) or die(mysqli_error($db));

		$member = mysqli_fetch_assoc($record);



	}
	// else{
	// 	//ログインしていない
	// 	header('Location: login.php');
	// 	exit();
	// }

	//-----------ログインしている人のユーザー情報を取得 end-----------



	//------------投稿者のデータを取得-------------
	// $sql = sprintf('SELECT * FROM members WHERE 1');
	// $members = mysqli_query($db, $sql) or die(mysqli_error($db));

	// $member=array();
	// while ($members = mysqli_fetch_assoc($members)) {
	// 	$member[] = $members;
	// }


	//------------投稿者のデータを取得end-------------


	//------------------投稿を記録する------------------
	if (!empty($_POST)) {
		//messageが入っているならば下記の処理を行う(入力されていたら)
		//var_dump($_POST['message']);
		if ($_POST['message'] != '' || $_REQUEST['reply_message']) {
			$member['id']=$_SESSION['id'];

			if(!empty($_REQUEST['reply_message'])){
				$message=$_REQUEST['reply_message'];
			}
			
			if(!empty($_POST['message'])){
				$message=$_POST['message'];
			}

			$sql = sprintf('INSERT INTO posts SET member_id=%d, message="%s", reply_id=%d, created=NOW()',
				
				mysqli_real_escape_string($db, $member['id']),
				
				mysqli_real_escape_string($db, htmlspecialchars($message)),
				mysqli_real_escape_string($db, htmlspecialchars($_POST['reply_id']))
				);
			//echo $sql;
				mysqli_query($db, $sql) or die(mysqli_error($db));
			header('Location: index.php');
			exit();

		
			
		}
	}

	//投稿を取得
	$sql = sprintf('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
	$posts = mysqli_query($db, $sql) or die (mysqli_error($db));



		// var_dump($_REQUEST);
	//返信
	if (isset($_REQUEST['reply_message'])) {
		$sql = sprintf('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=%d ORDER BY p.created DESC',
		mysqli_real_escape_string($db, $_REQUEST['reply_message'])
		);
		$record = mysqli_query($db, $sql) or die(mysqli_error($db));
		$table = mysqli_fetch_assoc($record);

	}
	

	//------------------投稿を記録するend------------------


	//---------------返信メッセージを取得---------------
	$i=1; 
	$reply_count=1;
	$reply_posts=array();
	while($reply_count>=$i){
		
		$sql = sprintf('SELECT * FROM posts WHERE reply_id > 0 ORDER BY created DESC');
			// mysqli_real_escape_string($db, htmlspecialchars($i))
			// mysqli_real_escape_string($db, htmlspecialchars($i))
			// );

		// echo $sql;

		$reply = mysqli_query($db, $sql) or die(mysqli_error($db));

			while($row = mysqli_fetch_assoc($reply)){
				$reply_posts[]=$row;
			}

		// echo $reply;
		// var_dump($reply);
		$i++;
		}

		// echo $reply_posts['message'];
		// var_dump($reply_posts);
		$reply_count = count($reply_posts);
		// echo $reply_count;

		$randum_reply_posts=rand(0,$reply_count);
		// echo $randum_reply_posts;

		$reply_postss=$reply_posts[$randum_reply_posts];
		// $_POST['message']=$reply_posts['message'];
		// echo $_POST['message'];
		// var_dump($reply_posts);


	//---------------返信メッセージを取得end---------------	



	//-----------投稿を取得-----------
	$sql = sprintf('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
	$m_posts = mysqli_query($db, $sql) or die (mysqli_error($db));
	// var_dump($posts);
	// var_dump($member);

	// $randum_id=rand(1,45);
	$sql = sprintf('SELECT * FROM posts WHERE 1 ORDER BY created DESC');
	// $record = mysqli_query($db, $sql) or die(mysqli_error($db));
	$posts = mysqli_query($db, $sql) or die(mysqli_error($db));
	// $post = mysqli_fetch_assoc($posts);
	// $table = mysqli_fetch_assoc($record);
	// while($table = mysqli_fetch_assoc($record)){
	// 	$_SESSION = $table;
	// }

	// var_dump($_SESSION);
	// echo $_SESSION['message'];	
	// $randum_message = array_rand($_SESSION['message']);
	// $tmpArray  = $table['reply_id'];
	// echo $_SESSION[$randum_message];
	

	//-----------投稿を取得end-----------


	//-----------自動返信用メッセージをインサート----------

	//投稿を記録する
	
	if ($count % 3 == 0 ) {

			$randum_reply_id=rand(1,$reply_count);
			// echo $randum_reply_id;
		
			$member['id']=$_SESSION['id'];
			// $_POST['reply_id']=$randum_reply_id;


			// $sql = sprintf('SELECT * FROM posts WHERE id='.$randum_reply_id);
			// $record = mysqli_query($db, $sql) or die(mysqli_error($db));
			// $table = mysqli_fetch_assoc($record);
			// $_POST['message'] = $table['message'];

			// $sql = sprintf('SELECT * FROM members WHERE id AND modified');
			// $record = mysqli_query($db, $sql) or die(mysqli_error($db));
			// $time = mysqli_fetch_assoc($record);

			// $randum_messages=$posts['$randum_reply_id'];
			// $randum_message=$randum_messages['message'];
			// echo $randum_message;
			// $_SESSION['message']=$messager;

			$sql = sprintf('INSERT INTO posts SET member_id=%d, message="%s", reply_id=%d, created=NOW()',
				
				mysqli_real_escape_string($db, $member['id']),
				mysqli_real_escape_string($db, htmlspecialchars($reply_postss['message'])),
				mysqli_real_escape_string($db, htmlspecialchars($randum_reply_id))
				);

			// echo $sql;
			mysqli_query($db, $sql) or die(mysqli_error($db));
			header('Location: index.php');
			exit();
	}


	//-----------返信メッセージをインサートend----------



	//-----------自動返信機能-----------
	// $randum_id=rand(1,6);
	// $sql = sprintf('SELECT * FROM posts WHERE id='.$randum_id);
	// $record = mysqli_query($db, $sql) or die(mysqli_error($db));
	// $table = mysqli_fetch_assoc($record);
	// $message = $table['message'];

	// $sql = sprintf('SELECT * FROM members WHERE id AND modified');
	// $record = mysqli_query($db, $sql) or die(mysqli_error($db));
	// $time = mysqli_fetch_assoc($record);

	// echo $time['modified'];
	// echo $message;



	// if($count % 3 == 0 ){
	// 	if($time['modified'] < $time['modified']+60*60*24*14){
	// 		echo $message;
	// 	}
	// }

	//-----------自動返信機能 end----------


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

    <title>pigeotter</title>

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
			            	<div class="panel panel-default arrow left">
			                	<!-- <div class="panel-body"> -->
			          <span>あなたは<?php  print $count; ?>羽目のハトです。</span>
			        </div>
			        <!-- </div> -->
			        </div>
			    </div>

		<form method="post" action="">
			<div class="col-lg-4 centered">
			<div class="input-group">
			<textarea name="message" class="form-control" cols="50" rows=""></textarea>
			<input type="hidden" name="reply_id" value="0" />
					    <!-- <textarea class="form-control" rows="" ></textarea> -->
					    <span class="input-group-btn">
					    	<button class="btn " type="submit" >Go!</button>
					    </span>
					</div><!-- /input-group -->
			    </div>
		</form>
			    <div class="col-lg-4">
		        	<div class="button1">
			       		<a href="index.php"><button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
						</button></a>
						<a href="favorite.php"><button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
						</button></a>
						<a href="profile.php"><button type="button" class="btn btn-default btn-lg">
						  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
						</button></a>
					</div>
				</div>
			</div>
		</div>
    </div><!--/.nav-collapse -->

	<br />
	<br />
	<br />

<!-- 投稿 -->
	<?php while($post = mysqli_fetch_assoc($posts)): ?>
	<?php //var_dump($post); ?>
	<?php if($post['reply_id'] == 0){ ?>
	<div class="container" style="margin-bottom:50px;">
 	 	<div class="row">
 	 		<div class="col-md-2"></div>
    		<div class="col-md-8">
	       		<section class="comment-list">
	  
		    		<article class="row">
		            	<div class="col-md-2 col-sm-2 hidden-xs">
				            <figure class="thumbnail">
					            <img class="img-responsive" src="<?php if(!isset($member['picture'])){ echo 'assets/img/hato2.jpg'; }else{ echo htmlspecialchars($member['picture']);} ?>" width="100" height="100" />
					            <figcaption class="text-center"><?php echo htmlspecialchars($member['name']); ?></figcaption>
				            </figure>
	           			</div>

			            <div class="col-md-10 col-sm-10">
			            	<div class="panel panel-default arrow left">
			                	<div class="panel-body">
					                <header class="text-left">
					                	<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo $post['created']; ?></time>
					                </header>
			                		<div class="comment-post">
					                    <p>
					                    <?php echo nl2br($post['message']); ?>
					                    </p>
	                				</div>
									<form method="post" action="">
										<div class="col-lg-10 centered">
											<dl id="acMenu">
												<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
												<dd>
													<textarea name="reply_message" class="form-control1" rows style="display:inline-block;float:left;width:400px;margin-right:5px"></textarea>
												    <button class="btn " type="submit" style="display:inline-block;">Go!</button>
												    <input type="hidden" name="reply_id" value="<?php echo $post['id']; ?>" />  
												</dd>
											</dl>
										</div>
									</form>
	            					<input type="hidden" name="reply_id" value="<?php echo $post['id']; ?>" />
	                   				<span class="glyphicon glyphicon-thumbs-up" ></span>

								<!-- 返信 -->
									<dl id="acMenu">
										<dt><span style="margin-left:90%;">Re</span></dt>
										<dd>
										<?php $j=0; ?>
										<?php while($reply_count > $j):?>
										<?php $reply_post =$reply_posts[$j]; ?>
										<?php if($reply_post['reply_id'] == $post['id'] && $post['created']  < $post['created']+60*60*24*14){ ?>

										    <article class="row">
												<div class="col-md-9 col-sm-9 col-md-offset-1 col-md-pull-1 col-sm-offset-0">
												    <div class="panel panel-default arrow right">
												        <div class="panel-heading">Reply</div>
												        <div class="panel-body">
														    <header class="text-right">
														        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo $reply_post['created']; ?></time>
														    </header>
										                  	<div class="comment-post">
														        <p>
														            <?php echo $reply_post['message']; ?>
														        </p>
										                	</div>
										                	<span class="glyphicon glyphicon-thumbs-up" ></span>
										                </div>
										            </div>
												</div>
												<div class="col-md-2 col-sm-2 col-md-pull-1 hidden-xs">
													<figure class="thumbnail">
														<img class="img-responsive" src="member_picture/<?php echo htmlspecialchars($member['picture']); ?>" width="100" height="100" />
														<figcaption class="text-center"><?php echo htmlspecialchars($member['name']); ?></figcaption>
													</figure>
												</div>
											</article>

										<?php } ?>
										<?php $j++; ?>
										<?php endwhile; ?>
										
										</dd>
									</dl>
	                			</div>
	              			</div>
	            		</div>
	            	</article>
	<?php }else{continue;} ?>

<!-- 返信 -->

 	<?php $k=0; ?>
	<?php while($table_count > $k):?>
	<?php $table =$table[$k]; ?>
	<?php if(!empty($_REQUEST['reply_message']) && $table['reply_id'] == $post['id']){ ?>

	
	            	<article class="row">
			            <div class="col-md-9 col-sm-9 col-md-offset-1 col-md-pull-1 col-sm-offset-0">
			            	<div class="panel panel-default arrow right">
			                	<div class="panel-heading">Reply</div>
			                	<div class="panel-body">
					                <header class="text-right">
					                	<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo $_REQUEST['created']; ?></time>
					                </header>
					                
	                  				<div class="comment-post">
					                    <p>
					                    	<?php echo $_REQUEST['reply_message']; ?>
					                    </p>
	                				</div>
	                				
	                				<span class="glyphicon glyphicon-thumbs-up" ></span>
	                			</div>
	              			</div>
	            		</div>
			            <div class="col-md-2 col-sm-2 col-md-pull-1 hidden-xs">
				            <figure class="thumbnail">
					            <img class="img-responsive" src="member_picture/<?php echo htmlspecialchars($_REQUEST['picture']); ?>" width="100" height="100" />
					            <figcaption class="text-center"><?php echo htmlspecialchars($_REQUEST['name']); ?></figcaption>
				            </figure>
			            </div>
					</article>
	
	
	<?php } ?>
	<?php $k++; ?>
	<?php endwhile; ?>






        		</section>  	
    		</div>
    	</div>
    </div>
 
	<?php endwhile; ?>
	
	
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
