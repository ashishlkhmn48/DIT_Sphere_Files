<?php

// Get cURL resource
$curl = curl_init();
$url = "http://www.dituniversity.edu.in/happenings/news";
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
// Send the request & save response to $resp
$response = curl_exec($curl);

$match = array();
preg_match_all('/<ul id="blog-landing">(.*?)<\/ul>/s',$response,$match,PREG_PATTERN_ORDER);

$heading_array = array();
$heading = array();
preg_match_all('/<h3(.*?)">(.*?)<\/h3>/s',$match[0][0],$heading_array,PREG_PATTERN_ORDER);
for ($i = count($heading_array)-1 ; $i >= 2 ; $i--) {
    for ($j = 0; $j < count($heading_array[$i]); $j++) {
		array_push($heading,$heading_array[$i][$j]);
    }
}

$url_array = array();
$url = array();
$date_array = array();
$date = array();
preg_match_all('/(\/news\/.*?)"/s',$match[0][0],$url_array,PREG_PATTERN_ORDER);
preg_match_all('/<h4>(.*?)<\/h4>/s',$match[0][0],$date_array,PREG_PATTERN_ORDER);
for ($i = count($date_array)-1 ; $i >=1 ; $i--) {
    for ($j = 0 ; $j < count($date_array[$i]) ; $j++) {
		array_push($date,$date_array[$i][$j]);
		array_push($url,"http://www.dituniversity.edu.in" . $url_array[$i][$j]);
    }
}

$query = new ParseQuery("News");
$query->descending("createdAt");
$result = $query->first();

$key = array_search($result->get("url"), $url);

for($i=$key-1 ; $i>=0 ; $i--){
    
    $news = new ParseObject("News");
    $news->set("heading", $heading[$i]);
    $news->set("date", $date[$i]);
    $news->set("url", $url[$i]);
    
    try {
        $news->save();
        $query = "select * from fcm_info;";
        $result = mysqli_query($conn,$query);
        while($row = mysqli_fetch_array($result)){
            $fields = array(
	        "to"=>$row["token"],
	        "data"=>array("heading"=>$heading[$i],"type"=>"news")
		        );
	
            $details = json_encode($fields);
            curl_setopt($curl_session, CURLOPT_POSTFIELDS, $details);
	        $result_curl = curl_exec($curl_session);
        }
        echo "Notification Sent";
        echo "<br>";
    } catch (ParseException $ex) {  
        echo 'Failed to create new object, with error message: ' . $ex->getMessage();
    }
    
}
echo "Details Updated ".$key." Values";

?>