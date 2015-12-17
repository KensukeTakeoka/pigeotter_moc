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

	//---------------返信メッセージを取得---------------
	$i=1; 
	$reply_posts=array();
	while(100>$i){
		
		$sql = sprintf('SELECT * FROM posts WHERE id=%d || reply_id=%d',
			mysqli_real_escape_string($db, htmlspecialchars($i)),
			mysqli_real_escape_string($db, htmlspecialchars($i))
			);

		// echo $sql;

		$reply = mysqli_query($db, $sql) or die(mysqli_error($db));

			while($row = mysqli_fetch_assoc($reply)){
				// $row = mysqli_fetch_assoc($reply);
				$reply_pposts[]=$row;
			}

		// echo $reply;
		// var_dump($reply);
		$i++;
		}

		// echo $reply_pposts['message'];
		// var_dump($reply_pposts);





		// $randum_reply = mysqli_fetch_assoc($reply);
		// var_dump($_SESSION);
		// $table = mysqli_fetch_assoc($reply);
		// $randum_reply = $table;
		// echo $randum_reply;
	
	// $randum_reply = $randum_reply['id'];
	// echo $randum_reply;



	//---------------返信メッセージを取得end---------------	



	//-----------投稿を取得-----------
	// $sql = sprintf('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id ORDER BY p.created DESC');
	// $posts = mysqli_query($db, $sql) or die (mysqli_error($db));
	// var_dump($posts);

	// $randum_id=rand(1,45);
	$sql = sprintf('SELECT * FROM posts WHERE 1');
	// $record = mysqli_query($db, $sql) or die(mysqli_error($db));
	$posts = mysqli_query($db, $sql) or die(mysqli_error($db));
	$post = mysqli_fetch_assoc($posts);
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

	
	//-----------返信メッセージをインサート----------

	//投稿を記録する
	if ($count % 3 == 0 ) {

			$randum_reply_id=rand(1,50);
		
			$member['id']=1;
			$_POST['reply_id']=$randum_reply_id;
			// $_SESSION['message']=$messager;

			$sql = sprintf('INSERT INTO posts SET member_id=%d, message="%s", reply_id=%d, created=NOW()',
				
				mysqli_real_escape_string($db, $member['id']),
				mysqli_real_escape_string($db, htmlspecialchars($randum_message)),
				mysqli_real_escape_string($db, htmlspecialchars($_POST['reply_id']))
				);

			// echo $sql;
			mysqli_query($db, $sql) or die(mysqli_error($db));
			header('Location: plofile.php');
			exit();
	}



	//-----------返信メッセージをインサートend----------


	//-----------ログインしている人のユーザー情報を取得-----------

	// $_SESSION['id'] = 1;
	// if (isset($_SESSION['id'])){

	// 	//ログインしている人のユーザー情報を取得
	// 	$sql = sprintf('SELECT * FROM members WHERE id=%d',
	// 			mysqli_real_escape_string($db, $_SESSION['id'])
	// 			);

	// 	$record = mysqli_query($db, $sql) or die(mysqli_error($db));

	// 	$member = mysqli_fetch_assoc($record);

	// }else{
	// 	//ログインしていない
	// 	header('Location: login.php');
	// 	exit();
	// }

	//-----------ログインしている人のユーザー情報を取得 end-----------



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
			    	
			    	<span>あなたは<?php  print $count; ?>羽目のハトです。</span></br>
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

	<div  class ="row">
		<div  class="col-lg-12" >
   			<div class="card hovercard">
        		<div class="card-background" style="width:100%" >
        			
        		</div>
   
        		<div class="useravatar">
            		<a href="profile_edit.html"><img src="assets/img/<?php echo htmlspecialchars($members['plof_picture'], ENT_QUOTES, 'UTF-8'); ?>" /></a>
        		</div>

        		<div class="card-info">
        			<span class="plofile-name"><?php echo $member['name']; ?></span></br>
        			<span class="plofile-message"><?php echo $member['plof_message']; ?></span>
        		</div>

    		</div>
    	</div>
	</div>


	<?php while($post = mysqli_fetch_assoc($posts)): ?>
	<?php //var_dump($post); ?>
	<?php if($post['member_id'] == 1 && $post['reply_id'] == 0){ ?>
	<div class="container">
 	 	<div class="row">
 	 		<div class="col-md-2"></div>
    		<div class="col-md-8">
	       		<section class="comment-list">
	       			
		    		<article class="row">
		            	<div class="col-md-2 col-sm-2 hidden-xs">
				            <figure class="thumbnail">
					            <img class="img-responsive" src="member_picture/<?php echo htmlspecialchars($post['picture']); ?>" width="100" height="100" />
					            <figcaption class="text-center"><?php echo htmlspecialchars($members['name']); ?></figcaption>
				            </figure>
	           			</div>

			            <div class="col-md-10 col-sm-10">
			            	<div class="panel panel-default arrow left">
			                	<div class="panel-body">
					                <header class="text-left">
					                	<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
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
												<dd><textarea name="reply_message" class="form-control" rows style="display:inline-block;float:left;width:290px;margin-right:5px"></textarea>
												    <button class="btn " type="submit" style="display:inline-block;">Go!</button>
												    <input type="hidden" name="reply_id" value="<?php echo $post['id']; ?>" />  
												</dd>
											</dl>
										</div>
									</form>
	            					<input type="hidden" name="reply_id" value="<?php echo $post['id']; ?>" />
	                   				<span class="glyphicon glyphicon-thumbs-up" ></span>
	                			</div>
	              			</div>
	            		</div>
	            	</article>

        		</section>  	
    		</div>
    	</div>
    </div>	
 <?php } ?>
 	
	<?php //while($postR = mysqli_fetch_assoc($reply_pposts)): ?>
<!-- 	<?php if(!isset($postR['reply_id'])){ ?>
	            	<article class="row">
			            <div class="col-md-9 col-sm-9 col-md-offset-1 col-md-pull-1 col-sm-offset-0">
			            	<div class="panel panel-default arrow right">
			                	<div class="panel-heading">Reply</div>
			                	<div class="panel-body">
					                <header class="text-right">
					                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
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
					            <img class="img-responsive" src="member_picture/<?php echo htmlspecialchars($post['picture']); ?>" width="100" height="100" />
					            <figcaption class="text-center"><?php echo htmlspecialchars($reply_post['name']); ?></figcaption>
				            </figure>
			            </div>
					</article>
					
        		</section>  	
    		</div>
    	</div>
    </div>
   
    	<?php } ?> -->
	<?php endwhile; ?>

	<?php //endwhile; ?>
	
	
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
