<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlls extends CI_Controller {

	/**
	 * SNS 프로젝트 컨트롤러
	 */
	function __construct()
	{
		parent::__construct();
        $this->load->model('sns_m');
		$this->load->helper(array('form', 'date', 'url'));
		$this->load->database();
		$this->load->library('session');
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
	}

	/**
	 * 사이트 헤더, 푸터를 자동으로 추가해준다.
	 *
	 */
	public function _remap($method)
 	{
		if( BROWSER_TYPE == 'W' )
		{
			//헤더 include
			$this->load->view('header_v');

			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}

			//푸터 include
			$this->load->view('footer_v');
		}
		else if( BROWSER_TYPE == 'M' )
		{
			//모바일헤더 include
			$this->load->view('mobile_header_v');

			if( method_exists($this, $method) )
			{
				$this->{"{$method}"}();
			}

			//모바일푸터 include
			$this->load->view('mobile_footer_v');
		}
    }

	public function index()
	{
		$this->upload_photo();
	}

	function upload_photo()
	{
		if( @$this->session->userdata['logged_in'] == TRUE )
		{
			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('subject', '제목', 'required');
			$this->form_validation->set_rules('contents', '내용', 'required');

			if ( $this->form_validation->run() == FALSE )
			{
				$this->load->view('upload_photo_v');
			}
			else
			{
				// upload 설정
				$config = array(
					'upload_path' => 'uploads/',
					'allowed_types' => 'gif|jpg|png',
					'encrypt_name' => TRUE,
					'max_size' => '1000'
				);

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload())
				{
					$data['error'] = $this->upload->display_errors();

					$this->load->view('upload_photo_v', $data);
				}
				else
				{
					$upload_data = $this->upload->data();

					if($upload_data['image_width'] > 300)
					{
						//이미지 리사이즈.  파일명_thumb.확장자 형태로 썸네일 생성
						$config['image_library'] = 'gd2';
						$config['source_image'] = $upload_data['full_path'];
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 300;
						$config['height'] = 300;

						$this->load->library('image_lib', $config);

						$this->image_lib->resize();
					}

					$upload_data['subject'] = $this->input->post('subject', true);
					$upload_data['contents'] = $this->input->post('contents', true);
					$upload_data['user_id'] = $this->session->userdata('username');

					//a:4:{s:9:"file_size";i:12;s:11:"image_width";i:226;s:12:"image_height";i:150;s:8:"file_ext";s:4:".jpg";}
					$result = $this->sns_m->insert_sns($upload_data);

					redirect('/controlls/lists'); exit;

					//페이스북 전송
					if($result)
					{
						//sns 라이브러리 로드
						$this->load->library('sns');
						$this->facebook = $this->sns->facebook();
						$this->facebook->setCallback(site_url('upload_photo/facebook_upload/'.$result));

						if (!$this->facebook->isLoggedIn())
						{
							$this->facebook->login();
						}
					}
					else
					{
						echo "<script> alert('입력실패했습니다.'); </script>";
						redirect('/controlls/upload_photo');
					}

				}
			}
		}
		else
		{
			echo "<script>alert('로그인후 작성하세요');
			document.location = '/sns/auth/login/';
			</script>";
			exit;
		}
	}

	function facebook_upload()
	{
		//글 정보 가져오기
		$id = $this->uri->segment(3);
		$result = $this->sns_m->get_sns($id);

		//앨범 업로드
		$this->facebook->uploadPhoto($result['contents'], $result['file_path'].$result['file_name'], '');
		redirect('/cotrolls/lists');
	}

	function lists()
	{
		//검색어 초기화
		$search_word = '';

		//주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array = array_values($this->uri->segment_array());

		if( in_array('q', $uri_array) ) {
			//주소에 검색어가 있을 경우의 처리. 즉 검색시
			$search_word = urldecode($this->url_explode($uri_array, 'q'));
		}

		$data['list'] = $this->sns_m->get_sns_list('sns_files', '', 0, 6, $search_word);

		if( BROWSER_TYPE == 'M' )
		{
			$this->load->view('mobile_lists_v', $data);
		}
		else
		{
			$this->load->view('lists_v', $data);
		}
	}

	/**
	 * sns 보기
	 */
	function view()
 	{
		$id = $this->uri->segment(3);

 		//게시물 가져오기
 		$data['views'] = $this->sns_m->get_view($id);

		//댓글 리스트 가져오기
 		$data['comment_list'] = $this->sns_m->get_comment($id);

 		//view 호출
 		if( BROWSER_TYPE == 'M' )
		{
			$this->load->view('mobile_view_v', $data);
		}
		else
		{
 			$this->load->view('view_v', $data);
		}
 	}

	/**
	 * 게시물 삭제
	 */
	function delete()
 	{
		//경고창 헬퍼 로딩
	 	$this->load->helper('alert');

		if( @$this->session->userdata('logged_in') == TRUE )
		{
			//삭제하려는 글의 작성자가 본인인지 검증
			$board_id = $this->uri->segment(3);

			$writer_id = $this->sns_m->writer_check($board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/sns/controlls/view/'.$this->uri->segment(3).'/page/'.$this->uri->segment(5));
				exit;
			}

			//게시물 번호에 해당하는 게시물 삭제
			$return = $this->sns_m->delete_content($this->uri->segment(3));

			//게시물 목록으로 돌아가기
			if ( $return )
			{
				//삭제가 성공한 경우
				alert('삭제되었습니다.', '/sns/controlls/lists/page/'.$this->uri->segment(5));
				exit;
			}
			else
			{
				//삭제가 실패한 경우
				alert('삭제 실패하였습니다.', '/sns/controlls/view/'.$this->uri->segment(3).'/page/'.$this->uri->segment(5));
				exit;
			}
		}
		else
		{
			alert('로그인후 삭제하세요', '/sns/auth/login/');
			exit;
		}
 	}

	/**
	 * 수정
	 */
	function modify_photo()
	{
		//경고창 헬퍼 로딩
	 	$this->load->helper('alert');

		//주소중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array = array_values($this->uri->segment_array());

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
			$id = $this->uri->segment(3);

			//수정하려는 글의 작성자가 본인인지 검증
			$writer_id = $this->sns_m->writer_check($id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				alert('본인이 작성한 글이 아닙니다.', '/sns/controlls/view/'.$id.'/page/'.$pages);
				exit;
			}

			//폼 검증 라이브러리 로드
			$this->load->library('form_validation');

			//폼 검증할 필드와 규칙 사전 정의
			$this->form_validation->set_rules('subject', '제목', 'required');
			$this->form_validation->set_rules('contents', '내용', 'required');

			if ( $this->form_validation->run() == TRUE )
			{
				if ( !$this->input->post('subject', TRUE) AND !$this->input->post('contents', TRUE) )
				{
					//글 내용이 없을 경우, 프로그램단에서 한번 더 체크
					alert('비정상적인 접근입니다.', '/sns/controlls/lists/page/'.$pages);
					exit;
				}

				if($_FILES) //수정할 파일이 있다면
				{
					// upload 설정
					$config = array(
						'upload_path' => 'uploads/',
						'allowed_types' => 'gif|jpg|png',
						'encrypt_name' => TRUE,
						'max_size' => '1000'
					);

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload())
					{
						$data['error'] = $this->upload->display_errors();

						$this->load->view('modify_photo_v', $data);
					}
					else
					{
						$upload_data = $this->upload->data();

						if($upload_data['image_width'] > 300)
						{
							//이미지 리사이즈.  파일명_thumb.확장자 형태로 썸네일 생성
							$config['image_library'] = 'gd2';
							$config['source_image'] = $upload_data['full_path'];
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 300;
							$config['height'] = 300;

							$this->load->library('image_lib', $config);

							$this->image_lib->resize();
						}
					}
				}
				else
				{
					$upload_data = array();
				}
				//수정할 데이터 정리
				$upload_data['subject'] = $this->input->post('subject', true);
				$upload_data['contents'] = $this->input->post('contents', true);
				$upload_data['user_id'] = $this->session->userdata('username');
				$upload_data['id'] = $id;

				$result = $this->sns_m->update_sns($upload_data);

				redirect('/controlls/lists'); exit;

				//페이스북 전송
				if($result)
				{
					//sns 라이브러리 로드
					$this->load->library('sns');
					$this->facebook = $this->sns->facebook();
					$this->facebook->setCallback(site_url('upload_photo/facebook_upload/'.$result));

					if (!$this->facebook->isLoggedIn())
					{
						$this->facebook->login();
					}
				}
				else
				{
					echo "<script> alert('입력실패했습니다.'); </script>";
					redirect('/controlls/upload_photo');
				}



				if ( $result )
				{
					//글 작성 성공시 게시판 목록으로
					alert('수정되었습니다.', '/sns/controlls/lists/page/'.$pages);
					exit;
				}
				else
				{
					//글 수정 실패시 글 내용으로
					alert('다시 수정해 주세요.', '/sns/controlls/view/'.$id.'/page/'.$this->uri->segment(5));
					exit;
				}

			}
			else
			{
				//게시물 내용 가져오기
				$data['views'] = $this->sns_m->get_view($id);

				//쓰기폼 view 호출
				$this->load->view('modify_photo_v', $data);
			}
		}
		else
		{
			alert('로그인후 수정하세요', '/sns/auth/login/');
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
}

/* End of file controls.php */
/* Location: ./application/controllers/controls.php */