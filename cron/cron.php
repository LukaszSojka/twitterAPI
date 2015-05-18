<?php

#######################################################
#
#	get new twits into database, use cron on server to run this process
#
#######################################################

require_once('../config/mysql.php');
require_once('../config/twitter.php');
require_once('../php/api/TwitterAPIExchange.php');

$url = "https://api.twitter.com/1.1/statuses/user_timeline.json";
$requestMethod = "GET";

$user  = "ekomi";
$count = 200;

//get latest id
$query = "SELECT id FROM twits ORDER BY id DESC LIMIT 1"; 
if ($result = $conn->query($query)) {

    while ($obj = $result->fetch_object()) {
        $since_id=$obj->id;
    }

	//close db coonection
	$result->close();
}
 
if ($since_id != '') {
	$getfield = "?screen_name=$user&count=$count&since_id=$since_id";
} else {
	$getfield = "?screen_name=$user&count=$count";	
}
$twitter = new TwitterAPIExchange($twitter_settings); 

$string = json_decode($twitter->setGetfield($getfield)
->buildOauth($url, $requestMethod)
->performRequest(),$assoc = TRUE);

if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

/* 
//display array of results in browseer
echo "<pre>";
print_r($string);
echo "</pre>";
*/

foreach($string as $val) {
	
	foreach ($val as $key => $value) {
		if (!is_array($value)) {
			$val[$key]=addslashes($value);
		}
	}
	
	foreach ($val['user'] as $key => $value) {
		if (!is_array($value)) {
			$val['user'][$key]=addslashes($value);
		}
	}
	echo $val['retweeted_status']['user']['name']; 
	
	//insert twitts into database
	$query = "INSERT INTO twitts
	(twittid,created_at,id,text,
	name,location,description,retweeted_status,screen_name,
	profile_image_url0,profile_image_url,createtime)
	VALUES (NULL,'".$val['created_at']."',".$val['id'].",'".$val['text']."',
	'".$val['user']['name']."','".$val['user']['location']."','".$val['user']['description']."',
	'".$val['retweeted_status']['user']['name']."','".$val['retweeted_status']['user']['screen_name']."',
	'".$val['user']['profile_image_url']."','".$val['retweeted_status']['user']['profile_image_url']."','".date("Y-m-d H:i:s")."')";
	$conn->query($query);
}

?>