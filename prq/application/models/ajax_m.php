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
		$sql[]="update `".$array['prq_table']."` set ";
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
		$mb_id=$array['mb_id'];
		$prq_table=$array['prq_table'];

		foreach($arr_no as $an)
		{
			$items=array();
			$items['mb_status']=$this->get_status($array['mb_status']);
			$items['mb_no']=$an;
			array_push($json['posts'],$items);

			$sql=array();
			$sql[]="INSERT INTO `prq_log` SET ";
			$sql[]=" mb_id='".$mb_id."', ";
			$sql[]=" lo_ip='".$ip_addr."', ";
			$sql[]=" mb_no='".$an."', ";
			$sql[]=" prq_table='".$prq_table."', ";
			$sql[]=" lo_how='ajax', ";
			$sql[]=" lo_reason='".$lo_reason."', ";
			$sql[]=" lo_status='".$array['mb_status']."', ";
			$sql[]=" lo_datetime=now(); ";
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);
		}

		echo json_encode($json);
	}

	/**/
	function chg_status_code($array)
	{
		$sql=array();
		$json=array();
		$json['posts']=array();
		if($array['mb_status']=="delete")
		{
			$sql[]="delete from `".$array['prq_table']."` ";
			$sql[]="WHERE ";
			$sql[]="ds_code in ('".$array['join_ds_code']."');";
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);
			$json['success']=$query;
		}
		$ds_name=$array['ds_name'];





		
		$arr_no= explode (",", $array['join_chk_seq']);
		
		$ip_addr= $this->input->ip_address();
		$referrer=$this->agent->referrer();
		$lo_reason=$array['mb_reason'];
		$mb_id=$array['mb_id'];
		$prq_table=$array['prq_table'];

		foreach($arr_no as $an)
		{
			if($array['mb_status']=="modify")
			{
				$sql=array();
				$sql[]="update `".$array['prq_table']."` set ";
				$sql[]=" ds_name='".$ds_name[$an]."' ";
				$sql[]="WHERE ";
				$sql[]="ds_code in ('".$an."');";
				$join_sql=join("",$sql);
				$query = $this->db->query($join_sql);
			}
			$json['success']=$query;
			$items=array();
			$items['mb_status']=$array['mb_status'];
			$items['ds_code']=$an;
			array_push($json['posts'],$items);

			$sql=array();
			$sql[]="INSERT INTO `prq_log` SET ";
			$sql[]=" mb_id='".$mb_id."', ";
			$sql[]=" lo_ip='".$ip_addr."', ";
//			$sql[]=" mb_no='".$an."', ";
			$sql[]=" prq_fcode='".$an."', ";
			$sql[]=" prq_table='".$prq_table."', ";
			$sql[]=" lo_how='ajax', ";
			$sql[]=" lo_reason='".$lo_reason."', ";
			$sql[]=" lo_status='".$array['mb_status']."', ";
			$sql[]=" lo_datetime=now(); ";
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);
		}

		echo json_encode($json);
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
	
	
	function get_pcode($array)
	{
		$json=array();
		$json['success']=false;
		$json['posts']=array();
	

		$sql=array();
		$sql[]="SELECT ";
		$sql[]="mb_code,";
		$sql[]="mb_id,";
		$sql[]="mb_ceoname ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]="where ";
		$sql[]="mb_gcode='G3';";
		$join_sql=join("",$sql);
//		$json['query']=$join_sql;
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;

		foreach($query->result_array() as $list){
			/*방법 1 각 객체를 변경*/
			//$items=array();
			//$items['mb_code']=$list['mb_code'];
			//$items['mb_ceoname']=$list['mb_ceoname'];
			//array_push($json['posts'],$items);
			/*방법 2 각 객체 그대로*/
			array_push($json['posts'],$list);
		}

		echo json_encode($json);
		//print_r($array);
		//echo $join_sql;
	}
}

/* End of file auth_m.php */
/* Location: ./application/models/auth_m.php */