/*
JSP2PHP Converter helps you to convert your JSP code to PHP COde even its DB connection can be converted just need to provide database connection
http://vcoder.5gbfree.com/JSP2PHP/
Created by Pranav Pandey
*/

<html>
<head><img src="images/jsp2php.png">
<script>

function validate()
{
var email,pass,fname,uid;

pass=document.getElementById("subject").value;
if(pass=="" || pass==null)
{
alert("Kindly fill  subject");
//document.getElementById("perror").innerHTML="<p style=background-color:red;>Kindly Fill password</p>";
document.getElementById("subject").focus();
return false;
}

uid=document.getElementById("detail").value;
if(uid=="" || uid==null)
{
alert("Kindly fill detail");
//document.getElementById("iderror").innerHTML="<p style=background-color:red;>Kindly Fill your ID</p>";
document.getElementById("detail").focus();
return false;
}


fname=document.getElementById("name").value;
if(fname=="" || fname==null)
{
alert("Kindly fill name");
//document.getElementById("fnerror").innerHTML="<p style=background-color:red;>Kindly Fill Full name</p>";
document.getElementById("name").focus();
return false;
}

email=document.getElementById("email").value;
var ch=email.match("^(.+)@(.+)$");
var re= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var h= email.match(re);
if(email=="" || email==null || ch == null || h==null)
{
alert("Kindly fill valid email");
//document.getElementById("eerror").innerHTML="<p style=background-color:red;>Kindly Fill valid email</p>";
document.getElementById("email").focus();
return false;
}

return true;

}
</script>

<link rel="stylesheet" href="style/style.css" />
</head>
<body background="images/lbg.jpg">


<?php
$s=$_POST["php"];
$var=$_POST["vars"];
$ip=$_POST['ip'];
$uname=$_POST['uname'];
$upass=$_POST['upass'];
$dbname=$_POST['dbname'];
if($var=="")
{
$var="rtyuiiuvbm";
}
$vr=explode(",",$var);
$k=0;
$j=0;
$stt=preg_replace(('/Statement (.*);/'),"",$s);
$stt1=preg_replace(('/<%=(.*)%>/'),"<?php echo \"$1\";?>",$stt);
/*$o=array("out.print(","out.println(",");","<%","%>","@","Connection ","Statement ","rs.getString","rs.getInt","String ","int ","float ",".jsp","+\"","\"+","(int)","(String)");*/
$o=array("out.print(","out.println(",");","<%","%>","@","Connection ","Statement ","rs.getString","rs.getInt","String ","int ","float ",".jsp","+\"","\"+","(int)","(String)","trim(;","Integer.parseInt(","Double.parseDouble(","char");
$n=array("echo","echo",";","<?php "," ?>","","$","$","&#36row","&#36row","","","",".php","","=","","","trim();","","","");
$change=str_replace($o,$n,$stt1);
$st13=preg_replace(('/\+(.*)\+\"\'/'),"&#36$1",$change);

$st= preg_replace(('/DriverManager.getConnection(.*;)/'), "mysqli_connect($ip,$uname,$upass,$dbname);", $st13);

$st1= preg_replace(('/Class.forName(.*;)/'), "", $st);
$st11= preg_replace(('/echo(.*);/'), "echo($1);", $st1);
$st2= preg_replace(('/=(.*)executeUpdate\((.*;)/'), "=mysqli_query(&#36con,$2);", $st1);
$st3= preg_replace(('/session.setAttribute\((.*"),/'), "&#36_SESSION[$1]=&#36$2", $st2);
$st4= preg_replace(('/request.getParameter\("(.*);/'), '$_POST[&#34$1];', $st3);
$st5=preg_replace(('/RequestDispatcher(.*)= request.getRequestDispatcher\("((.*"));/'),'header("Location:$2);',$st4 );
 $st6= preg_replace(('/(.*).forward(.*;)/'), "", $st5);
