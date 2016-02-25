<?php
extract($_GET);
/* 값이 없을시 참조할 초기값 설정 */
$defaultLevel=isset($latitude)?11:4;
$latitude=isset($latitude)?$latitude:39.123;
$longitude=isset($longitude)?$longitude:128.123;
$store_name=isset($store_name)?$store_name:"여긴 어디? 동해?!!!!<br>이용방법을 참고하세요";
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body style="margin:0;padding:0">
<input type="hidden" name="store_name"  id="store_name" value="<?php echo $store_name;?>">
<input type="hidden" name="defaultLevel"  id="defaultLevel" value="<?php echo $defaultLevel;?>">
<script src="/prq/include/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v2/maps.js?clientId=aWWbsFdRSNQZL6Df5ATr"></script>
<div id="map" style="border:1px solid #000;"></div>
<script type="text/javascript">
/*구글 지도 */
var geocoder = new google.maps.Geocoder();
var markersArray = []; 

//지도 셋팅
function setMarkerByGeocoding1(address) 
{
if (geocoder) {
var lat;
var lng;
geocoder.geocode( { 'address': address}, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
lat = parseFloat(results[0].geometry.location.lat());
lng = parseFloat(results[0].geometry.location.lng());
document.getElementById("latitude").value=lat;
document.getElementById("longitude").value=lng;
} else {
alert(address + " 주소를 찾을 수 없습니다.");
}
});
}
}

/* 네이버 지도 */
var map_width=$(window).width();
console.log(map_width);
var map_heigth=parseInt(map_width*3/5);
console.log(map_heigth);
var latitude=<?php echo $latitude;?>;
var longitude=<?php echo $longitude;?>;
var tr_latitude=latitude+.05;
var tr_longitude=longitude+.05;
console.log(latitude+", ->"+tr_latitude);
console.log(longitude+", ->"+tr_longitude);
var oSeoulCityPoint = new nhn.api.map.LatLng(latitude,longitude);
var oSeoulCityPoint2 = new nhn.api.map.LatLng(tr_latitude,tr_longitude);

var defaultLevel = $("#defaultLevel").val();
var oMap = new nhn.api.map.Map(document.getElementById('map'), { 
								point : oSeoulCityPoint,
								zoom : defaultLevel,
								enableWheelZoom : true,
								enableDragPan : true,
								enableDblClickZoom : false,
								mapMode : 0,
								activateTrafficMap : false,
								activateBicycleMap : false,
								minMaxLevel : [ 1, 14 ],
								size : new nhn.api.map.Size(map_width, map_heigth)           });
var oSlider = new nhn.api.map.ZoomControl();
//oMap.addControl(oSlider);
oSlider.setPosition({
		top : 10,
		left : 10
});

  var mPoint = oSeoulCityPoint;
  var oSize = new nhn.api.map.Size(28, 37);
  var oOffset = new nhn.api.map.Size(28, 37);

  var oIcon = new nhn.api.map.Icon("http://static.naver.com/maps2/icons/pin_spot2.png", oSize);
 
  var oMarker = new nhn.api.map.Marker(oIcon, {
  point : mPoint,
  zIndex : 1,
  title :$("#store_name").val()
  });
  oMap.addOverlay(oMarker);
/*
var oSeoulCityPoint2 = new nhn.api.map.LatLng(tr_latitude,tr_longitude);
  var mPoint = oSeoulCityPoint2;
  var oSize = new nhn.api.map.Size(28, 37);
  var oOffset = new nhn.api.map.Size(28, 37);

  var oIcon = new nhn.api.map.Icon("http://static.naver.com/maps2/icons/pin_spot2.png", oSize);
 
  var oMarker = new nhn.api.map.Marker(oIcon, {
  point : mPoint,
  zIndex : 1,
  title :$("#store_name").val()+"2"
  });
  oMap.addOverlay(oMarker);
*/

var oMapTypeBtn = new nhn.api.map.MapTypeBtn();
oMap.addControl(oMapTypeBtn);
oMapTypeBtn.setPosition({
		bottom : 10,
		right : 80
});

var oThemeMapBtn = new nhn.api.map.ThemeMapBtn();
oThemeMapBtn.setPosition({
		bottom : 10,
		right : 10
});
//oMap.addControl(oThemeMapBtn);

var oBicycleGuide = new nhn.api.map.BicycleGuide(); // - 자전거 범례 선언
oBicycleGuide.setPosition({
		top : 10,
		right : 10
}); // - 자전거 범례 위치 지정
//oMap.addControl(oBicycleGuide);// - 자전거 범례를 지도에 추가.

