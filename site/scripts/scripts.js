// JavaScript Document

// Function to bind the plays of the video
function onYouTubePlayerReady(playerId) {
    ytplayer = document.getElementById("ytplayer");
    ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
}

function onytplayerStateChange(newState) {
    if (newState == 1) {
        console.log("playing");
    } 
    if (newState == 0) {
        console.log("ended");
    }
	if (newState == 2) {
        console.log("paused or ad!");
    }
}

function GetVideos(numberOfVideos, channelId) {
	$.ajax({
	  method: "GET",
	  url: "https://www.googleapis.com/youtube/v3/playlists?id=PL3E245DF445E37F50&key=AIzaSyBrd7H-rEyn_bxcFnFUPbP8qAa7a-00qXo&part=snippet,contentDetails,status",
	  success: function(response){
	  	console.log(response);
	  },
	  error: function(message) {
		console.log(message);
	  }
	});
	
	// Volume 1: http://www.youtube.com/playlist?list=PL3E245DF445E37F50
	// var obj = jQuery.parseJSON('{"name":"John"}');
	
	//for(int i = 0; i<numberOfVideos; i++) {
		
	//}
}

//Retrieve the uploads playlist id.
function requestUserUploadsPlaylistId() {
    // https://developers.google.com/youtube/v3/docs/channels/list
    var request = gapi.client.youtube.channels.list({
        // mine: '' indicates that we want to retrieve the channel for the authenticated user.
        mine: '',
        part: 'contentDetails'
    });
    request.execute(function (response) {
        playlistId = response.result.items[0].relatedPlaylists.uploads;
        requestVideoPlaylist(playlistId);
    });
}