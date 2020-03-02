<?php

/**
 * @file
 * Take the user when they return from Twitter. Get access tokens.
 * Verify credentials and redirect to based on response from Twitter.
 */

/* Start session and load lib */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('social/config.php');

/* If the oauth_token is old redirect to the connect page. */
/*if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
 $_SESSION['oauth_status'] = 'oldtoken';
// header('Location: http://www.thetweetmarket.com/clearsessions.php/');
 }*/

/* Create TwitteroAuth object with app key/secret and token key/secret from default phase */

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

/* Request access tokens from twitter */
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

/* Save the access tokens. Normally these would be saved in a database for future use. */
$_SESSION['access_token'] = $access_token;

/* Remove no longer needed request tokens */
unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

//$tweet_user_id= $connection->get('account/verify_credentials');
//$_SESSION['tweet_user_id']=$tweet_user_id->id;
//echo $tweet_user_id->id;
$connection->http_code;
//exit;
/* If HTTP response is 200 continue otherwise send to connect page to retry */
if (200 == $connection->http_code) {
	/* The user has been verified and the access tokens can be saved for future use */

	//for check id in database || By Maneesh ||
?>

<script type="text/javascript">

    window.opener.location.reload();
	window.close();
</script>


<?php

} else {

}
?>
