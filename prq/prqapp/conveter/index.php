<html>
<head><img src="images/jsp2php.png"><img src="images/covert.jpg" style="height:100px;">
<link rel="stylesheet" href="style/style.css" />
</head>
<body background="images/lbg.jpg">

<form action="process.php" method="post">
<textarea name="php" rows="15" cols="50" placeholder="Put your Jsp code here. NOTE:It will not convert 'preparedStatement' so use 'Statement' for SQL query.and give database connection name below"></textarea>
<textarea name="vars" rows="15" cols="50" placeholder="write name of all variables used,separated by commas e.g i,n,j,k,sum"></textarea><br>
<table><tr><td>Database Connection Host Ip:</t><td><input type="text" name="ip" placeholder="e.g. localhost"></td></tr>
<tr><td>Database Username:</td><td><input type="text" name="uname"></td></tr>
<tr><td>Database Password:</td><td><input type="text" name="upass" ></td></tr>
<tr><td>Database Name:</td><td><input type="text" name="dbname"></td></tr></table>
<center><input type="image"  src="images/c.png" title="convert" type="submit" onclick="process.php">
</form>

<ul>CONDITIONS</ul>
<ul>1.It converts only simple JSP Page</ul>
<ul>2.Just give the name of all variables used separating each by comma.</ul>
<ul>3.Give the name of Database connections as mentioned.</ul>
<ul><font color="red">Note: Script works if you are using "Statement" inplace of PreparedStatement</font></ul>
<ul><font color="red">Note: It will not convert library functions like math.round , date,equals etc.</font></ul>
<ul><font color="red">TLD(Tag library Descriptor) and java beans will not work</font></ul>
<img src="images/copy.jpg" style="width:20px;height:30px;"> All rights reserved vcoder<img src="images/vc1.png" style="width:50px;height:50px;">
</body>
</html>