<?php
function documentRoot(){
  if(!isset($_SERVER["SCRIPT_NAME"]) || !isset($_SERVER["SCRIPT_FILENAME"])){
    return false;
  }
  $name = $_SERVER["SCRIPT_NAME"];
  $filename = $_SERVER["SCRIPT_FILENAME"];

  $dr = substr($filename, 0, strlen($filename) - strlen($name));
  return str_replace("/",DIRECTORY_SEPARATOR,$dr);
}
?>

<DOCTYPE html>
  <!--ホテルの宿泊先一覧-->
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>全国宿泊可能ホテル</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <h1><br>a全国の宿泊可能なホテルをお探しいただけます</h1>
      <div class="top-image">
        <img src="./c-file/img/nippon.png" alt="" title="">
      </div>
      <div class="space">
      <?php
        $num=0;

        $nameList =[             //配列を定義(各地方の名前を入れる)
          ['hokkaido','北海道','北海道'],
          ['tohoku','東北','青森県','岩手県','秋田県','宮城県','山形県','福島県'],
          ['kanto','関東','群馬県','栃木県','埼玉県','東京都','茨城県','千葉県','神奈川県'],
          ['chubu','中部','新潟県','富山県','石川県','福井県','長野県','岐阜県','山梨県','静岡県','愛知県'],
          ['kinki','近畿','滋賀県','三重県','京都府','奈良県','和歌山県','大阪府','兵庫県'],
          ['chushikoku','中国・四国','鳥取県','岡山県','島根県','広島県','山口県','香川県','徳島県','愛媛県','高知県'],
          ['kyushu','九州','福岡県','大分県','佐賀県','長崎県','宮崎県','熊本県','鹿児島県','沖縄県'],
        ];
        while(!empty($nameList[$num])):
          $preNum=2;
          $localName = $nameList[$num][0];
          $localName_J = $nameList[$num][1];
            //配列から$num番目の要素を取り出して$nameに設定する
      ?>

        <div class="block">
            <div class="<?php echo $localName ?>">
              <h3><?php echo "$localName_J","地方"?></h3>
            </div>
          <div class="preName">

            <?php while($preNum < 11):
              if(empty($nameList[$num][$preNum])){
                 echo '<br>';
              }
              else{
                $preName = $nameList[$num][$preNum];
                $urlNum = $preNum -2;
              ?>
              <a href= "./c-file/ch-hokkaido<?php echo "$urlNum";?>.php" ><?php echo "$preName<br>"?></a>
            <?php
            }
              $preNum++;
              endwhile;?>
          </div>
        </div>
      <?php
        $num++;
        endwhile;
      ?>
      </div>
  </body>

  </html>
