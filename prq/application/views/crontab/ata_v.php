 <?php
/********************************************************
* 1분마다 콜로그를 조회하여 gcm과 mms 를 전송하는 페이지 크론탭에 등록 되어 있습니다.
* location : /prq/application/views/crontab/ata_v.php
* url : http://prq.co.k/prq/crontab/ata
* 작성일 : 2017-11-24 (금) 17:33:02 
* 수정일 : 2018-02-12 (월) 10:16:02
* 1. [ 2017-11-24 (금) 17:33:09  ] prq_ata_log 추가

********************************************************/
$host_name="localhost";
$db_name="prq";
$user_name="root";
$db_password="hanna0987";
$connect=mysql_connect($host_name, $user_name, $db_password);
define("CONNECT",$connect);
mysql_select_db($db_name, $connect);
mysql_query("set names utf8;") ;
extract($_REQUEST);
extract($_GET);
extract($_POST);
$ROOT = $_SERVER['DOCUMENT_ROOT'];
header("Content-Type:text/html;charset=utf-8");
//phpinfo();
/*
이름 : get_rand_int
기능 : 임의의 길이(기본값은 6) 만큼 숫자를 반환한다.
입력 : 길이
출력 : 임의의 6자리 혹은 입력한 길이만큼의 수 
작성 : 문태부
*/
function get_rand_int($length=6)
{
	# code...
	$pool = '0123456789';
	$str = '';
	for ($i = 0; $i < $length; $i++)
	{
		$str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
	}
	$word = $str;
	return $word;
}
#{넘버링6자리숫자}=function.get_rand_int
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>PRQ crontab/ata_v ATA Sender</title>
  <link rel="stylesheet" type="text/css" href="http://cashq.co.kr/adm/lib/css/main.css" media="all">

 </head>
 <body>
<pre>
접근 경로 http://prq.co.kr/prq/crontab/ata
이 문서 실제 위치는 /prq/application/views/crontab/ata_v.php 에 위치 합니다. 
[ 2017-11-24 (금) 17:33:37  ] prq_ata_log 추가

[ 2018-02-09 (금) 17:33:37  ] 
prq_ata_pay.bp_appid 추가 
prq_ata_pay.bt_code 추가
템플릿 코드를 불러와서 적용 되도록 할 것!!!

[ 2018-04-13 (금) 17:02:15  ]
상점 등록 후 실행해 줄것!!!
http://prq.co.kr/prq/ajax/make_store

crontab -e 에서
<input type="checkbox" name="" id="" checked>구현] * * * * * /etc/set_mms.sh로 돌아가도록 설정 되어 있으며, 1분마다 구동 설정 되어 있습니다.
<input type="checkbox" name="" id="">미구현] 그래서 curl -u http://prq.co.kr/prq/crontab/view 링크를 실행시 같이 구동 되도록 설정
상태 코드에 대한 설명
1. 로그 발생
- join 상점이 "정상" 가맹점인 경우
- 해지, 정지 된 매장은 로그를 발생하지 않습니다.
</p>

</pre>
<?php 
include_once($_SERVER['DOCUMENT_ROOT'].'/prq/include/php/prq_store.php');

// Using the $records array from Example #1
$st_name= array_column($arr['store'], 'st_name', 'st_no');
$st_vtel= array_column($arr['store'], 'st_vtel', 'st_no');

/****************************************************************************** 
* 1. 블랙 리스트 가져오기 
* 
******************************************************************************/
$black_list=$controller->crontab_m->get_black();
$black_arr=array();


foreach($black_list as $bl){
	$black_arr[]=$bl->bl_hp;
}

/******************************************************************************
*
* 2. 콜 리스트 조회 일부는 조회한 후 필터링 
* 조건
* 1. mn_dup_limit 날짜를 기준으로 상점의 번호와 아이디 번호를 조회해 결과 리스트가 없으면 발송
* 2. 해당 리스트 발송에 대하여 GCM MMS 로그를 발생 수발신 성공 여부 기록 
*
*******************************************************************************/

/******************************************************************************
* 
* 3. select max
* SET @max_count=7;
* SET @max_count=@max_count+1;
*
*******************************************************************************/
echo "<table class='ibk_board mlr30'>";
echo "<tr>";
echo "<th>상태</th>";
echo "<th>전송결과</th>";
echo "<th>비즈톡 결과코드</th>";
echo "<th>성공갯수 / 제한갯수</th>";
echo "<th>고객번호(키)</th>";
echo "<th>매장전화</th>";
echo "<th>발송일(키)</th>";
echo "<th>매장번호</th>";
echo "<th>매장이름</th>";
echo "</tr>";

/*****************************************************
* 
* 2-1. 리스트가 없으면 없는 값 출력
* $list=array(); 리스트 초기화 시
* print_r($list); 리스트 내용 조회시
*****************************************************/
$at_success="";
if(count($list)==0){
	echo '<tr><td scope="row" colspan="12" style="text-align:center"> 조회한 `알림톡 전송대기`목록이 없습니다.</td></tr>';
}
$plusfriend=$controller->crontab_m->get_plusid();
$plusfriend=json_decode(json_encode($plusfriend),true);
	echo "<pre>";
