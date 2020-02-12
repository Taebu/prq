<%
/**

    Class dir  : /
    Class Name : checksum.jsp
    Date : 2013.12.03
    Modify : 

*/
%><%@ page contentType="text/html; charset=euc-kr" %><%@ page 
import="java.lang.*,java.io.*,java.security.*"%><%!
	final String getFileMD5Checksum(String file_path)
	{
		String retVal = "";		
		try {
			
			   InputStream fis =  new FileInputStream(file_path);

		       byte[] buffer = new byte[1024];
		       MessageDigest complete = MessageDigest.getInstance("MD5");
		       int numRead;

		       do {
		           numRead = fis.read(buffer);
		           if (numRead > 0) {
		               complete.update(buffer, 0, numRead);
		           }
		       } while (numRead != -1);

		       fis.close();		        
			
		  byte[] digest = complete.digest();
		  
		  String result = "";
		  StringBuffer buf = new StringBuffer();
		  String char2byte=null;
		  
		  for(int i=0;i< digest.length;i++){
				char2byte = Integer.toHexString(digest[i] & 0x00ff);
				if(char2byte.length()==1){
					char2byte = "0" + char2byte;// careful "0" append
				}
				buf.append(char2byte);
			}
		  	retVal = buf.toString();
		  
		}
		catch(java.lang.Exception exc)
		{	
			retVal = exc.getMessage();
		}		
		return retVal;
	}
%><%
String param1 = request.getParameter("param1");
String result = "";
if("/".equals(File.separator))
{
	//linux, unix
	result = getFileMD5Checksum(application.getRealPath("/") + "/update" + File.separator +param1.replaceAll("\\\\","/"));
}
else if("\\".equals(File.separator)){
	//windows
	result = getFileMD5Checksum(application.getRealPath("/") + "\\update" + File.separator +param1);
}
else{
	result = getFileMD5Checksum(application.getRealPath(File.separator) + File.separator + "update" + File.separator +param1.replaceAll("\\\\",File.separator));	
}
out.print(result);%>
