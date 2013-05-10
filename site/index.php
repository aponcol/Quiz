<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Main Site</title>
</head>

<body>
	
    <link href="styles/styles.css" rel="stylesheet"/>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
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
    <div class="btn-box">
    	<button onclick="ytplayer.playVideo()">Play</button>
        <button onclick="ytplayer.pauseVideo()">Pause</button>
        <button onclick="requestUserUploadsPlaylistId()">Get Videos</button>
        <button onclick="$('#hideBox').toggle();">Show Video</button>
    </div>
    <div id="results"></div>
	
    
    <script src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
    <script>
	function appendResults(text) {
        var results = document.getElementById('results');
        results.appendChild(document.createElement('P'));
        results.appendChild(document.createTextNode(text));
      }

      function makeRequest() {
        var request = gapi.client.get({
          'shortUrl': 'http://goo.gl/fbsS'
        });
        request.execute(function(response) {
          appendResults(response.longUrl);
        });
      }
	
	function load() {
        gapi.client.setApiKey('AIzaSyBrd7H-rEyn_bxcFnFUPbP8qAa7a-00qXo');
        gapi.client.load('urlshortener', 'v1', makeRequest);
      }
    </script>
    <script src="https://apis.google.com/js/client.js?onload=load"></script>
    <script src="scripts/scripts.js" type="application/javascript"></script>
	<script>
        // Load youtube video
        var params = { allowScriptAccess: "always", allowFullScreen: true };
        var atts = { id: "ytplayer" };
        //swfobject.embedSWF("http://www.youtube.com/v/cCGVo3QTygI?enablejsapi=1&playerapiid=ytplayer&version=3&autoplay=1", "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
    	swfobject.embedSWF("http://www.youtube.com/v/cCGVo3QTygI?enablejsapi=1&playerapiid=ytplayer&version=3", "ytapiplayer", "100%", "100%", "8", null, null, params, atts);
    
    </script>
    
</body>
</html>
<!--http://www.youtube.com/watch?v=cCGVo3QTygI-->