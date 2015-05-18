<?

//db connect
require_once('../../config/mysql.php');

//get tweet info
$query = "SELECT * FROM twitts WHERE id='".$_POST['twit_id']."'"; 
$twits_arr='';
if ($result = $conn->query($query)) {

    while ($obj = $result->fetch_object()) {
		
		$twits_arr['twittid']=$obj->twittid;
		$twits_arr['created_at']=$obj->created_at;
		$twits_arr['id']=$obj->id;
		$twits_arr['text']=$obj->text;
		$twits_arr['name']=$obj->name;
		$twits_arr['retweeted_status']=$obj->retweeted_status;
		$twits_arr['screen_name']=$obj->screen_name;
		$twits_arr['location']=$obj->location;
		$twits_arr['profile_image_url0']=$obj->profile_image_url0;
		$twits_arr['profile_image_url']=$obj->profile_image_url;
		$twits_arr['description']=$obj->description;
    }
    $result->close();
}

//close db connection 
$conn->close();

?>
<div class="twits_reply_popup">
	<div class="popup1">
		<a class="close_popup close_tweet">x</a>
		<div class="popup1_head1">
			Reply to @<? echo $twits_arr['screen_name'] ?>
		</div>
		<div class="popup1_head2">
			<div class="popup1_head2_1">
				<? if ($twits_arr['retweeted_status'] != '') { ?>
					<img src="<? echo $twits_arr['profile_image_url']; ?>" />
				<? } else { ?>
					<img src="<? echo $twits_arr['profile_image_url0']; ?>" />
				<? } ?>
			</div>
			<div class="popup1_head2_2">
				<span class="popup1_head2_t1"><? echo $twits_arr['retweeted_status'] ?></span>
				<span class="popup1_head2_t2">‏@<? echo $twits_arr['screen_name'] ?> <? echo $twits_arr['created_at'] ?></span> <br />
				<span class="popup1_head2_t3">
					<? echo $twits_arr['text'] ?>
				</span>	
			</div>
			<div class="clear"></div>
		</div>
		<div class="popup1_body">
			<textarea class="reply_text" name=""></textarea>
		</div>  	
		<div class="popup1_submit">
			<input type="submit" name="" value="Tweet" class="tweet_button" />
		</div>
	</div>
</div>
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>