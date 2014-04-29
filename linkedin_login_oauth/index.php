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
 * @author    Khadime Diakhate Teambuktoo
 * @category  Custom
 * @copyright Copyright (c) 2014, Teambuktoo, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

require_once('oAuth/config.php');
if ($config['linkedin_access'] === '' || CONSUMER_SECRET === '') {
  echo 'You need a API Key and Secret Key to test the sample code. Get one from <a href="https://www.linkedin.com/secure/developer">https://www.linkedin.com/secure/developer</a>';
  exit;
}

$content = '<a href="linkedin.php"><img src="./images/linkedin_connect_button.png" alt="Sign in with LinkedIn"/></a>';

include('html.inc');
