<?php
require 'parse-php-sdk-master/autoload.php';

use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;
use Parse\ParseException;
use Parse\ParseFile;
use Parse\ParseCloud;


$app_id = "OCbIsKw6KBpwaiL6HsG7AwY2ZJC8AHh4TwhO9x1V";
$rest_key = "bE5qg05CVVjxgSIQwqmWEGNrnCELu7TJ6Gltf6rE";
$master_key = "miiAmedTDPCMLR6KcAliIPOvPwHoqubP9IAU9P6p";

ParseClient::initialize( $app_id, $rest_key, $master_key );

ParseClient::setServerURL('https://parseapi.back4app.com','/');

?>