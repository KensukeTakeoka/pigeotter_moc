<?php
session_start();
require('dbconnect.php');
// if (empty($_REQUEST['name'])){
//   print('名前を記入してください');

// }else{
//   print('正しく記入されています');
// }

var_dump($_POST);if (!empty($_POST)) {
  //登録処理をする
  $sql = sprintf('INSERT INTO members SET name="%s", email="%s",password="%s",created="%s"',
    mysqli_real_escape_string($db, $_POST['name']),
    mysqli_real_escape_string($db, $_POST['email']),
    mysqli_real_escape_string($db, sha1($_POST['password'])),date('Y-m-d H:i:s'));
    // mysqli_real_escape_string($db, $_POST['join']['image']), date('Y-m-d H:i:s'));
  //$imageを代入すること 
    // echo $sql;

    mysqli_query($db, $sql) or die(mysqli_error($db));
    unset($_SESSION['join']);
    // $_SESSION['join']=$_POST;
    header('Location: index.php');
    exit();
}
?>