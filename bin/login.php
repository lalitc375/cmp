<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "toor";
$db_database="cmp";
$connection = new mysqli($db_hostname,$db_username,$db_password,$db_database);
$prefix="";
	$suffix="";

if($connection->connect_error) die($connection->connect_error);
session_start();
	

$args = json_decode(file_get_contents("php://input"));
if($args->email_id!=""  && $args->password!="")
{	
	$useremail=$args->email_id;
	$password=$args->password;
	$query="select * from user where email_id='$useremail'and password='$password'";
	$run=$connection->query($query);	
	
	if($run->num_rows==1)
	{
		$row=$run->fetch_assoc();
		$_SESSION['email_id']=$row['email_id'];
		$_SESSION['mobile_number']=$row['mobile_number'];
		$arr = array('loginstatus' => 1);
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