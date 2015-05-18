$(document).ready(function() {	


	$(".close_tweet").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var id = twit_id.split("_");
		close_popup(id[2]);
	});
	
	$(".tweet_reply").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var id = twit_id.split("_");
		replay_popup(id[2]);				
	});
	
	$(".tweet_retweet").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var id = twit_id.split("_");
		retweet_popup(id[2]);				
	}); 

	$(".tweet_button").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var twit_text = $("#"+twit_id+" .reply_text").val();		
		var id = twit_id.split("_");
		send_reply(id[2],twit_text);
	});

	$(".retweet_button").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var text_text = $("#"+twit_id+" .retweet_text").val();		
		var id = twit_id.split("_");
		send_retweet(id[2],text_text);
	});	

	$(".favorite_button").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var id = twit_id.split("_");
		send_favorite(id[2]);
	});

	$(".view_summary_button").click(function() {
		
		var twit_id = $(this).closest('.twits_element').attr('id');
		var id = twit_id.split("_");
		view_summary(id[2]);
	});	
}); 

function view_summary(twit_id,info) {		
	
	$.post( "php/popups/view_summary.php", { twit_id: twit_id, info: info }, function( data ) {	
		
		$(".popup_bg").fadeIn( "slow", function() {
			var body_height = $(document).height();
			$(".popup_bg").css("height",body_height+"px");
			$("#twits_element_"+twit_id+" .twits_popup1").html(data);		
		});
	});
}

function info1(twit_id,info) {		
	
	$.post( "php/popups/info1.php", { twit_id: twit_id, info: info }, function( data ) {	
		
		$("#twits_element_"+twit_id+" .twits_popup1").html(data);		
		setTimeout(function(){ 
			close_popup(twit_id);
		}, 1200);
	});
}

function close_popup(twit_id) {

	$(".popup_bg").fadeOut( "slow", function() {});
	$("#twits_element_"+twit_id+" .twits_popup1").html('');
}

function replay_popup(twit_id) {
	
	$.post( "php/popups/reply.php", { twit_id: twit_id }, function( data ) {	
		
		var body_height = $(document).height();
		$(".popup_bg").css("display","block");
		$(".popup_bg").css("height",body_height+"px");
		$("#twits_element_"+twit_id+" .twits_popup1").html(data);
	});
}

function retweet_popup(twit_id) {
	
	$.post( "php/popups/retweet.php", { twit_id: twit_id }, function( data ) {	
		 
		var body_height = $(document).height();
		$(".popup_bg").css("display","block");
		$(".popup_bg").css("height",body_height+"px");
		$("#twits_element_"+twit_id+" .twits_popup1").html(data);
	});
}


function send_reply(twit_id,twit_text) {
	
	$.post( "ajax/twitter_communication.php", { type: 'reply', twit_id: twit_id, twit_text: twit_text }, function( data ) {		
		info1(twit_id,"Tweet send!");
	});
}

function send_retweet(twit_id,twit_text) {
	
	$.post( "ajax/twitter_communication.php", { type: 'retweet', twit_id: twit_id, twit_text: twit_text }, function( data ) {		
		info1(twit_id,"Retweet sent!");
	});
}

function send_favorite(twit_id) {
	
	$.post( "ajax/twitter_communication.php", { type: 'favorite', twit_id: twit_id }, function( data ) {		

		$(".popup_bg").fadeIn( "slow", function() {
			var body_height = $(document).height();
			$(".popup_bg").css("height",body_height+"px");
			info1(twit_id,"Favorite sent!");	
		});
	});
}