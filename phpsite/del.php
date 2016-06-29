<html>
  <head>
    <!--マテリアルデザイン-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

    <link rel="stylesheet" href="index.css" media="screen" title="no title" charset="utf-8">

<?php

//接続情報
$dns ="mysql:host=127.0.0.1;dbname=webapp;charset=utf8";
//ユーザー名、パスワード
$pdo = new PDO($dns,"root","19970110");
//エラーが起きた際に例外を投げるように
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = "
  DELETE FROM `task`
  WHERE id = {$_GET["id"]}
";
$stmh = $pdo->prepare($sql);
$stmh->execute();

echo "<p class='aaa'>削除しました!</p>";
echo "<form action='index.php' class='aaa'><input type='submit'class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised' value='戻る'></form>";
