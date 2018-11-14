<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 가맹점 메인 controller.
 * 생성 : 2015-12-23 (수)
 * 수정 : 2016-05-27 (금)
 * @author Taebu,Moon<mtaebu@gmail.com>
 */
class Franchise extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
//		$this->load->model('board_m');
//		$this->load->model('member_m');
		$this->load->model('franchise_m');
		$this->load->helper('form');
		$this->load->helper(array('url','date'));
	}

	/**
	 * 주소에서 메소드가 생략되었을 때 실행되는 기본 메소드
	 */
	public function index()
	{
		$this->lists();
	}

	/**
	 * 사이트 헤더, 푸터를 자동으로 추가해준다.
	 *
	 */
	public function _remap($method)
 	{

		if($method=="write"||$method=="modify")
		{
			//헤더 include
			$this->load->view('header_write_v');
			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}

			//푸터 include		
			$this->load->view('footer_write_v');
		}else{
			//헤더 include
			$this->load->view('header_v5_v');

			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}

			//푸터 include		
			$this->load->view('footer_v5_v');
		}
		
    }

	/**
	 * 목록 불러오기
	 */
	public function lists()
	{
//		$this->output->enable_profiler(TRUE);
//		$this->output->enable_profiler(FALSE);
		//검색어 초기화
		$search_word = $page_url = '';
		$uri_segment = 5;

		//주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if( in_array('q', $uri_array) ) {
			//주소에 검색어가 있을 경우의 처리. 즉 검색시
			$search_word = urldecode($this->url_explode($uri_array, 'q'));

			//페이지네이션용 주소
			$page_url = '/q/'.$search_word;
			$uri_segment = 7;
		}

		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');
		$search_array = array(
			'mb_name'=>$this->input->post('mb_name', TRUE),
			'mb_id'=>$this->input->post('mb_id', TRUE),
			'mb_email'=>$this->input->post('mb_email', TRUE),
			'mb_hp'=>$this->input->post('mb_hp', TRUE)
		);
			$is_status_view=$this->uri->segment(3)=="prq_member_status";
		if($is_status_view){
		$base_url='/prq/franchise/lists/prq_member_status'.$page_url.'/page/';
		}else{
		$base_url='/prq/franchise/lists/prq_member'.$page_url.'/page/';
		}
		$config = array(
		//페이지네이션 기본 설정
		'base_url'=> $base_url,
		//'total_rows' => $this->franchise_m->get_list($this->uri->segment(3), 'count', '', '', $search_word),
		'total_rows' => $this->franchise_m->get_list2($this->uri->segment(3), 'count', '', '', $search_array),
		'per_page' => 25,
		'uri_segment' => $uri_segment,

		//페이지네이션 커스텀 설정 
		'first_tag_open'	=> '<li>',
		'first_tag_close'	=> '</li>',
		'first_link'	=> '<i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>',
		'last_link'	=> '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>',
		'last_tag_open'	=> '<li>',
		'last_tag_close'	=> '</li>',		
		'next_link'	=> '<i class="fa fa-chevron-right"></i>',
		'next_tag_open'	=> '<li>',
		'next_tag_close'	=> '</li>',
		'prev_link'	=> '<i class="fa fa-chevron-left"></i>',
		'prev_tag_open'	=> '<li>',
		'prev_tag_close'	=> '</li>',
//		'cur_tag_open'	=> '<li class="active"><a href="#">',
//		'cur_tag_close'	=> '</a></li>',
		'cur_tag_open'	=> '<li class="active"><a>',
		'cur_tag_close'	=> '</a></li>',
		'num_tag_open'	=> '<li>',
		'num_tag_close'	=> '</li>',
		);
		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();


		//게시판 목록을 불러오기 위한 offset, limit 값 가져오기
		$data['page'] = $page = $this->uri->segment($uri_segment, 1);

		if ( $page > 1 )
		{
			$start = (($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
			$start = ($page-1) * $config['per_page'];
		}

		$limit = $config['per_page'];

		/* 검색한 값들 상세 검색 배열*/
		$data['search']=$search_array;

//		$data['list'] = $this->franchise_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
		$data['list'] = $this->franchise_m->get_list2($this->uri->segment(3), '', $start, $limit, $search_array);

		$data['st_count'] = json_decode(json_encode($this->franchise_m->get_stcnt()), True);
		$data['pt_names'] = json_decode(json_encode($this->franchise_m->get_ptcode()), True);
		$data['ds_names'] = json_decode(json_encode($this->franchise_m->get_dscode()), True);
		$data['controllers'] = $this;
		$is_status_view=$this->uri->segment(3)=="prq_member_status";

		if($is_status_view)
		$this->load->view('franchise/status/list_v', $data);

		if(!$is_status_view)
		$this->load->view('franchise/list_v', $data);
	}

	/**
	 * 게시물 보기
	 */
	function view()
 	{
		$class=$this->uri->segment(1);
		$table=$this->uri->segment(3);
		$mb_no=$this->uri->segment(5);
		$page=$this->uri->segment(7);

		$data['list_link']=sprintf("/prq/%s/lists/%s/page/%s",$class,$table,$page);
		$data['modify_link']=sprintf("/prq/%s/modify/%s/mb_no/%s/page/%s",$class,$table,$mb_no,$page);
		$data['delete_link']=sprintf("/prq/%s/delete/%s/mb_no/%s/page/%s",$class,$table,$mb_no,$page);
		$data['write_link']=sprintf("/prq/%s/write/%s/page/%s",$class,$table,$page);
 		
		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		$data['views'] = $this->franchise_m->get_view($table, $mb_no);

		//게시판 이름과 게시물 번호에 해당하는 댓글 리스트 가져오기
 		$data['comment_list'] = $this->franchise_m->get_comment($table, $mb_no);

 		//view 호출
 		$this->load->view('franchise/view_v', $data);
 	}

 	/**
	 * 게시물 쓰기
	 */
	function write()
 	{
		//경고창 헬퍼 로딩
		$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('mb_id', '아이디', 'required');
			$this->form_validation->set_rules('mb_password', '비밀번호', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				$this->load->model('franchise_m');
				//주소중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$write_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'mb_id' => $this->input->post('mb_id', TRUE),
					'mb_pcode' => $this->input->post('mb_pcode', TRUE),
					'mb_name' => $this->input->post('mb_name', TRUE),
					'mb_gcode' => $this->input->post('mb_gcode', TRUE),
					'mb_gtype' => $this->input->post('mb_gtype', TRUE),
					'mb_gname_eng' => $this->input->post('mb_gname_eng', TRUE),
					'mb_gname_kor' => $this->input->post('mb_gname_kor', TRUE),
					'prq_fcode' => $this->input->post('prq_fcode', TRUE),
					'mb_email' => $this->input->post('mb_email', TRUE),
					'mb_imgprefix' => $this->input->post('mb_imgprefix', TRUE),
					'mb_birth' => $this->input->post('mb_birth', TRUE),
					'mb_addr1' => $this->input->post('mb_addr1', TRUE),
					'mb_addr2' => $this->input->post('mb_addr2', TRUE),
					'mb_addr3' => $this->input->post('mb_addr3', TRUE),
					'mb_password' => $this->input->post('mb_password', TRUE),
					'mb_hp' => $this->input->post('mb_hp', TRUE),
					'mb_ceoname' => $this->input->post('mb_ceoname', TRUE),
					'mb_business_num' => $this->input->post('mb_business_num', TRUE),
					'mb_exactcaculation_ratio' => $this->input->post('mb_exactcaculation_ratio', TRUE),
					'mb_bankname' => $this->input->post('mb_bankname', TRUE),
					'mb_banknum' => $this->input->post('mb_banknum', TRUE),
					'mb_bankholder' => $this->input->post('mb_bankholder', TRUE),
					'mb_bigo' => $this->input->post('mb_bigo', TRUE),
					'mb_business_paper' => $this->input->post('mb_business_paper', TRUE),
					'mb_distributors_paper' => $this->input->post('mb_distributors_paper', TRUE),
					'mb_bank_paper' => $this->input->post('mb_bank_paper', TRUE),
					'mb_business_paper_size' => $this->input->post('mb_business_paper_size', TRUE),
					'mb_distributors_paper_size' => $this->input->post('mb_distributors_paper_size', TRUE),
					'mb_bank_paper_size' => $this->input->post('mb_bank_paper_size', TRUE),
				);
				//$result = $this->distributors_m->insert_distributors($write_data);

				$result = $this->franchise_m->insert_franchise($write_data);

				if ( $result )
				{
					//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', '/prq/franchise/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 실패시 게시판 목록으로
					alert('다시 입력해 주세요.', '/prq/franchise/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//쓰기폼 view 호출
				$this->load->view('franchise/write_v');
			}
		}
		else
		{
			alert('로그인후 작성하세요', '/prq/auth/login/');
			exit;
		}
 	}

	/**
	 * 게시물 수정
	 */
	function modify()
 	{
		$class=$this->uri->segment(1);
		$table=$this->uri->segment(3);
		$mb_no=$this->uri->segment(5);
		$page=$this->uri->segment(7);

		$data['list_link']=sprintf("/prq/%s/lists/%s/page/%s",$class,$table,$page);
		$data['modify_link']=sprintf("/prq/%s/modify/%s/mb_no/%s/page/%s",$class,$table,$mb_no,$page);
		$data['delete_link']=sprintf("/prq/%s/delete/%s/mb_no/%s/page/%s",$class,$table,$mb_no,$page);
		$data['write_link']=sprintf("/prq/%s/write/%s/page/%s",$class,$table,$page);
 		
		//경고창 헬퍼 로딩
	 	$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		//주소중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if( in_array('page', $uri_array) )
		{
			$pages = urldecode($this->url_explode($uri_array, 'page'));
		}
		else
		{
			$pages = 1;
		}

		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			//수정하려는 글의 작성자가 본인인지 검증
			$writer_id = $this->franchise_m->writer_check($this->uri->segment(3), $this->uri->segment(5));
/*
			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/prq/franchise/view/'.$this->uri->segment(3).'/franchise_id/'.$this->uri->segment(5).'/page/'.$pages);
				exit;
			}
*/
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('mb_addr1', '주소1', 'required');
			$this->form_validation->set_rules('mb_addr2', '주소2', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				if ( !$this->input->post('mb_id', TRUE) AND !$this->input->post('mb_addr1', TRUE) )
				{
					//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
					alert('비정상적인 접근입니다.', '/prq/franchise/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}

				//var_dump($_POST);
				/*
				$modify_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'franchise_id' => $this->uri->segment(5), //게시물번호
					'subject' => $this->input->post('subject', TRUE),
					'contents' => $this->input->post('contents', TRUE)
				);

				$result = $this->franchise_m->modify_franchise($modify_data);
*/
				$modify_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'mb_no' => $this->uri->segment(5), //게시판 번호
					'mb_id' => $this->input->post('mb_id', TRUE),
					'mb_email' => $this->input->post('mb_email', TRUE),
					'mb_name' => $this->input->post('mb_name', TRUE),
					'prq_fcode' => $this->input->post('prq_fcode', TRUE),
					'mb_birth' => $this->input->post('mb_birth', TRUE),
					'mb_addr1' => $this->input->post('mb_addr1', TRUE),
					'mb_addr2' => $this->input->post('mb_addr2', TRUE),
					'mb_addr3' => $this->input->post('mb_addr3', TRUE),
					'mb_password' => $this->input->post('mb_password', TRUE),
					'mb_hp' => $this->input->post('mb_hp', TRUE),
					'mb_ceoname' => $this->input->post('mb_ceoname', TRUE),
					'mb_business_num' => $this->input->post('mb_business_num', TRUE),
					'mb_exactcaculation_ratio' => $this->input->post('mb_exactcaculation_ratio', TRUE),
					'mb_bankname' => $this->input->post('mb_bankname', TRUE),
					'mb_banknum' => $this->input->post('mb_banknum', TRUE),
					'mb_bankholder' => $this->input->post('mb_bankholder', TRUE),
					'mb_bigo' => $this->input->post('mb_bigo', TRUE),
					'mb_business_paper' => $this->input->post('mb_business_paper', TRUE),
					'mb_distributors_paper' => $this->input->post('mb_distributors_paper', TRUE),
					'mb_bank_paper' => $this->input->post('mb_bank_paper', TRUE),
					'mb_business_paper_size' => $this->input->post('mb_business_paper_size', TRUE),
					'mb_distributors_paper_size' => $this->input->post('mb_distributors_paper_size', TRUE),
					'mb_bank_paper_size' => $this->input->post('mb_bank_paper_size', TRUE)
				);
//				$result = $this->distributors_m->insert_distributors($write_data);
				$modify_mno_data = array(
					'mn_id' => $this->input->post('mb_id', TRUE),
					'mn_email' => $this->input->post('mb_email', TRUE),
					'mn_hp' => $this->input->post('mb_hp', TRUE),
					'mn_dup_limit' => $this->input->post('mn_dup_limit', TRUE),
					'mn_mms_limit' => $this->input->post('mn_mms_limit', TRUE)
				);
				$result2 = $this->franchise_m->modify_mno($modify_mno_data);

				$result = $this->franchise_m->modify_franchise($modify_data);

				if ( $result )
				{
					//글 작성 성공시 게시판 목록으로
					alert('수정되었습니다.', '/prq/franchise/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 수정 실패시 글 내용으로
					alert('다시 수정해 주세요.', '/prq/franchise/view/'.$this->uri->segment(3).'/mb_no/'.$this->uri->segment(5).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//게시물 내용 가져오기
				$data['views'] = $this->franchise_m->get_view($this->uri->segment(3), $this->uri->segment(5));

				//쓰기폼 view 호출
				$this->load->view('franchise/modify_v', $data);
			}
		}
		else
		{
			alert('로그인후 수정하세요', '/prq/auth/login/');
			exit;
		}
 	}

	/**
	 * 게시물 삭제
	 */
	function delete()
 	{
		//경고창 헬퍼 로딩
	 	$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			//삭제하려는 글의 작성자가 본인인지 검증
			$table = $this->uri->segment(3);
			$board_id = $this->uri->segment(5);

			$writer_id = $this->franchise_m->writer_check($table, $board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/prq/franchise/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
				exit;
			}

			//게시물 번호에 해당하는 게시물 삭제
			$return = $this->franchise_m->delete_content($this->uri->segment(3), $this->uri->segment(5));

			//게시물 목록으로 돌아가기
			if ( $return )
			{
				//삭제가 성공한 경우
				alert('삭제되었습니다.', '/prq/franchise/lists/'.$this->uri->segment(3).'/page/'.$this->uri->segment(7));
			}
			else
			{
				//삭제가 실패한 경
				alert('삭제 실패하였습니다.', '/prq/franchise/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
			}
		}
		else
		{
			alert('로그인후 삭제하세요', '/prq/auth/login/');
			exit;
		}
 	}

	/**
	 * url중 키값을 구분하여 값을 가져오도록.
	 *
	 * @param Array $url : segment_explode 한 url값
	 * @param String $key : 가져오려는 값의 key
	 * @return String $url[$k] : 리턴값
	 */
	function url_explode($url, $key)
	{
		$cnt = count($url);
		for($i=0; $cnt>$i; $i++ )
		{
			if($url[$i] ==$key)
			{
				$k = $i+1;
				return $url[$k];
			}
		}
	}

	/**
	 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
	 *
	 * @param	string	대상이 되는 문자열
	 * @return	string[]
	 */
	function segment_explode($seg)
	{
		//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/')
		{
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if(substr($seg, -1) == '/')
		{
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}

	/* 가맹점 상태 보기 */
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

	/*prq_fcode 별 상점 갯수 반환 하기*/
	function get_store_cnt($code){
		$count = $this->franchise_m->get_store_cnt($code);
		return $count;
	}
}

/* End of file franchise.php */
/* Location: ./prq/application/controllers/franchise.php */