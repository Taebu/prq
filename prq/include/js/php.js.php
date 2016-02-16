<?php
    header('Content-Type: text/javascript; charset=UTF-8');
	extract($_GET);
	$param=$_GET['param'];
?>
var phpvalue="is php value";
var param="<?echo $param;?>";
console.log(phpvalue);
console.log(param);	