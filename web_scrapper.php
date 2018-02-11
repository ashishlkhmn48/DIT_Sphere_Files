<?php

include 'parse-php-sdk-master/autoload.php';
include 'db_connect.php';
include 'notify.php';
include 'parse_connect.php';

include 'scrap_news.php';
include 'scrap_upcoming_events.php';

curl_close($curl);
curl_close($curl_session);
mysqli_close($conn);

?>