<?php

//get latest id
$query = "SELECT * FROM twitts ORDER BY id DESC"; 
$twits_arr='';
if ($result = $conn->query($query)) {

    while ($obj = $result->fetch_object()) {
		
		$twits_arr[$obj->id]['twittid']=$obj->twittid;
		$twits_arr[$obj->id]['created_at']=$obj->created_at;
		$twits_arr[$obj->id]['id']=$obj->id;
		$twits_arr[$obj->id]['text']=$obj->text;
		$twits_arr[$obj->id]['name']=$obj->name;
		$twits_arr[$obj->id]['retweeted_status']=$obj->retweeted_status;
		$twits_arr[$obj->id]['screen_name']=$obj->screen_name;
		$twits_arr[$obj->id]['profile_image_url0']=$obj->profile_image_url0;
		$twits_arr[$obj->id]['profile_image_url']=$obj->profile_image_url;
		$twits_arr[$obj->id]['location']=$obj->location;
		$twits_arr[$obj->id]['description']=$obj->description;
    }
    $result->close();
}




//view in bigger app separated file depending on structure
?>

<? foreach($twits_arr as $key => $value) { ?>	

	<div class="twits_element" id="twits_element_<? echo $twits_arr[$key]['id']; ?>">
		<div class="twits_popup1">
			<? //include_once('php/popups/info1.php'); ?>
			<? //include_once('php/popups/reply.php'); ?>
			<? //include_once('php/popups/retweet.php'); ?>
		</div>
		<div class="twits_element1">
			<? if ($twits_arr[$key]['retweeted_status'] != '') { ?>
				<div class="retweeted_tweeted_by"><span><? echo $twits_arr[$key]['name']; ?> retweeted</span></div>
			<? } ?>
		</div>
		<div class="twits_element10_1">
			<? if ($twits_arr[$key]['retweeted_status'] != '') { ?>
				<img src="<? echo $twits_arr[$key]['profile_image_url']; ?>" />
			<? } else { ?>
				<img src="<? echo $twits_arr[$key]['profile_image_url0']; ?>" />
			<? } ?>
		</div>
		<div class="twits_element10_2">
			<div class="twits_element2">
				<? if ($twits_arr[$key]['retweeted_status'] != '') { ?>
					<? echo '<span class="retweeted_name">'.$twits_arr[$key]['retweeted_status'].'</span>'; ?>
					<? echo '<span class="retweeted_screen_name">@'.$twits_arr[$key]['screen_name'].'</span>'; ?>
					<? echo '<span class="retweeted_date">'.$twits_arr[$key]['created_at'].'</span>'; ?>
				<? } ?>
			</div>
			<div class="twits_element3">
				<span class="retweeted_tweet"><? echo $twits_arr[$key]['text']; ?></span><br />
			</div>
		</div>
		<div class="twits_element4">
			<a class="tweet_reply"><span>Reply</span></a>
			<a class="tweet_retweet"><span>Retweet</span></a>
			<a class="favorite_button"><span>Favorite</span></a>
			<a class="view_summary_button"><span>View summary</span></a><br />
		</div>
	</div>
<? } ?>