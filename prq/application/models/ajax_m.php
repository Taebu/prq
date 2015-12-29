<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 사용자인증 모델
 *
 * @author Jongwon Byun <advisor@cikorea.net>
 */
class Ajax_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->load->library('user_agent');
    }

	/**
	 * 아이디, 비밀번호 체크
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $auth 폼전송 받은 아이디, 비밀번호
	 * @return array
	 */
    function login($auth)
    {
		$sql=array();
		$sql[]="SELECT ";
		$sql[]="username, ";
		$sql[]="email,";
		$sql[]="name ";
		$sql[]="FROM ";
		$sql[]="users ";
		$sql[]="WHERE ";
		$sql[]="username = '".$auth['username']."' ";
		$sql[]="AND password = '".$auth['password']."' ";
		$query = $this->db->query(join("",$sql));

		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
			return $query->row();
     	}
     	else
     	{
     		//맞는 데이터가 없을 경우
	    	return FALSE;
     	}
    }

	/**/	
    function chk_id($auth)
    {
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="prq_member ";
		$sql[]="WHERE ";
		$sql[]="mb_id = '".$auth['mb_id']."';";
		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);

		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
//			return $query->row();
//			return $query->row();
			return FALSE;
     	}
     	else
     	{
     		//맞는 데이터가 없을 경우
	    	return TRUE;
     	}
    }
	
	/**/
	function chg_status($array)
	{

		$sql=array();
		$sql[]="update `prq_member` set ";
		$sql[]=" mb_status='".$array['mb_status']."' ";
		$sql[]="WHERE ";
		$sql[]="mb_no in (".$array['join_chk_seq'].");";
		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);

		$json=array();
		$json['success']=$query;
		$json['posts']=array();
		
		$arr_no= explode (",", $array['join_chk_seq']);
		
		$ip_addr= $this->input->ip_address();
		$referrer=$this->agent->referrer();
		$lo_reason=$array['mb_reason'];

/*
drop table `prq_log`;
CREATE TABLE `prq_log` (
  `mb_id` varchar(20) NOT NULL DEFAULT '',
  `lo_ip` varchar(255) NOT NULL DEFAULT '',
  `mb_no` int(11) NOT NULL DEFAULT '0',
  `prq_table` varchar(255) NOT NULL DEFAULT '',
  `lo_status` varchar(255) NOT NULL DEFAULT '',
  `lo_how` varchar(255) NOT NULL DEFAULT '',
  `lo_reason`  varchar(255) NOT NULL DEFAULT '',
  `lo_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`mb_id`,`prq_table`,`lo_datetime`)
) DEFAULT CHARSET=utf8;

*/
		foreach($arr_no as $an)
		{
			$items=array();
			$items['mb_status']=$this->get_status($array['mb_status']);
			$items['mb_no']=$an;
			array_push($json['posts'],$items);

			$sql=array();
			$sql[]="INSERT INTO `prq_log` SET ";
			$sql[]=" mb_id='"."admin"."', ";
			$sql[]=" lo_ip='".$ip_addr."', ";
			$sql[]=" mb_no='".$an."', ";
			$sql[]=" prq_table='prq_member', ";
			$sql[]=" lo_how='ajax', ";
			$sql[]=" lo_reason='".$lo_reason."', ";
			$sql[]=" lo_status='".$array['mb_status']."', ";
			$sql[]=" lo_datetime=now(); ";
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);
		}

		echo json_encode($json);
		//print_r($array);
		//echo $join_sql;
	}


	function get_status($code)
	{
		switch ($code) {
		case "wa":
			$result='<button type="button" class="btn btn-default btn-xs">대기</button>';
			break;
		case "pr":
			$result='<button type="button" class="btn btn-primary btn-xs">처리중</button>';
			break;
		case "ac":
			$result='<button type="button" class="btn btn-success btn-xs">승인</button>';
			break;
		case "ad":
			$result='<button type="button" class="btn btn-danger btn-xs">승인거부</button>';
			break;
		case "ec":
			$result='<button type="button" class="btn btn-info btn-xs">연계완료</button>';
			break;
		case "ca":
			$result='<button type="button" class="btn btn-warning btn-xs">해지</button>';
			break;
		}
		return $result;
	}

}

/* End of file auth_m.php */
/* Location: ./application/models/auth_m.php */