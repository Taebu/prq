<?php
//echo http_head("http://naver.com/");
function generate_state() 
{
	$mt = microtime();
	$rand = mt_rand();

	return md5($mt . $rand);
}

echo generate_state();
?>
