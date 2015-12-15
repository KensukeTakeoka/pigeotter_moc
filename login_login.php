<?php
session_start();
require('dbconnect.php');
// if (empty($_REQUEST['name'])){
//   print('名前を記入してください');

// }else{
//   print('正しく記入されています');
// }

// var_dump($_POST);
if(!empty($_POST)) {
  //ログイン処理
  if ($_POST['name'] != '' && $_POST['password'] != '') {
    $sql = sprintf('SELECT * FROM members WHERE name="%s" AND password="%s"',
    mysqli_real_escape_string($db, $_POST['name']),
    mysqli_real_escape_string($db, sha1($_POST['password'])));
    $record = mysqli_query($db, $sql) or die (mysqli_error($db));
    if ($table = mysqli_fetch_assoc($record)) {
      //ログイン成功
      $_SESSION['id'] = $table['id'];
      $_SESSION['time'] = time();

      //ログイン情報を記録する
      if ($_POST['save'] == 'on') {
        setcookie('name', $_POST['name'], time()+60*60*24*14);
        setcookie('password', $_POST['password'],time()+60*60*24*14);
      }
      header('Location: index.php');
      exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
  }

}else{
  $_POST['name'] = "";
  $_POST['password'] = "";
}
?>