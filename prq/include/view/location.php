<?php
extract($_POST);
?>
<!-- <iframe src="/prq/map.php?latitude=<?php echo $latitude;?>&longitude=<?php echo $longitude;?>&store_name=<?php echo $store_name;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" id="map_iframe"></iframe> -->
<iframe src="/prq/map.php?latitude=<?php echo $latitude;?>&longitude=<?php echo $longitude;?>&store_name=<?php echo $store_name;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" id="map_iframe"></iframe>

<div style="clear:both;height:15px;"></div>

<div style="text-align:center;">
	<p id="address_area_map" style="font-size:17px;"><?php echo $address_area;?></p>
</div>
