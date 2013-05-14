<?php
	  $messagetopost = $_POST["message"];
	  $user_token = $_POST["user_token"];
	  $site_subdomain = 'aponcol';
	  $site_public_key = '085b4614-7fdf-4069-97ac-5caeaf052bba';
	  $site_private_key = '41183b78-f478-412a-9b08-a3dc21ae7f7d';
	  $site_domain = $site_subdomain.'.api.oneall.com';
	
	  $resource_uri = 'https://'.$site_domain.'/users/'.$user_token.'/publish.json';
	  echo($resource_uri."<br/>");
	  //echo($resource_uri);
	  //Setup connection
	  $messagetopost = '{
  "request":{
    "message":{
      "providers":[
        "facebook"
      ],
	  "parts": {
        "text": {
          "body": "'.$messagetopost.'"
        }
	  }
    }
  }
}';
	  //$messagetopost = json_encode($messagetopost);
	  $curl = curl_init();
	  curl_setopt($curl, CURLOPT_URL, $resource_uri);
	  curl_setopt($curl, CURLOPT_POST, 1);
	  curl_setopt($curl, CURLOPT_POSTFIELDS, $messagetopost);
	  curl_setopt($curl, CURLOPT_HEADER, 0);
	  curl_setopt($curl, CURLOPT_USERPWD, $site_public_key . ":" . $site_private_key);
	  curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	  curl_setopt($curl, CURLOPT_VERBOSE, 0);
	  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
	  curl_setopt($curl, CURLOPT_FAILONERROR, 0);
	  
	 
	  //Send request
	  $result_json = curl_exec($curl);
	  print_r($result_json);
	  if ($result_json === false)
		  {
			//You may want to implement your custom error handling here
			echo 'Curl error: ' . curl_error($curl). '<br />';
			echo 'Curl info: ' . curl_getinfo($curl). '<br />';
			curl_close($curl);
		  }
	  //Success
	  else {
	      echo('The message has been posted!');
		  curl_close($curl);
	   }
?>

  
