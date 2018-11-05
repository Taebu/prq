<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 상점 메인 controller.
 * 생성 : 2018-02-08 (목) 12:49:50 
 * @author Taebu,Moon<mtaebu@gmail.com>
 * 
 */
class Atapay extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('atapay_m');
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
			$this->load->view('footer_store_write_v');
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
		$search_array = array(
			'st_name'=>$this->input->post('st_name', TRUE),
			'mb_id'=>$this->input->post('mb_id', TRUE),
			'prq_fcode'=>$this->input->post('prq_fcode', TRUE)
		);
 		
		$this->load->library('pagination');

		$config = array(
		//페이지네이션 기본 설정
		'base_url'=> '/prq/atapay/lists/prq_ata_pay'.$page_url.'/page/',
		'total_rows' => $this->atapay_m->get_list2($this->uri->segment(3), 'count', '', '', $search_array),
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
		'cur_tag_open'	=> '<li class="active"><a href="#">',
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

		$data['list'] = $this->atapay_m->get_list2($this->uri->segment(3), '', $start, $limit, $search_array);
		$data['group_cnt'] =  json_decode(json_encode($this->atapay_m->get_groupcnt("prq_ata_pay")), True);
		//echo "prq_ata_pay";
		$data['store'] = $this->atapay_m->get_store_ata($data['list']);		
		$data['store']=json_decode(json_encode($data['store']), True);
		$data['store'] = array_column($data['store'], 'st_ata_YN','st_no');

		
		$data['pt_code'] = $this->atapay_m->get_ptcode($data['list']);		
		$data['pt_code']=json_decode(json_encode($data['pt_code']), True);

		$data['pt_code'] = array_column($data['pt_code'], 'pt_name','pt_code');
		$this->load->view('store/ata_pay/list_v', $data);
	}

	/**
	 * 게시물 보기
	 */
	function view()
 	{
		$table = $this->uri->segment(3);
		$board_id = $this->uri->segment(5);
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		$data['views'] = $this->atapay_m->get_view($table, $board_id);
		$array=json_decode(json_encode($data['views']), True);
		$data['logs'] = $this->atapay_m->get_logs($array);
		$data['store'] = $this->atapay_m->get_store();
		$data['plusfriend'] = $this->atapay_m->get_plusfriend();
		$data['template'] = $this->atapay_m->get_template();
		$data['member'] = $this->atapay_m->get_member();

 		//view 호출
 		$this->load->view('store/ata_pay/view_v', $data);
 	}

 	/**
	 * 게시물 쓰기
	 */
	function write()
 	{
		//경고창 헬퍼 로딩
		$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		if( @$this->session->userdata('logged_in') == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE )
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');
			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', '매장명', 'required');
			if ( $this->form_validation->run() == TRUE )
			{
				$this->load->model('atapay_m');
				//주소중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());
				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;
				$write_data = $this->input->post(NULL, TRUE);
				$result = $this->atapay_m->insert_atapay($write_data);
				if($result)
				{
					//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', '/prq/atapay/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 실패시 게시판 목록으로
					alert('다시 입력해 주세요.', '/prq/atapay/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
			}
			else
			{
				//쓰기폼 view 호출
		$data['plusfriend'] = $this->atapay_m->get_plusfriend();
		$data['template'] = $this->atapay_m->get_template();
				$this->load->view('store/ata_pay/write_v',$data);	
			}
		}
		else
		{
			alert('로그인후 작성하세요', '/prq/auth/login/');
			exit;
		}
 	}


	/**
	 * 알림톡 결재 정보 수정
	 * 2018-02-08 (목) 13:50:06 
	 */
	function modify()
 	{
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

		if( @$this->session->userdata('logged_in') == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE )
		{
			//수정하려는 글의 작성자가 본인인지 검증
			$writer_id = $this->atapay_m->writer_check($this->uri->segment(3), $this->uri->segment(5));
/*
			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/prq/atapay/view/'.$this->uri->segment(3).'/store_id/'.$this->uri->segment(5).'/page/'.$pages);
				exit;
			}
*/
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', 'st_name', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				if ( !$this->input->post('st_name', TRUE))
				{
					//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
					alert('비정상적인 접근입니다.', '/prq/atapay/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}

				$modify_data = $this->input->post(NULL, TRUE);
				$result = $this->atapay_m->modify_atapay($modify_data);
				if ( $result )
				{
					//글 작성 성공시 게시판 목록으로
					alert('수정되었습니다.', '/prq/atapay/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 수정 실패시 글 내용으로
					alert('다시 수정해 주세요.', '/prq/atapay/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//게시물 내용 가져오기
				$data['views'] = $this->atapay_m->get_view($this->uri->segment(3), $this->uri->segment(5));
				$array=json_decode(json_encode($data['views']), True);
				$data['logs'] = $this->atapay_m->get_logs($array);
				$data['store'] = $this->atapay_m->get_store();
				$data['plusfriend'] = $this->atapay_m->get_plusfriend();
				$data['template'] = $this->atapay_m->get_template();
				$data['member'] = $this->atapay_m->get_member();
				//쓰기폼 view 호출
				$this->load->view('store/ata_pay/modify_v', $data);
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
			$page=$this->uri->segment(7);
			$writer_id = $this->atapay_m->writer_check($table, $board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', sprintf('/prq/atapay/view/%s/board_id/%s/page/%s',$table,$board_id,$page));
				exit;
			}

			//게시물 번호에 해당하는 게시물 삭제
			$return = $this->atapay_m->delete_content($table,$board_id);

			//게시물 목록으로 돌아가기
			if ( $return )
			{
				//삭제가 성공한 경우
				alert('삭제되었습니다.', sprintf('/prq/atapay/lists/%s/page/%s',$table,$page));
			}
			else
			{
				//삭제가 실패한 경
				alert('삭제 실패하였습니다.', sprintf('/prq/atapay/view/%s/board_id/%s/page/%s',$table,$board_id,$page));
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
}
/* End of file atapay.php */
/* Location: ./application/controllers/atapay.php */