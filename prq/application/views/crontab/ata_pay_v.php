<?php
 if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* cashq 포인트 이벤트 갱신
* file : /var/www/html/prq/application/views/crontab/ata_pay_v.php
* crontab -e
* 0 0 * * * sh /etc/sh/set_ata_pay_day.sh
*
* excute location : curl -v http://prq.co.kr/prq/crontab/ata_pay
* 작성 : 2018-02-20 17:53:04
* 수정 : 
* 
* @author Moon Taebum 
* @Copyright (c) 2018, 태부
*/	

/**
2015-07-30 (목)
last_array
마지막 문자열을 "_" 나눈 후 마지막 배열을 반환 합니다.
이벤트 코드를 자동 생성하기 위해 만든 fn 기존의 단일 코드였다면 이벤트 코드를 복합코드로 사용하기 위합입니다.

@s 나눌 문자열 값을 넣지 않으면 "str none"을 반환한다.
@sp 나눌 기호 기본값은 _ 나눌기호가 있다면 다른 기호를 넣어도 무방하다.
@lastindex '통상적으로 마지막 값이 들어 오면 되는데 1이 초기값이고 배열의 크기보다 너무 크면 처음 배열 값을 가져 옵니다.

사용예 ::
$str="a001_m_3";
echo last_array($str);
결과 3
*/
function last_array($s,$sp="_",$lastindex=1)
{
	if($s==""){
	return "str none";
	}
	$arr_str=explode($sp,$s);
	$i=count($arr_str)-$lastindex;
	if($lastindex>count($arr_str)){
	echo  "Too big last index";
	echo "<br>";
	return $arr_str[0];
	}
	return $arr_str[$i];
}
echo last_array("a001_m_6");
$json=array();