//print_r($plusfriend);
foreach($list as $li)
{
	echo "<pre>";
	//print_r($li);
	echo "</pre>";
	$st_names="";
	$st_names=isset($st_name[$li->st_no])?$st_name[$li->st_no]:"";
	echo "<tr>";
	echo "<td>"; 
	echo "<pre>";
//	print_r($li);

	$is_limit=false;

	/* 보낸상태를 조회합니다. */
	$at_status=$controller->crontab_m->get_mmt_id($li->at_mmt_no,$li->at_datetime);
	$mt_report_code_ib=isset($at_status[0]->mt_report_code_ib)?$at_status[0]->mt_report_code_ib:"";
	echo "</td><td>";
	echo "mt_report_code_ib : ".$mt_report_code_ib;


	if($mt_report_code_ib=="1000"&&$mt_report_code_ib!="")
	{
		$at_success="Y";
		echo "전송성공";
	}else if($mt_report_code_ib!="1000"&&$mt_report_code_ib!=""){
		$at_success="N";
		echo "전송실패";
	}else{

		echo "전송대기";
	}
//	echo $li->at_no;
	//	if($ap_limit_cnt>=
	$ap_limit_cnt=$controller->crontab_m->get_ap_limit_cnt($li->ap_no);
	/* 리미트 여부 */
	$is_limit=$ap_limit_cnt>=$li->at_month_limit;
	echo "</td><td>";
	echo $mt_report_code_ib;
	echo "</td><td>";
	echo $ap_limit_cnt."/".$li->at_month_limit;
	echo "</td><td>";
	echo $li->at_receiver;
	echo "</td><td>";
	echo $li->at_sender;
	echo "</td><td>";
	echo $li->at_date;
	echo "</td><td>";
	echo $li->st_no;
	echo "</td><td>";
	echo $st_names;
	echo "</td>";
	echo "</tr>";
	//$template=$controller->crontab_m->get_template("bkc","K00001");
	echo "</pre>";
	/* 전송 대기 */
	if($li->at_status=="1"&&$is_limit){
		/* 전송 초과 */
		$ata_info = array(
		'at_no'=>$li->at_no,
		'at_status'=>"4",
		'at_result'=>'9999',
		'at_success'=>$at_success,

		);
		/* ATA전송확인완료  */
		$controller->crontab_m->set_ata_pay($ata_info);
	}else if($li->at_status=="1"&&!$is_limit){
	/* 전송이 가능한 상황인 경우 정보를 불러온다. */
	$st_names=isset($st_name[$li->st_no])?$st_name[$li->st_no]:"";
	//	echo "st_name : ".$st_names;
	/* 템플릿 정보 가져오기 */
	//$template=$controller->crontab_m->get_template($li->bp_appid,$li->bt_code);
	//echo "<pre>";
	//print_r($template);
	//echo "</pre>";
	
	if($st_names!="")
	{
		$template=$controller->crontab_m->get_template($li->bp_appid,$li->bt_code);
		
		$key = array_search($li->bp_appid, array_column($plusfriend, 'bp_appid'));
		$sender_key=$plusfriend[$key]['bp_senderid'];
		
		echo "<pre>";	

		$arr_string=$template['bt_content'];

		$exp_regex=explode("&",$template['bt_regex']);	
		
		$store=array(
			"name"=>$st_names,
			"tel"=>$st_vtel[$li->st_no],
			"homepage"=>sprintf("http://prq.co.kr/prq/page/%s",$li->st_no),
			"point"=>"첫 다운로드 2,000"
		);
		
		$agencyMember=array(
			"point_items"=>"5회 주문시, 최대 10,000원\n10회 주문시, 최대 20,000원",
			"min_point"=>"15,000",
			"cell"=>"010-7743-0009");

		$function=array(
			"get_rand_int"=>get_rand_int(),
		);
		
		foreach($exp_regex as $er)
		{
			$keys=explode("=",$er);
			//echo $keys[0]." / ".$keys[1];
			$table_split=explode(".",$keys[1]);
			$replace_string=${$table_split[0]}[$table_split[1]]; 
			//printf("table_name : %s, table_column : %s\n",$table_split[0],$table_split[1]);
			$arr_string=str_replace($keys[0],$replace_string,$arr_string);
		}
		$template_code=$template['bt_code'];
		$ata_info = array(
		'date_client_req'=>$li->date_client_req,
		'template_code'=>$template_code,
		'subject'=>"알림톡페이테스트",
		'content'=>$arr_string,
		'sender_key'=>$sender_key,
		'mb_hp'=>$li->at_receiver,
		'tel'=>$li->at_sender,
		'at_no'=>$li->at_no,
		'at_status'=>"2"
		);
	
		echo "</pre>";
		$controller->crontab_m->set_ata_pay($ata_info);
	}
	/* ATA전송확인 */
	}else if($li->at_status=="2"&&!$is_limit){
		if($at_success=="Y"||$at_success=="N")
		{
		$ata_info = array(
		'at_no'=>$li->at_no,
		'ap_no'=>$li->ap_no,
		'at_status'=>"3",
		'at_result'=>$mt_report_code_ib,
		'at_success'=>$at_success
		);
		/* ATA전송확인완료  */
		$controller->crontab_m->set_ata_pay($ata_info);
		} /* if($at_success=="Y"||$at_success=="N"){...} */
	} /* if($li->at_status=="2"&&!$is_limit)...} */	
	

}/*foreach($list as $li){...}*/
echo "</table>";
?>
</body>
</html>