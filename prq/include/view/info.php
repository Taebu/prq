<?php
extract($_POST);


?>
<div class="contents" id="cInfo" ng-controller="infoCtrl">
	<!-- storedetail -->
	<div id="storedetail_area">
    	<div class="store_detail clearfix"> 
		<span class="thumb" style="background:url(/prq/uploads/TH/<?php echo $st_thumb_paper;?>) center center no-repeat; background-size:100% 100%;">매장썸네일</span>
			<dl class="store_info">
				<dt><span class="user_photo_b">전화번호</span></dt>
				<dd><?php 
				if($st_teltype=="cashq"){
					echo $st_vtel==""?" - ":$st_vtel;
				}else{
					echo $st_tel==""?" - ":$st_tel;
				}
				?></dd>
				<dt>주문방법</dt>
				<dd>배달/포장 가능</dd>
		        <dt class="spac">휴 무 일</dt>
		        <dd><?php echo $st_closingdate==""?"연중무휴":$st_closingdate;?></dd>
		        <dt>영업시간</dt>
		                        <dd><?php echo $st_alltime=="on"?"24시간영업점":$st_open." ~ ".$st_closed;?></dd>
                		        <dt>결제방법</dt>
		        <dd>현금/카드 가능</dd>
      		</dl>
	  		<dl class="store_introduce clearfix">
	  			<dt>배달지역</dt>
	  			<dd><?php echo $st_destination;?></dd>
	  			<dt>매장소개</dt>
	  			<dd><?php echo $st_intro;?></dd>
      		</dl>
    	</div>
  	</div>
  	<!-- //storedetail -->

  	<!-- review -->
  	<div id="review_area">
	  	<!-- 후기 header -->
    	<div class="review_top">
	    						<span class="star star_inert"> 평점 비활성아이콘 </span>
								<span class="star star_inert"> 평점 비활성아이콘 </span>
								<span class="star star_inert"> 평점 비활성아이콘 </span>
								<span class="star star_inert"> 평점 비활성아이콘 </span>
								<span class="star star_inert"> 평점 비활성아이콘 </span>
						<p><em class="t_color_red_b">0.00점</em> (0명)</p>
			<span class="btn_area"> <a href="/review/write.php" class="btn gray_btn_b"><span>후기작성</span></a> </span> 
		</div>
		
		<div id="box_reviews">
			    </div>
	    
		    	
	<!-- //review -->
  	</div>
  	
</div>