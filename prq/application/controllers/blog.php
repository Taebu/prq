<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 블로그 메인 모바일 뷰 controller.
 * 생성 : 2016-11-14 (월)
 * @author Taebu,Moon<mtaebu@gmail.com>
 */
class Blog extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('blog_m');
		$this->load->helper('form');
		$this->load->library('curl'); 
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
				//$this->{"{$method}"}();
				$this->view();
			}
			//$this->view();
			//푸터 include		
			$this->load->view('footer_blog_v');
		}else{
			//헤더 include
			$this->load->view('header_write_v');
			//
			if( method_exists($this, $method) )
			{
				//$this->{"{$method}"}();
				$this->view();
			}
			$this->view();

			//푸터 include		
			$this->load->view('footer_write_v');
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


		$config = array(
		//페이지네이션 기본 설정
		'base_url'=> '/prq/store/lists/prq_store'.$page_url.'/page/',
		'total_rows' => $this->blog_m->get_list($this->uri->segment(3), 'count', '', '', $search_word),
		'per_page' => 5,
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
//		'cur_tag_open'	=> '<li class="disabled"><a href="#">',
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

		$data['list'] = $this->blog_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
		$this->load->view('store/list_v', $data);
	}

	/**
	 * 게시물 보기
	 */
	function view()
 	{
		$table = "prq_store";
//		$board_id = $this->uri->segment(5);
		$board_id =$this->uri->segment(2);
		$is_test=$this->uri->segment(3)=="test";
		$mobile=$this->uri->segment(3)=="mobile";

 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		$data['views'] = $this->blog_m->get_view($table, $board_id);

		//게시판 이름과 게시물 번호에 해당하는 댓글 리스트 가져오기
 		//$data['comment_list'] = $this->blog_m->get_comment($table, $board_id);

 		//view 호출
 		$config=array('clientId'=>'aWWbsFdRSNQZL6Df5ATr');
		$data['curl']=$this->curl->simple_get('http://openapi.map.naver.com/openapi/v2/maps.js', $config, array(CURLOPT_BUFFERSIZE => 10)); 
		$isMobile = $this->check_user_agent('mobile');

		if($is_test){
			$this->load->view('blog/view2_v', $data);
		}else{
			$this->load->view('blog/view_v', $data);
		}
 	}

 	/**
	 * 게시물 쓰기
	 */
	function write()
 	{
		//경고창 헬퍼 로딩
		$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		if( @$this->session->userdata('logged_in') == TRUE )
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', '상점이름', 'required');
			$this->form_validation->set_rules('st_tel', '상점번호', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				$this->load->model('blog_m');
				//주소중에서 blog 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$write_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'prq_fcode' => $this->input->post('prq_fcode', TRUE),
					'st_category' => $this->input->post('st_category', TRUE),
					'st_name' => $this->input->post('st_name', TRUE),
					'st_tel' => $this->input->post('st_tel', TRUE),
					'mb_id' => $this->input->post('mb_id', TRUE),
					'st_open' => $this->input->post('st_open', TRUE),
					'st_closed' => $this->input->post('st_closed', TRUE),
					'st_alltime' => $this->input->post('st_alltime', TRUE),
					'st_mno' => $this->input->post('st_mno', TRUE),
//					'st_closingdate' => $this->input->post('st_closingdate', TRUE),
					'st_closingdate' => join(",",$this->input->post('st_closingdate', TRUE)),
					'st_destination' => $this->input->post('st_destination', TRUE),
					'st_intro' => $this->input->post('st_intro', TRUE),
					'st_password' => $this->input->post('st_password', TRUE),
					'st_nick' => $this->input->post('st_nick', TRUE),
					'st_nick_date' => $this->input->post('st_nick_date', TRUE),
					'st_email' => $this->input->post('st_email', TRUE),
					'st_homepage' => $this->input->post('st_homepage', TRUE),
					'st_business_name' => $this->input->post('st_business_name', TRUE),
					'st_business_paper' => $this->input->post('st_business_paper', TRUE),
					'st_business_paper_size' => $this->input->post('st_business_paper_size', TRUE),
					'st_thumb_paper' => $this->input->post('st_thumb_paper', TRUE),
					'st_thumb_paper_size' => $this->input->post('st_thumb_paper_size', TRUE),
					'st_menu_paper' => $this->input->post('st_menu_paper', TRUE),
					'st_menu_paper_size' => $this->input->post('st_menu_paper_size', TRUE),
					'st_main_paper' => $this->input->post('st_main_paper', TRUE),
					'st_main_paper_size' => $this->input->post('st_main_paper_size', TRUE),
					'st_modoo_url' => $this->input->post('st_modoo_url', TRUE),
					'st_top_msg' => $this->input->post('st_top_msg', TRUE),
					'st_middle_msg' => $this->input->post('st_middle_msg', TRUE),
					'st_bottom_msg' => $this->input->post('st_bottom_msg', TRUE),
					'st_business_num' => $this->input->post('st_business_num', TRUE),
					'st_datetime' => $this->input->post('st_datetime', TRUE),
					'st_cidtype' => $this->input->post('st_cidtype', TRUE),
					'st_tel_1' => $this->input->post('st_tel_1', TRUE),
					'st_tel_2' => $this->input->post('st_tel_2', TRUE),
					'st_tel_3' => $this->input->post('st_tel_3', TRUE),
					'st_tel_4' => $this->input->post('st_tel_4', TRUE),
					'st_hp_1' => $this->input->post('st_hp_1', TRUE),
					'st_hp_2' => $this->input->post('st_hp_2', TRUE),
					'st_hp_3' => $this->input->post('st_hp_3', TRUE),
					'st_hp_4' => $this->input->post('st_hp_4', TRUE),
					'st_status' => $this->input->post('st_status', TRUE)
				);
				$result = $this->blog_m->insert_store($write_data);

				if ( $result )
				{
					//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 실패시 게시판 목록으로
					alert('다시 입력해 주세요.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//쓰기폼 view 호출
				$this->load->view('store/write_v');	
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

		if( @$this->session->userdata('logged_in') == TRUE )
		{
			//수정하려는 글의 작성자가 본인인지 검증
			$writer_id = $this->blog_m->writer_check($this->uri->segment(3), $this->uri->segment(5));
/*
			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/prq/store/view/'.$this->uri->segment(3).'/blog_id/'.$this->uri->segment(5).'/page/'.$pages);
				exit;
			}
*/
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', 'st_name', 'required');
			//$this->form_validation->set_rules('mb_addr2', '주소2', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
//				if ( !$this->input->post('mb_id', TRUE) AND !$this->input->post('mb_addr1', TRUE) )
				if ( !$this->input->post('st_name', TRUE))
				{
					//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
					alert('비정상적인 접근입니다.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}

				//var_dump($_POST);
				/*
				$modify_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'distributors_id' => $this->uri->segment(5), //게시물번호
					'subject' => $this->input->post('subject', TRUE),
					'contents' => $this->input->post('contents', TRUE)
				);

				$result = $this->page_m->modify_distributors($modify_data);
*/
				$modify_data = array(
					'table' => $this->uri->segment(3), //게시판 테이블명
					'st_no' => $this->uri->segment(5), //게시판 번호
					'prq_fcode' => $this->input->post('prq_fcode', TRUE),
					'st_category' => $this->input->post('st_category', TRUE),
					'st_name' => $this->input->post('st_name', TRUE),
					'mb_id' => $this->input->post('mb_id', TRUE),
					'st_tel' => $this->input->post('st_tel', TRUE),
					'st_open' => $this->input->post('st_open', TRUE),
					'st_closed' => $this->input->post('st_closed', TRUE),
					'st_alltime' => $this->input->post('st_alltime', TRUE),
					'st_mno' => $this->input->post('st_mno', TRUE),
					'st_closingdate' => join(",",$this->input->post('st_closingdate', TRUE)),
					'st_destination' => $this->input->post('st_destination', TRUE),
					'st_intro' => $this->input->post('st_intro', TRUE),
					'st_password' => $this->input->post('st_password', TRUE),
					'st_nick' => $this->input->post('st_nick', TRUE),
					'st_nick_date' => $this->input->post('st_nick_date', TRUE),
					'st_email' => $this->input->post('st_email', TRUE),
					'st_homepage' => $this->input->post('st_homepage', TRUE),
					'st_business_name' => $this->input->post('st_business_name', TRUE),
					'st_business_paper' => $this->input->post('st_business_paper', TRUE),
					'st_business_paper_size' => $this->input->post('st_business_paper_size', TRUE),
					'st_thumb_paper' => $this->input->post('st_thumb_paper', TRUE),
					'st_thumb_paper_size' => $this->input->post('st_thumb_paper_size', TRUE),
					'st_menu_paper' => $this->input->post('st_menu_paper', TRUE),
					'st_menu_paper_size' => $this->input->post('st_menu_paper_size', TRUE),
					'st_main_paper' => $this->input->post('st_main_paper', TRUE),
					'st_main_paper_size' => $this->input->post('st_main_paper_size', TRUE),
					'st_modoo_url' => $this->input->post('st_modoo_url', TRUE),
					'st_top_msg' => $this->input->post('st_top_msg', TRUE),
					'st_middle_msg' => $this->input->post('st_middle_msg', TRUE),
					'st_bottom_msg' => $this->input->post('st_bottom_msg', TRUE),
					'st_business_num' => $this->input->post('st_business_num', TRUE),
					'st_datetime' => $this->input->post('st_datetime', TRUE),
					'st_cidtype' => $this->input->post('st_cidtype', TRUE),
					'st_tel_1' => $this->input->post('st_tel_1', TRUE),
					'st_tel_2' => $this->input->post('st_tel_2', TRUE),
					'st_tel_3' => $this->input->post('st_tel_3', TRUE),
					'st_tel_4' => $this->input->post('st_tel_4', TRUE),
					'st_hp_1' => $this->input->post('st_hp_1', TRUE),
					'st_hp_2' => $this->input->post('st_hp_2', TRUE),
					'st_hp_3' => $this->input->post('st_hp_3', TRUE),
					'st_hp_4' => $this->input->post('st_hp_4', TRUE),
					'st_status' => $this->input->post('st_status', TRUE)
				);
//				$result = $this->distributors_m->insert_distributors($write_data);

				$result = $this->blog_m->modify_store($modify_data);

				if ( $result )
				{
					//글 작성 성공시 게시판 목록으로
					alert('수정되었습니다.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 수정 실패시 글 내용으로
					alert('다시 수정해 주세요.', '/prq/store/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//게시물 내용 가져오기
				$data['views'] = $this->blog_m->get_view($this->uri->segment(3), $this->uri->segment(5));

				//쓰기폼 view 호출
				$this->load->view('store/modify_v', $data);
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

		if( @$this->session->userdata('logged_in') == TRUE )
		{
			//삭제하려는 글의 작성자가 본인인지 검증
			$table = $this->uri->segment(3);
			$board_id = $this->uri->segment(5);

			$writer_id = $this->blog_m->writer_check($table, $board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/prq/store/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
				exit;
			}

			//게시물 번호에 해당하는 게시물 삭제
			$return = $this->blog_m->delete_content($this->uri->segment(3), $this->uri->segment(5));

			//게시물 목록으로 돌아가기
			if ( $return )
			{
				//삭제가 성공한 경우
				alert('삭제되었습니다.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$this->uri->segment(7));
			}
			else
			{
				//삭제가 실패한 경
				alert('삭제 실패하였습니다.', '/prq/store/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
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

	/* USER-AGENTS
	================================================== */
	function check_user_agent ( $type = NULL ) {
        $user_agent = strtolower ( $_SERVER['HTTP_USER_AGENT'] );
        if ( $type == 'bot' ) {
                // matches popular bots
                if ( preg_match ( "/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent ) ) {
                        return true;
                        // watchmouse|pingdom\.com are "uptime services"
                }
        } else if ( $type == 'browser' ) {
                // matches core browser types
                if ( preg_match ( "/mozilla\/|opera\//", $user_agent ) ) {
                        return true;
                }
        } else if ( $type == 'mobile' ) {
                // matches popular mobile devices that have small screens and/or touch inputs
                // mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
                // detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
                if ( preg_match ( "/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent ) ) {
                        // these are the most common
                        return true;
                } else if ( preg_match ( "/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent ) ) {
                        // these are less common, and might not be worth checking
                        return true;
                }
        }
        return false;
	}
}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */