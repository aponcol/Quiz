<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Main Site</title>
</head>

<body>
	
    <link href="styles/styles.css" rel="stylesheet"/>
	<header>
        <h1>
        Video Game Music Quiz prototype
        </h1>
    </header>
    <div id="main">
    	<div id="video-holder">
        	<div id="ytapiplayer">
                You need Flash player 8+ and JavaScript enabled to view this video.
            </div>
        </div>
        <div id="hideBox"></div>
    </div>
    <br/>
    <div class="btn-box">
    	<!--<button onclick="ytplayer.playVideo()">Play</button>
        <button onclick="ytplayer.pauseVideo()">Pause</button>-->
        <button onclick="SendResponse(); return false;">Answer!</button>
        <button onclick="location.reload()">Next question</button>
    </div>
    <br/>
    <div id="options">
    	<input class="option-1" type="radio" name="answer" value="1" /> <span id="option-1"></span><br/>
        <input class="option-2" type="radio" name="answer" value="2" /> <span id="option-2"></span><br/>
        <input class="option-3" type="radio" name="answer" value="3" /> <span id="option-3"></span><br/>
        <input class="option-4" type="radio" name="answer" value="4" /> <span id="option-4"></span><br/>
    </div>
    <br/>
    	<button onclick="$('#hideBox').toggle();">Cheat!</button>
        <button onclick="ytplayer.pauseVideo()">Pause Video</button>
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script>
	// Load youtube video
	var params = { allowScriptAccess: "always", allowFullScreen: true};
	var atts = { id: "ytplayer" };
	//swfobject.embedSWF("http://www.youtube.com/v/cCGVo3QTygI?enablejsapi=1&playerapiid=ytplayer&version=3&autoplay=1", "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
	//swfobject.embedSWF("http://www.youtube.com/v/"+id+"?enablejsapi=1&playerapiid=ytplayer&version=3&autoplay=1&startSeconds=5", "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
	swfobject.embedSWF("http://www.youtube.com/apiplayer?enablejsapi=1&version=3&playerapiid=ytplayer", "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="scripts/auth.js"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    <script src="scripts/scripts.js" type="application/javascript"></script>
    <script src="https://apis.google.com/js/client.js"></script>
    
	</body>
</html>