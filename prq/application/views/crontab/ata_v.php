<?php
/********************************************************
* 1분마다 콜로그를 조회하여 gcm과 mms 를 전송하는 페이지 크론탭에 등록 되어 있습니다.
* location : /prq/application/views/crontab/ata_v.php
* url : /prq/crontab/ata
* 작성일 : 2017-11-24 (금) 17:33:02 
* 수정일 : 
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

foreach($list as $li)
{
	$st_names="";
	$st_names=isset($st_name[$li->st_no])?$st_name[$li->st_no]:"";
	echo "<tr>";

	echo "<td>";
	echo "<pre>";
//	print_r($li);

	$is_limit=false;
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

	/* 전송 대기 */
	if($li->at_status=="1"&&$is_limit){
		/* 전송 초과 */
		$ata_info = array(
		'at_no'=>$li->at_no,
		'at_status'=>"4",
		'at_result'=>'9999',
		'at_success'=>$at_success
		);
		/* ATA전송확인완료  */
		$controller->crontab_m->set_ata_pay($ata_info);
	}else if($li->at_status=="1"&&!$is_limit){
	
	$st_names=isset($st_name[$li->st_no])?$st_name[$li->st_no]:"";
	//	echo "st_name : ".$st_names;
	if($st_names!="")
	{
		$message=array();
		$message[]="[".$st_names."]을 이용해주셔서 감사합니다.";
		$message[]="적립번호 : [".$li->at_sender."]";
		$message[]="";
		$message[]="고객님에게 \"2,000원\" 적립 해드렸습니다.";
		$message[]="\"배달톡톡\" 어플로 접속하시면 확인가능합니다.";
		$message[]="";
		$message[]="[새로운 미션내용]";
		$message[]="5회 주문시 현금 최대 10,000원";
		$message[]="10회 주문시 현금 최대 20,000원";
		$message[]="적립기간 : 주문일 부터 60일 후 소멸";
		$message[]="";
		$message[]="요즘 트랜드에 맞게 배달음식을 주문 시 마다 현금적립 어플을 새롭게 출시 하였습니다.";
		$message[]="고객님만을 위한 배달어플을 지금 확인 하세요\!";
		$message[]="";
		$message[]="적립금 관련 궁금한 점은 1599-9495 으로 문의해 주세요";
		$message[]="";
		$message[]="\"배달톡톡\" 앱 포인트 확인 링크";
		$message[]="http://bdtalk.co.kr/m/p/";
		$msg=join("\n",$message);
//		echo $msg;
	
		$ata_info = array(
		'date_client_req'=>$li->date_client_req,
		'msg'=>$msg,
		'mb_hp'=>$li->at_receiver,
		'tel'=>$li->at_sender,
		'at_no'=>$li->at_no,
		'subject'=>"알림톡페이테스트",
		'at_status'=>"2"
		);
	
		echo "</pre>>";
		/* ATA전송대기 */
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