var oTrafficGuide = new nhn.api.map.TrafficGuide(); // - 교통 범례 선언
oTrafficGuide.setPosition({
		bottom : 30,
		left : 10
});  // - 교통 범례 위치 지정.
//oMap.addControl(oTrafficGuide); // - 교통 범례를 지도에 추가.

var trafficButton = new nhn.api.map.TrafficMapBtn(); // - 실시간 교통 지도 버튼 선언
trafficButton.setPosition({
		bottom:10, 
		right:150
}); // - 실시간 교통 지도 버튼 위치 지정
//oMap.addControl(trafficButton);

var oSize = new nhn.api.map.Size(28, 37);
var oOffset = new nhn.api.map.Size(14, 37);
var oIcon = new nhn.api.map.Icon('http://static.naver.com/maps2/icons/pin_spot2.png', oSize, oOffset);

var oInfoWnd = new nhn.api.map.InfoWindow();
oInfoWnd.setVisible(false);
oMap.addOverlay(oInfoWnd);

oInfoWnd.setPosition({
		top : 20,
		left :20
});

var oLabel = new nhn.api.map.MarkerLabel(); // - 마커 라벨 선언.
oMap.addOverlay(oLabel); // - 마커 라벨 지도에 추가. 기본은 라벨이 보이지 않는 상태로 추가됨.

oInfoWnd.attach('changeVisible', function(oCustomEvent) {
		if (oCustomEvent.visible) {
				oLabel.setVisible(false);
		}
});

var oPolyline = new nhn.api.map.Polyline([], {
		strokeColor : '#f00', // - 선의 색깔
		strokeWidth : 5, // - 선의 두께
		strokeOpacity : 0.5 // - 선의 투명도
}); // - polyline 선언, 첫번째 인자는 선이 그려질 점의 위치. 현재는 없음.
oMap.addOverlay(oPolyline); // - 지도에 선을 추가함.

oMap.attach('mouseenter', function(oCustomEvent) {

		var oTarget = oCustomEvent.target;
		// 마커위에 마우스 올라간거면
		if (oTarget instanceof nhn.api.map.Marker) {
				var oMarker = oTarget;
				oLabel.setVisible(true, oMarker); // - 특정 마커를 지정하여 해당 마커의 title을 보여준다.
		}
});

oMap.attach('mouseleave', function(oCustomEvent) {

		var oTarget = oCustomEvent.target;
		// 마커위에서 마우스 나간거면
		if (oTarget instanceof nhn.api.map.Marker) {
				oLabel.setVisible(false);
		}
});
/*
* 클릭시 마커 하기
oMap.attach('click', function(oCustomEvent) {
		var oPoint = oCustomEvent.point;
		var oTarget = oCustomEvent.target;
		oInfoWnd.setVisible(false);
		// 마커 클릭하면
		if (oTarget instanceof nhn.api.map.Marker) {
				// 겹침 마커 클릭한거면
				if (oCustomEvent.clickCoveredMarker) {
						return;
				}
				// - InfoWindow에 들어갈 내용은 setContent로 자유롭게 넣을 수 있습니다. 외부 css를 이용할 수 있으며, 
				// - 외부 css에 선언된 class를 이용하면 해당 class의 스타일을 바로 적용할 수 있습니다.
				// - 단, DIV의 position style은 absolute가 되면 안되며, 
				// - absolute의 경우 autoPosition이 동작하지 않습니다. 
				oInfoWnd.setContent('<DIV style="border-top:1px solid; border-bottom:2px groove black; border-left:1px solid; border-right:2px groove black;margin-bottom:1px;color:black;background-color:white; width:auto; height:auto;">'+
						'<span style="color: #000000 !important;display: inline-block;font-size: 12px !important;font-weight: bold !important;letter-spacing: -1px !important;white-space: nowrap !important; padding: 2px 5px 2px 2px !important">' + 
						'Hello World <br /> ' + oTarget.getPoint()
						+'<span></div>');
				oInfoWnd.setPoint(oTarget.getPoint());
				oInfoWnd.setPosition({right : 15, top : 30});
				oInfoWnd.setVisible(true);
				oInfoWnd.autoPosition();
				return;
		}
		var oMarker = new nhn.api.map.Marker(oIcon, { title : '마커 : ' + oPoint.toString() });
		oMarker.setPoint(oPoint);
		oMap.addOverlay(oMarker);

		var aPoints = oPolyline.getPoints(); // - 현재 폴리라인을 이루는 점을 가져와서 배열에 저장.
		aPoints.push(oPoint); // - 추가하고자 하는 점을 추가하여 배열로 저장함.
		oPolyline.setPoints(aPoints); // - 해당 폴리라인에 배열에 저장된 점을 추가함
});
*/

</script>
</body>
</html>
