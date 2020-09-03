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
    $date = "";
    $age = "";
    $in = "";
    $out ="";
    $type = "";
    $num ="";
?>
<DOCTYPE html>
  <!--予約システム-->
  <html lang="ja">

  <head>
    <meta charset="utf-8">
    <title>北海道ホテル｜宿泊できるホテル一覧</title>
    <link rel="stylesheet" type="text/css" href="ch-hokkaido.css">
  </head>

  <body>
    <div class="width">
      <h1>北海道の宿泊可能ホテル一覧</h1>

      <?php
          $name =["プリンスホテル北海道","グランドホテル札幌","オータルホテル小樽","A","B","C"];
          $pic =["hokkaido1.jpg","hokkaido2.jpg","hokkaido3.jpg","url","url","url"];
          $money1 = [10000,13000,20000,12999,7999,14999,];
          $money1w = [14000,15000,25000,13999,8900,16999];
          $money2 = [18000,23000,40000,16999,12000,1];

          if(isset($_POST['people'])){  //$outはカレンダーであるためPOSTされているか確かめる
            $people = $_POST['people'];
          }
          else{  //エラー
            $people="";
          }
      ?>

      <?php
      $num =0;
      while(!empty($name[$num])):
        $money = "$money1[$num] ～ $money2[$num] 円";
      ?>
      <div class="hotel">
        <div class="pic">
          <img src="/c-file/img/<?php echo $pic[$num];?>" alt="" title="">
        </div>
        <div class="name">
          <?php
            echo $name[$num];
          ?>
        </div>
        <div class="reserve">
          <form method="POST" class="form" action="check.php">
            <input type="hidden" name ="num" value="<?php echo $num;?>">
            <input type="hidden" name ="name" value="<?php echo $name[$num];?>">
            <input type="hidden" name ="money1" value="<?php echo $money1[$num];?>">
            <input type="hidden" name ="money1w" value="<?php echo $money1w[$num];?>">
            <input type="hidden" name ="money2" value="<?php echo $money2[$num];?>">
            チェックイン　　　チェックアウト<br>
            <input type ="date" name="in" class="input1" value=<?php echo $in?>>
            <input type ="date" name="out" class="input1" value=<?php echo $out?>><br>
            客室
            <select name='roomType'>
              <option value='unselected'>選択してください</option>
              <option value='single'>シングル</option>
              <option value='double'>ダブル</option>
              <option value='twin'>ツイン</option>
            </select>
            　年齢
            <input type ="number" name="age" class="input0" value=<?php echo $age?>>
            　人数
            <input type ="number" name="people" class="input0" value=<?php echo $people?>><br>
            <div class="botton"><input type="submit" value="予約する"style="background-color:#DDDDDD;"></div>
          </form>
        </div>
        <div class="money">
          <?php echo $money;?>
        </div>
      </div>
      <?php
      $num++;
      endwhile;
      ?>

  </div>
  </body>

  </html>
