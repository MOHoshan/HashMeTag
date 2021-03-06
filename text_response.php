<?php 

// My own tokens, Modhafir Hoshan
require 'app_tokens.php';

// Create an OAuth connection
require 'tmhOAuth.php';
$connection = new tmhOAuth(array(
  'consumer_key'    => $consumer_key,
  'consumer_secret' => $consumer_secret,
  'user_token'      => $user_token,
  'user_secret'     => $user_secret
));

// use https://api.twitter.com/1.1/search/tweets.json 
// Get the test Hashtag with the Twitter API
$http_code = $connection->request('GET',$connection->url('1.1/search/tweets.json'), 
	array('text' => 'hashtag',
		'count' => 100));
			
// Request was successful
if ($http_code == 200) {
	
	// Extract the tweets from the API response
	$tweet_data = json_decode($connection->response['response'],true);
	
	// Accumulate tweets from results
	$tweet_stream = '';		
	foreach($tweet_data['statuses'] as $tweet) {
		
		// Add this tweet's text to the results
		$tweet_stream .= $tweet['text'] . '<br/><br/>';
	}
		
	// Send the tweets back to the Ajax request
	print $tweet_stream;
	
// Handle errors from API request
} else {
	if ($http_code == 429) {
		print 'Error: Twitter API rate limit reached';
	} else {
		print 'Error: Twitter was not able to process that request';
	}
}
?>
