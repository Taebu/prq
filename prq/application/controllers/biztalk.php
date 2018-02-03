<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 비즈톡 메인 모바일 뷰 controller.
 * 생성 : 2018-02-02 (금) 17:06:24 
 * @author Taebu,Moon<mtaebu@gmail.com>
 */
class Biztalk extends CI_Controller {
 
 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('biztalk_m');
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

		if($method=="modify")
		{
			//헤더 include
			$this->load->view('header_write_v');
			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}
			//푸터 include		
			$this->load->view('footer_blog_v');
		}else if($method=="write"||$method=="event")
		{
			//헤더 include
			$this->load->view('header_write_v');
			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}
			//푸터 include		
			$this->load->view('footer_blogone_v');
		}else if($method=="writeone")
		{
			//헤더 include
			$this->load->view('header_write_v');
			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}
			//푸터 include		
			$this->load->view('footer_blogone_v');
		}else{
			//헤더 include
			$this->load->view('header_write_v');
			//
			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
				//$this->view();
			}
			//$this->view();

			//푸터 include		
			//$this->load->view('footer_write_v');
			$this->load->view('footer_blog_v');
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
		
		
		if(strlen($this->input->get('q'))>0)
		{
			$search_word = urldecode($this->input->get('q'));
		}
		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');
		$search_array = array(
			'mb_name'=>$this->input->post('mb_name', TRUE),
			'st_name'=>$this->input->post('st_name', TRUE),
			'st_no'=>$this->input->post('st_no', TRUE),
			'mb_id'=>$this->input->post('mb_id', TRUE),
			'mb_email'=>$this->input->post('mb_email', TRUE),
			'bl_datetime'=>$this->input->post('bl_datetime', TRUE),
			'mb_hp'=>$this->input->post('mb_hp', TRUE)
		);

		$config = array(
		//페이지네이션 기본 설정
		'base_url'=> '/prq/biztalk/lists/prq_store'.$page_url.'/page/',
//		'total_rows' => $this->biztalk_m->get_list("prq_blog", 'count', '', '', $search_word),
//		'total_rows' => $this->logs_m->get_list($this->uri->segment(3), 'count', '', '', $search_word),
		'total_rows' => $this->biztalk_m->get_list2("prq_blog", 'count', '', '', $search_array),

		'per_page' => 15,
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

		/* 검색한 값들 상세 검색 배열*/
		$data['search']=$search_array;
		
		if ( $page > 1 )
		{
			$start = (($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
			$start = ($page-1) * $config['per_page'];
		}

		$limit = $config['per_page'];

		//$data['list'] = $this->biztalk_m->get_list("prq_blog", '', $start, $limit, $search_word);
		$data['list'] = $this->biztalk_m->get_list2("prq_blog", '', $start, $limit, $search_array);

		$this->load->view('biztalk/list_v', $data);
	}

	/**
	 * 게시물 보기
	 */
	function view()
 	{
		$table = "bt_plusfriend";
//		$board_id = $this->uri->segment(5);
		$board_id =$this->uri->segment(3);
		$is_test=$this->uri->segment(3)=="test";
		$mobile=$this->uri->segment(3)=="mobile";

 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		$data['views'] = $this->biztalk_m->get_view($table, $board_id);
		//$array = json_decode(json_encode($data['views']),true);
		//$data['files'] = $this->biztalk_m->get_files($array);
		//$data['store'] = $this->biztalk_m->get_store($array);
		//$isMobile = $this->check_user_agent('mobile');
		//$array = json_decode(json_encode($data['store']),true);
		//$data['friends'] = $this->biztalk_m->get_friends($array);
		$this->load->view('biztalk/view_v', $data);
 	}

 	/**
	 * 게시물 쓰기
	 */
	function write()
 	{
		//경고창 헬퍼 로딩
		$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		//if( @$this->session->userdata('logged_in') == TRUE )
		if(TRUE)
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', '상점이름', 'required');
			$this->form_validation->set_rules('st_no', '상점번호', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				$this->load->model('biztalk_m');
				//주소중에서 blog 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$img_src=$this->input->post('img_src', TRUE);

				//$this->input->post(NULL, TRUE); 
				$array_content=$this->input->post('content', TRUE);
				
				$write_data = array(
					'st_no' => $this->input->post('st_no', TRUE),
					'st_name' => $this->input->post('st_name', TRUE),
					'bl_imgprefix' => $this->input->post('bl_imgprefix', TRUE),
					'bl_file' => $this->input->post('bl_file', TRUE),
					'bl_name' => $this->input->post('bl_name', TRUE),
					'bl_hp' => $this->input->post('bl_hp', TRUE),
					'content1' => $array_content[0],
					'content2' => $array_content[1],
					'content3' => $array_content[2],
					'bl_gifticon_type' => $this->input->post('bl_gifticon_type', TRUE),
					'post_data' => $this->input->post(null, TRUE),
				);
				$result = $this->biztalk_m->insert_blog($write_data);
				//print_r($result);
				
				
				for($i=0;$i<count($img_src);$i++)
				{
					//echo $is;
					$filelocation=getcwd().'/uploads/'.$this->input->post('bl_imgprefix', TRUE)."/".$img_src[$i];
					$files=getimagesize($filelocation);

					$write_data = array(
						'pr_table' => "review",
						'bl_no' => $result['insert_id'],
						'bf_no' => $i,
						'bf_source' => $img_src[$i],
						'bf_file' => $img_src[$i],
						'bf_download' => "0",
						'bf_content' => $this->input->post('bl_imgprefix', TRUE),
						'bf_filesize' => filesize($filelocation),
						'bf_width' => $files[0],
						'bf_height' => $files[1],
						'bf_type' => $files[2],
					);
					//print_r($write_data);
					$result2 = $this->biztalk_m->insert_file($write_data);
					//echo $result2;
				} /*for($i=0;$i<=count($img_src);$i++){ ... } */

				if ( $result['result'] )
				{
					//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', '/prq/biztalk/cview/'.$result['insert_id']);
					exit;
				}
				else
				{
					//글 실패시 게시판 목록으로
					alert('다시 입력해 주세요.', '/prq/biztalk/write/'.$this->uri->segment(3));
					exit;
				}

			}
			else
			{
				//쓰기폼 view 호출
				//$this->load->view('biztalk/write_v');	
				$this->load->view('biztalk/write_v');	
			}
		}
		else
		{
			//alert('로그인후 작성하세요', '/prq/auth/login/');
			//exit;
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
		$is_bug=$this->uri->segment(4)=="bug_test";
		if( in_array('page', $uri_array) )
		{
			$pages = urldecode($this->url_explode($uri_array, 'page'));
		}
		else
		{
			$pages = 1;
		}

		if( @$this->session->userdata('logged_in') == TRUE ||$is_bug)
		{
			//수정하려는 글의 작성자가 본인인지 검증
			//$writer_id = $this->biztalk_m->writer_check($this->uri->segment(3), $this->uri->segment(5));
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
			$this->form_validation->set_rules('st_no', 'st_no', 'required');
			//$this->form_validation->set_rules('mb_addr2', '주소2', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
//				if ( !$this->input->post('mb_id', TRUE) AND !$this->input->post('mb_addr1', TRUE) )
				if ( !$this->input->post('st_no', TRUE))
				{
					//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
					alert('비정상적인 접근입니다.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}


				$this->load->model('biztalk_m');
				//주소중에서 blog 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$img_src=$this->input->post('img_src', TRUE);

				//$this->input->post(NULL, TRUE); 
				$array_content=$this->input->post('content', TRUE);
				
				$write_data = array(
					'table' => "prq_blog",
					'st_no' => $this->input->post('st_no', TRUE),
					'bl_no' => $this->input->post('bl_no', TRUE),
					'bl_imgprefix' => $this->input->post('bl_imgprefix', TRUE),
					'bl_file' => $this->input->post('bl_file', TRUE),
					'bl_name' => $this->input->post('bl_name', TRUE),
					'bl_hp' => $this->input->post('bl_hp', TRUE),
					'content1' => $array_content[0],
					'content2' => $array_content[1],
					'content3' => $array_content[2],
					'post_data' => $this->input->post(null, TRUE),
				);
				$result = $this->biztalk_m->modify_blog($write_data);
				

				if ( $result3 )
				{
					//글 작성 성공시 게시판 목록으로
					alert('수정되었습니다.', '/prq/biztalk/view/'.$this->input->post('bl_no', TRUE).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 수정 실패시 글 내용으로
					alert('다시 수정해 주세요.', '/prq/biztalk/modify/'.$this->input->post('bl_no', TRUE).'/board_id/'.$this->uri->segment(5).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//게시물 내용 가져오기
				$data['views'] = $this->biztalk_m->get_view("bt_plusfriend", $this->uri->segment(3));
				//$array = json_decode(json_encode($data['views']),true);
				//파일 정보 가져오기
				//$data['files'] = $this->biztalk_m->get_files($array);


				//member 정보 가져오기
				//$data['store'] = $this->biztalk_m->get_store($array);
				//$arrays = json_decode(json_encode($data['store']),true);
				
				//member 정보 가져오기
				//$data['member'] = $this->biztalk_m->get_member($arrays);


				//쓰기폼 view 호출
				$this->load->view('biztalk/modify_v', $data);
			}
		}
		else
		{
			alert('로그인후 수정하세요', '/prq/auth/login/');
			exit;
		}
 	}

	/**
	 * 게시물 수정
	 */
	function modify2()
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
			//$writer_id = $this->biztalk_m->writer_check($this->uri->segment(3), $this->uri->segment(5));
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
			$this->form_validation->set_rules('st_no', 'st_no', 'required');
			//$this->form_validation->set_rules('mb_addr2', '주소2', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
//				if ( !$this->input->post('mb_id', TRUE) AND !$this->input->post('mb_addr1', TRUE) )
				if ( !$this->input->post('st_no', TRUE))
				{
					//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
					alert('비정상적인 접근입니다.', '/prq/store/lists/'.$this->uri->segment(3).'/page/'.$pages);
					exit;
				}


				$this->load->model('biztalk_m');
				//주소중에서 blog 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$img_src=$this->input->post('img_src', TRUE);

				//$this->input->post(NULL, TRUE); 
				$array_content=$this->input->post('content', TRUE);
				
				$write_data = array(
					'table' => "prq_blog",
					'st_no' => $this->input->post('st_no', TRUE),
					'bl_no' => $this->input->post('bl_no', TRUE),
					'bl_imgprefix' => $this->input->post('bl_imgprefix', TRUE),
					'bl_file' => $this->input->post('bl_file', TRUE),
					'bl_name' => $this->input->post('bl_name', TRUE),
					'bl_hp' => $this->input->post('bl_hp', TRUE),
					'content1' => $array_content[0],
					'content2' => $array_content[1],
					'content3' => $array_content[2],
					'post_data' => $this->input->post(null, TRUE),
				);
				$result = $this->biztalk_m->modify_blog($write_data);
				$result2 = $this->biztalk_m->delete_file($write_data);
				
				for($i=0;$i<count($img_src);$i++)
				{
					//echo $is;
					$filelocation=getcwd().'/uploads/'.$this->input->post('bl_imgprefix', TRUE)."/".$img_src[$i];
					$files=getimagesize($filelocation);

					$write_data = array(
						'pr_table' => "review",
						'bl_no' => $this->input->post('bl_no', TRUE),
						'bf_no' => $i,
						'bf_source' => $img_src[$i],
						'bf_file' => $img_src[$i],
						'bf_download' => "0",
						'bf_content' => $this->input->post('bl_imgprefix', TRUE),
						'bf_filesize' => filesize($filelocation),
						'bf_width' => $files[0],
						'bf_height' => $files[1],
						'bf_type' => $files[2],
					);
					//print_r($write_data);
					$result3 = $this->biztalk_m->insert_file($write_data);
					echo $result3;
				} /*for($i=0;$i<=count($img_src);$i++){ ... } */

				if ( $result3 )
				{
					//글 작성 성공시 게시판 목록으로
					alert('수정되었습니다.', '/prq/biztalk/view/'.$this->input->post('bl_no', TRUE).'/page/'.$pages);
					exit;
				}
				else
				{
					//글 수정 실패시 글 내용으로
					alert('다시 수정해 주세요.', '/prq/biztalk/modify/'.$this->input->post('bl_no', TRUE).'/board_id/'.$this->uri->segment(5).'/page/'.$pages);
					exit;
				}

			}
			else
			{
				//게시물 내용 가져오기
				$data['views'] = $this->biztalk_m->get_view("prq_blog", $this->uri->segment(3));
				$array = json_decode(json_encode($data['views']),true);
				//파일 정보 가져오기
				$data['files'] = $this->biztalk_m->get_files($array);


				//member 정보 가져오기
				$data['store'] = $this->biztalk_m->get_store($array);
				$arrays = json_decode(json_encode($data['store']),true);
				
				//member 정보 가져오기
				$data['member'] = $this->biztalk_m->get_member($arrays);


				//쓰기폼 view 호출
				$this->load->view('biztalk/modify2_v', $data);
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

			$writer_id = $this->biztalk_m->writer_check($table, $board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/prq/store/view/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5).'/page/'.$this->uri->segment(7));
				exit;
			}

			//게시물 번호에 해당하는 게시물 삭제
			$return = $this->biztalk_m->delete_content($this->uri->segment(3), $this->uri->segment(5));

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

	/**
	 * 게시물 보기
	 */
	function cview()
 	{
		$table = "prq_blog";
//		$board_id = $this->uri->segment(5);
		$board_id =$this->uri->segment(3);
		$is_test=$this->uri->segment(3)=="test";
		$mobile=$this->uri->segment(3)=="mobile";

 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		$data['views'] = $this->biztalk_m->get_view($table, $board_id);
		$array = json_decode(json_encode($data['views']),true);
		$data['files'] = $this->biztalk_m->get_files($array);
		$data['store'] = $this->biztalk_m->get_store($array);
		//$isMobile = $this->check_user_agent('mobile');

		$this->load->view('biztalk/view_custom_v', $data);
 	}



	/**
	 * 게시물 하나만 쓰기
	 */
	function writeone()
 	{
		//경고창 헬퍼 로딩
		$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		//if( @$this->session->userdata('logged_in') == TRUE )
		if(TRUE)
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', '상점이름', 'required');
			$this->form_validation->set_rules('st_no', '상점번호', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				$this->load->model('biztalk_m');
				//주소중에서 blog 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$img_src=$this->input->post('img_src', TRUE);

				//$this->input->post(NULL, TRUE); 
				$array_content=$this->input->post('content', TRUE);
				
				$write_data = array(
					'st_no' => $this->input->post('st_no', TRUE),
					'st_name' => $this->input->post('st_name', TRUE),
					'bl_imgprefix' => $this->input->post('bl_imgprefix', TRUE),
					'bl_file' => $this->input->post('bl_file', TRUE),
					'bl_name' => $this->input->post('bl_name', TRUE),
					'bl_hp' => $this->input->post('bl_hp', TRUE),
					'content1' => $array_content[0],
					'content2' => $array_content[1],
					'content3' => $array_content[2],
					'bl_gifticon_type' => $this->input->post('bl_gifticon_type', TRUE),
					'post_data' => $this->input->post(null, TRUE),
				);
				$result = $this->biztalk_m->insert_blog($write_data);
				//print_r($result);
				
				
				for($i=0;$i<count($img_src);$i++)
				{
					//echo $is;
					$filelocation=getcwd().'/uploads/'.$this->input->post('bl_imgprefix', TRUE)."/".$img_src[$i];
					$files=getimagesize($filelocation);

					$write_data = array(
						'pr_table' => "review",
						'bl_no' => $result['insert_id'],
						'bf_no' => $i,
						'bf_source' => $img_src[$i],
						'bf_file' => $img_src[$i],
						'bf_download' => "0",
						'bf_content' => $this->input->post('bl_imgprefix', TRUE),
						'bf_filesize' => filesize($filelocation),
						'bf_width' => $files[0],
						'bf_height' => $files[1],
						'bf_type' => $files[2],
					);
					//print_r($write_data);
					$result2 = $this->biztalk_m->insert_file($write_data);
					//echo $result2;
				} /*for($i=0;$i<=count($img_src);$i++){ ... } */

				if ( $result['result'] )
				{
					//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', '/prq/biztalk/cview/'.$result['insert_id']);
					exit;
				}
				else
				{
					//글 실패시 게시판 목록으로
					alert('다시 입력해 주세요.', '/prq/biztalk/write/'.$this->uri->segment(3));
					exit;
				}

			}
			else
			{
				//쓰기폼 view 호출
				$this->load->view('biztalk/writeone_v');	
			}
		}
		else
		{
			//alert('로그인후 작성하세요', '/prq/auth/login/');
			//exit;
		}
 	}

	/**
	 * curl refresh token
	 */
	function get_curl($param)
	{
		// Get cURL resource
		$curl = curl_init();
		$url = "https://nid.naver.com/oauth2.0/token?".$param;
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		
		// Close request to clear up some resources
		curl_close($curl);

		return json_decode($resp, true);
	}
	
 	/**
	 * 게시물 event 쓰기
	 */
	function event()
 	{
		//경고창 헬퍼 로딩
		$this->load->helper('alert');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		//if( @$this->session->userdata('logged_in') == TRUE )
		if(TRUE)
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('st_name', '상점이름', 'required');
			$this->form_validation->set_rules('st_no', '상점번호', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				$this->load->model('biztalk_m');
				//주소중에서 blog 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
				$uri_array = $this->segment_explode($this->uri->uri_string());

				$pages = in_array('page', $uri_array)?urldecode($this->url_explode($uri_array, 'page')):1;

				$img_src=$this->input->post('img_src', TRUE);

				//$this->input->post(NULL, TRUE); 
				$array_content=$this->input->post('content', TRUE);
				
				$write_data = array(
					'st_no' => $this->input->post('st_no', TRUE),
					'st_name' => $this->input->post('st_name', TRUE),
					'bl_imgprefix' => $this->input->post('bl_imgprefix', TRUE),
					'bl_file' => $this->input->post('bl_file', TRUE),
					'bl_name' => $this->input->post('bl_name', TRUE),
					'bl_hp' => $this->input->post('bl_hp', TRUE),
					'content1' => $array_content[0],
					'content2' => $array_content[1],
					'content3' => $array_content[2],
					'bl_gifticon_type' => $this->input->post('bl_gifticon_type', TRUE),
					'post_data' => $this->input->post(null, TRUE),
				);
				$result = $this->biztalk_m->insert_blog($write_data);
				//print_r($result);
				
				
				for($i=0;$i<count($img_src);$i++)
				{
					//echo $is;
					$filelocation=getcwd().'/uploads/'.$this->input->post('bl_imgprefix', TRUE)."/".$img_src[$i];
					$files=getimagesize($filelocation);

					$write_data = array(
						'pr_table' => "review",
						'bl_no' => $result['insert_id'],
						'bf_no' => $i,
						'bf_source' => $img_src[$i],
						'bf_file' => $img_src[$i],
						'bf_download' => "0",
						'bf_content' => $this->input->post('bl_imgprefix', TRUE),
						'bf_filesize' => filesize($filelocation),
						'bf_width' => $files[0],
						'bf_height' => $files[1],
						'bf_type' => $files[2],
					);
					//print_r($write_data);
					$result2 = $this->biztalk_m->insert_file($write_data);
					//echo $result2;
				} /*for($i=0;$i<=count($img_src);$i++){ ... } */

				if ( $result['result'] )
				{
					//글 작성 성공시 게시판 목록으로
					alert('입력되었습니다.', '/prq/biztalk/cview/'.$result['insert_id']);
					exit;
				}
				else
				{
					//글 실패시 게시판 목록으로
					alert('다시 입력해 주세요.', '/prq/biztalk/event/'.$this->uri->segment(3));
					exit;
				}

			}
			else
			{
				//쓰기폼 view 호출
				//$this->load->view('biztalk/write_v');	
				$this->load->view('biztalk/event_v');	
			}
		}
		else
		{
			//alert('로그인후 작성하세요', '/prq/auth/login/');
			//exit;
		}
 	}


}

/* End of file blog.php */
/* Location: ./application/controllers/blog.php */