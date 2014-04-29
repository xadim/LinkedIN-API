<?php

/**
 * Plugin Name: LinkedIN API
 * Plugin URI: http://www.Teambuktoo.com/contact/
 * Description: LinkedIN Api develped by Khadime Diakhate Teambuktoo
 * Author: SkyVerge
 * Author URI: http://www.Teambuktoo.com
 * Version: 1.0
 *
 * Copyright: (c) 2013 Teambuktoo, Inc. (hello@teambuktoo.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @author    Teambuktoo
 * @category  Custom
 * @copyright Copyright (c) 2014, Teambuktoo, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

//Check session start

//This is main class, this must be included!
include 'src/SocialAuth.php';
//Check cookie first, if it is not set it means you are not logged in yet.
if (empty($_COOKIE['SocialAuth'])) {
    //action = login, logout ; type = twitter, facebook, google, linkedin
    if (!empty($_GET['action']) && $_GET['action'] == "login") {
        switch ($_GET['type']) {
            case 'linkedin':
		 
	session_start();
    include_once 'linkedin_login_oauth/oAuth/config.php';
    include_once 'linkedin_login_oauth/oAuth/linkedinoAuth.php';
    
    $linkedin = new LinkedIn($config['linkedin_access'], $config['linkedin_secret'], $config['base_url'] . 'linkedin_login_oauth/linkedinauth.php' );

    # Now we retrieve a request token. It will be set as $linkedin->request_token
    $linkedin->getRequestToken();
    $_SESSION['requestToken'] = serialize($linkedin->request_token);
  
    # With a request token in hand, we can generate an authorization URL, which we'll direct the user to
   ## echo "Authorization URL: " . $linkedin->generateAuthorizeUrl() . "\n\n";
    header("Location: " . $linkedin->generateAuthorizeUrl());

		    break;
            default:
                //If any login system found, warn user
                echo "Invalid Login system";
        }
    }
} else {
    if (!empty($_GET['action']) && $_GET['action'] == "logout") {
        //If action is logout, just expire the cookie
        SocialAuth::clearSessionData('SocialAuth');
        //var_dump($_COOKIE);exit;
        header("Location:" . SocialAuth::getConfig('main', 'base_path'));
    }
}   

?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
    <!--<![endif]-->
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width" />
        
        <title>Teambuktoo | LinkedIN Api</title>
        
        <!-- Social Network icones -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script src="js/popup.js"></script>
        <script src="js/common.js"></script>
        <!-- End Social Network icones -->
        
        <!-- CUSTOM JAVASCRIPT -->                           
        <script type="text/javascript" src="js/jquery.custom.js"></script>
</head>
    
    <body class="home image-sphere-style responsive">           

            <a href="javascript:;" onclick="openLoginDialog('?action=login&type=linkedin')">
                <img src="http://www.reciprocatellc.com/wp-content/uploads/2010/04/linkedin-logo.jpg" width="600px" height="170px"/></a>
                 <h2 style="color: #666; font-size:17px">Sign Up with LinkedIN API By Teambuktoo<br>"Don't forget to get an API Key and Secret Key to test the sample code. Get one from <a href="https://www.linkedin.com/secure/developer">https://www.linkedin.com/secure/developer</a>".</h2>


  <?php
  if (!empty($_GET['step']) && !empty($_GET['type']) && !empty($_GET['token']) && !empty($_GET['ref'])) {
      if (empty($_SESSION['complete_registration_type']) || empty($_SESSION['complete_registration_token'])) {
          SocialAuth::refreshSession();
          header("Location:" . SocialAuth::getConfig('main', 'base_path'));
      } else if ($_SESSION['complete_registration_type'] != $_GET['type'] || $_SESSION['complete_registration_token'] != $_GET['token'] || $_COOKIE['ref'] != urldecode($_GET['ref'])) {
          header("Location:" . SocialAuth::getConfig('main', 'base_path'));
          SocialAuth::refreshSession();
      } else {
          $userData = unserialize($_SESSION['complete_registration_data']);
          $username = ($userData["username"] != null) ? $userData["username"] : "";
          $email = ($userData["email"] != null) ? $userData["email"] : "";
          $disable = "";
          if (!empty($email)) {
              $disable = '$("#email").attr("disabled", "disabled");';
          }
          $checkResult = SocialAuth::checkUser($userData['username'], $userData['email'], $userData['type']);
          if ($checkResult['resultType'] == SocialAuth::$_NON_EXISTING_USER) {
              echo '<script type="text/javascript">$("#myModal").modal({ keyboard: false, backdrop: "static", toggle: "modal" });$("#username").val("' . preg_replace('/[^\00-\255]+/u', '', strtolower($username)) . '");$("#email").val("' . $email . '");$("#network-type").val("' . $_SESSION['complete_registration_type'] . '");' . $disable . '$("#email").focus();</script>';
          } else {
              SocialAuth::setSessionData('SocialAuth', $checkResult["data"]);
              $ref = $_COOKIE['ref'];
              SocialAuth::refreshSession();
              header("Location:" . $ref);
			  //echo "bla bla bla";
          }
      }
  }
  ?>            
    </body>
</html>

<?php ob_end_flush(); ?>
