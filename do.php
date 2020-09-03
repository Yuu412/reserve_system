
 <?php
   $name = $_POST['name'];
   $in = $_POST['in'];
   $out = $_POST['out'];
   $roomType = $_POST['roomType'];
   $age = $_POST['age'];
   $people = $_POST['people'];
   $total = $_POST['total'];
?>


<?php
//ファイルを開く
 $fp = fopen('test.txt', "a+");
 //$name = mb_convert_encoding($name, "SJIS", "UTF-8");
 fwrite($fp, "$name, $in, $out, $roomType, $age, $people,$total\n");
 //ファイルを閉じる
 fclose($fp);
?>

<DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>購入画面</title>
    <link rel="stylesheet" type="text/css" href="do.css">
  </head>

  <body>
    <h1>お申込みありがとうございます。</h1>

  <!--戻るボタンのフォーム-->
  <form method="POST" action="../index.php">
    <!--隠しフィールドに個数を設定してPOSTする-->
    <input type="hidden" name ="kosu" value="<?php echo $kosu;?>">
    <input class ="orderBotton" type="submit" value="トップに戻る"style="background-color:#EEEEEE;">
    <imput type="submit" value="戻る">
    </form>
  </body>

  </html>
