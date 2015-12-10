<?php
session_start();
require('dbconnect.php');
if (empty($_REQUEST['name'])){
  print('名前を記入してください');

}else{
  print('正しく記入されています');
}

var_dump($_POST);
// if(!isset($_SESSION['join'])){
//   header('Location: login.php');
//   exit();
// }
if (!empty($_POST)) {
  //登録処理をする
  $sql = sprintf('INSERT INTO members SET name="%s", email="%s",password="%s",created="%s"',
    mysqli_real_escape_string($db, $_POST['name']),
    mysqli_real_escape_string($db, $_POST['email']),
    mysqli_real_escape_string($db, $_POST['password']),date('Y-m-d H:i:s'));
    // mysqli_real_escape_string($db, $_POST['join']['image']), date('Y-m-d H:i:s'));
  //$imageを代入すること 
    // echo $sql;
    mysqli_query($db, $sql) or die(mysqli_error($db));
    unset($_SESSION['join']);
    // $_SESSION['join']=$_POST;
    header('Location: login.php');
    // exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.png">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/soon.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->
    
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

  </head>
  <!-- START BODY -->

  <body class="nomobile">


    <!-- START HEADER -->
    <section id="header">
        <div class="container">
            <header>
                <!-- HEADLINE -->
                <h1 data-animated="GoIn"><b>Pigeotter</b> へようこそ</h1>
            </header>

              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-area">  
                      <form role="form" method="post">
                        <br style="clear:both">
                        <span style=" margin-bottom: 25px;  font-size:30px; color:#00a1e9; text-align: center ;">Login</span>
                          <!-- <h3 style="margin-bottom: 25px; text-align: center;">Login</h3> -->
                            <div class="form-group">
                              <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                          <button type="submit" id="login" name="login" class="btn btn-primary pull-right">Login</button>
                      </form>
                    </div>
                  </div>
              
                  <div class="col-md-6">
                      <div class="form-area">  
                        <form role="form" method="post">
                          <br style="clear:both">
                          <span style=" margin-bottom: 25px;  font-size:30px; color:#00a1e9; text-align: center ;">New Members</span>
                            <!-- <h3 style="margin-bottom: 25px; text-align: center ;">New Members</h3> -->
                                <div class="form-group">
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" id="email" name="email" placeholder="Email adress" required>                   
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" id="password" name="password" placeholder="Pass Word" required>
                                </div>
                                <button type="submit" id="member" name="member" class="btn btn-primary pull-right">Member</button>
                        </form>
                      </div>
                  </div>
                </div>
              </div>



            <!-- START TIMER -->
            <!-- <div id="timer" data-animated="FadeIn">
                <p id="message"></p>
                
                <div id="hours" class="timer_box"></div>
                <div id="minutes" class="timer_box"></div>
                <div id="seconds" class="timer_box"></div>
            </div> -->
            <!-- END TIMER -->
            <div class="col-lg-4 col-lg-offset-4 mt centered">
            
				<!-- <form class="form-inline" role="form">
				  <div class="form-group">
				    <label class="sr-only" for="exampleInputEmail2">Email address</label>
				    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
				  </div> -->
				<!--   <button type="submit" class="btn btn-info">Submit</button> -->
				<!-- </form> -->            
			</div>
            
        </div>
        <!-- LAYER OVER THE SLIDER TO MAKE THE WHITE TEXTE READABLE -->
        <div id="layer"></div>
        <!-- END LAYER -->
        <!-- START SLIDER -->
        <div id="slider" class="rev_slider">
            <ul>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="assets/img/slider/14.jpg">
                <img src="assets/img/slider/14.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="assets/img/slider/13.jpg">
                <img src="assets/img/slider/13.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="assets/img/slider/12.jpg">
                <img src="assets/img/slider/12.jpg">
              </li>
              <li data-transition="slideleft" data-slotamount="1" data-thumb="assets/img/slider/5.jpg">
                <img src="assets/img/slider/5.jpg">
              </li>
            </ul>
        </div>
        <!-- END SLIDER -->
    </section>
    <!-- END HEADER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/soon/plugins.js"></script>
    <script src="assets/js/soon/jquery.themepunch.revolution.min.js"></script>
    <script src="assets/js/soon/custom.js"></script>
  </body>
  <!-- END BODY -->
</html>