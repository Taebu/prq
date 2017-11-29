<?php
 if (!defined('BASEPATH')) exit('No direct script access allowed');
foreach($list as $ls)
{
	echo "<pre>";
//	print_r($ls);
	$time = strtotime($ls->ap_autobill_date);
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
		$array=array(
		'ap_no'=>$ls->ap_no,
		'st_no'=>$ls->st_no,
		'st_name'=>$ls->st_name,
		'prq_fcode'=>$ls->prq_fcode,
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
	}else{
		/* 2017-11-29 (수) 14:39:29 
			not last proccess
		*/
    
		echo "not last";
	}
	echo "</pre>";


}