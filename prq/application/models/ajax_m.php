<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 사용자인증 모델
 *
 * @author Taebu Moon <mtaebu@gmail.com>
 */
class Ajax_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->load->library('user_agent');
		$this->load->library('curl'); 

		/* 이기종간 디비 불러오기 */
        $this->prq = $this->load->database('default', TRUE);
        $this->cashq = $this->load->database('cashq', TRUE);
        //$this->blog = $this->load->model('blog');
	}

	/**
	 * 아이디, 비밀번호 체크
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
		$query = $this->prq->query(join("",$sql));

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
		$query = $this->prq->query($join_sql);

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
		$json=array();

		$sql=array();
		$json['success']=false;
		if($array['prq_table']=="prq_member"){
			$sql[]="update `".$array['prq_table']."` set ";
			$sql[]=" mb_status='".$array['mb_status']."' ";
			$sql[]="WHERE ";
			$sql[]="mb_no in (".$array['join_chk_seq'].");";
		}else if($array['prq_table']=="prq_store"){
			$sql[]="update `".$array['prq_table']."` set ";
			$sql[]=" st_status='".$array['mb_status']."' ";
			$sql[]="WHERE ";
			$sql[]="st_no in (".$array['join_chk_seq'].");";		
		}else if($array['prq_table']=="prq_blog"){
			$sql[]="update `".$array['prq_table']."` set ";
			$sql[]=" bl_status='".$array['mb_status']."' ";
			$sql[]="WHERE ";
			$sql[]="bl_no in (".$array['join_chk_seq'].");";		
		}else if($array['prq_table']=="prq_isblog"){

		}

		if($array['prq_table']!="prq_isblog")
		{
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);
			$json['success']=$query;
		}
		
		
		$json['posts']=array();
		
		$arr_no= explode (",", $array['join_chk_seq']);
		
		$ip_addr= $this->input->ip_address();
		$referrer=$this->agent->referrer();
		$lo_reason=$array['mb_reason'];
		$mb_id=$array['mb_id'];
		$prq_table=$array['prq_table'];
		
		/* 블로그 상태 변경시 */
		$st=$array['mb_status'];



		foreach($arr_no as $an)
		{
			$items=array();
			/* 블로그인 경우 코드 예외 처리 */
			if($array['prq_table']=="prq_blog"){
				$json['success']=true;
				$items['mb_status']=$this->get_status_isblog($array['mb_status']);
			    
				/* 일반승인*/
				if($st=="co_blog_allow"){
					/* 소비자에게 전송 */
					$array['content']="일반 승인 되었습니다.\n";
					$array['content'].=$array['mb_reason'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['bl_hp'],
								'subject'=>'소비자에게 일반승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);
				
				/* 일반거절*/
				}else if($st=="co_blog_deny"){
					/* 소비자에게 전송 */
					$array['content']="일반 거절 되었습니다.\n";
					$array['content'].=$array['mb_reason'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['bl_hp'],
								'subject'=>'소비자에게 일반거절',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				
				/* 포인트승인 */
				}else if($st=="po_blog_allow"){
					/* 소비자에게 전송 */
					$array['content']="블로그 이용 후기 완료\n";
					$array['content'].=$array['bl_url'];

					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['bl_hp'],
								'subject'=>'소비자에게 포인트 승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				

					/* 사장에게 전송 */
					$array['content']="블로그 리뷰 등록확인\n";
					$array['content'].=$array['bl_hp']."\n";
					$array['content'].=$array['bl_url'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['st_hp_1'],
								'subject'=>'사장에게 포인트 승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				
					
					/* 영업자에게 전송 */
					$array['content']="블로그 리뷰 등록확인\n";
					$array['content'].=$array['bl_hp']."\n";
					$array['content'].=$array['bl_url'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['mb_hp'],
								'subject'=>'영업자에게 포인트 승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				

					// Simple call to remote URL
					$this->curl->simple_get('http://cashq.co.kr/m/ajax_data/set_reviewpt.php?mb_hp='.$array['bl_hp'].'&bl_no='.$an.'&bl_status=ceo_allow');
				/* 포인트거절 */
				}else if($st=="po_blog_deny"){
					/* 소비자에게 전송 */
					$array['content']="포인트 거절 되었습니다.\n";
					$array['content'].=$array['mb_reason'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['mb_hp'],
								'subject'=>'소비자에게 포인트 승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				
				}
			/* 상  점인 경우 코드 예외 처리 */
			}else if($array['prq_table']=="prq_store"){
				$items['mb_status']=$this->get_status_store($array['mb_status']);
			/* 블로그url 사용인 경우 코드 예외 처리 */
			}else if($array['prq_table']=="prq_isblog"){
				$items['mb_status']=$this->get_status_isblog($array['mb_status']);
			}else{
				$items['mb_status']=$this->get_status($array['mb_status']);
			}

			$items['mb_no']=$an;
			//array_push($json['posts'],$items);

			$sql=array();
			$sql[]="INSERT INTO `prq_log` SET ";
			$sql[]=" mb_id='".$array['pv_no']."', ";
			$sql[]=" lo_ip='".$ip_addr."', ";
			$sql[]=" mb_no='".$an."', ";
			$sql[]=" prq_table='".$prq_table."', ";
			$sql[]=" lo_how='ajax', ";
			$sql[]=" lo_reason='".$lo_reason."', ";
			$sql[]=" lo_status='".$array['mb_status']."', ";
			$sql[]=" lo_datetime=now(); ";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);
		}

		//echo json_encode($json);
		return json_encode($json);
	}



	/* 네이버 블로그에 자동등록 합니다.*/
	function chg_status_naver($array)
	{
		$json=array();

		$sql=array();
		$json['success']=false;
		if($array['prq_table']=="prq_member"){
			$sql[]="update `".$array['prq_table']."` set ";
			$sql[]=" mb_status='".$array['mb_status']."' ";
			$sql[]="WHERE ";
			$sql[]="mb_no in (".$array['join_chk_seq'].");";
		}else if($array['prq_table']=="prq_store"){
			$sql[]="update `".$array['prq_table']."` set ";
			$sql[]=" st_status='".$array['mb_status']."' ";
			$sql[]="WHERE ";
			$sql[]="st_no in (".$array['join_chk_seq'].");";		
		}else if($array['prq_table']=="prq_blog"){
			$sql[]="update `".$array['prq_table']."` set ";
			$sql[]=" bl_status='".$array['mb_status']."' ";
			$sql[]="WHERE ";
			$sql[]="bl_no in (".$array['join_chk_seq'].");";		
		}else if($array['prq_table']=="prq_isblog"){

		}

		if($array['prq_table']!="prq_isblog")
		{
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);
			$json['success']=$query;
		}
		
		
		$json['posts']=array();
		
		$arr_no= explode (",", $array['join_chk_seq']);
		
		$ip_addr= $this->input->ip_address();
		$referrer=$this->agent->referrer();
		$lo_reason=$array['mb_reason'];
		$mb_id=$array['mb_id'];
		$prq_table=$array['prq_table'];
		
		/* 블로그 상태 변경시 */
		$st=$array['mb_status'];



		foreach($arr_no as $an)
		{
			$items=array();
			/* 블로그인 경우 코드 예외 처리 */
			if($array['prq_table']=="prq_blog"){
				$json['success']=true;
				$items['mb_status']=$this->get_status_isblog($array['mb_status']);
			    
				/* 일반승인*/
				if($st=="co_blog_allow"){
					/* 소비자에게 전송 */
					$array['content']="일반 승인 되었습니다.\n";
					$array['content'].=$array['mb_reason'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['bl_hp'],
								'subject'=>'소비자에게 일반승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);
				
				/* 일반거절*/
				}else if($st=="co_blog_deny"){
					/* 소비자에게 전송 */
					$array['content']="일반 거절 되었습니다.\n";
					$array['content'].=$array['mb_reason'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['bl_hp'],
								'subject'=>'소비자에게 일반거절',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				
				/* 포인트승인 */
				}else if($st=="po_blog_allow"){
					/* 소비자에게 전송 */
					$array['content']="블로그 이용 후기 완료\n";
					$array['content'].=$array['bl_url'];
					$array['naver_id'];

				/* 포인트거절 */
				}else if($st=="po_blog_deny"){
					/* 소비자에게 전송 */
					$array['content']="포인트 거절 되었습니다.\n";
					$array['content'].=$array['mb_reason'];
					$array_data=array(
								'st_no'=>$array['pv_no'],
								'mb_hp'=>$array['mb_hp'],
								'subject'=>'소비자에게 포인트 승인',
								'content'=>$array['content'],
								'prq_table'=>$array['prq_table'],
								'bl_no'=>$an);
					$this->set_sms($array_data);				
				}
			/* 상  점인 경우 코드 예외 처리 */
			}else if($array['prq_table']=="prq_store"){
				$items['mb_status']=$this->get_status_store($array['mb_status']);
			/* 블로그url 사용인 경우 코드 예외 처리 */
			}else if($array['prq_table']=="prq_isblog"){
				$items['mb_status']=$this->get_status_isblog($array['mb_status']);
			}else{
				$items['mb_status']=$this->get_status($array['mb_status']);
			}

			$items['mb_no']=$an;
			//array_push($json['posts'],$items);

			$sql=array();
			$sql[]="INSERT INTO `prq_log` SET ";
			$sql[]=" mb_id='".$array['pv_no']."', ";
			$sql[]=" lo_ip='".$ip_addr."', ";
			$sql[]=" mb_no='".$an."', ";
			$sql[]=" prq_table='".$prq_table."', ";
			$sql[]=" lo_how='ajax', ";
			$sql[]=" lo_reason='".$lo_reason."', ";
			$sql[]=" lo_status='".$array['mb_status']."', ";
			$sql[]=" lo_datetime=now(); ";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);
		}

		//echo json_encode($json);
		return json_encode($json);
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
			$query = $this->prq->query($join_sql);
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
				$query = $this->prq->query($join_sql);
				$json['success']=$query;
			}

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
			$query = $this->prq->query($join_sql);
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

	function get_status_isblog($code)
	{
		switch ($code) {
		case "view":
			$result='<button type="button" class="btn btn-default btn-xs">포스팅</button>';
			break;
		case "ceo_allow":
			$result='<button type="button" class="btn btn-success btn-xs">사장 승인</button>';
			break;
		case "ceo_deny":
			$result='<button type="button" class="btn btn-danger btn-xs">사장 거절</button>';
			break;
		case "co_blog_allow":
			$result='<button type="button" class="btn btn-success btn-xs">일반 승인</button>';
			break;
		case "co_blog_deny":
			$result='<button type="button" class="btn btn-danger btn-xs">일반 거절</button>';
			break;
		case "po_blog_allow":
			$result='<button type="button" class="btn btn-success btn-xs">포인트 승인</button>';
			break;
		case "po_blog_deny":
			$result='<button type="button" class="btn btn-danger btn-xs">포인트 거절</button>';
			break;
		}
		return $result;
	}	
	

	function get_status_store($code)
	{
		switch ($code) {
		case "wa":
			$result='<button type="button" class="btn btn-default btn-xs">대기</button>';
			break;
		case "pr":
			$result='<button type="button" class="btn btn-primary btn-xs">처리중</button>';
			break;
		case "ac":
			$result='<button type="button" class="btn btn-success btn-xs">완료</button>';
			break;
		case "ad":
			$result='<button type="button" class="btn btn-danger btn-xs">네이버신규등록</button>';
			break;
		case "ec":
			$result='<button type="button" class="btn btn-info btn-xs">네이버권한신청</button>';
			break;
		case "ca":
			$result='<button type="button" class="btn btn-warning btn-xs">설치실패</button>';
			break;
		case "delete":
			$result='<button type="button" class="btn btn-danger btn-xs">삭제</button>';
			break;
		case "modify":
			$result='<button type="button" class="btn btn-warning btn-xs">수정</button>';
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
		$json['posts']=array();
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
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
		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
	
		$json['posts']=array();
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}else{
			$json['posts']=array();
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
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

		if(isset($pt_code)&&strlen($pt_code)>3)
		{
			$sql[]=" where fr_code like '".$pt_code."%' ";
		}
		$sql[]=" order by fr_code ";


		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
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
			$query = $this->prq->query($join_sql);
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
				$query = $this->prq->query($join_sql);
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
			$query = $this->prq->query($join_sql);
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
			$query = $this->prq->query($join_sql);
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
			$query = $this->prq->query($join_sql);
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
				$query = $this->prq->query($join_sql);
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
			$query = $this->prq->query($join_sql);
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
			$query = $this->prq->query($join_sql);
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($query->num_rows() > 0){
			$row = $query->row();
			$mb_hp=$row->mb_hp;
			echo $json['success']?"TRUE":"FALSE";
			echo ",".$mb_hp;
			//echo ",".$join_sql;
			//echo $this->input->ip_address();
		}else{
			echo "FALSE";
			echo ",null";		
		}
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
		
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
		$query = $this->prq->query($join_sql);
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
		$query = $this->prq->query($join_sql,$write_array) or die(false);
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
		$query = $this->prq->query($join_sql,$write_array) or die(false);
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
		$query = $this->prq->query($join_sql);
		
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
	set_mno($array)
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
		$query = $this->prq->query($join_sql);
		
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
			$sql[]=" mn_appvcode='".$array['mn_appvcode']."', ";
			$sql[]=" mn_appvname='".$array['mn_appvname']."', ";
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
			$sql[]=" mn_appvcode='".$array['mn_appvcode']."', ";
			$sql[]=" mn_appvname='".$array['mn_appvname']."', ";
			$sql[]=" mn_mms_limit='".$array['mn_dup_limit']."', ";
			$sql[]=" mn_datetime=now();";
		}
		$join_sql=join("",$sql);
		//$json['query']=$ojin_sql;
		$query = $this->prq->query($join_sql);
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
		$query = $this->prq->query($join_sql);
		
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
	set_mms($array)

	 mms 전송 정보 실패 성공 값 로그를 
	@param $array data
	@return json
	*/
	function set_mms($array)
	{
		$json=array();
		$json['success']=false;
		if(is_null($array['mm_sender'])||strlen($array['mm_sender'])<2){
		echo json_encode($json);
		return ;
		}

		$sql=array();
		$sql[]="INSERT INTO  `prq_mms_log` SET ";
		$sql[]=" mm_subject='".$array['mm_subject']."', ";
		$sql[]=" mm_content='".$array['mm_content']."', ";
		$sql[]=" mm_type='".$array['mm_type']."', ";
		$sql[]=" mm_receiver='".$array['mm_receiver']."', ";
		$sql[]=" mm_sender='".$array['mm_sender']."', ";
		$sql[]=" mm_imgurl='".$array['mm_imgurl']."', ";
		$sql[]=" mm_result='".$array['mm_result']."', ";
		$sql[]=" mm_ipaddr='".$array['mm_ipaddr']."', ";
		$sql[]=" mm_monthly_cnt='".$array['mm_monthly_cnt']."', ";
		$sql[]=" mm_daily_cnt='".$array['mm_daily_cnt']."', ";
		$sql[]=" mm_datetime=now();";
		//$array['mm_sender']
		$join_sql=join("",$sql);
		//$json['query']=$ojin_sql;
		$query = $this->prq->query($join_sql);
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

	/**
	 * 프랜차이즈 정보 코드로 불러오기
	 *

	 * @param array $arrays 테이블명, 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
    function get_franchise($prq_fcode)
    {
    	$sql = "SELECT * FROM prq_member WHERE prq_fcode='".$prq_fcode."'";
   		$query = $this->prq->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return json_encode($result);
    }
  
	/**
	 * 보낸 갯수 불러 오기
	 * @param string mb_hp 보낸 번호
	 * @return json array
	 */
    function get_stat($mb_hp,$type="json")
    {
    	$sql = "select * from prq_stat where st_sender='".$mb_hp."'";
   		$query = $this->prq->query($sql);
		$json['success']=$query->num_rows() > 0;
	
		
     	//게시물 내용 반환
//	    $result = $query->row();
		if($mb_hp==""){
			$json['success']=false;
		}else if($json['success']){
			$json['posts']=array();
			foreach($query->result_array() as $list){
				array_push($json['posts'],$list);
			}
		}
		if($type=="json"){
			$result=json_encode($json);
		}else{
			$result=print_r($json);
		}
    	return $result;
    }
	/*
	set_cdr($array)

	JdbcUtils.updateByPreparedStatement("insert into cdr(date,UserID,port,callerid,calledid) values(now(),?,?,?,?)", list);
	cdr 전송 정보 실패 성공 값 로그를 
	@param $array data
	@return json
	*/
	function set_cdr($array)
	{
		$json=array();
		$json['success']=false;
		if(is_null($array['UserID'])||strlen($array['callerid'])<2){
		$json['msg_user']=$array['UserID']." is empty";
		$json['msg_callerid']=$array['callerid']." is smaller";
		echo json_encode($json);
		return ;
		}
/*

데이터베이스 오류가 발생하였습니다.

Error Number: 1062

Duplicate entry '01050421183' for key 'pf_hp_chk'

INSERT INTO `callerid`.`cdr` SET date=now(), UserID='0319044084@naver.com', port='1', callerid='01050421183', calledid='01020135535';

Filename: /var/www/html/prq/models/ajax_m.php

Line Number: 1245

mysql> show create table cdr\G;
*************************** 1. row ***************************
       Table: cdr
Create Table: CREATE TABLE `cdr` (
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UserID` varchar(255) NOT NULL DEFAULT '',
  `port` varchar(10) NOT NULL DEFAULT '',
  `callerid` varchar(30) NOT NULL DEFAULT '',
  `calledid` varchar(30) DEFAULT '',
  `state` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8
1 row in set (0.00 sec)


1 row in set (0.00 sec)

mysql> show create table prq_first_log\G;
*************************** 1. row ***************************
       Table: prq_first_log
Create Table: CREATE TABLE `prq_first_log` (
  `pf_no` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pf_id` varchar(30) NOT NULL DEFAULT '' COMMENT '가맹점 아이디',
  `pf_port` varchar(10) NOT NULL DEFAULT '' COMMENT '가맹점 포트',
  `pf_hp` char(12) DEFAULT '0' COMMENT '수신번호',
  `pf_name` varchar(255) NOT NULL DEFAULT '' COMMENT '상점명',
  `pf_tel` char(30) NOT NULL DEFAULT '' COMMENT '상점번호',
  `pf_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pf_status` enum('first','before_send','sended','send_fail','member','pause','not_regi') NOT NULL DEFAULT 'first' COMMENT '전송 상태 ',
  PRIMARY KEY (`pf_no`),
  UNIQUE KEY `pf_hp_chk` (`pf_hp`)
) ENGINE=MyISAM AUTO_INCREMENT=16758 DEFAULT CHARSET=utf8 COMMENT='BDMT App FIRST LOG'
1 row in set (0.00 sec)

ERROR:



*/
		$sql=array();
		$sql[]="INSERT INTO  `callerid`.`cdr` SET ";
		$sql[]=" date=now(), ";
		$sql[]=" UserID='".$array['UserID']."', ";
		$sql[]=" port='".$array['port']."', ";
		$sql[]=" callerid='".$array['callerid']."', ";
		$sql[]=" comname='".$array['comname']."', ";
		$sql[]=" calledid='".$array['calledid']."'; ";


		$join_sql=join("",$sql);

		$query = $this->prq->query($join_sql);
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
	set_ata($array)
	/prq/ajax/set_ata
	@param $array data
	@return json
	*/
	function set_ata($array)
	{
		$json=array();
		$json['success']=false;
/*
		if(is_null($array['mb_hp'])||strlen($array['msg'])<2){
		$json['mb_hp']=$array['mb_hp']." is empty";
		$json['msg']=$array['msg']." is smaller";
		$json['tel']=$array['tel']." is smaller";
		echo json_encode($json);
		return ;
		}
*/
		/* Biztalk 전송 */
		$sql=array();
		$sql[]="INSERT INTO biztalk.em_mmt_tran SET ";
		$sql[]="date_client_req=SYSDATE(), ";
		$sql[]="template_code='R00001',";
		$sql[]="content='".$array['msg']."',";
		$sql[]="recipient_num='".$array['mb_hp']."',";
		$sql[]="callback='".$array['tel']."',";
		$sql[]="msg_status='1',";
		$sql[]="subject=' ', ";
		$sql[]="sender_key='70b606cac13417a4dccc7577fb8d5f177e9ab8e3', ";
		$sql[]="service_type='3', ";
		$sql[]="msg_type='1008';";

		$join_sql=join("",$sql);
		$json['query']=$join_sql;
		$query = $this->prq->query($join_sql);
		$insert_id = $this->prq->insert_id();
		$status=$query?"성공":"실패";

		$sql=array();
		$sql[]="INSERT INTO `prq_ata_log` SET ";
		$sql[]=" at_subject='".$array['subject']."', ";
		$sql[]=" at_content='".$array['msg']."', ";
		$sql[]=" at_receiver='".$array['mb_hp']."', ";
		$sql[]=" at_sender='".$array['tel']."', ";
		$sql[]=" at_mmt_no='".$insert_id."', ";
		$sql[]=" at_datetime=now(); ";
		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
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
	function set_device_info($array)
	{
		$json=array();
		$json['success']=false;
		if(is_null($array['mn_hp'])||strlen($array['mn_hp'])<2){
		echo json_encode($json);
		return ;
		}
		$sql=array();
		$sql[]="SELECT * FROM prq_mno ";
		$sql[]=" WHERE mn_hp='".$array['mn_hp']."';";

		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
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
			$sql[]=" mn_appvcode='".$array['mn_appvcode']."', ";
			$sql[]=" mn_appvname='".$array['mn_appvname']."', ";
			$sql[]=" mn_mms_limit='".$array['mn_dup_limit']."' ";
			$sql[]=" WHERE mn_hp='".$array['mn_hp']."';";
		}else{
			$sql=array();
			$sql[]="INSERT INTO  `prq_mno` SET ";
			$sql[]=" mn_id='".$array['mn_id']."', ";
			$sql[]=" mn_email='".$array['mn_email']."', ";
			$sql[]=" mn_hp='".$array['mn_hp']."', ";
			$sql[]=" mn_operator='".$array['mn_operator']."', ";
			$sql[]=" mn_model='".$array['mn_model']."', ";
			$sql[]=" mn_version='".$array['mn_version']."', ";
			$sql[]=" mn_appvcode='".$array['mn_appvcode']."', ";
			$sql[]=" mn_appvname='".$array['mn_appvname']."', ";
			$sql[]=" mn_mms_limit='".$array['mn_dup_limit']."', ";
			$sql[]=" mn_datetime=now();";
		}
		$join_sql=join("",$sql);
		//$json['query']=$ojin_sql;
		$query = $this->prq->query($join_sql);
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
	get_mnoinfo2()
	mno 정보를 반환 가맹점의 모바일 정보
	2016-07-07 (목)
	*/
	function get_mnoinfo2($mn_hp)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]="  * ";	
		$sql[]="FROM ";
		$sql[]="`prq_mno` ";
		if(isset($mn_hp)&&strlen($mn_hp)>3)
		{
			$sql[]=" where mn_hp='".$mn_hp."' ";
		}

		//$sql[]=" where ds_code like 'rs%' ";
		//$sql[]=" order by pt_code ";


		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
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
	del_mno($array)

	'mn_dup_limit'=>$mn_dup_limit
	가맹점 mno 정보를 insert 합니다.
	@param $array data
	@return json
	*/
	function del_mno($array)
	{
		$json=array();
		$json['success']=false;
		if(is_null($array['mn_no'])){
		echo json_encode($json);
		return ;
		}
		
		$sql=array();
		$sql[]="DELETE FROM `prq_mno` WHERE ";
		$sql[]=" mn_no='".$array['mn_no']."'; ";

		$join_sql=join("",$sql);
		//$json['query']=$ojin_sql;
		$query = $this->prq->query($join_sql);
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

	/*2016-11-30 (수) 14:56:44 
	get_store_info()


	사용 중인 모든 상점 코드를 반환한다.
	*/
	function get_store_info()
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_store`; ";


		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
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


	/**
	 * 아이디, 비밀번호 체크
	 * @param array $auth 폼전송 받은 아이디, 비밀번호
	 * @return array
	 */
    function get_login($auth)
    {
		$sql=array();
		$sql[]="SELECT * ";
		$sql[]="FROM ";
		$sql[]="`prq_member` ";
		$sql[]="WHERE ";
		$sql[]="mb_id = '".$auth['setup_id']."' ";
		$sql[]="AND mb_password = password('".$auth['setup_pw']."'); ";

		$url_1="http://prq.co.kr/prq/uploads/files/PRQ_Serial.zip";
		$url_2="http://prq.co.kr/prq/uploads/files/KTProQ.zip";
		$url_3="http://prq.co.kr/prq/uploads/files/PRQ_KT.zip";
		
		$url_no=${"url_".$auth['setup_v']};


	//	$query = $this->prq->query(join("",$sql));
//		if ( $query->num_rows() > 0 )
		if ( $auth['setup_pw']=="eoqkr9495"&&$auth['setup_id']=="admin")
		{
			//맞는 데이터가 있다면 해당 내용 반환
			$result = array(
				'success_yn'=>'Y',
				'url'=>$url_no
			);
			return json_encode($result);
     	}
     	else
     	{
     		//맞는 데이터가 없을 경우
			$result = array(
				'success_yn'=>'N',
				'cause'=>'fail'
			);
			return json_encode($result);
     	}
    }

	/*2016-01-28 (목)
	get_storeno()
	사용 중인 모든 상점 번호에 상점이름을 반환한다.
	*/
	function get_storeno($st_no)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" st_name ";
		$sql[]="FROM ";
		$sql[]="`prq_store` ";
		$sql[]=" where st_no='".$st_no."';";


		$join_sql=join("",$sql);

		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json=$query->result_array();
		}
		return json_encode($json);
	}

	/*2016-01-28 (목)
	get_storeno()
	사용 중인 모든 상점 번호에 상점이름을 반환한다.
	*/
	function set_storeno($st_no)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" st_name ";
		$sql[]="FROM ";
		$sql[]="`prq_store` ";
		$sql[]=" where st_no='".$st_no."';";


		$join_sql=join("",$sql);

		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json=$query->result_array();
		}
		return json_encode($json);
	}

	/*2016-12-26 (월) 15:10:04 
	set_blog_status()
	블로그의 상태를 변경 합니다.
	*/
	function set_blog_status($array)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="UPDATE prq_blog SET ";
		$sql[]=" bl_status='".$array['bl_status']."' ";
		$sql[]=" where bl_no='".$array['bl_no']."';";


		$join_sql=join("",$sql);

		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		
		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$json=$query->result_array();
		}
		return json_encode($json);
	}

	/**
	 * 사장, 영업사원, 소비자 sms 전송
	 *
	 * @param array $auth 폼전송 받은 아이디, 비밀번호
	 * @return array
	 */
	function set_sms($array)
	{
		$store=$this->get_store($array['st_no']);
		$store=json_decode(json_encode($store),true);
		$st_hp=$store['st_hp_1'];
		$result_msg="test";

		/* 182.cashq.SMS 전송 */
		$sql_array=array();
		$sql_array[]="insert into SMSQ_SEND set";
		$sql_array[]="	msg_type='S', ";
		$sql_array[]="	dest_no='".$array['mb_hp']."',";
		$sql_array[]="	call_back='15999495',";
		$sql_array[]="	msg_contents='".$array['content']."' , ";
		$sql_array[]="	sendreq_time=now();";

		$sql=join("",$sql_array);
		$results = $this->cashq->query($sql);
		$sms_result=$results?"성공":"실패";

		/* 182.cashq.SMS_log 생성 */
		$sql_array=array();
		$sql_array[]="insert into `site_push_log` set ";
		$sql_array[]="stype='SMS',";
		$sql_array[]="biz_code='central',";
		$sql_array[]="caller='15999495',";
		$sql_array[]="called='".$array['mb_hp']."',";
		$sql_array[]="wr_subject='".$array['content']."',";
		$sql_array[]="wr_content='push를 테스트 합니다.',";
		$sql_array[]="regdate=now(),";
		$sql_array[]="result='".$result_msg."';";
		$sql=join("",$sql_array);
		$results = $this->cashq->query($sql);

		/* 21.prq.sms_log  */
		$results = true;
		$sql_array=array();
		$sql_array[]="INSERT INTO prq_sms_log SET ";
		$sql_array[]="`sm_subject`='".$array['subject']."',";
		$sql_array[]="`sm_content`='".$array['content']."',";
		$sql_array[]="`sm_type`='SMS',";
		$sql_array[]="`sm_receiver`='".$array['mb_hp']."',";
		$sql_array[]="`sm_sender`='0215999495',";
		$sql_array[]="`sm_result`='".$sms_result."',";
		$sql_array[]="`sm_datetime`=now(),";
		$sql_array[]="`sm_status`='I',";
		$sql_array[]="`sm_ipaddr`='".$this->input->ip_address()."',";
		$sql_array[]="`sm_stno`='".$array['st_no']."';";

		$sql=join("",$sql_array);
		$results = $this->prq->query($sql);
	}

	/**
	 * 상점 정보 가져오기
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_store_no($st_no)
    {
    	$sql = "SELECT * FROM prq_store WHERE st_no='".$st_no."'";
   		$query = $this->prq->query($sql);

     	//댓글 리스트 반환
	    $result = $query->row();

    	return $result;
    }

	/**
	 * 원산지 정보 가져오기
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
	function get_origin($array)
	{
		$json=array();
		$json['success']=false;
		$json['posts']=array();
	

		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" pv_value ";
		$sql[]="FROM ";
		$sql[]="`prq_values` ";
		$sql[]="where ";
		$sql[]="pv_no='".$array['pv_no']."' ";
		$sql[]="and pv_code='".$array['pv_code']."';";
		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;

		foreach($query->result_array() as $list){
			array_push($json['posts'],$list);
		}

		echo json_encode($json);
	}


	/**
	 * 원산지 정보 할당하기
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
	function set_origin($array)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_values`  ";
		$sql[]="where ";
		$sql[]="pv_no='".$array['pv_no']."' ";
		$sql[]="and pv_code='".$array['pv_code']."';";

		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		

		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		

		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$sql=array();
			$sql[]="update prq_values set ";
			$sql[]="pv_value='".$array['pv_value']."', ";
			$sql[]="pv_datetime=now() ";
			$sql[]=" where ";
			$sql[]="pv_code='".$array['pv_code']."' and ";
			$sql[]="pv_no='".$array['pv_no']."';";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);	
		}else{
			/* 조회 결과가 없으면 */
			$sql=array();
			$sql[]="insert into prq_values set ";
			$sql[]="pv_code='".$array['pv_code']."',";
			$sql[]="pv_no='".$array['pv_no']."',";
			$sql[]="pv_value='".$array['pv_value']."',";
			$sql[]="pv_datetime=now();";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);	
		}
		$json['sql']=$join_sql;
		echo json_encode($json);
	}

	/**
	 * code values 정보 가져오기
	 * @param string $pv_code 코드명
	 * @param string $pv_no 코드 연동 번호
	 * @return json_array
	 */
	function get_values($array)
	{
		$json=array();
		$json['success']=false;
		$json['posts']=array();
	

		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" pv_value ";
		$sql[]="FROM ";
		$sql[]="`prq_values` ";
		$sql[]="where ";
		$sql[]="pv_no='".$array['pv_no']."' ";
		$sql[]="and pv_code='".$array['pv_code']."';";
		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;

		foreach($query->result_array() as $list){
			$list['pv_value']=stripcslashes($list['pv_value']);
			array_push($json['posts'],$list);
		}

		echo json_encode($json);
	}


	/**
	 * code values 할당하기
	 * @param string $pv_code 코드명
	 * @param string $pv_no 코드 연동 번호
	 * @param string $pv_value 코드 값
	 * @return array
	 */
	function set_values($array)
	{
		$json=array();
		$json['success']=false;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" * ";
		$sql[]="FROM ";
		$sql[]="`prq_values`  ";
		$sql[]="where ";
		$sql[]="pv_no='".$array['pv_no']."' ";
		$sql[]="and pv_code='".$array['pv_code']."';";

		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		

		/*조회된 갯수 여부*/
		$json['success']=$query->num_rows() > 0;
		

		/* 조회 결과가 성공 이라면 */
		if($json['success'])
		{
			$sql=array();
			$sql[]="update prq_values set ";
			$sql[]="pv_value='".$array['pv_value']."', ";
			$sql[]="pv_datetime=now() ";
			$sql[]=" where ";
			$sql[]="pv_code='".$array['pv_code']."' and ";
			$sql[]="pv_no='".$array['pv_no']."';";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);	
			$json['success']=$query;
		}else{
			/* 조회 결과가 없으면 */
			$sql=array();
			$sql[]="insert into prq_values set ";
			$sql[]="pv_code='".$array['pv_code']."',";
			$sql[]="pv_no='".$array['pv_no']."',";
			$sql[]="pv_value='".$array['pv_value']."', ";
			$sql[]="pv_datetime=now();";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);	
			$json['success']=$query;
		}
		$json['sql']=$join_sql;
		return json_encode($json);
	}


	function get_status_blogyn($code)
	{
		$result='<button type="button" class="btn btn-danger btn-xs">미사용</button>';

		switch ($code) {
		case "Y":
			$result='<button type="button" class="btn btn-success btn-xs">사용</button>';
			break;
		case "N":
			$result='<button type="button" class="btn btn-danger btn-xs">미사용</button>';
			break;
		}
		return $result;
	}	
	
	/** chg_status_blog */
	function chg_status_blog($array)
	{

		$result=$this->set_values($array);

		$json=array();
		$json['success']=false;
		$json['posts']=array();
		
		$arr_no= explode (",", $array['join_chk_seq']);
		
		$ip_addr= $this->input->ip_address();
		$referrer=$this->agent->referrer();
		$lo_reason=$array['mb_reason'];
		$mb_id=$array['mb_id'];
		$prq_table=$array['prq_table'];
		
		/* 블로그 상태 변경시 */
		$st=$array['mb_status'];



		foreach($arr_no as $an)
		{
			$items=array();

			//$items['mb_status']=$this->get_status_isblog($array['mb_status']);
			$items['mb_status']=$this->get_status_blogyn($array['mb_status']);

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
			$sql[]=" lo_status='".$array['pv_value']."', ";
			$sql[]=" lo_datetime=now(); ";
			$join_sql=join("",$sql);
			$query = $this->prq->query($join_sql);
			$json['success']=$query;
		}
		
		echo json_encode($json);
	}

	/**
	 * get_naver_cat 정보 가져오기
	 * @param string $pb_naver_id 코드명
	 * @return json_array
	 */
	function get_naver_cat($array)
	{
		$json=array();
		$json['success']=false;
		$json['posts']=array();
	
		/* select pb_category from prq_blogapi where pb_naver_id='erm00'; */
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" pb_category ";
		$sql[]="FROM ";
		$sql[]="`prq_blogapi` ";
		$sql[]="where ";
		$sql[]="pb_naver_id='".$array['pb_naver_id']."';";

		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);
		
		$result=$query->row();

		echo $result->pb_category;
	}

	/**
	 * get_naver_cat 정보 가져오기
	 * @param string $pb_naver_id 코드명
	 * @return json_array
	 */
	function get_naverapi_id()
	{
		$json=array();
		$json['success']=false;
		$json['posts']=array();
	
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" pb_naver_id ";
		$sql[]="FROM ";
		$sql[]="`prq_blogapi` ";

		$join_sql=join("",$sql);
		$query = $this->prq->query($join_sql);

		foreach($query->result_array() as $list){
			array_push($json['posts'],$list);
		}
		return json_encode($json);
	}
	
	function is_posting($arrays)
	{
    	$sql ="select count(*) cnt from prq_post_log ";
		$sql.="where po_status='s' ";
		$sql.="and bl_no='".$arrays['bl_no']."';";
   		$query = $this->prq->query($sql);

     	//블로그 등록 갯수 반환
		$result = $query->result();
    	return $result;
	}
}
/* End of file ajax_m.php */
/* Location: ./application/models/ajax_m.php */