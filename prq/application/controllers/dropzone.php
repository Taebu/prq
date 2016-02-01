<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('DS', DIRECTORY_SEPARATOR);
define('DES', 'uploads');
$action = "upload";
$zone = 'zone_one';

class Dropzone extends CI_Controller {
  
	public function __construct() {
	   parent::__construct();
   		$this->load->database();
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
			$mb_imgprefix="";
			if($this->uri->segment(4)!=""){
				$mb_imgprefix=$this->uri->segment(4)."/";
			}
			$targetPath = getcwd() . '/uploads/'.$mb_imgprefix;
			if(!is_dir($targetPath)){
			mkdir($targetPath,0700);
			}
			//$targetFile = $targetPath . $fileName ;
			//	move_uploaded_file($tempFile, $targetFile);
			
			$prefix="DF";
			if($this->uri->segment(3)!=""){
				$prefix=$this->uri->segment(3);
			}


			$chk_file = explode(".", $fileName);
			$extension = $chk_file[sizeof($chk_file)-1];
			$fileName= $prefix."_".time().".".$extension;
			//  $file_newname = confirmFname($file_newname,$uploaddir);
			
			if ($_FILES['file']["error"] > 0)
			{
				$errmsg = "에러코드: " . $_FILES['file']["error"];
			}else {
				$targetFile = $targetPath . $fileName ;
				move_uploaded_file($tempFile, $targetFile);
				// if you want to save in db,where here
				// with out model just for example
				// $this->load->database(); // load database
				// $this->db->insert('file_table',array('file_name' => $fileName));
				
				$result=array();
				$obj['name']=$fileName;
				$obj['size']=filesize($targetFile);
				$result[]=$obj;
//				echo json_encode(array("filename" => $fileName));
				header("Content-type: text/json");
				header("Content-type: application/json");
				echo json_encode($result);
			}
		}
	}



	public function delete() {
		/*
		move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/".$file
		*/
		$name = $_POST["filename"];
		$mb_imgprefix = $_POST["mb_imgprefix"];
		$mb_no = $_POST["mb_no"];
		$mb_removetype = $_POST["mb_removetype"];
		$name = $_POST["filename"];

//		$name = "106745763.jpg";
		
		if(file_exists(getcwd().'/uploads/'.$mb_imgprefix."/".$name))
		{
			$sql=array();
			unlink(getcwd().'/uploads/'.$mb_imgprefix."/".$name);
			$sql[]="update prq_member set ";
			$sql[]=$mb_removetype."='',";
			$sql[]=$mb_removetype."_size=0";
			$sql[]=" where ";
			$sql[]="mb_no='".$mb_no."';";
			
			$result= $this->db->query(join("",$sql));
//			$link = mysql_connect("localhost", "root", "");
//			mysql_select_db("dropzone", $link);
//			mysql_query("DELETE FROM uploads WHERE name = '$name'", $link);
//			mysql_close($link);
			echo json_encode(array("res" => true,"sql"=>$sql));
		}
		else
		{
			//$result=array("res" => false);
			//echo json_encode($result);
			$sql="update prq_member set ".$mb_removetype."='',".$mb_removetype."_size=0 where mb_no='".$mb_no."';";
			$result= $this->db->query($sql);
			echo json_encode(array("res" => true,"sql"=>$sql));
		}

    }


	public function delete_st() {
		$name = $_POST["filename"];
		$st_imgprefix = $_POST["st_imgprefix"];
		$st_no = $_POST["st_no"];
		$st_removetype = $_POST["st_removetype"];
		
		if(file_exists(getcwd().'/uploads/'.$st_imgprefix."/".$name))
		{
			$sql=array();
			unlink(getcwd().'/uploads/'.$st_imgprefix."/".$name);
			$sql[]="update prq_store set ";
			$sql[]=$st_removetype."='',";
			$sql[]=$st_removetype."_size=0";
			$sql[]=" where ";
			$sql[]="st_no='".$st_no."';";
			
			$result= $this->db->query(join("",$sql));
//			$link = mysql_connect("localhost", "root", "");
//			mysql_select_db("dropzone", $link);
//			mysql_query("DELETE FROM uploads WHERE name = '$name'", $link);
//			mysql_close($link);
			echo json_encode(array("res" => true,"sql"=>$sql));
		}
		else
		{
			//$result=array("res" => false);
			//echo json_encode($result);
			$sql="update prq_store set ".$st_removetype."='',".$st_removetype."_size=0 where st_no='".$st_no."';";
			$result= $this->db->query($sql);
			echo json_encode(array("res" => true,"sql"=>$sql));
		}
    }
}
 
/* End of file dropzone.js */
/* Location: ./prq/application/controllers/dropzone.php */