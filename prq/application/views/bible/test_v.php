<?php

//$k=$bible;

extract($_GET);
echo "<pre>";
//print_r($_SERVER);
echo "</pre>";
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
<style type="text/css">
body{padding:15px;margin:5px;line-height:2;
background-color: #000;color:wheat;
}
</style>
<?php
$k=urldecode($bible);
if(isset($k)){
?>
  <title>"<?php echo $k;?>" 검색결과</title>
<?php
}else{
?>
  <title>개역개정 | 교독문 | 성경찾기</title>
<?php
}
?>
 </head>
 <body>


<?php
$option=" 2>&1";
if(strrpos($k,",")>-1)
{
	$kkk=explode(",",$k);
}else{
	$kkk=explode("\n",$k);
}


$kkk[]="창1:1";
$keyword=$k;

foreach($kkk as $keyword)
{
//exec("java -cp '.:./sqlite-jdbc-3.16.1.jar' Program ".$keyword.$option, $output); 
$java_path="/usr/lib/jvm/java-1.8.0-openjdk-1.8.0.111-0.b15.el6_8.x86_64/bin/java";
echo $keyword;
exec(sprintf("%s -cp '.:./sqlite-jdbc-3.16.1.jar' Program %s",$java_path,$keyword.$option), $output); 
//array_push($output,$output2);
//array_push($output,$output3);
while(list($key, $val) = each($output)) { 
//    echo $key . "=". $val."<br>"; 
    echo $val."<br>"; 
}
echo "<br>";
}
?>
 </body>
</html>

