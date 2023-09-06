<?php
//Sk
function limit_words($string, $word_limit) {
$words = explode(" ", $string);
return implode(" ", array_splice($words, 0, $word_limit));
}
function ob_html_compress($buf) {
// return str_replace(array("\n","\r","\t"),'',$buf);
return preg_replace(array('/<!--(.*)-->/Uis', "/[[:blank:]]+/"), array('', ' '), str_replace(array("\n", "\r", "\t"), '', $buf));
}