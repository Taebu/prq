<?php
extract($_POST);
?>
<iframe src="/prq/map.php?latitude=<?php echo $latitude;?>&longitude=<?php echo $longitude;?>&store_name=<?php echo $store_name;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" id="map_iframe"></iframe>
