<?php

$path_to_fcm = "https://fcm.googleapis.com/fcm/send";
$server_key = "AAAArb0XIzA:APA91bE9xLzxvrix8arDorPWEwSa-MWieJA7afFCdhEBNih1_-vejQfM3lONVEzFADyk17CL5YeM_I7RF3eY7UrQaL6GPiIlCgJg7cbgMjxcNxfEevgic9sBiPGIVbdJ_b4D1htVmrYI";

$headers = array(
		"Authorization:key=" .$server_key,
		"Content-Type:application/json"
		);

$curl_session = curl_init();
curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
curl_setopt($curl_session, CURLOPT_POST, true);
curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);    //Check its usage

?>