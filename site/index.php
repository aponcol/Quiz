<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Videogame music Quiz</title>
</head>
<body>
	<link href="styles/styles.css" rel="stylesheet"/>
	<div id="wrapper">
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
            <button onclick="SendResponse(); return false;">Answer!</button>
            <button onclick="location.reload()">Next question</button>
        </div>
        <br/>
        <div id="options">
            <div id="option-1">
                <div id="selector"><img src="images/arrow.gif" alt="" style="height: 19px;"/></div>
                <input type="radio" name="answer" value="1" />
                <span id="option-1"></span>
            </div>
            <div id="option-2">
                <input type="radio" name="answer" value="2" />
                <span id="option-2"></span>
            </div>
            <div id="option-3">
                <input type="radio" name="answer" value="3" />
                <span id="option-3"></span>
            </div>
            <div id="option-4">
                <input type="radio" name="answer" value="4" />
                <span id="option-4"></span>
            </div>
        </div>
        <br/>
            <button onclick="$('#hideBox').toggle();">Cheat!</button>
            <button onclick="ytplayer.pauseVideo()">Pause Video</button>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script>
		// Load youtube video
		var params = { allowScriptAccess: "always", allowFullScreen: true};
		var atts = { id: "ytplayer" };
		swfobject.embedSWF("http://www.youtube.com/apiplayer?enablejsapi=1&version=3&playerapiid=ytplayer", "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
	</script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="scripts/scripts.js" type="application/javascript"></script>
    <script src="https://apis.google.com/js/client.js?onload=googleApiClientReady"></script>
    </body>
</html>