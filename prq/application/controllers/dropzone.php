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

			//file size allowed in kb
			//$allowedMaxSize=1024;
			$allowedMaxSize=1024*10;

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
			
			//file size validation
			if((filesize($tempFile)/1024)>$allowedMaxSize){
				header("HTTP/1.0 500 Internal Server Error");
				echo "File exceeds maximum allowed size";
				exit();
			}

			if ($_FILES['file']["error"] > 0)
			{
				$errmsg = "에러코드: " . $_FILES['file']["error"];
//				header("HTTP/1.0 500 Internal Server Error");
//				echo $errmsg;

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
//		mysql_close($link);
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

	public function thumbnail(){
		/*
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
			//	echo json_encode(array("filename" => $fileName));
				header("Content-type: text/json");
				header("Content-type: application/json");
				echo json_encode($result);
			}
		}*/
		
		/* 
		if (!empty($_FILES)){...} 
		*/
		
		$size="763";
		// public function thumnail($file,$rpath,$size){
		if ($_FILES['file']["error"][0] > 0)
		{
			$errmsg = "에러코드: " . print_r($_FILES['file']["error"]);
			echo $errmsg;
		}

		if (!empty($_FILES)) 
		{
		// File Variables
		$fileName=$_FILES['file']['name'];
		if(is_array($_FILES['file']['tmp_name'])){
		$fileTmpLoc=$_FILES['file']['tmp_name'][0];
		}else{
		$fileTmpLoc2=$_FILES['file']['tmp_name'];
		}

		$fileTmpLoc2=$_FILES['file']['tmp_name'];

		print_r($fileTmpLoc);
		$fileType=$_FILES['file']['type'];
		$fileSize=$_FILES['file']['size'];
		$fileSize2=getimagesize($fileTmpLoc);
		//print_r($fileSize2);
		//print_r($fileType);
		//$fileType
		$fileErrorMsg = $_FILES['file']["error"]; // 0 for false ... and 1 for true
		if (!$fileTmpLoc){ //if file not chosen
			echo "ERROR: Please browse for a file befor clicking the upload button.";
			exit();
		}
		/* outer function thumbs*/
			$width=$fileSize2[0];
			$height=$fileSize2[1];
		//	$upload=md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) );
			$ftemp = time(); //파일네임에 사용할 시리얼 생성
			$serial_make = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // 시리얼 번호 생성
			srand((double)microtime()*1000000);
			$upload = "";
			for($j=0; $j<5; $j++){ 
				$upload .= $serial_make[rand()%strlen($serial_make)];
				uniqid($upload);
			}
			// Restrictions for uploading
			$maxwidth=1920;
			$maxheight=1080;
			$allowed=array("image/jpeg", "image/png", "image/gif" );
			// Recognizing the extension
			switch( $fileType[0] ){
				// Image/Jpeg
				case 'image/jpeg':
					$ext= '.jpg';
				break;
				// Image/png
				case 'image/png':
					$ext= '.png';
				break;
				
				// Image/gif
				case 'image/gif':
					$ext= '.gif';
				break;
			}
			$flag="0";
			//resize:
			$thumb_path=$_SERVER['DOCUMENT_ROOT']."/prq/uploads/201611/".$ftemp.$upload.$ext;
//			if($size=="120"){$thumb_path=$rpath."/thumbs/".$ftemp.$upload.$ext;}
			if($size=="120"){
				$thumb_path=$_SERVER['DOCUMENT_ROOT']."/prq/uploads/201611/".$ftemp.$upload.$ext;
				//$thumb_path=$rpath."/thumbs/".$ftemp.$upload.$ext;
			}
			if( $width == $height ){ $shape=1; }
			if( $width > $height ){ $shape=2; }
			if( $width < $height ){ $shape=3; }
			// Ajusting the resize script on shape.
			switch( $shape ){
				// Code to resize a square image.
				case 1:
					$newwidth=$size;
					$newheight=$size;
				break;
				// Code to resize a tall image.
				case 2:
					$newwidth=$size;
					$ratio=$newwidth / $width;
					$newheight=round( $height * $ratio );
				break;
				// Code to resize a wide image.
				case 3:
					$newheight=$size;
					$ratio=$newheight / $height;
					$newwidth=round( $width * $ratio );
				break;
			}
			// Resizing according to extension.
			/**
			*
			$uploadTempFile = $myField[ 'tmp_name' ]
			list( $uploadWidth, $uploadHeight, $uploadType ) 
			  = getimagesize( $uploadTempFile );

			$srcImage = imagecreatefrompng( $uploadTempFile ); 

			$targetImage = imagecreatetruecolor( 128, 128 );   
			imagealphablending( $targetImage, false );
			imagesavealpha( $targetImage, true );

			imagecopyresampled( $targetImage, $srcImage, 
								0, 0, 
								0, 0, 
								128, 128, 
								$uploadWidth, $uploadHeight );

			imagepng(  $targetImage, 'out.png', 9 );

			-----

			$im = ImageCreateFromPNG($source);
			$new_im = imagecreatetruecolor($new_size[0],$new_size[1]);
			imagecolortransparent($new_im, imagecolorallocate($new_im, 0, 0, 0));
			imagecopyresampled($new_im,$im,0,0,0,0,$new_size[0],$new_size[1],$size[0],$size[1]);
			*/
			switch( $fileType ){
				// Image/Jpeg
				case 'image/jpeg':
				$img = ImageCreateFromJPEG( $fileTmpLoc2 );
				$thumb=imagecreatetruecolor( $newwidth, $newheight );
				imagecopyresized( $thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
				imagejpeg( $thumb, $thumb_path );
                //imagedestroy($thumb);
                //imagedestroy($img);
				break;
				// Image/png
				case 'image/png':
				
				/* png */
				$img = ImageCreateFromPNG($fileTmpLoc2);
				$thumb = imagecreatetruecolor( $newwidth, $newheight );
				imagecolortransparent($thumb, imagecolorallocate($thumb, 0, 0, 0));
				imagecopyresampled($thumb,$img,0,0,0,0,$newwidth, $newheight,$width, $height );
				/*
				$img=imagecreatefrompng( $fileTmpLoc );
				$thumb=imagecreatetruecolor( $newwidth, $newheight );
				imagealphablending($thumb, false );
				imagesavealpha($thumb, true );
				
				imagecopyresized( $thumb, $img,0, 0, 0, 0, $newwidth, $newheight, $width, $height );
				*/
				imagepng( $thumb, $thumb_path);
                //imagedestroy($thumb);
                //imagedestroy($img);
				break;
				// Image/gif
				case 'image/gif':
				$img=ImageCreateFromGIF( $fileTmpLoc2 );
				$thumb=imagecreatetruecolor( $newwidth, $newheight );
				imagecopyresized( $thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height );
				imagegif( $thumb, $thumb_path );
                //imagedestroy($thumb);
                //imagedestroy($img);
				break;
			}
			//$flag++;
		//	echo ($size==640)?"640<br><img src=\"../photo/".$ftemp.$upload.$ext."\" width=120 height=120>":"";
			//if($flag==1){$size=120;goto resize;}
				$result=array();
				$obj['name']=$fileName;
				$obj['name']=$ftemp.$upload.$ext;
				//$obj['size']=filesize($targetFile);
				//$obj['size']=filesize($fileTmpLoc);
				$obj['size']=filesize($thumb_path);
				$obj['thumb_path']=$thumb_path;
				$obj['fileTmpLoc']=$fileTmpLoc;
				$obj['tmp_name']=$_FILES['file']['tmp_name'];

				$result[]=$obj;

				header("Content-type: text/json");
				header("Content-type: application/json");
				echo json_encode($result);
		// Move the original file aswell.
		/*!outer function thumb `*/
		//move_uploaded_file( $fileTmpLoc, $path );
		//echo $filename."function upload is complets";
		//		$result=array();
		//		$obj['name']=$fileName;
		//		$obj['size']=filesize($targetFile);
		//		$result[]=$obj;
		//		header("Content-type: text/json");
		//		header("Content-type: application/json");
		//		echo json_encode($result);
		//echo $filename."move_uploaded_file function failed";
		// Putting out the data.
	}/* if (!empty($_FILES)){...} */
	}
}
 
/* End of file dropzone.js */
/* Location: ./prq/application/controllers/dropzone.php */