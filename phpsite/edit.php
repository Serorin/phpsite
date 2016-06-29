<?php
//接続情報
$dns ="mysql:host=127.0.0.1;dbname=webapp;charset=utf8";
//ユーザー名、パスワード
$pdo = new PDO($dns,"root","19970110");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//URLからページの値をとってくる
if(isset($_GET["id"]))
{
  $id = $_GET["id"];
}else{
  echo "URLが異常です";
  exit;
}
//URLからデータを取得する
$sql = "select * from task where id=$id";

$stmh = $pdo->prepare($sql);
$stmh->execute();

$data = $stmh->fetch(PDO::FETCH_ASSOC);
if(!$data){
  echo "URLが異常です";
  exit;
}
?>

<html>
  <head>
    <!--Jquery-->
    <script   src="https://code.jquery.com/jquery-2.2.4.js"   integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="   crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

    <!--マテリアルデザイン-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>

<link rel="stylesheet" href="index.css" charset="utf-8">

  </head>
  <body>

    <form action="edit_complete.php"method="POST">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input type="hidden" class="bbb" name="id" value="<?=$data["id"]?>">
    <input type="text" class="mdl-textfield__input"name="name" value="<?=$data["name"]?>">
    <label class="mdl-textfield__label" for="sample1">英語でどうぞ</label>
  </div>
  </form>


<?php echo "<form action='index.php'><input type='submit'class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised' value='戻る'></form>"; ?>
  </body>
</html>
