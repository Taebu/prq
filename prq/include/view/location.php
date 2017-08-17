<?php
extract($_POST);
?>
<!-- <iframe src="/prq/map.php?latitude=<?php echo $latitude;?>&longitude=<?php echo $longitude;?>&store_name=<?php echo $store_name;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" id="map_iframe"></iframe> -->
<iframe src="/prq/map.php?latitude=<?php echo $latitude;?>&longitude=<?php echo $longitude;?>&store_name=<?php echo $store_name;?>" width="<?php echo $width;?>" height="<?php echo $height;?>" id="map_iframe" style="border:0px solid red;height:300px;"></iframe>

<div style="clear:both;"></div>

<div style="text-align:center;margin-top:-5px;">
	<ul>
		<li style="font-size:15px;margin-bottom:2px;">오시는 길</li>
		<li id="address_area_map" style="font-size:17px;font-weight:bold;"><?php echo $address_area;?></li>
	</ul>
</div>
