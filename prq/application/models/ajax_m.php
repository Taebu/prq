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

	/*2016-01-06 (수)
	get_dscode()

	모든 총판 코드를 반환한다.
	*/
	function get_dscode($ds_code)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_dscode` ";
		if(isset($ds_code)&&strlen($ds_code)>3)
		{
			$sql[]=" where ds_code='".$ds_code."' ";
		}
		$sql[]=" order by ds_code ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}

	/*2016-01-15 (금)
	get_used_dscode()

	사용 중인 모든 총판 코드를 반환한다.
	*/
	function get_used_dscode()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" prq_fcode,mb_id,mb_gcode ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]=" where mb_gcode='G3' ";
		$sql[]=" order by prq_fcode ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}

	/*
	get_ptcode()
	모든 대리점 코드를 반환한다.
	*/
	function get_ptcode($ds_code)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";	
		$sql[]="FROM ";
		$sql[]="`prq_ptcode` ";
		if(isset($ds_code)&&strlen($ds_code)>3)
		{
			$sql[]=" where pt_code like '".$ds_code."PT____' ";
		}

//		$sql[]=" where ds_code like 'rs%' ";
		$sql[]=" order by pt_code ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
	
		$json['posts']=array();
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}



	/*
	get_cidinfo()
	cid 정보를 반환 프렌차이즈에
	*/
	function get_cidinfo($prq_fcode)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		//mysql> select st_name,st_cidtype,st_tel_1,st_hp_1 from prq_store where prq_fcode='DS0003PT0001FR0003';
		$sql[]="SELECT ";
		$sql[]="  st_port,st_no,st_name,st_cidtype,st_tel_1,st_hp_1 ";	
		$sql[]="FROM ";
		$sql[]="`prq_store` ";
		if(isset($prq_fcode)&&strlen($prq_fcode)>3)
		{
			$sql[]=" where prq_fcode='".$prq_fcode."' ";
		}

		//$sql[]=" where ds_code like 'rs%' ";
		//$sql[]=" order by pt_code ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
	
		$json['posts']=array();
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}


	/*2016-01-25 (월)
	get_used_ptcode()

	사용 중인 모든 대리점 코드를 반환한다.
	*/
	function get_used_ptcode()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" prq_fcode,mb_id,mb_gcode ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]=" where mb_gcode='G4' ";
		$sql[]=" order by prq_fcode ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		$json['posts']=array();
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}


	/*
	get_frcode()
	모든 가맹점 코드를 반환한다.
	*/
	function get_frcode($pt_code)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_frcode` ";
		if(isset($pt_code)&&strlen($pt_code)>11)
		{
			$sql[]=" where fr_code like '".$pt_code."FR____' ";
		}
		$sql[]=" order by fr_code ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}

	/*2016-01-26 (화)
	get_used_frcode()

	사용 중인 모든 가맹점 코드를 반환한다.
	*/
	function get_used_frcode()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" prq_fcode,mb_id,mb_gcode ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]=" where mb_gcode='G5' ";
		$sql[]=" order by prq_fcode ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		$json['posts']=array();
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}
	/*
	insert_ptcode($array)
	대리점 코드를 등록합니다.
	@param $array data
	@return json
	*/
	function insert_ptcode($array)
	{
		$json=array();
		$json['success']=false;
	
		if($array['mode']=="add")
		{
			$sql=array();
			$sql[]="select * from `prq_ptcode` where ";
			$sql[]="pt_code='".$array['pt_code_new']."';";

			$join_sql=join("",$sql);
	//		$json['query']=$join_sql;
			$query = $this->db->query($join_sql);
			if($query->num_rows()>0)
			{
				$json['result']="이미 존재하는 코드이니 삭제나 수정 바랍니다.";
				$json['sql']=$join_sql;
			}else if($query->num_rows()==0){

				$sql=array();
				$sql[]="insert into `prq_ptcode` set ";
				$sql[]="pt_code='".$array['pt_code_new']."',";
				$sql[]="pt_name='".$array['pt_name']."';";

				$join_sql=join("",$sql);
				$query = $this->db->query($join_sql);
				$json['success']=$query;
				$json['result']="코드 입력이 성공 되었습니다.";
			}
		}
	
		/* 수정 하기 */
		if($array['mode']=="modify")
		{
			$sql=array();
			$sql[]="update `prq_ptcode` set ";
			$sql[]=" pt_name='".$array['edit_pt_name']."'";
			$sql[]=" where pt_code='".$array['pt_code_new']."';";

			$join_sql=join("",$sql);
			//$json['query']=$ojin_sql;
			$query = $this->db->query($join_sql);
			if($query)
			{
				$json['result']="수정 성공.";
				$json['sql']=$join_sql;
				$json['success']=true;
			}else{
				$json['result']="수정 실패.";
			}
		}

		/* 삭제 하기 */
		if($array['mode']=="delete")
		{
			$sql=array();
			$sql[]="delete from `prq_ptcode` where ";
			$sql[]="pt_code='".$array['pt_code_new']."';";

			$join_sql=join("",$sql);
	//		$json['query']=$join_sql;
			$query = $this->db->query($join_sql);
			if($query)
			{
				$json['result']="삭제 성공.";
				$json['success']=true;
			}else{
				$json['sql']=$join_sql;
				$json['result']="삭제 실패.";
			}
		}
		echo json_encode($json);
	}


	/*
	insert_frcode($array)
	가맹점 코드를 등록합니다.
	@param $array data
	@return json
	*/
	function insert_frcode($array)
	{
		$json=array();
		$json['success']=false;

		/* 추가 하기*/
		if($array['mode']=="add")
		{
			$sql=array();
			$sql[]="select * from `prq_frcode` where ";
			$sql[]="fr_code='".$array['fr_code_new']."';";

			$join_sql=join("",$sql);
	//		$json['query']=$join_sql;
			$query = $this->db->query($join_sql);
			if($query->num_rows()>0)
			{
				$json['result']="이미 존재하는 코드이니 삭제나 수정 바랍니다.";
				$json['sql']=$join_sql;
			}else if($query->num_rows()==0){

				$sql=array();
				$sql[]="insert into `prq_frcode` set ";
				$sql[]="fr_code='".$array['fr_code_new']."',";
				$sql[]="fr_name='".$array['fr_name']."';";

				$join_sql=join("",$sql);
				$query = $this->db->query($join_sql);
				$json['success']=$query;
				$json['result']="코드 입력이 성공 되었습니다.";
			}
		}
	
		/* 수정 하기 */
		if($array['mode']=="modify")
		{
			$sql=array();
			$sql[]="update `prq_frcode` set ";
			$sql[]=" fr_name='".$array['edit_fr_name']."'";
			$sql[]=" where fr_code='".$array['fr_code_new']."';";

			$join_sql=join("",$sql);
			//$json['query']=$ojin_sql;
			$query = $this->db->query($join_sql);
			if($query)
			{
				$json['result']="수정 성공.";
				$json['sql']=$join_sql;
				$json['success']=true;
			}else{
				$json['result']="수정 실패.";
			}
		}

		/* 삭제 하기 */
		if($array['mode']=="delete")
		{
			$sql=array();
			$sql[]="delete from `prq_frcode` where ";
			$sql[]="fr_code='".$array['fr_code_new']."';";

			$join_sql=join("",$sql);
	//		$json['query']=$join_sql;
			$query = $this->db->query($join_sql);
			if($query)
			{
				$json['result']="삭제 성공.";
				$json['success']=true;
			}else{
				$json['sql']=$join_sql;
				$json['result']="삭제 실패.";
			}
		}
		echo json_encode($json);
	}


	/*
	2016-01-18 (월)
	get_id()

	가입중인 아이디를 반환한다.
	*/
	function get_id($array)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]=" where mb_id like '%".$array['user_id']."%' ";
	

		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		
		echo $json['success']?"TRUE":"FALSE";
		echo ",01030372004";
		//echo $this->input->ip_address();
	}


	/*
	2016-01-19 (화)
	get_email()

	가입중인 이메일 여부를 반환한다.
	*/
	function get_email($array)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]=" where mb_email='".$array['mb_email']."' ";
	

		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		
		echo $json['success']?"TRUE":"FALSE";
		echo ",01030372004";
