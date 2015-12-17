<?php
	
	//var_dump($_REQUEST[res]);
	session_start();
	require('dbconnect.php');
	
	//投稿を記録する
	if (!empty($_POST)) {
		//messageが入っているならば下記の処理を行う(入力されていたら)
		//var_dump($_POST['message']);
		if ($_POST['message'] != '' || $_REQUEST['reply_message']) {
			$member['id']=1;

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



		var_dump($_REQUEST);
	//返信
	if (isset($_REQUEST['reply_message'])) {
		$sql = sprintf('SELECT m.name, p.* FROM members m, posts p WHERE m.id=p.member_id AND p.id=%d ORDER BY p.created DESC',
		mysqli_real_escape_string($db, $_REQUEST['reply_message'])
		);
		$record = mysqli_query($db, $sql) or die(mysqli_error($db));
		$table = mysqli_fetch_assoc($record);
		
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

    <!-- アコーディオン機能 -->
    <script>
	$(function(){
		$("#acMenu dt #reply").on("click", function() {
			//$(this).next().slideToggle();
			$(this).parents("dl").find("dd").slideToggle();
			//$(this).closest("#acMenu dd").slideToggle();
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

	<?php //while($post = mysqli_fetch_assoc($posts)): ?>
	<!-- <div id="green"> -->
	<!-- 	<div class="containerRe"> -->
			<!-- <div style="margin-bottom: 15px;"> -->
				<!-- <div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-3 centered">
						<img src="member_picture/<?php //echo htmlspecialchars($post['picture']); ?>" width="100" height="100" alt="<?php //echo htmlspecialchars($post['name']); ?>" />
					</div>
					<div class="col-lg-5 centered">
					<span type="text" name="nickname" class="form-control1"><p><?php //echo nl2br($post['message']); ?></p></span>
						<form method="post" action="">
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt><span class="glyphicon glyphicon-share-alt" style="margin-left:400px;"></span></dt>
									<dd><textarea name="reply_message" class="form-control" rows="" ></textarea>
										<span class="input-group-btn">
									    	<button class="btn " type="submit" >Go!</button>
									    	<input type="hidden" name="reply_id" value="<?php //echo $post['id']; ?>" />
									    </span>
									</dd>
								</dl>
							</div>
						</form>
							<div class="col-lg-1 centered">
								<span class="glyphicon glyphicon-thumbs-up" style="margin-top:17px;"></span>
							</div>
						</div>
					</div>
					<br />
					<br />
					<div class="col-md-5"></div>
					<div class="col-md-6">
					<div class="col-lg-3 centered"> -->
						<!-- <img src="member_picture/<?php //echo htmlspecialchars($post['picture']); ?>" width="100" height="100" alt="<?php //echo htmlspecialchars($post['name']); ?>" />
					</div>
					<div class="col-lg-6 centered">
						<span type="text" name="nickname" class="form-control1"><p><?php  ?></p></span>
					</div>
					</div>
				</div>
		</div> -->

	<?php// endwhile; ?>				

	<br />
	<br />
	<br />

	<?php while($post = mysqli_fetch_assoc($posts)): ?>	
	<div class="container" style="margin-bottom:50px">
 	 	<div class="row">
 	 	<div class="col-md-2"></div>
    	<div class="col-md-8">
       		<section class="comment-list">
    		<article class="row">
            <div class="col-md-2 col-sm-2 hidden-xs">
              <figure class="thumbnail">
                <!-- <img class="img-responsive" src="member_picture/<?php //echo htmlspecialchars($post['picture']); ?>" width="100" height="100" /> -->
                <img src="assets/img/hato2.jpg">
                <figcaption class="text-center"><?php echo htmlspecialchars($post['name']); ?></figcaption>
              </figure>
            </div>
            <div class="col-md-10 col-sm-10">
              <div class="panel panel-default arrow left">
                <div class="panel-body">
                  <header class="text-left">
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo htmlspecialchars($post['created']); ?></time>
                  </header>
                  <div class="comment-post">
                    <p>
                    <?php echo nl2br($post['message']); ?>
                    </p>
                  </div>
					<form method="post" action="">
							<div class="col-lg-10 centered">
								<dl id="acMenu">
									<dt>
										<span id="reply" class="glyphicon glyphicon-share-alt" style="margin-left:400px;" &nbsp;></span>	
										<span class="glyphicon glyphicon-thumbs-up" ></span>									
									</dt>
									<dd><textarea name="reply_message" class="form-control" rows style="display:inline-block;float:left;width:290px;margin-right:5px"></textarea>
									    <button class="btn " type="submit" style="display:inline-block;">Go!</button>
									    <input type="hidden" name="reply_id" value="<?php echo $post['id']; ?>" />
									</dd>
								</dl>
							</div>
						</form>
					
                  <input type="hidden" name="reply_id" value="<?php echo $post['id']; ?>" />                 
                </div>
              </div>
            </div>
             </article>

            <article class="row">
            <div class="col-md-9 col-sm-9 col-md-offset-1 col-md-pull-1 col-sm-offset-0">
              <div class="panel panel-default arrow right">
                <div class="panel-heading">Reply</div>
                <div class="panel-body">
                  <header class="text-right">
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php echo htmlspecialchars($post['created']); ?></time>
                  </header>
                  <div class="comment-post">
                    <p>
                    <?php //while($post = mysqli_fetch_assoc($posts)){
                   
	                    	if(!empty($_REQUEST['reply_message']) && $post['id']==$post['reply_id']){
	                    		echo $post['message'];
							}
						//}
					//endwhile; 
					?>
                    </p>
                  </div>
                  <span class="glyphicon glyphicon-thumbs-up" ></span>
                 <!--  <button class="btn " type="submit" >Go!</button>
					<input type="hidden" name="reply_id" value="<?php //echo $post['id']; ?>" /> -->
                 <!--  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>GO!</a></p> -->
                </div>
              </div>
            </div>
            <div class="col-md-2 col-sm-2 col-md-pull-1 hidden-xs">
              <figure class="thumbnail">
                <!-- <img class="img-responsive" src="member_picture/<?php //echo htmlspecialchars($post['picture']); ?>" width="100" height="100" /> -->
                <img src="assets/img/hato2.jpg">
                <figcaption class="text-center"><?php echo htmlspecialchars($post['name']); ?></figcaption>
              </figure>
            </div>
        	</section>
          	</article>
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
