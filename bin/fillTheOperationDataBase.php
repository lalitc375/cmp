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
if($args->at_airport_id!=""  && $args->date!="")
{	
	$airport=$args->at_airport_id;
	$date=$args->date;
$weekday = date('l', strtotime($date)); 
$dayarr=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$search=array_search($weekday,$dayarr);
	$flight =array();
		
	$query="select * from flight_schedule where  at_airport_id='$airport'";
	$run=$connection->query($query);
	$count=$run->num_rows;	
	echo $count;
	$counter=0;
	if($count>0)
	{
		for($j=0;$j<$count;$j++){
			$row=$run->fetch_assoc();
		
 			$ans=$row['running_days'];

			if($ans[$search]==1){
				/*echo $row['flight_id'];*/
				$query="insert into operational_data values ('','".$date."','".$row['flight_id']."','".$row['schedule_departure']."',0,'".$row['schedule_arrival']."',0,'".$row['at_airport_id']."',0,0)";
				echo $query;
				$run2=$connection->query($query);
				if($run2)
					$counter++;
				//	echo "Yes";
			}	
	}
		echo $counter;
	}
	

	else
	{
		$arr = array('loginstatus' => 2);
	
	echo json_encode($arr);
}
}
else
{
	$arr = array('loginstatus' => 3);
	echo json_encode($arr);
}

?>