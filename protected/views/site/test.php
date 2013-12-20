<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */

/* Load required lib files. */
session_start();
// require_once('twitteroauth/twitteroauth.php');
// require_once('config.php');


$oauth_token = "";
$oauth_token_secret = "";
/* If access tokens are not available redirect to connect page. */
if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
    // session_start();
	
	session_destroy();
	if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
	  echo 'You need a consumer key and secret to test the sample code. Get one from <a href="https://twitter.com/apps">https://twitter.com/apps</a>';
	  exit;
	}
	
	/* Build TwitterOAuth object with client credentials. */
	// dump(CONSUMER_KEY);
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	 // dump(CONSUMER_KEY);
	/* Get temporary credentials. */
	$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
	// dump($request_token);
	/* Save temporary credentials to session. */
	// $_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
	// $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$oauth_token = $token = $request_token['oauth_token'];
	$oauth_token_secret = $request_token['oauth_token_secret'];
	
	 
	/* If last connection failed don't display authorization link. */
	switch ($connection->http_code) {
	  case 200:
		/* Build authorize URL and redirect user to Twitter. */
		$url = $connection->getAuthorizeURL($token);
		header('Location: ' . $url); 
		break;
	  default:
		/* Show notification if something went wrong. */
		echo 'Could not connect to Twitter. Refresh the page or try again later.';
	}
		// die('a');
}
/* Get user access tokens out of the session. */
// $access_token = $_SESSION['access_token'];
Yii::app()->session['oauth_token'] = $oauth_token;
Yii::app()->session['oauth_token_secret'] = $oauth_token_secret;
/* Create a TwitterOauth object with consumer/user tokens. */
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

// $content = $connection->get('users/show', array('screen_name' => 'abraham'));
// dump($content);
/* If method is set change API call made. Test is called by default. */
// $content = $connection->get('account/verify_credentials');
// $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
// Yii::app()->session['twitter_token']  = $connection->getAccessToken($_REQUEST['oauth_verifier']);
// Yii::app()->session['twitter'] =  $connection->get('/account/verify_credentials.json?oauth_consumer_key='.CONSUMER_KEY.'&oauth_nonce=10b81b68b401081e2fa1ebc73edffb1a&oauth_signature=10b81b68b401081e2fa1ebc73edffb1a&oauth_signature_method=HMAC-SHA1&oauth_timestamp='.time().'&oauth_token='.Yii::app()->session['oauth_token']);

// Yii::app()->session['url'] = '/account/verify_credentials.json?oauth_consumer_key='.CONSUMER_KEY.'&oauth_nonce=10b81b68b401081e2fa1ebc73edffb1a&oauth_signature=10b81b68b401081e2fa1ebc73edffb1a&oauth_signature_method=HMAC-SHA1&oauth_timestamp='.time().'&oauth_token='.Yii::app()->session['oauth_token'];





/* Some example calls */
// $connection->get('users/show', array('screen_name' => 'abraham'));
//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
//$connection->post('statuses/destroy', array('id' => 5437877770));
//$connection->post('friendships/create', array('id' => 9436992));
//$connection->post('friendships/destroy', array('id' => 9436992));

/* Include HTML to display on the page */
?>
