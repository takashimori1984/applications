<?php

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/Poll.php');


try {
  $poll = new \MyApp\Poll();
} catch (Exception $e) {
  echo $e->getMessage();
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $poll->post();
}

$err = $poll->getError();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Poll</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/animate.css">
  <link rel="stylesheet" type="text/css" href="css/opening.css">
</head>
<body>
  <!-- オープニングアニメーション -->
<!--<div class="bg">
    <p class="text"><span>J</span><span>o</span><span>l</span><span>l</span><span>i</span><span>b</span><span>e</span><span>e</span></p>
　</div> -->
  <?php if (isset($err)) : ?>
  <div class="error"><?= h($err); ?></div>
  <?php endif; ?>
  <div class="titbox">
  <p class="title animated slideInLeft infinite"><img src="img/title2.png" alt="title" class="titimg"></p>
  </div>
  <div class="otbox">
  <h1 class="subtit">あなたの好きなジョリビーのメニューは？</h1>
  <form action="result.php" method="post">
    <div class="row">
      <div class="bbox"><div class="box" id="box_0" data-id="0"></div>
      <p class="btxt">Chickenjoy</p></div>
      <div class="bbox"><div class="box" id="box_0" data-id="0"></div>
      <p class="btxt">Jolly Spaghetti</p></div>
      <div class="bbox"><div class="box" id="box_0" data-id="0"></div>
      <p class="btxt">Burger Steak</p></div>
      <div class="bbox"><div class="box" id="box_0" data-id="0"></div>
      <p class="btxt">YUM BRUGER</p></div>
      <div class="bbox"><div class="box" id="box_0" data-id="0"></div>
      <p class="btxt">French fries</p></div>
      <input type="hidden" id="answer" name="answer" value="">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </div>
    <div id="btn">投票する！</div>
  </form>
  </div>
 <!--  <div class="otbox2">
  <h3 class="title2">About Jollibee</h3>
  <div class="txtbox">
  <p class="txt">
  ほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげほげ
  </p>
  </div>
  </div> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="js/animate.js"></script>
  <script>
  $(function() {
    'use strict';

    $('.box').on('click', function() {
      $('.box').removeClass('selected');
      $(this).addClass('selected');
      $('#answer').val($(this).data('id'));
    });

    $('#btn').on('click', function() {
      if ($('#answer').val() === '') {
        alert('ひとつ選んでね');
      } else {
        $('form').submit();
      }
    });

    $('.error').fadeOut(3000);
  });
  </script>
</body>
</html>