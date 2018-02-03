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
 <body style="margin:0;padding:0;">
<input type="hidden" name="store_name"  id="store_name" value="<?php echo $store_name;?>">
<input type="hidden" name="defaultLevel"  id="defaultLevel" value="<?php echo $defaultLevel;?>">
<script src="/prq/include/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!-- <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=aWWbsFdRSNQZL6Df5ATr"></script> -->
<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=aWWbsFdRSNQZL6Df5ATr&submodules=geocoder"></script>
<div id="map2" style="width:100%;height:400px;border:0px solid #000;"></div>
<div id="map" style="width:100%;height:400px;border:0px solid #000;"></div>

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
var map_heigth=parseInt(map_width*4/5);
console.log(map_heigth);
var latitude=<?php echo $latitude;?>;
var longitude=<?php echo $longitude;?>;
console.log(latitude);
console.log(longitude);
var mapOptions = {
    center: new naver.maps.LatLng(latitude, longitude),
    zoom: 10
};
var map = new naver.maps.Map('map2', mapOptions);
</script>
</body>
</html>
