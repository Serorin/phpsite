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

//エラー処理:何か書く

if(empty($_POST["label"]))
{
  echo '<p class="aaa">データが入力されていません</p>';
  echo "<form action='index.php'class='aaa'><input type='submit'<a class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised'  value='戻る'></form>";
}
else if (!preg_match("/^[a-zA-Z0-9\ \!?]+$/", $_POST["label"])) {
  echo "<p class='aaa'>英語で入力してください</p>";
  echo "<form action='index.php'class='aaa'><input type='submit'<a class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised'  value='戻る'></form>";
}

else{
  $sql = "
  insert into task
  (id,name,created_at,updated_at)
  VALUES(NULL,'".$_POST["label"]."',NOW(),NOW());";
  $stmh = $pdo->prepare($sql);
  $stmh->execute();
echo '<p class="aaa">送信しました！</p>';
echo "<form action='index.php'class='aaa'><input type='submit' <a class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised' value='戻る'></form>";
}
?>
