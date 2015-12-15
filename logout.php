<?php
session_start();
if (isset($_SESSION["id"])) {
  $errorMessage = "ログアウトしました。";
}
else {
  $errorMessage = "セッションがタイムアウトしました。";
}

//セッション情報を解除
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time()  - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
        );
}
session_destroy();

//Cookie情報も削除
setcookie('email', '', time() -3600);
setcookie('password', '', time() -3600);

// header('Location: login.php');
// exit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pigotter</title>

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

    <body background="assets/img/hato3.jpg">
    <div align="center">

    <span class="hato">LOGOUT!!</span><br />
    <a href="login.php">
    <body link="#fff" alink="#ddd">
    <span class="hato1">

    <div id="d1" onmouseover="this.innerText='悲しみだけが消えません。'"onmouseout="this.innerText='ハトが消えました。'" onclick="this.innerText='悲しみだけが消えました。'">ハトが消えました。</div></span></div></a>







</body>
</html>