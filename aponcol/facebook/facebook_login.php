<?php session_start();
   $code = $_REQUEST["code"];
   
   $app_id = "292198557496782";
   $app_secret = "d7cfe08679ed4556964430ffc6ed5a9b";
   $my_url = "http://aponcol.co.cc/facebook/facebook_login.php/";
    	
   if(empty($code)) {
     $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
     $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
       . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
       . $_SESSION['state'] . "&scope=email,read_stream,friends_about_me";

     echo("<script> top.location.href='" . $dialog_url . "'</script>");
   }
	
   if($_REQUEST['state'] == $_SESSION['state']) {
     $token_url = "https://graph.facebook.com/oauth/access_token?"."client_id=".$app_id."&redirect_uri=".urlencode($my_url)."&client_secret=".$app_secret."&code=".$code;
	  echo($token_url."<br/>");
	 $response = @file_get_contents($token_url);
	 $params = null;
     parse_str($response, $params);

     $graph_url = "https://graph.facebook.com/me?access_token=" 
       . $params['access_token'];

     $user = json_decode(file_get_contents($graph_url));
	 
     echo("Hello " . $user->name."<br/>".$user->gender."<br/>".$user->email."<br/>".$user->timezone."<br/>");
   }
   else {
     echo("The state does not match. You may be a victim of CSRF.");
   }

 ?>
 
 <html>
    <head>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" ></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" ></script>
    <script type="text/javascript" src="/validate.js"></script> 
	
	</head>
    
    <body>
	
    This is your info:
	<br/><img id="image" src="http://graph.facebook.com/<?php echo($user->id);?>/picture" />
	
	
	
    
    </body>
</html>
