<?php
session_start();
include("serverInfo.php");
$args = json_decode(file_get_contents("php://input"));
mysql_connect($server,$suname,$password);
mysql_select_db($database);

if($args->userName!=""  && $args->password!="")
{	

	$userName=$args->userName;
	$password=$args->password;
	$query="select * from users where userName='".$userName."'and password='".md5($password)."' ";
	$run=mysql_query($query);	
	$count=mysql_num_rows($run);
	//echo($count);
	$result=mysql_fetch_assoc($run);
	if($count==1)
	{
		
		$_SESSION['userName']=$result['userName'];
		$_SESSION['name']=$result['name'];
		$arr = array('loginstatus' => 1);
		$result=mysql_fetch_assoc($run);
	}
	else
	{
		$arr = array('loginstatus' => 2);
	}
	echo json_encode($arr);
}
else
{
	$arr = array('loginstatus' => 3);
	echo json_encode($arr);
}
?>