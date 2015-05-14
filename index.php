<?php
//configuration for our PHP server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();
//make constants using define.

define('clientID', '8ff07ece43184a1981567fa73fe626c6');
define('client_Secret', 'b473eeea0b584196a84352e8e31b38be');
define('redirectURI', 'http://localhost/instagrampage/index.php');
define('ImageDirectory', 'pics/');

//function that is going to connect to Instagram.
function connectToInstagram($url){
	$ch = curl_init();

	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
	));
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
//Function to get userID cause userName doesn't allow us to get pictures
function getUserID($userName){
	$url = 'http://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;
	$instagramInfo = connectToInstagram($url);
	$results = json_decode($instagramInfo, true);
	echo $results['data']['0']['id'];
}


if (isset($_GET['code'])) {
	$code = ($_GET['code']);
	$url = 'https://api.instagram.com/oauth/access_token';
	$access_token_settings = array('client_id' => clientID,
									'client_secret' => clientSecret,
									'grant_type' => 'authorization_code',
									'redirect_uri' => redirectURI,
									'code' => $code
									);
//cURL is what we use in PHP, it's a library calls to other API's
$curl = curl_init($url); //setting a cURL session and we put in $url because that's where we are getting the data from.
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); //setting the POSTFIELDS to the array setup that we created.
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //setting it equal to 1 because we are getting strings back.
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //but in live work-production we want to set this to true.


$result = curl_exec($curl);
curl_close($curl);

$results = json_decode($result, true);
getUserID($results['user']['username']);
}
else {
?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Untitled</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="author" href="humans.txt">
</head>
<body>
	<!-- Creating a login for people to go and give approval for our web app to access their Instagram Account
	After getting approval we are now going to have the info so that we can play with it.
	 -->
	<a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI; ?>&response_type=code">LOGIN</a>
<script src="js/main.js"></script>
</body>
</html>
<?php
}
?>