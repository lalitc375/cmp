

<?php
//Input(name,mobile,password,firebase,email,usermode)

include("serverInfo.php");
$args = json_decode(file_get_contents("php://input"));
$con = new mysqli($server,$suname,$password,$database);

if($con->connect_error) die($con->connect_error);
//$con = mysql_connect($server,$suname,$password);
//mysql_select_db($suffix.$database.$prefix,$con);
if($args->name!="" && $args->mobile!="" && $args->password!="" && $args->firebase!="" && $args->email!="" && $args->usermode!="")
	{
		$query="select * from user where name='".$args->name."'and password='".md5($args->password)."' ";
		$result = $con->query($query);
		//$run=mysql_query($query);

		//$count=mysql_num_rows($run);
		$rows = $result->num_rows;
		//echo $count;
		if($rows==0)
		 {
		 	//$name=$args->firstName." ".$args->lastName;
		 	//echo $count;


		 	$rec="INSERT INTO user VALUES ('','$args->name','$args->mobile','$args->password','$args->firebase','$args->email','$args->usermode')";

      $result = $con->query($rec);
			//echo $result;
			if($result)
				$arr = array('signupstatus' => 1,'msg'=>'User created Successfully.');
			else{
				$arr = array('signupstatus' => 0,'msg'=>'Something Went Wrong.');
			}
	}
	else if($rows != 0){
		$arr = array('signupstatus' => 2,'msg'=>'User already exist.');
	}
}
  else
		$arr = array('signupstatus' => 3,'msg'=>'Fields cannot be Empty.');

	echo json_encode($arr);
?>
