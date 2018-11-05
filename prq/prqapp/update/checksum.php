<?php 
/**

    Class dir  : /
    Class Name : checksum.php
    Date : 2018.07.10
    Modify : 

*/
 ?><? header(' contentType="text/html; set=euc-kr"  ');?><?php  page 
 ?><?php !
	final getFileMD5Checksum(file_path)
	{
		retVal = ";		
		try {
			
			   InputStream fis =  new FileInputStream(file_path;

 buffer = new byte[1024];
		       MessageDigest complete = MessageDigest.getInstance("MD5;
		       numRead;

		       do {
		           numRead = fis.read(buffer;
		           if (numRead > 0) {
		               complete.update(buffer, 0, numRead;
		           }
		       } while($row=mysqli_fetch_array())

		       fis.close(;		        
			
 digest = complete.digest(;
		  
		  result = ";
		  StringBuffer buf = new StringBuffer(;
		  2byte=null;
		  
		  for(i=0;i< digest.length;i++){
				2byte = Integer.toHexString(digest[i] & 0x00ff;
				if(2byte.length()==1){
					2byte = "0" + 2byte;// careful "0" append
				}
				buf.append(2byte;
			}
		  	retVal = buf.toString(;
		  
		}
		 		{	
			retVal = exc.getMessage(;
		}		
		return retVal;
	}
 ?><?php 
param1 = $_POST["param1"];
result = ";
if("/".equals(File.separator))
{
	//linux, unix
	result = getFileMD5Checksum(application.getRealPath("/") + "/update" + File.separator +param1.replaceAll("\\\\","/");
}
else if("\\".equals(File.separator)){
	//windows
	result = getFileMD5Checksum(application.getRealPath("/") + "\\update" + File.separator +param1;
}
else{
	result = getFileMD5Checksum(application.getRealPath(File.separator) + File.separator + "update" + File.separator +param1.replaceAll("\\\\",File.separator);	
}
echo result; ?>
