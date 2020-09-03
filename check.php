<?php
//=========文字エンコードの検証==============================
require_once("util.php");

if(!cken($_POST)){
  $encoding = mb_check_encoding();
  $err = "Encoding Error! The expected encoding is". $encoding;
  //エラーメッセージを表示して処理を終了させる
  exit($err);
}
//HTMLエスケープ(XSS対策)
$_POST = es($_POST);
 ?>

 <?php
 //入力された値の設定
 //$num = $_POST['num'];
 $name = $_POST['name'];
 $money1 = $_POST['money1'];
 $money1w = $_POST['money1w'];
 $money2 = $_POST['money2'];
 if(isset($_POST['in'])){  //$inはカレンダーであるためPOSTされているか確かめる
   $in = $_POST['in'];
 }
 else{  //エラー
   $in="";
 }
 if(isset($_POST['out'])){  //$outはカレンダーであるためPOSTされているか確かめる
   $out = $_POST['out'];
 }
 else{  //エラー
   $out="";
 }
 $roomType = $_POST['roomType'];
 $age = $_POST['age'];
 $people = $_POST['people'];
 ?>

 <?php
 $arr =[$name,$in,$out,$roomType,$age,$people];
 foreach ($arr as $item) {
    if (preg_match('/^\s*$/u', $item)){
      $error = 1;
      break;
    }
    else{
      $error="";
    }
  }
  if($roomType=="unselected"){
    $error = 1;
  }
 ?>

<DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>購入画面</title>
    <link rel="stylesheet" type="text/css" href="check.css">
  </head>
<?php if(($error)!=1){?>
  <body>
    <h2>お申込み内容</h2>
    <div class="box">
      <div class="subtitle">お申込み内容</div>
      <ul class = "form">
        <li><label>ホテル名</label></li>
          　<span class="input"><?php echo $name?></span><br>
        <li><label>チェックイン日</label></li>
          　<span class="input"><?php echo $in?></span><br>
        <li><label>チェックアウト日</label></li>
          　<span class="input"><?php echo $out?></span><br>
        <li><label>ベッドタイプ</label></li>
            <span class="input">
              <?php
              if($roomType =="single"){
                echo "シングル";
                $payment = $money1;
              }
              elseif($roomType =="double"){
                echo "ダブル";
                $payment = $money1w;
              }
              else {
                echo "ツイン";
                $payment = $money2;
              }
              ?>
            </span><br>
        <li><label>年齢</label></li>
            <span class="input"><?php echo $age?></span><br>
        <li><label>人数</label></li>
          　<span class="input"><?php echo $people?></span><br>
        <li><label>合計金額</label></li>
            <span class="input">
              <?php
                $total = $payment * $people;
                echo $total;
               ?>
             </span><br>
      </ul>
    </div>


  <!--内容を修正するボタンのフォーム-->
  <div class="orderBotton">
  <form method="POST" action="ch-hokkaido0.php">
    <!--隠しフィールドに個数を設定してPOSTする-->
    　<input type="hidden" name ="name" value="<?php echo $name;?>">
      <input type="hidden" name ="in" value="<?php echo $in;?>">
      <input type="hidden" name ="out" value="<?php echo $out;?>">
      <input type="hidden" name ="roomType" value="<?php echo $roomType;?>">
      <input type="hidden" name ="age" value="<?php echo $age;?>">
      <input type="hidden" name ="people" value="<?php echo $people;?>">
      <input class="button"type="submit" value="内容を修正する" style="background-color:#a9a9a9;">
  </form>


    <form method="POST" action="do.php">
      <!--隠しフィールドに個数を設定してPOSTする-->
      　<input type="hidden" name ="name" value="<?php echo $name;?>">
        <input type="hidden" name ="in" value="<?php echo $in;?>">
        <input type="hidden" name ="out" value="<?php echo $out;?>">
        <input type="hidden" name ="roomType" value="<?php echo $roomType;?>">
        <input type="hidden" name ="age" value="<?php echo $age;?>">
        <input type="hidden" name ="people" value="<?php echo $people;?>">
        <input type="hidden" name ="total" value="<?php echo $total;?>">
      <input class="button" type="submit" value="送信する" style="background-color:#a9a9a9;">
    </form>
  </div>
  </body>
<?php } else{?>
  <body>
    <div class="center">
      <div class="error-msg">
        必須項目を入力してください。
      </div>
      <form method="POST" action="ch-hokkaido0.php">
        <!--隠しフィールドに個数を設定してPOSTする-->
        　<input type="hidden" name ="name" value="<?php echo $name;?>">
          <input type="hidden" name ="in" value="<?php echo $in;?>">
          <input type="hidden" name ="out" value="<?php echo $out;?>">
          <input type="hidden" name ="roomType" value="<?php echo $roomType;?>">
          <input type="hidden" name ="age" value="<?php echo $age;?>">
          <input type="hidden" name ="people" value="<?php echo $people;?>">
        <input type="submit" value="戻る" style="background-color:#CCCCCC;">
      </form>
  </div>
  </body>
<?php }?>

  </html>
