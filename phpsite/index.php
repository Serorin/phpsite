<?php
//接続情報
$dns ="mysql:host=127.0.0.1;dbname=webapp;charset=utf8";
//ユーザー名、パスワード
$pdo = new PDO($dns,"root","19970110");
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//URLからページの値をとってくる
if(isset($_GET["page"]))
{
  $page = $_GET["page"];

}else{
  $page = 1;//デフォルト値
}
if($page < 1){//ページが１以下の時<<でページ移動しない
  $page = 1;
}
else{}

if($page > 5){//ページが５以上の時>>でページ移動しない
    $page = 5;
  }
  else{}

$offset = ($page -1)*10;

//limit文で結果を絞る
$sql = "select*from task limit 10 offset $offset";
//検索キーワードがあるとき
if(isset($_GET["word"])){
  $sql .="where name like '%{$_GET["word"]}%'";
}

$stmh = $pdo->prepare($sql);
$stmh->execute();
$count = 6;
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

<h2>TO DO LIST</h2>

    <form action="./sen.php" method="POST">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" name="label" type="text" id="sample3"placeholder="英語でどうぞ">
        <label class="mdl-textfield__label" for="sample3"></label>
      </div>
    </form>

  <table class="table table-bordered mdl-shadow--2dp">
  <tehad>
    <tr>
      <th class="mdl-data-table__cell--non-numeri">  </th>
      <th>内容</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
  </thead>
  <tbody>

<?php
//データそのものを取得
//var_dump($stmh->fetch(PDO::FETCH_ASSOC));
for($i = 0;$i< $stmh->rowCount(); $i++){
  $hoge = $stmh->fetch(PDO::FETCH_ASSOC);


echo "<tr>";
echo '<td class="aaa"><label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" ><input type="checkbox" id="list-checkbox-1" class="mdl-checkbox__input" /></label></td>';
  echo '<td class="mdl-data-table__cell--non-numeric">'.$hoge["name"].'</td>';
  echo "<td>&nbsp;<a class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised' href='./edit.php?id={$hoge["id"]}'>edit</a></td>";
  echo "<td>&nbsp;<a class='btn btn-default btn-xs mdl-button mdl-js-button mdl-button--raised' href='./del.php?id={$hoge["id"]}'>del</a></td>";
echo "</tr>";
}
?>
</tbody>
</table>
<nav>
<ul class="pagination">
  <li>

    <li><a 　href="?page=<?php  echo $page-1;?>" aria-label="Previous">
      <span aria-label="true">&laquo;</span>
    </a>
    </li>

<?php for($i = 1;$i<$count;$i++){
     if($page == $i){ ?>
      <li class="active"><a href="?page=<?php echo $i?>"><?php echo $i?></a></li>
    <?php }else{?>
      <li><a href="?page=<?php echo $i?>"><?php echo $i?></a></li>
    <?php }}?>

  <li>
    <a href="?page=<?php echo $page+1;?>" aria-label="Next">
      <span aria-label="true">&raquo;</span>
</a>
</li>
</ul>


</nav>
