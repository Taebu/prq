<?php
//browser_check.php
function b_check() {
	if ( preg_match('/(iPhone|Android|iPod|iPad|BlackBerry|IEMobile|HTC|Server_KO_SKT|SonyEricssonX1|SKT)/',$_SERVER['HTTP_USER_AGENT']) )
	{
		define('BROWSER_TYPE', 'M');
	}
	else
	{
		define('BROWSER_TYPE', 'W');
	}
}
?>
