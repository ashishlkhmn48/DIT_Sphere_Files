<?php
require 'parse-php-sdk-master/autoload.php';
include 'db_connect.php';
include 'notify.php';
include 'parse_connect.php';

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseFile;

$student_id = $_POST["student_id"];
$message = $_POST["message"];
$object_id = $_POST["object_id"];
$date = $_POST["date"];
$head = $_POST["head"];

try {
  $query = new ParseQuery("Threads");
  $query->equalTo("objectId", $object_id);
  $parse_object = $query->first();
  $users_list = $parse_object->get("connected_id");
  
  for($i = 0;$i<count($users_list);$i++){
	if(strcmp($users_list[$i],$student_id) != 0){
		$query = "select * from fcm_info where id = '$users_list[$i]'";
		$result = mysqli_query($conn,$query);
		while($row = mysqli_fetch_array($result)){
			$fields = array(
				"to"=>$row["token"],
				"data"=>array("object_id"=>$object_id,"student_id"=>$student_id,"message"=>$message,"date"=>$date,"head"=>$head,"type"=>"message")
			);
			
			$details = json_encode($fields);
            curl_setopt($curl_session, CURLOPT_POSTFIELDS, $details);
	        $result_curl = curl_exec($curl_session);
		}
    }
  }
} catch (ParseException $ex) {
    echo $ex->getMessage();
}

curl_close($curl_session);
mysqli_close($conn);
echo "success";

?>