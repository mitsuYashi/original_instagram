<?php

// 関数名：hsc
// 関数の内容：引数で与えられた文字列をサニタイズした文字列を返す
// 引数：$str サニタイズしたい文字列
// 戻り値：htmlspecialcharsファンクションでサニタイズした文字列
function hsc($str){
    return htmlspecialchars($str, ENT_QUOTES);
}