//		echo ",".$join_sql;
		//echo $this->input->ip_address();
	}

	
	/*
	2016-01-28 (목) 오전 11:50
	get_mb_id()

	가입중인 아이디를 반환한다.
	*/
	function get_mb_id($array)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]=" where mb_id='".$array['mb_id']."' ";
		$sql[]="and mb_password=password('".$array['mb_password']."') ";
		$sql[]="and mb_hp='".$array['mb_hp']."';";

		$join_sql=join("",$sql);
		//echo $join_sql;
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success']){
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		
		echo json_encode($json);
		//echo $this->input->ip_address();
	}

	/*2016-01-28 (목)
	get_member()

	사용 중인 모든 멤버 코드를 반환한다.
	*/
	function get_member()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_member`; ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}


	/*2016-01-28 (목)
	get_store()


	사용 중인 모든 상점 코드를 반환한다.
	*/
	function get_store()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_store`; ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}

	/*
	insert_ptcode($array)
	대리점 코드를 등록합니다.
	@param $array data
	@return json
	*/
	function set_cidinfo($array)
	{
		$json=array();
		$json['success']=false;
	
		$sql=array();
		$sql[]="update `prq_store` set ";
		$sql[]=" st_port='".$array['st_port']."' ";
		$sql[]=" where st_no='".$array['st_no']."';";

		$join_sql=join("",$sql);
		//$json['query']=$ojin_sql;
		$query = $this->db->query($join_sql);
		if($query)
		{
			$json['result']="수정 성공.";
			$json['sql']=$join_sql;
			$json['success']=true;
		}else{
			$json['result']="수정 실패.";
		}

		echo json_encode($json);
	}


	/*
	insert_ptcode($array)
	대리점 코드를 등록합니다.
	@param $array data
	@return json
	*/
	function set_black($array)
	{
		if($array['phoneno']==""){
			echo "0";
			return;
		}
		$json=array();
		$json['success']=false;

			
						
		$sql=array();
		$sql[]="select * from `callerid`.`black_hp` ";
		$sql[]=" where bl_hp=?; ";

		$join_sql=join("",$sql);
		//echo $join_sql;
		//echo $join_sql;
		//$json['query']=$ojin_sql;
		/*
		ALTER TABLE `callerid`.`black_hp` add bl_gubun char(1) NOT NULL default '1';
		ALTER TABLE `callerid`.`black_hp` add bl_dnis varchar(30) NOT NULL default '';
		ALTER TABLE `callerid`.`black_hp` add bl_duration int NOT NULL default 0;
		*/
		$write_array=array($array['phoneno']);
		$query = $this->db->query($join_sql,$write_array) or die(false);
		if($query->num_rows() > 0){
			echo "0";
			return;
		}
		$sql=array();
		$sql[]="insert into `callerid`.`black_hp` set ";
//		$sql[]=" bl_hp='".$hp."', ";
		$sql[]=" bl_hp=?, ";
		$sql[]=" bl_gubun=?, ";
		$sql[]=" bl_dnis=?, ";
		$sql[]=" bl_duration=?, ";
		$sql[]=" bl_datetime=now(); ";

		$join_sql=join("",$sql);
		//echo $join_sql;
		//echo $join_sql;
		//$json['query']=$ojin_sql;
		/*
		ALTER TABLE `callerid`.`black_hp` add bl_gubun char(1) NOT NULL default '1';
		ALTER TABLE `callerid`.`black_hp` add bl_dnis varchar(30) NOT NULL default '';
		ALTER TABLE `callerid`.`black_hp` add bl_duration int NOT NULL default 0;
		*/
		$array['gubun']=$array['gubun']?$array['gubun']:"1";
		$array['dnis']=$array['dnis']?$array['dnis']:"1";
		$array['duration']=$array['duration']?$array['duration']:"15";
		$write_array=array(
			$array['phoneno'],
			$array['gubun'],
			$array['dnis'],
			$array['duration']);
		$query = $this->db->query($join_sql,$write_array) or die(false);
		if($query)
		{
			echo "1";
		}else{
			echo "0";
		}

		//echo json_encode($json);
		
	}

	/*
	get_fremail
	가맹점의 이메일 주소를 아이디로 갱신합니다.

	*/
	function get_frmail()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="select ";
		$sql[]="prq_fcode,";
		$sql[]="mb_email ";
		$sql[]="from ";
		$sql[]="prq_member ";
		$sql[]="where ";
		$sql[]="mb_gcode='G5';";

		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}		
		}
		echo json_encode($json);
	}

	/*
	set_mon($array)
	'mn_id'=>$mn_id,
	'mn_email'=>$mn_email,
	'mn_hp'=>$mn_hp,
	'mn_model'=>$mn_model,
	'mn_version'=>$mn_version,
	'mn_mms_limit'=>$mn_mms_limit,
	'mn_dup_limit'=>$mn_dup_limit
	가맹점 mno 정보를 insert 합니다.
	@param $array data
	@return json
	*/
	function set_mno($array)
	{
		$json=array();
		$json['success']=false;
		if(is_null($array['mn_id'])||strlen($array['mn_id'])<2){
		echo json_encode($json);
		return ;
		}
		$sql=array();
		$sql[]="SELECT * FROM `prq_mno` ";
		$sql[]=" WHERE mn_id='".$array['mn_id']."';";

		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		if($query->num_rows() > 0)
		{
			$sql=array();
			$sql[]="UPDATE `prq_mno` SET ";
			$sql[]=" mn_id='".$array['mn_id']."', ";
			$sql[]=" mn_email='".$array['mn_email']."', ";
			$sql[]=" mn_hp='".$array['mn_hp']."', ";
			$sql[]=" mn_operator='".$array['mn_operator']."', ";
			$sql[]=" mn_model='".$array['mn_model']."', ";
			$sql[]=" mn_version='".$array['mn_version']."', ";
			$sql[]=" mn_mms_limit='".$array['mn_dup_limit']."' ";
			$sql[]=" WHERE mn_id='".$array['mn_id']."';";
		}else{
			$sql=array();
			$sql[]="INSERT INTO  `prq_mno` SET ";
			$sql[]=" mn_id='".$array['mn_id']."', ";
			$sql[]=" mn_email='".$array['mn_email']."', ";
			$sql[]=" mn_hp='".$array['mn_hp']."', ";
			$sql[]=" mn_operator='".$array['mn_operator']."', ";
			$sql[]=" mn_model='".$array['mn_model']."', ";
			$sql[]=" mn_version='".$array['mn_version']."', ";
			$sql[]=" mn_mms_limit='".$array['mn_dup_limit']."', ";
			$sql[]=" mn_datetime=now();";
		}
		$join_sql=join("",$sql);
		//$json['query']=$ojin_sql;
		$query = $this->db->query($join_sql);
		if($query)
		{
			$json['result']="성공.";
			$json['sql']=$join_sql;
			$json['success']=true;
		}else{
			$json['result']="실패.";
		}

		echo json_encode($json);
	}

	/*
	get_mnoinfo()
	mno 정보를 반환 가맹점의 모바일 정보
	*/
	function get_mnoinfo($mn_id)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]="  * ";	
		$sql[]="FROM ";
		$sql[]="`prq_mno` ";
		if(isset($mn_id)&&strlen($mn_id)>3)
		{
			$sql[]=" where mn_id='".$mn_id."' ";
		}

		//$sql[]=" where ds_code like 'rs%' ";
		//$sql[]=" order by pt_code ";


		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
	
		$json['posts']=array();
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		echo json_encode($json);
	}

}

/* End of file auth_m.php */
/* Location: ./application/models/auth_m.php */