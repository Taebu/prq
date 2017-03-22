<?php 
  session_start(); 
   $url= "index.php";
  $_SESSION['access_token'] = "";

//  $_SESSION['JDAdmin_gugun'] = "";

  session_destroy(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=euc-kr">
<TITLE>로그아웃</TITLE>
<body>
<form name="frm" method="post">
</form> 
</body>
</html>
<script>
alert("로그아웃되었습니다.");
document.frm.action = "<?php echo $url?>";
document.frm.submit();
</script>