 <? include "../lib/db_con.php" ?>	
<? include "../lib/connect.php" ?>
<? include "../lib/user_function.php" ?>
<?
include_once "../GCM.php";
$gcm = new GCM();
header("Content-Type: text/html; charset=UTF-8");
$sql="select * from st_gcm where status='0';";
$stgcmlist=mysql_query($sql);
while($list=mysql_fetch_assoc($stgcmlist)){
$sql="select name,seq,biz_code from store where tel='{$list[VIRTUAL_NUM]}';";
$row=ass($sql);
$sql="update st_gcm set status='1',`update`=now() where seq='{$list[seq]}';";
mysql_query($sql);

	$sql="select distinct phone,st_seq from user_member where st_seq<>'';";
	$query=mysql_query($sql);
	while($phlst=mysql_fetch_assoc($query))
	{
		$registration_ids=array();
		$arrseq=explode("_",$phlst['st_seq']);
		$phlst['phone']=remove_minus($phlst['phone']);
		foreach($arrseq as $as)
		{
			if($row['seq']==$as){
				$registration_ids[]=get_token_id($phlst['phone'],'central');
				$msg="\"".$row['name']."\"에 주문 콜이 들어 왔습니다.";
				$message = array("title"=>$agency_name,"msg"=>$msg,"board"=>"spl");
				$push= json_decode($gcm->send_notification($registration_ids,$message));
				$p_temp=$push->results[0]->message_id;
				$result= (strpos($p_temp,"0:")!==false)?true:false;
				$result_msg= ($result)?"전달 성공":"전송 실패";
				$sql="insert into `site_push_log` set 
				stype='CAL_GCM',
				biz_code='".$row['biz_code']."',
				caller='{$list[VIRTUAL_NUM]}',
				called='".remove_minus($phlst['phone'])."',
				wr_subject='{$msg}',
				wr_content='push를 테스트 합니다.',
				regdate=now(),
				result='$result_msg';";
				mysql_query($sql);
			}
			}
	}
}

?>