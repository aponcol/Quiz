<?php 
include 'functions.php';
$connection_token = $_POST['connection_token'];
$id = $_GET['id'];
if ($connection_token=="") { $connection_token=$_GET['connection_token']; }
$user_token=""; 

if (! empty ($connection_token)) {
	$userData = GetInfo($connection_token);
	$user_token = $userData->response->result->data->user->user_token;
	setcookie("user_token", $user_token,  time()+60*60*24*30*2);
	setcookie("connection_token", $connection_token);
	UpdateConnectionToken($user_token,$connection_token);
	$data = $userData->response->result->data;
} else {
	$connection_token = $_COOKIE["connection_token"];
	$userData = GetInfo($connection_token);
	$user_token = $userData->response->result->data->user->user_token;
}
ConnectToDB();
$result = mysql_query("SELECT imagePath,favFootballTeam FROM user_social_link WHERE user_token LIKE '$user_token'");
$array = mysql_fetch_array($result);
$imagePath = "/images/".$array['imagePath'];
$favteam = $array['favFootballTeam'];
DisconnectFromDB();
?><html>
    <head>
        <br>
        <title>Testing site Gabriel</title>
    <!-- This is a testing site to improve my HTML skills -->
    <style type="text/css">
  
    h1 { text-align : center;}
    #login {
	padding:0px 0px 0px 330px; 
	text-align:left;
	vertical-align:top;
	}
	#fb-login-button {
		align:left;
	}
    
    </style>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" ></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" ></script>
    <script type="text/javascript" src=password.js></script>
    <script type="text/javascript" src=validate.js></script> 
	<script type="text/javascript">
	 
	 
	 var oneall_js_protocol = (("https:" == document.location.protocol) ? "https" : "http");
	 document.write(unescape("%3Cscript src='" + oneall_js_protocol + "://aponcol.api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E"));
	
	</script>
	</head>
    
    <body bgcolor = #FFFFFF>

    <center>
        <div>
        <h1>Login site.</h1>
        </div>
        <div style="cellspacing:2pt; cellpadding:2pt; border:1; align:center; width:600; margin:0pt; padding:0px;">
            <p align = center>This is a testing site. All the data is used for personal testing use and it won't be used for any other purpose. No personal info is stored on the database. </p>
        </div>
        <br />
        <div style="border:1; align:center; width:600; bgcolor:#FFFFFF; margin:0pt;">
            <div>
                <img align="left" style="width:300px;" src="<?php if ($imagePath!="/images/") { print_r($imagePath); } else { ?> http://web.me.com/apontecolina/Testing/Images/In_Defacto.jpg <?php } ?>">
            </div>
            <?php if ( ( empty ($connection_token))&&($id=="")) {
			?>
			<p> Login using your social media account: </p>
			<div id="social_login_container" style="float:right; width:280px; margin-top:0px; margin-bottom:15px;"></div>
			<script type="text/javascript">
			 oneall.api.plugins.social_login.build("social_login_container", {
			  'providers' :  ['facebook', 'google', 'twitter', 'wordpress'], 
			  'callback_uri': 'http://aponcol.co.cc/'
			 });
			</script>
			<div id="login">
                <p>...or with the provided email and password: </p>
                <form name="formulario" id="formulario" action="javascript:void(0);" method="post">
                Email: <br><input style="h1" type="text" name="email" id='email' /><br>
                Password: <br><input type="password" name="password" id='password' />
				<input type="hidden" name="connection_token" id="connection_token" value="<?php if (! empty ($_POST['connection_token'])) { print_r($_POST['connection_token']); } ?>">
				<input type="submit" value="Submit" onClick="return validate(formulario)" />
                </form>
            </div>
			<?php } else {
						
						if($id!="") {
							ConnectToDB();
							$userinfo = mysql_query("SELECT name,email,favFootballTeam FROM user_social_link WHERE id LIKE '$id'");
							$userarray = mysql_fetch_array($userinfo);
							$userrows = mysql_num_rows($userinfo);
							$name = $userarray['name'];
							$email = $userarray['email'];
							$favteam = $userarray['favFootballTeam'];
							
							echo ("Welcome! This is your info:<br/>");
							echo($name);
							echo ("<br/>");
							echo("Email: ".$email);
							echo ("<br/>");
							
							DisconnectFromDB();
							
						} 
						
						$data = $userData->response->result->data;
							
							if ($data->plugin->key == 'social_login') {
							  //Operation successfull
							  if ($data->plugin->data->status == 'success')
							  {
								$user_id = GetUserIdForUserToken($user_token); 
								
								if ($user_id === null)
								{
								  LinkUserTokenToUserId ($user_token);
								}
								else
								{         
								  // 2.2.1] The account already exists
									echo ("This is your FB display name:<br/>");
									print_r($data->user->identity->displayName);
									echo ("<br/>");
									echo("Favorite Team: ".$favteam);
									echo ("<br/>");
									$contacts = GetContacts($user_token)->response->result->data->results[0]->contacts;
									echo(count($contacts)." friends.<br/>");
									for ($i = 0; $i <= 2; $i++) {
										echo("<img src=\"");
										print_r($contacts[$i]->thumbnailUrl);
										echo("\" />");
										print_r($contacts[$i]->name->formatted);
										echo("<br/>");
									}
									echo("... and your profile pic:<br/>");
									$photoLarge = $data->user->identity->photos[1]->value;
									//$post = PostMessage($user_token,"2nd Test");
								}
								// 3.1] Setup your session/cookies to login the user
								// 3.2] Forward the user to his account dashboard       
							  }
							}
						
							
					}
			?>
		<div align="center">
        <?php if (! empty ($connection_token)) { ?><img id="image" src="<?php echo($photoLarge); ?>" /><?php } ?>
        </div>
		
		<?php //$messages = GetMessages($user_token);
		      //print_r($messages);
			  if ( empty ($connection_token)) { ?><p>To register, click <a href="/register.php">here</a></p><?php } ?>
			Post to the wall: <br/><input type="text" name="towall" id="towall" /><br/>
			<input type="button" value="Post to Wall" onClick="javascript:PostToWall('#towall','<?php echo($user_token);?>');" />
		</div><br/>
		<input type="button" value="Logoff" onClick="javascript:Logoff();" />
	</div>
       
    
    </body>
</html>