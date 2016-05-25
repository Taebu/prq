<?php
/********************************************************
* 1분마다 콜로그를 조회하여 gcm과 mms 를 전송하는 페이지 크론탭에 등록 되어 있습니다.
* location : /prq/application/views/crontab/first_v.php
* url : /prq/crontab/first
* 작성일 : 2016-05-19 (목)
* 수정일 : 
* 1. [ 2016-05-19 (목) ] prq_first_log 추가
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
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>PRQ crontab/fist_v ATA Sender</title>
  <link rel="stylesheet" type="text/css" href="http://cashq.co.kr/adm/lib/css/main.css" media="all">

 </head>
 <body>
<p>접근 경로 http://prq.co.kr/prq/crontab/first</p>
<p>이 문서 실제 위치는 /prq/application/views/crontab/first_v.php 에 위치 합니다. </p>
<p>[ 2016-05-19 (목) ] prq_first_log 추가</p>
<p>crontab -e 에서 </p>
<p><input type="checkbox" name="" id="" checked>구현] * * * * * /etc/sh/set_mms.sh로 돌아가도록 설정 되어 있으며, 1분마다 구동 설정 되어 있습니다.</p>
<p><input type="checkbox" name="" id="">미구현] 그래서 curl -u http://prq.co.kr/prq/crontab/view 링크를 실행시 같이 구동 되도록 설정</p>
<p></p>


<?php 
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
echo "<th>pf_no</th>";
echo "<th>날짜</th>";
echo "<th>아이디</th>";
echo "<th>포트</th>";
echo "<th>전화1</th>";
echo "<th>전화2</th>";
echo "<th>pf_state</th>";
echo "<th>pf_name</th>";
echo "<th>query</th>";
echo "<th>전송여부</th>";
echo "</tr>";

/*****************************************************
* 
* 2-1. 리스트가 없으면 없는 값 출력
* $list=array(); 리스트 초기화 시
* print_r($list); 리스트 내용 조회시
*****************************************************/

if(count($list)==0){
	echo '<tr><td scope="row" colspan="12" style="text-align:center"> 조회한 `최초 방문`가 없습니다.</td></tr>';
}

foreach($list as $li)
{
	/*****************************************************
	* 2-2. 리스트 출력 
	* SELECT TIMESTAMPDIFF(DAY,'2009-05-18','2009-07-29');
	***************************************************/
	echo "<tr>";
	echo "<td>".$li->pf_no."</td>";
	echo "<td>".$li->pf_datetime."</td>";
	echo "<td>".$li->pf_id."</td>";
	echo "<td>".$li->pf_port."</td>";
	echo "<td>".$li->pf_tel."</td>";
	echo "<td>".$li->pf_hp."</td>";
	echo "<td>".$li->pf_status."</td>";
	echo "<td>".$li->pf_name."</td>";
$message=array();
$message[]="[".$li->pf_name."] 에서 주문 해주셔서 감사합니다";
$message[]="전화번호 : ".$li->pf_tel."";
$message[]="적립금액 : 2,000원 적립";
$message[]="5회 주문시 현금 최대 10,000원";
$message[]="10회 주문시 현금 최대 20,000원";
$message[]="적립기간 : 적립 후 부터 60일 후 소멸";
$message[]="";
$message[]="\"배달맛톡\" 어플로 주문 시 마다 적립을 해드립니다.";
$message[]="";
$message[]="적립금은 \"배달맛톡\" 에서 제공하며 어플에서 미션달성 시 현금으로 교환하여 사용하실 수 있습니다.";
$message[]="";
$message[]="12,000원 이하 주문 시 적립금액은 무효 처리됩니다.";
$message[]="";
$message[]="적립금 관련 궁금한 점은 1599-9495 으로 문의해 주세요";
$message[]="";
$message[]="앱 다운로드 링크";
$message[]="http://bdmt.cashq.co.kr/m/p\"";
$msg=join("\n",$message);
	echo "<td><textarea style=\"margin: 0px; height: 366px; width: 342px;\">".$msg."</textarea></td>";
$is_ata=$li->pf_name==""?"등록되지 않은 상점 전송불가":"전송가능";
	echo "<td>".$is_ata."</td>";
	echo "</tr>";

	IF($li->pf_name=="")
	{
		$cdr_info = array(
		//상점 정보가 존재하지 않는 대리점
		'pf_no'=>$li->pf_no,
		'pf_status'=>'not_regi'
		);
		$controller->crontab_m->set_firt_status($cdr_info);
	}ELSE IF($li->pf_status=="first"){
		$cdr_info = array(
		//상점 정보가 존재하지 않는 대리점
		'pf_no'=>$li->pf_no,
		'pf_status'=>'before_send'
		);
		$controller->crontab_m->set_firt_status($cdr_info);
	}




	//$li->pf_hp="01077430009";
	/* 비즈톡 전송 시도*/
	if($li->pf_status=="before_send")
	{
		//상점 정보가 존재하지 않는 대리점
		$ata_info = array(
		'pf_no'=>$li->pf_no,
		'msg'=>$msg,
		'mb_hp'=>$li->pf_hp,
		'tel'=>$li->pf_tel,
		'subject'=>"TEST"
		);
		$controller->crontab_m->set_ata($ata_info);

//		$start_dt=date("Y-m-d H:i:s");
//		$CALLER_NUM="01030372004";
		$point_type="first";
//		$point_type="download";

		$config=array(
			'start_dt'=>$li->pf_datetime,
			'CALLER_NUM'=>$li->pf_hp,
			'point_type'=>$point_type
		);
		/* 처음 방문시 전송 */
		$curl=$controller->curl->simple_post('http://cashq.co.kr/ajax/set_bdmt_point.php', $config, array(CURLOPT_BUFFERSIZE => 10)); 
		$query=json_decode($curl,true);
		echo $query['query'];
	}

}/*foreach($list as $li){...}*/
echo "</table>";
?>
</body>
</html>