// SELECT * FROM `prq_ata_pay` where ap_status='join';
foreach($list as $ls)
{
	/* 2-1. ed_dt 유닉스타임 86400초를 더한다. */
	echo "<pre>";
	print_r($ls);
/*
CREATE TABLE `prq_ata_pay` (
  `ap_no` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `st_no` int(11) unsigned NOT NULL COMMENT '상점 번호',
  `st_name` varchar(255) NOT NULL DEFAULT '' COMMENT '상점이름',
  `prq_fcode` char(18) NOT NULL DEFAULT '' COMMENT '가맹점코드',
  `ap_name` int(11) NOT NULL COMMENT '상품 이름',
  `ap_price` int(11) NOT NULL COMMENT '가입금액',
  `bp_appid` varchar(20) NOT NULL COMMENT '비즈톡앱아이디',
  `bt_code` varchar(10) NOT NULL COMMENT '템플릿코드',
  `ap_limit` int(11) NOT NULL DEFAULT '1000' COMMENT '제한건수',
  `ap_limit_cnt` int(11) NOT NULL DEFAULT '0' COMMENT '제한건수-합계',
  `ap_false_cnt` int(11) NOT NULL DEFAULT '0' COMMENT 'ATA전송실패-합계',
  `ap_status` varchar(20) NOT NULL DEFAULT 'join' COMMENT '정상 join, 정지 stop, 해지 terminate, 만료 expired',
  `terminate_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '해지일',
  `stop_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '정지일',
  `join_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '가입일 혹은 재가입일',
  `ap_autobill_YN` char(1) NOT NULL DEFAULT 'Y' COMMENT '정기 결재 여부 기본값 Y, 일회 사용 N',
  `ap_autobill_date` date NOT NULL DEFAULT '1970-01-01' COMMENT '정기 결재일 결재일 기준으로 전송횟수 초기화',
  `ap_reserve` int(11) NOT NULL DEFAULT '0',
  `ap_datetime` datetime NOT NULL DEFAULT '1970-01-01 09:00:00',
  PRIMARY KEY (`ap_no`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='2017-11-20 알림톡 결재 리스트'
[ap_no] => 8
[st_no] => 9
[st_name] => 배터지는생돈까스
[prq_fcode] => DS0001PT0006FR0001
[ap_name] => 0
[ap_price] => 10000
[bp_appid] => cashb
[bt_code] => T00002
[ap_limit] => 1000
[ap_limit_cnt] => 2
[ap_false_cnt] => 0
[ap_status] => join
[terminate_date] => 1970-01-01
[stop_date] => 1970-01-01
[join_date] => 1970-01-01
[ap_autobill_YN] => Y
[ap_autobill_date] => 2018-02-14
[ap_reserve] => 0
[ap_datetime] => 2018-02-14 13:13:35
*/
echo date( "Y-m-d", strtotime( "2009-01-31 +1 month" ) ); // PHP:  2009-03-03
echo date( "Y-m-d", strtotime( "2009-01-31 +2 month" ) ); // PHP:  2009-03-31
	/* 1. 현재 시간을 조회한다.; */
	echo "1. 현재 시간을 조회한다. ";
	echo "<br>";
	echo date("Y-m-d h:i:s");
	//echo $ls->ap_autobill_date;
	/* 2. 포인트이벤트 기간이 오토인것만 조회하여 반복한다. */


	$now_time=strtotime(date("Y-m-d h:i:s"));
	$autobill_date=date("Y-m-d",strtotime($ls->ap_autobill_date));
	$time = strtotime($autobill_date." +1 month");
	$plus_date=date("Y-m-d",$time);
	echo "<br>";
	echo "plus_date : ".$plus_date;
	echo "<br>";
	/* 2-2. 이벤트 기간이 지났다면 */
	if($now_time>$time){
		echo "now_time : ".$now_time." > ".$time;
		/* 2-2-2. 이벤트 기간을 종료일로 부터 하루 더하여 ev_st_dt 변수에 담는다. */
		//$ev_st_dt=date("Y-m-d", strtotime($list[ev_ed_dt].' + 1day')); 

		/* 2-2-3. 이벤트 기간을 시작일로 부터 두달을 더하고 하루를 뺀 날짜를 ev_ed_dt 변수에 담는다. */
		
		/* 2-2-4. ed_type인 reviewpt 라면 */
		
		/* 2-2-4-1. 이벤트 기간을 시작일로 부터 세달을 더하고 하루를 뺀 날짜를 ev_ed_dt 변수에 담는다. */
		
		/* 2-2-5. 이벤트코드에서 '_'로 나누어 마지막에 있는 배열에 있는 숫자인 증가한 하나의 값을 ins 변수에 담는다.  */
		
		/* 2-2-6. biz_code와 '_' 와 ins를 합하여, 새로운 이벤트코드를 생성한다.  */
		
		/* 2-2-7. 리스트 cash에 캐시에 담는다.  */
		
		/* 2-2-1. 현재 이벤트 종료하고 오토였던 상태를 수동으로 사용한 상태로 변경한다. */
		/* 2-2-8. point_event_dt insert into list에 모든 데이터를 그대로 담는다. */
		/* - ev_st_dt, ev_ed_dt, eventcode 에 다르게 담아서 적용한다. */
		$time = strtotime($autobill_date." +1 month");
		$ap_autobill_date=date("Y-m-d",$time);

		$array=array(
		'ap_no'=>$ls->ap_no,
		'st_no'=>$ls->st_no,
		'st_name'=>$ls->st_name,
		'prq_fcode'=>$ls->prq_fcode,
		'bt_code'=>$ls->bt_code,
		'bp_appid'=>$ls->bp_appid,
		'ap_name'=>$ls->ap_name,
		'ap_price'=>$ls->ap_price,
		'ap_limit'=>$ls->ap_limit,
		'ap_limit_cnt'=>'0',
		'ap_false_cnt'=>'0',
		'ap_status'=>$ls->ap_status,
		'terminate_date'=>$ls->terminate_date,
		'stop_date'=>$ls->stop_date,
		'join_date'=>$ls->join_date,
		'ap_autobill_YN'=>$ls->ap_autobill_YN,
		'ap_autobill_date'=>$ap_autobill_date,
		'ap_reserve'=>$ls->ap_reserve,
		'ap_datetime'=>$ls->ap_datetime,
		);
		$this->crontab_m->insert_ata_pay($array);
		$this->crontab_m->set_ata_store($ls->st_no);
		

		echo "last time : ".$now_time." > ".$time;
	}else{
		echo "not last time : ".$now_time." > ".$time;
	}

	$now_time=strtotime(date("Y-m-d h:i:s"));
	$last_time = strtotime("+1 month",$time);
	$final = date("Y-m-d", $last_time);
	printf("%s > %s ",$last_time,$time);
	echo "<br>";
	echo $last_time-$now_time;
	echo "<br>";
	echo date("Y-m-d H:i:s")." / ".$final;
	echo "<br>";


	if($last_time<$now_time)
	{
		echo "last";
		/* 2017-11-29 (수) 14:39:29 
			last proccess
			ap_no, st_no, st_name, prq_fcode, ap_name, ap_price, ap_limit, ap_limit_cnt, ap_false_cnt, ap_status, terminate_date, stop_date, join_date, ap_autobill_YN, ap_autobill_date, ap_reserve, ap_datetime
		*/
		/* 정기결제 */
		if($ls->ap_autobill_YN=="Y")
		{
			echo "autobill Y";
			echo "<br>";
			echo "성공 갯수 : ".$ls->ap_limit_cnt;
			echo "<br>";
			echo "실패 갯수 : ".$ls->ap_false_cnt;
			echo "<br>";
		}
		$ap_autobill_date=date("Y-m-d",strtotime("+1 month",strtotime($ls->ap_autobill_date)));
		
	}else{
		/* 2017-11-29 (수) 14:39:29 
			not last proccess
 		*/
    
		echo "not last";
	}
	echo "</pre>";
}
/* 3. 끝낸다. */