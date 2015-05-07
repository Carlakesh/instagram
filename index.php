<?php
//configuration for our PHP server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();
//make constants using define.

define('client_id', '8ff07ece43184a1981567fa73fe626c6');
define('client_secret', 'b473eeea0b584196a84352e8e31b38be');
define('redirectURI', 'http://localhost/instagrampage/index.php');
define('ImageDirectory', 'pics/');
?>


<!--- CLIENT INFO
CLIENT ID	8ff07ece43184a1981567fa73fe626c6
CLIENT SECRET	b473eeea0b584196a84352e8e31b38be
WEBSITE URL	http://localhost/instagrampage/index.php
REDIRECT URI	http://localhost/instagrampage/index.php --> 