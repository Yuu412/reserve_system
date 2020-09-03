<?php

//XSS対策のためのHTMLエスケープ
function es($data){
  //$dataが配列のとき
  if(is_array($data)){
    //再帰呼出し
    return array_map(__METHOD__, $data);
  }
  else{
    //HTMLエスケープを行う
    return htmlspecialchars($data, ENT_QUOTES, 'utf-8');
  }
}

function cken(array $data){
  $result = true;
  foreach($data as $key => $value){
    if(is_array($value)){
    //含まれている値が配列のとき文字列に連結する
    $value = implode("", $value);
}
  if(!mb_check_encoding($value)){
    //文字エンコードが一致しないとき
    $result = faulse;
    //foreachでの査定を終わらせる
    break;
  }
}
return $result;
}
 ?>
