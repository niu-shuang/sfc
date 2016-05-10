<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" >
<title>µÇåh½Y¹û</title>
</head>
<?php
$m_uid = $_POST['m_uid'];
$m_pw = $_POST['m_pw'];
$pass = $_POST['pass'];
if(strlen($m_uid)<1)
echo "Account can not be empty ! <a href='User_Register.php'>return</a></p>";
$pattern = '/[^\\x7f-\xff]/';
if(!preg_match($pattern,$m_uid))
echo "Account is Illigel ! <a href='User_Register.php'>return</a></p>";
else if(empty($m_pw))
echo "Password can not be empty ! <a href='User_Register.php'>return</a></p>";
else if($m_pw!=$pass)
echo "You have typed different Password ! <a href='User_Register.php'>return</a></p>";

else{
$db = mysql_connect("webdb.sfc.keio.ac.jp", "ni9zhang", "rXj9npNG");
if (!$db) {
	print "Error - Could not connect to MySQL";
	exit;
}
$er = mysql_select_db("ni9zhang");
if (!$er) {
	print "Error - Could not select the guest database";
	exit;
}
$sql="select * from userTable where userID = '$m_uid'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if($row)
echo "Account Exists ! <a href='User_Register.php'>return</a></p>";
else{
$query = 'INSERT INTO userTable VALUES ("'.$m_uid.'","'.$m_pw.'")';
echo $query;
$result = mysql_query($query);
echo "Success ! <a href='index.php'>Back to Index</a></p>";
}
mysql_close($db);
}

?>
<body>
</body>
</html>