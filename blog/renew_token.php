<?php
$client_id="qfvtBcPswnXE4O0veCZU";
$client_secret="PK6SrAhm8o";
$refresh_token="giippIgHGQ7pZuisXnY7zbn5GffmhiiL5ip1YWMQmEiilYYiiSCuZip1QO6jxEiswVD6ip7CXpgDXMGWm1xHzx47ipOUkkbk768AkVlKHLL9fyXUKiiQVkie";
$param="grant_type=refresh_token&client_id=".$client_id."&client_secret=".$client_secret."&refresh_token=".$refresh_token;

function get_curl($param)
{
	// Get cURL resource
	$curl = curl_init();
	$url = "https://nid.naver.com/oauth2.0/token?".$param;
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_URL => $url,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	
	// Close request to clear up some resources
	curl_close($curl);

	return json_decode($resp, true);
}

$renew_token=get_curl($param);

echo $renew_token['access_token'];
?>