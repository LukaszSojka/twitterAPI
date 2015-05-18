<?php

require_once('../config/mysql.php');
require_once('../config/twitter.php');
require_once('../php/api/TwitterAPIExchange.php');

if ($_POST['type'] == 'reply') {
	
	$url = "https://api.twitter.com/1.1/statuses/update.json";
	$requestMethod = "POST";
	  
	$twitter = new TwitterAPIExchange($twitter_settings); 
	$postFields = array(
		'status' => $_POST['twit_text'],
		'in_reply_to_status_id' => $_POST['twit_id']
	);

	$string = json_decode($twitter->setPostfields($postFields)
	->buildOauth($url, $requestMethod)
	->performRequest(),$assoc = TRUE);

	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

	//display feedback in firebug
	echo "<pre>";
	print_r($string);
	echo "</pre>";
	
} elseif ($_POST['type'] == 'retweet') {

	$url = "https://api.twitter.com/1.1/statuses/retweet/".$_POST['twit_id'].".json";
	$requestMethod = "POST";
	  
	$twitter = new TwitterAPIExchange($twitter_settings); 
	$postFields = array(
		'id' => '123'
	);

	$string = json_decode($twitter->setPostfields($postFields)
	->buildOauth($url, $requestMethod)
	->performRequest(),$assoc = TRUE);

	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

	//display feedback in firebug
	echo "<pre>";
	print_r($string);
	echo "</pre>";
	
} elseif ($_POST['type'] == 'favorite') {
	
	$url = "https://api.twitter.com/1.1/favorites/create.json";
	$requestMethod = "POST";
	  
	$twitter = new TwitterAPIExchange($twitter_settings); 
	$postFields = array(
		'id' => $_POST['twit_id']
	);

	$string = json_decode($twitter->setPostfields($postFields)
	->buildOauth($url, $requestMethod)
	->performRequest(),$assoc = TRUE);

	if($string["errors"][0]["message"] != "") {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}

	//display feedback in firebug
	echo "<pre>";
	print_r($string);
	echo "</pre>";
}

?>