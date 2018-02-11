<?php

//database connection
$db_name = "id4109358_fcm_info";
$mysql_username = "id4109358_fcm_info";
$mysql_password = "ashish123";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

$token = $_POST["fcm_token"];
$id = $_POST["student_id"];
$date = $_POST["date"];

$query = "select token from fcm_info where id = '$id';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
	$if_query = "update fcm_info set token = '$token', date = '$date' where id = '$id';";
	$if_result = mysqli_query($conn, $if_query);
	if($if_result)
		echo "updated";
	else
		echo "not updated";
}
else{
	$else_query = "insert into fcm_info values('$id','$token','$date');";
	$else_result = mysqli_query($conn, $else_query);
	if($else_result)
		echo "inserted";
	else
		echo "not inserted";
}
?>