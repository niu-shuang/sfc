<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>
<body>
<?php
$uid;
$uname=$_POST['req_key1'];
$passwd=$_POST['req_key2'];
$error='';
if ($uname=='')
{
	if ($passwd=='')
	{
		$error='UserName and PassWord can not be empty';
	}
	else
	{
		$error='UserName can not be empty';
	}
}
else
{
	if ($passwd=='')
	{
		$error='PassWord can not be empty';
	}
	else
	{
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
		trim($sql);
		$sql="select count(*) from userTable where
		userID='$uname'";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		echo $row;
		if ($row==0)
		{
			$error='Account does not exist';
		}
		else
		{
			$sql="select * from userTable where
			userID='$uname'";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);
			if ($row['userPassword']!=$passwd)
			{
				$error='PassWord is not invalid, please input again';
			}
			else
			{
				$uid=$row['UID'];
			}
		}
	}
}

if ($error=='')
{
	echo 'Login Susscessful£¡';
	$_SESSION['UID']=$uid;
	$_SESSION['userID']=$uname;

	$return="<a href='index.php'>Back to index</a>";
	echo $return;
}
else
{
	echo $error;
}

?>
</body>
</html>