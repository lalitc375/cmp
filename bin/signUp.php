<?php

include("serverInfo.php");
$args = json_decode(file_get_contents("php://input"));
$con = mysql_connect($server,$suname,$password);
mysql_select_db($suffix.$database.$prefix,$con);
if($args->firstName!="" && $args->lastName!="" && $args->userName!="" &&$args->password!="")
	{	
		$query="select * from users where userName='".$userName."'and password='".md5($password)."' ";
		$run=mysql_query($query);
		$count=mysql_num_rows($run);
		//echo $count;
		if($count==0)
		 {
		 	$name=$args->firstName." ".$args->lastName;
		 	//echo $count;

		 
		 	$rec="INSERT INTO users VALUES ('".$name."','".$args->userName."','".md5($args->password)."');";
		 	//echo $rec;
			
			if(mysql_query($rec,$con))
				$arr = array('signupstatus' => 1,'msg'=>'User created Successfully.');
			else
				$arr = array('signupstatus' => 2,'msg'=>'User created Successfully.');
		 }
		 else
		 	$arr = array('signupstatus' => 3,'msg'=>'User already exist.');
		
	}
else 
		$arr = array('signupstatus' => 4,'msg'=>'Fields cannot be Empty.');
	echo json_encode($arr);
	//echo 1;
?>