<?php 
function ConnectToDB() {
	$con = mysql_connect('localhost','aponcolc_main','al=r0205');
	if (!$con){
	  die('Could not connect to database: ' . mysql_error());
	}

	$dbs = mysql_select_db('aponcolc_users', $con);
  }
  
  function  DisconnectFromDB() {
	mysql_close(mysql_connect('localhost','aponcolc_main','al=r0205'));
  }
  
  function GetUserIdForUserToken($token) {
	ConnectToDB();
	
	$result = mysql_query("SELECT id FROM user_social_link WHERE user_token = '$token'");
	$array = mysql_fetch_array($result);

	if($array[0]) {
	  return $array[0];
	}
	else {
		return null;
	}
	
	DisconnectFromDB();
  }

function GetMessages($user_token) {
	  $site_subdomain = 'aponcol';
	  $site_public_key = '085b4614-7fdf-4069-97ac-5caeaf052bba';
	  $site_private_key = '41183b78-f478-412a-9b08-a3dc21ae7f7d';
	  $site_domain = $site_subdomain.'.api.oneall.com';
	
	  $resource_uri = 'https://'.$site_domain.'/users/'.$user_token.'/details.json';
	  //echo($resource_uri);
	  //Setup connection
	  $curl = curl_init();
	  curl_setopt($curl, CURLOPT_URL, $resource_uri);
	  curl_setopt($curl, CURLOPT_HEADER, 0);
	  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
	  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	  curl_setopt($curl, CURLOPT_VERBOSE, 0);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
	  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
	 
	  //Send request
	  $result_json = curl_exec($curl);
	  
	  if ($result_json === false)
		  {
			//You may want to implement your custom error handling here
			echo 'Curl error: ' . curl_error($curl). '<br />';
			echo 'Curl info: ' . curl_getinfo($curl). '<br />';
			curl_close($curl);
		  }
	  //Success
	  else {
	      curl_close($curl);
		  $userData = json_decode($result_json);
		  return $userData;
	   }
}
  
function GetContacts($user_token) {
	  $site_subdomain = 'aponcol';
	  $site_public_key = '085b4614-7fdf-4069-97ac-5caeaf052bba';
	  $site_private_key = '41183b78-f478-412a-9b08-a3dc21ae7f7d';
	  $site_domain = $site_subdomain.'.api.oneall.com';
	
	  $resource_uri = 'https://'.$site_domain.'/users/'.$user_token.'/contacts.json';
	  //echo($resource_uri);
	  //Setup connection
	  $curl = curl_init();
	  curl_setopt($curl, CURLOPT_URL, $resource_uri);
	  curl_setopt($curl, CURLOPT_HEADER, 0);
	  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
	  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	  curl_setopt($curl, CURLOPT_VERBOSE, 0);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
	  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
	 
	  //Send request
	  $result_json = curl_exec($curl);
	  
	  if ($result_json === false)
		  {
			//You may want to implement your custom error handling here
			echo 'Curl error: ' . curl_error($curl). '<br />';
			echo 'Curl info: ' . curl_getinfo($curl). '<br />';
			curl_close($curl);
		  }
	  //Success
	  else {
	      curl_close($curl);
		  $userData = json_decode($result_json);
		  return $userData;
	   }
}

function GetInfo($token) {
		//Your Site Settings
	  $site_subdomain = 'aponcol';
	  $site_public_key = '085b4614-7fdf-4069-97ac-5caeaf052bba';
	  $site_private_key = '41183b78-f478-412a-9b08-a3dc21ae7f7d';
	 
	  //API Access Domain
	  $site_domain = $site_subdomain.'.api.oneall.com';
	
	  //Connection Resource
	  
	  $resource_uri = 'https://'.$site_domain.'/connections/'.$token.'.json';
	  //echo($resource_uri);
	  //Setup connection
	  $curl = curl_init();
	  curl_setopt($curl, CURLOPT_URL, $resource_uri);
	  curl_setopt($curl, CURLOPT_HEADER, 0);
	  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
	  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	  curl_setopt($curl, CURLOPT_VERBOSE, 0);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
	  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
	 
	  //Send request
	  $result_json = curl_exec($curl);
	  
	  if ($result_json === false)
		  {
			//You may want to implement your custom error handling here
			echo 'Curl error: ' . curl_error($curl). '<br />';
			echo 'Curl info: ' . curl_getinfo($curl). '<br />';
			curl_close($curl);
		  }
	  //Success
	  else {
	  
	  curl_close($curl);
	  $userData = json_decode($result_json);
	  return $userData;
	  }
  }
  
  function LinkUserTokenToUserId ($token) {
	ConnectToDB();
	
	$result = mysql_query("INSERT INTO `user_social_link`(`user_token`) VALUES ('$token')");
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
	DisconnectFromDB();
  }
  
  function UpdateConnectionToken($user_token,$connection_token) {
	ConnectToDB();
	
	$result = mysql_query("UPDATE `user_social_link` SET `connection_token`='$connection_token' WHERE `user_token` LIKE '$user_token'");
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}
	DisconnectFromDB();
  }
  function FillBlanksFB($element) {
	$userdata = GetInfo($_POST['connection_token']);
	$user_token = $userdata->response->result->data->user->user_token;
	UpdateConnectionToken($user_token,$_POST['connection_token']);
	$data = $userdata->response->result->data;
	echo('value="');
	if ($element=="displayName") {
		print_r($data->user->identity->displayName);
	} else if ($element=="email") {
		print_r($data->user->identity->emails[0]->value);
	} else {
		print_r($data);
	}
	echo('"');
  }
  
?>