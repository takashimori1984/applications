<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Poll.php');

try {
  $poll = new \MyApp\Poll();
} catch (Exception $e) {
  echo $e->getMessage();
  exit;
}


$results = $poll->getResults();
// ユーザーの入力を受け取る
$id = 1;

// DBから$id1のデータを取得する
$res = 1;

// countカラムのあたいを取得する
// countカラムのあたいを1増やす
$res['count'] = $res['count']++;

// id1のデータを更新する(countの数を1増やす)

// どこかのぺーじに移動する



// var_dump($results);
// exit;

// $results = [
//   0 => 12,
//   1 => 32,
//   2 => 44
// ];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Poll Result</title>
  <link rel="stylesheet" type="text/css" href="css/result.css">
</head>
<body>
  <h1 class="thtitle">Thank you for answer</h1>
  <p class="coupon"><img src="img/coupon.jpg" alt="coupon" class="couponimg"></p>
    <a href="index.php"><div id="btn">Go Back</div></a>
</body>
</html>