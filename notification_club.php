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

$object_id = $_POST["object_id"];
$club_id = $_POST["club_id"];
$club_name = $_POST["club_name"];

try {
  $query = new ParseQuery("ClubNotification");
  $query->equalTo("objectId", $object_id);
  $parse_object = $query->first();
  
  $heading = $parse_object->get("heading");
  $message = $parse_object->get("message");
  $temp = $parse_object->get("image");
  $image = $temp->getURL();
  
  $query_club = new ParseQuery("Club");
  $object = $query_club->get($club_id);
  $users_list = $object->get("connected_id");
  
  
  for($i = 0;$i<count($users_list);$i++){
	$query = "select * from fcm_info where id = '$users_list[$i]'";
	$result = mysqli_query($conn,$query);
	echo $users_list[$i];
	echo "<br>";
	while($row = mysqli_fetch_array($result)){
		$fields = array(
			"to"=>$row["token"],
			"data"=>array("club_id"=>$club_id,"club_name"=>$club_name,"heading"=>$heading,"message"=>$message,"image_url"=>$image,"type"=>"club")
		);
			
		$details = json_encode($fields);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $details);
	    $result_curl = curl_exec($curl_session);
	}
  }
} catch (ParseException $ex) {
    echo $ex->getMessage();
}

curl_close($curl_session);
mysqli_close($conn);
echo "success";

?>