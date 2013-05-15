<?php
	// Call set_include_path() as needed to point to your client library.
	require_once 'google-api-php-client/src/Google_Client.php';
	require_once 'google-api-php-client/src/contrib/Google_YouTubeService.php';
	
	/* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
	  Google APIs Console <http://code.google.com/apis/console#access>
	  Please ensure that you have enabled the YouTube Data API for your project. */
	  $DEVELOPER_KEY = 'AIzaSyBrd7H-rEyn_bxcFnFUPbP8qAa7a-00qXo';
	
	$client = new Google_Client();
  	$client->setDeveloperKey($DEVELOPER_KEY);
	
	$youtube = new Google_YoutubeService($client);
	
	try {
		$searchResponse = $youtube->playlistItems->listSearch('id,snippet', array('playlistId' => 'PL3E245DF445E37F50'));
	
		$videos = '';
		$channels = '';
		$playlists = '';
	
		foreach ($searchResponse['items'] as $searchResult) {
		  switch ($searchResult['id']['kind']) {
			case 'youtube#video':
			  $videos .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
				$searchResult['id']['videoId']);
			  break;
			case 'youtube#channel':
			  $channels .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
				$searchResult['id']['channelId']);
			  break;
			case 'youtube#playlist':
			  $playlists .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'],
				$searchResult['id']['playlistId']);
			  break;
			  }
		}
?>
    <h3>Videos</h3>
    <ul><?php echo $videos; ?></ul>
    <h3>Channels</h3>
    <ul><?php echo $channels; ?></ul>
    <h3>Playlists</h3>
    <ul><?php echo $playlists; ?></ul>
<?php

  } catch (Google_ServiceException $e) {
    //$htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
      //htmlspecialchars($e->getMessage()));
	  echo "Service Error";
  } catch (Google_Exception $e) {
    //$htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
      //htmlspecialchars($e->getMessage()));
	  echo "Exception".$e->getMessage();
  }
	
	//$requestUrl = "https://www.googleapis.com/youtube/v3/videos?playlistId=PL3E245DF445E37F50&key=AIzaSyBrd7H-rEyn_bxcFnFUPbP8qAa7a-00qXo&part=snippet";
	//$youtubeRequest = file_get_contents(requestUrl);
	
	
	/*$con = mysql_connect('127.0.0.1','root','');
	if (!$con){
	  die('Could not connect to database: ' . mysql_error());
	} 
	$dbs = mysql_select_db('videogamemusicquiz', $con);
	mysql_close($con);*/
	
	/*
	$phpemail = $_GET["email"];
	$phppassword = $_GET["password"];
	
	$phpemail = mysql_real_escape_string($phpemail);
	$phppassword = mysql_real_escape_string($phppassword);
	
	$result = mysql_query("SELECT password FROM register WHERE email = '$phpemail'");
	$array = mysql_fetch_array($result);
	
	$dbpass = $array['password'];
	if($dbpass==$phppassword)
		echo "Valid!";
	else
		echo "Not!";
	
	*/
?>