$st7=preg_replace(('/=(.*).executeQuery\((.*);/'),"=mysqli_query(&#36con,$2);",$st6);
$st8=preg_replace(('/while(.*)/'),"while(&#36row=mysqli_fetch_array())",$st7);
$st9=preg_replace(('/include file=(.*)"/'),"include($1&#34);",$st8);
$st10=preg_replace(('/ResultSet (.*)=/'),"&#36$1",$st9);
$st11=preg_replace(('/try\{(.*)/'),"",$st10);
$st12=preg_replace(('/catch\((.*)\)(.\n)/')," ",$st11);
$st13=preg_replace(('/session.getAttribute\((.*")/'),"&#36_SESSION[$1]",$st12);
$st14=preg_replace(('/import=(.*)\"/'),"",$st13);
$st15=preg_replace(('/row(.*)\"/'),"row$1\")",$st14);
 $st16= preg_replace(('/rd(.*)include(.*;)/'), "", $st15);
 $st17= preg_replace(('/echo(.*);/'), "echo $1\";", $st16);
 $st18= preg_replace(('/<?php  page(.*)\?>/'), " header('$1');?>", $st17);
 $st19= preg_replace(('/\";/'), ";", $st18);
 $st20= preg_replace(('/(.*).getString(.*)\)/'), "&#36row$2);", $st19);
 $st21= preg_replace(('/new(.*)int\[(.*)\];/'), "array($2);", $st20);
 $st22= preg_replace(('/new(.*)String\[(.*)\];/'), "array($2);", $st21);
 $st23= preg_replace(('/new(.*)Double\[(.*)\];/'), "array($2);", $st22);
 $st24= preg_replace(('/new(.*)float\[(.*)\];/'), "array($2);", $st23);
 $st25= preg_replace(('/int(.*)\[\]/'), "", $st24);
$st26= preg_replace(('/(.*)\[\]/'), "", $st25);
$st27= preg_replace(('/Cookie (.*)=new(.*)Cookie\((.*);/'), "setcookie($3);", $st26);
$st28= preg_replace(('/response.add(.*)/'), "", $st27);
$st29= preg_replace(('/(.*).createStatement(.*)/'), "", $st28);

foreach($vr as $i)
{
echo "<br>";
/*$v[$j]=$vr[$j]."=";
echo $v[$j];

$f=$v[$k];
$j++;
echo $f;
if(preg_match("/$f/i", $st29, $matches))
{

echo "hi";
echo $vr[$k];*/
$c[$k]="&#36".$vr[$k];
$k++;

/*$d=str_replace($vr,$c,$st14);
}*/
}
$c = array_combine($vr, $c);
 $z=preg_replace('#\b('.implode('|',$vr).')\b#e', '$c["$1"]?:"$1"', $st29);
$q="$"."$";
$z1=array($q);
$z2=array("$");
$z3=str_replace($z1,$z2,$z);
echo "Your Jsp<br>";
echo "<textarea rows=10 cols=100 id='jsp'>".$s."</textarea><br>";
echo "Generated Php Code<br>";
echo "<textarea rows=10 cols=100 id=php>".$z3."</textarea>";

?>

<table width="400" border="0" align="center" cellpadding="3" cellspacing="1">
<tr>
<td><strong>Feedback Form </strong></td>
</tr>
</table>

<table width="400" border="0" align="center" cellpadding="0" cellspacing="1">
<tr>
<td><form name="form1" method="post" action="save.php" onsubmit="return validate()">
<table width="100%" border="0" cellspacing="1" cellpadding="3">
<tr>
<td width="16%">Pros/Cons</td>
<td width="2%">:</td>
<td width="82%"><input name="subject" type="text" id="subject" size="50"></td>
</tr>
<tr>
<td>Detail/Any New Idea </td>
<td>:</td>
<td><textarea name="detail" cols="50" rows="4" id="detail"></textarea></td>
</tr>
<tr>
<td>Name</td>
<td>:</td>
<td><input name="name" type="text" id="name" size="50"></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input name="email" type="text" id="email" size="50"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit"> <input type="reset" name="Submit2" value="Reset"></td>
</tr>
</table>
</form>
</td>
</tr>
</table>

</body>
</html>