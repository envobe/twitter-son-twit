<style>
.twitter-bubble {
	position: relative;
	width: 200px;
	padding: 19px;
	background: #96DDFF;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	color: #474747;
	display: inline-block;
}

.twitter-bubble:after 
{
	content: '';
	position: absolute;
	border-style: solid;
	border-width: 15px 11px 0;
	border-color: #96DDFF transparent;
	display: block;
	width: 0;
	z-index: 1;
	bottom: -15px;
	left: 110px;
}
</style>
<?php

include_once('twitteroauth/twitteroauth.php');

$twitter_customer_key           = '';
$twitter_customer_secret        = '';
$twitter_access_token           = '';
$twitter_access_token_secret    = '';

$connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);

$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => 'username?', 'count' => 1));

echo '<div class="twitter-bubble">';
if(isset($my_tweets->errors))
{           
    echo 'Error :'. $my_tweets->errors[0]->code. ' - '. $my_tweets->errors[0]->message;
}else{
    echo makeClickableLinks($my_tweets[0]->text);
}
echo '</div>';

function makeClickableLinks($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a target="blank" rel="nofollow" href="$1" target="_blank">$1</a>', $s);
}
?>
