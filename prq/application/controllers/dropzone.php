<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('DS', DIRECTORY_SEPARATOR);
define('DES', 'uploads');
$action = "upload";
$zone = 'zone_one';

class Dropzone extends CI_Controller {
  
	public function __construct() {
	   parent::__construct();
	   $this->load->helper(array('url','html','form')); 
	}
 
	public function index() {
		echo getcwd()."/uploads/";
		$this->load->view('dropzone_v');
	}
	

	/*
	파일명,폴더명 매개변수 
	$Fname, @파일이름 
	$path @경로
	*/
	public function confirmFname($Fname,$path) {  
		if(strpos($Fname,'.') > 0) { #확장자가 있으면 
			$attach_file = explode(".",$Fname);  #파일명 분리 
			$strExt= array_pop($attach_file);      #확장자
			$strName = implode(".",$attach_file);       #파일명
			$bExist = True ;  #일단 파일이 있다고 가정하는 불린 변수 
			$strName = str_replace(" ", "_", $strName); 
			$strName = str_replace("&nbsp;", "_", $strName);	
			$FileName = $strName . "." . $strExt;
			$FileName1 = $strName . "." . $strExt;
		}
		else {
			$strName = $Fname;       #파일명
			$bExist = True ;  #일단 파일이 있다고 가정하는 불린 변수 
			$strName = str_replace(" ", "_", $strName); 
			$strName = str_replace("&nbsp;", "_", $strName);	
			$FileName = $strName;
			$FileName1 = $strName;
		}

		$countFileName = 0; 
		If (file_exists($path.$FileName)) { 
		while ($bExist)  {                  #우선 있다고 생각 
		  If (file_exists($path.$FileName1)) { 
			$countFileName = $countFileName + 1 ; 
			if(strpos($Fname,'.') > 0) { #확장자가 있으면 
				$attach_file = explode(".",$Fname);  #파일명 분리
				$strExt= array_pop($attach_file);      #확장자
				$strName = implode(".",$attach_file);       #파일명
			  $FileName1 = $strName . "_" . $countFileName . "." . $strExt; 
			}else {
			  $FileName1 = $FileName . "_" . $countFileName;
			}
		  } else { 
			$bExist = False;
		  } 
		} 
		return $FileName1; 
		}else{ 
			return $FileName; 
		} 
	}


	public function upload() 
	{
		if (!empty($_FILES)) 
		{
			$tempFile = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$targetPath = getcwd() . '/uploads/';
			//$targetFile = $targetPath . $fileName ;
		//	move_uploaded_file($tempFile, $targetFile);
		//$this->uri->segment(3);
			$chk_file = explode(".", $fileName);
			$extension = $chk_file[sizeof($chk_file)-1];
			$fileName= "DS_test.".$extension;
	//    $file_newname = confirmFname($file_newname,$uploaddir);
			if ($_FILES['file']["error"] > 0){
				$errmsg = "에러코드: " . $_FILES['file']["error"];
			}else {
				$targetFile = $targetPath . $fileName ;
				move_uploaded_file($tempFile, $targetFile);
				// if you want to save in db,where here
				// with out model just for example
				// $this->load->database(); // load database
				// $this->db->insert('file_table',array('file_name' => $fileName));
				echo json_encode(array("filename" => $fileName));
			}
		}
	}



	public function delete() {
		/*
		move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$file
		*/
		$name = $_POST["filename"];
//		$name = "106745763.jpg";
		
		if(file_exists(getcwd().'/uploads/'.$name))
		{
			unlink(getcwd().'/uploads/'.$name);
//			$link = mysql_connect("localhost", "root", "");
//			mysql_select_db("dropzone", $link);
//			mysql_query("DELETE FROM uploads WHERE name = '$name'", $link);
//			mysql_close($link);
			echo json_encode(array("res" => true));
		}
		else
		{
			$result=array("res" => false);
			echo json_encode($result);
		}

    }
}
 
/* End of file dropzone.js */
/* Location: ./prq/application/controllers/dropzone.php */