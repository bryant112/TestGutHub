
<?php
session_start();
 
require_once( 'Facebook/FacebookSession.php' );
require_once( 'Facebook/FacebookRedirectLoginHelper.php' );
require_once( 'Facebook/FacebookRequest.php' );
require_once( 'Facebook/FacebookResponse.php' );
require_once( 'Facebook/FacebookSDKException.php' );
require_once( 'Facebook/FacebookRequestException.php' );
require_once( 'Facebook/FacebookAuthorizationException.php' );
require_once( 'Facebook/GraphObject.php' );
require_once( 'Facebook/Entities/AccessToken.php' );
require_once( 'Facebook/HttpClients/FacebookHttpable.php' );
require_once( 'Facebook/HttpClients/FacebookStreamHttpClient.php' );
require_once( 'Facebook/HttpClients/FacebookStream.php' );
require_once( 'Facebook/HttpClients/FacebookStream.php' );
require_once( 'Facebook/FacebookPermissionException.php' );
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookStreamHttpClient;
use Facebook\FacebookPermissionException;

// init app with app id (APPID) and secret (SECRET)
FacebookSession::setDefaultApplication('345498798970598', '7c271ef014ec40f1ac5a6c27b279f82e');
 

// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper( 'http://localhost/FacebookTest3.php' );
 
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
 
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
   
  // print data
  echo  print_r( $graphObject, 1 );
} else {
  // show login url
  echo '<a href="' . $helper->getLoginUrl(array('scope' => 'publish_actions, email,user_groups')) . '">Login</a>';
}
if($session) {

  try {
/* PHP SDK v4.0.0 */
/* make the API call */
$request = new FacebookRequest(
  $session,
  'GET',
  '/me/groups'
);
$response = $request->execute();
$graphObject = $response->getGraphObject()->asArray();
echo '<pre>' .  print_r( $graphObject, 1 ) . '</pre>';
/* handle the result */


    $response = (new FacebookRequest(
      $session, 'POST', '/me/feed', array(
        'link' => 'www.example.com',
        'message' => 'User provided message'
      )
    ))->execute()->getGraphObject();

    echo "Posted with id: " . $response->getProperty('id');

  } catch(FacebookRequestException $e) {

    echo "Exception occured, code: " . $e->getCode();
    echo " with message: " . $e->getMessage();

  }   

}

?>