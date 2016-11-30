<?php
$mb_imgprefix="201611";
$name="RV_VPBXT.jpg";
$file=getcwd().'/prq/uploads/'.$mb_imgprefix."/".$name;
echo $file;
echo filesize($file);
/*69259*/
$files=getimagesize($file);
print_r($files);
/*
Array
(
    [0] => 763
    [1] => 509
    [2] => 2
)
*/
?>