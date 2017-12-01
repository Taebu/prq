<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * todo 컨트롤러
 */
class Main extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->database();
//		$this->load->model('todo_m');
		$this->load->helper(array('url','date'));

	}

	/**
	* 주소에서 메서드가 생략되었을 때 실행되는 기본 
	*/
	public function index()
	{
		$this->lists();
	}

	/**
	* todo 조회
	*/
	public function lists(){
		$data['list']=$this->todo_m->get_list();
		$this->load->view('todo/list_v',$data);
	}
	/**
	* view 호출
	*/
	public function view()
	{
		# code...
		//todo 번호에 해당하는 데이터 가져오기
		$id = $this->uri->segment(3);
		$data['views']=$this->todo_m->get_view($id);

		//view 호출
		$this->load->view('todo/view_v',$data);
	}

	/**
	 * todo 입력
	 */
	function write()
 	{
		if ( $_POST )
  		{
			//글쓰기 POST 전송시

	  		$content = $this->input->post('content', TRUE);
			$created_on = $this->input->post('created_on', TRUE);
			$due_date = $this->input->post('due_date', TRUE);

	  		$this->todo_m->insert_todo($content, $created_on, $due_date);

			redirect('/main/lists/');

			exit;
  		}
  		else
  		{
	 		//쓰기폼 view 호출
	 		$this->load->view('todo/write_v');
		}
 	}

 	/**
	* todo 삭제
 	*/
	function delete()
 	{
 		# code...
 		$id= $this->uri->segment(3);
 		$this->todo_m->delete_todo($id);
 		redirect('/main/lists/');
 	}
	
	function error_404()
	{
	 		$this->load->view('errors/error_404');
	}

}
/* End of file main.php*/
/* Location ./application/controllers/main.php */