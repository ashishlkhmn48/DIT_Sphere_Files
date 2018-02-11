<?php

//database connection
$db_name = "id4109358_fcm_info";
$mysql_username = "id4109358_fcm_info";
$mysql_password = "ashish123";
$server_name = "localhost";
$conn = mysqli_connect($server_name, $mysql_username, $mysql_password, $db_name);

$id = $_POST["student_id"];
$query = "delete from fcm_info where id = '$id';";
$result = mysqli_query($conn, $query);

if($result){
    echo "deleted";
}else{
    echo "not deleted";
}
?>