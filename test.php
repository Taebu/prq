<?php
//echo "test";
echo filesize('/var/www/html/prq/uploads/201611/1480293374GECAC.jpg');

//phpinfo();
$im = imagecreatefrompng("test.png");

header('Content-Type: image/png');

imagepng($im);
imagedestroy($im);
?>