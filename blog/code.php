<?php
function encodeS ($arg1){
    $str = $arg1;
    $array = str_split($str);
    $c = count($array);
    for ($i = 0; $i < $c; $i++) {
        $array[$i] = ord($array[$i]) + 100;
    }
    $encode = implode($array);
    return $encode;
}

function decodeS ($arg2){
    $array = str_split($arg2,3);
    var_dump($array);
    $c2 = count($array);
    for ($i2 = 0;$i2<$c2;$i2++){
        $array[$i2] = chr($array[$i2] - 100);
    }
    var_dump($array);
    $decode = implode($array);
    return $decode;
}
?>