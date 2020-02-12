<? header(' contentType="text/html; set=euc-kr" ');?><?php 
$param1 = $_POST["param1"];
echo md5_file('/var/www/html/prq/prq2021app/update/' + str_replace('\\', '/', $param1));?>