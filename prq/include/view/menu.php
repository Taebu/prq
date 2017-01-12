<div class="contents" id="cMenu">
		<!-- <img class="menu_img imageCache" src="http://admin.delipartner.kr/store/paper/server/php/files/b0o9/b0o9_31d9ad2857.jpg" style="width: 100%; z-index: -1;" draggable="false" alt="메뉴이미지" /> -->
		<!-- <img class="menu_img imageCache" src="http://admin.delipartner.kr/store/paper/server/php/files/b0o9/b0o9_af916f05a0.jpg" style="width: 100%; z-index: -1;" draggable="false" alt="메뉴이미지" /> 
		-->
<?php 
$me_src=$_POST['st_menu_paper'];
$st_origin=$_POST['st_origin']?$_POST['st_origin']:"";

if(strlen($st_origin)>3){
?>
<p class="btn_menu_zoom">
<a href="/prq/include/view/menu_zoom.php?me_src=<?php echo $me_src;?>" target="blank"><img src="/prq/img/btn_menu_zoom_01.png" width="50px" border="0" alt=""></a>
</p>
<img class="menu_img imageCache" src="http://prq.co.kr/prq/uploads/ME/<?php echo $me_src;?>" style="width: 100%; z-index: -1;" draggable="false" alt="메뉴이미지" /> 
<?php }else{ ?>
<p class="btn_menu_zoom">
<a href="#" target="blank"><img src="/prq/img/btn_menu_zoom_01.png" width="50px" border="0" alt=""></a>
</p>
<img class="menu_img imageCache" src="http://prq.co.kr/prq/include/img/page/origin_none.png" style="width: 100%; z-index: -1;" draggable="false" alt="메뉴이미지" /> 
<?php } ?>
</div>
