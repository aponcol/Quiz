<?php 
include 'functions.php';
?>
<html>
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
        <h1>Register</h1>
        </div>
        <div style="cellspacing:2pt; cellpadding:2pt; border:1; align:center; width:600; margin:0pt; padding:0px;">
            <p align = center> Use this page to register to aponcol testing site.</p>
        </div>
        <br />
        <div style="border:1; align:center; width:600; bgcolor:#FFFFFF; margin:0pt;">
            <div>
                <img align="left" src="http://web.me.com/apontecolina/Testing/Images/In_Defacto.jpg">
            </div>
            <div id="login">
                <p> Please register by providing the following info: </p>
                <form name="formulario" id="formulario" action="javascript:void(0);" method="post">
                Name: <br><input style="h1" type="text" name="username" id="username" <?php if (! empty ($_POST['connection_token'])) { FillBlanksFB(displayName);} ?> /><br>
				Email: <br><input style="h1" type="text" name="email" id="email" <?php if (! empty ($_POST['connection_token'])) { FillBlanksFB(email);} ?> /><br>
				Password: <br><input style="h1" type="password" name="password" id="password" /><br>
				Favorite Team: <br><input type="text" name="favteam" id="favteam" />
                <input type="hidden" name="user_token" id="user_token" value="<?php if (! empty ($_POST['connection_token'])) { print_r(GetInfo($_POST['connection_token'])->response->result->data->user->user_token); } ?>">
				<input type="hidden" name="connection_token" id="connection_token" value="<?php if (! empty ($_POST['connection_token'])) { print_r($_POST['connection_token']); } ?>">
				<input type="submit" value="Submit" OnClick="return register(formulario);" />
                </form>
            </div>
		<p></br>...or register with your social account:</br></p>
		<div id="social_login_container" style="float:right; width:280px; margin-top:20px;"></div>
		<script type="text/javascript">
		 oneall.api.plugins.social_login.build("social_login_container", {
		  'providers' :  ['facebook', 'google', 'twitter', 'wordpress'], 
		  'callback_uri': 'http://aponcol.co.cc/register.php'
		 });
		</script>
		</div>
       
    
    </body>
</html>