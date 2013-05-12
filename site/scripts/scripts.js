// This callback is invoked by the Google APIs JS client automatically when it is loaded.
googleApiClientReady = function() {
  gapi.auth.init(function() {
    loadAPIClientInterfaces();
	//window.setTimeout(checkAuth, 1);
  });
}

// Loads the client interface for the YouTube Analytics and Data APIs.
// This is required before using the Google APIs JS client; more info is available at
// http://code.google.com/p/google-api-javascript-client/wiki/GettingStarted#Loading_the_Client
function loadAPIClientInterfaces() {
  gapi.client.setApiKey('AIzaSyBrd7H-rEyn_bxcFnFUPbP8qAa7a-00qXo');
  gapi.client.load('youtube', 'v3', function() {
    handleAPILoaded();
  });
}

// Some variables to remember state.
var playlistId, nextPageToken, prevPageToken;

// Once the api loads call a function to get the uploads playlist id.
function handleAPILoaded() {
  // Playlist 1
  requestVideoPlaylist("PL3E245DF445E37F50");
  
  // Playlist 2
  //requestVideoPlaylist("PLE450FE833FA2B69E");
  
  // Playlist 3
  //requestVideoPlaylist("PL31E85566E71354FD");
}

// Retrieve a playist of videos.
function requestVideoPlaylist(playlistId) {
  $('#video-container').html('');
  var requestOptions = {
    playlistId: playlistId,
    part: 'snippet',
	maxResults: 50
  };
  var request = gapi.client.youtube.playlistItems.list(requestOptions);
  request.execute(function(response) {
    console.log(response);
	
	// Only show the page buttons if there's a next or previous page.
    /*nextPageToken = response.result.nextPageToken;
    var nextVis = nextPageToken ? 'visible' : 'hidden';
    $('#next-button').css('visibility', nextVis);
    prevPageToken = response.result.prevPageToken
    var prevVis = prevPageToken ? 'visible' : 'hidden';
    $('#prev-button').css('visibility', prevVis);
*/
    var playlistItems = response.result.items;
    if (playlistItems) {
      // For each result lets show a thumbnail.
      //jQuery.each(playlistItems, function(index, item) {
        //createDisplayThumbnail(item.snippet);
		//console.log(item);
      //});
	  
	  //console.log(playlistItems.length);
	  
	  //loadYoutubeVideo(playlistItems[0].snippet.resourceId.videoId);
	  var answerArray = [1,2,3,4];
	  
	  for(var i = 1; i < 5; i++) {
	  	var randomNum = getRandomInt(playlistItems.length - 1);
		var answerSlot = getRandomInt(answerArray.length -1);
		var videoId = playlistItems[randomNum].snippet.resourceId.videoId;
		// Load last video on the 4 loop
		if(i == 3) {
			loadYoutubeVideo(videoId);
	  	}
		
		//console.log("randomNum: "+randomNum+",answerSlot: "+answerSlot+",answerArraySplice: "+answerArray.splice(answerSlot,1)+"playlistSplice: "+playlistItems.splice(randomNum,1));
		//console.log(answerArray);
		//console.log(playlistItems.length);
		var answerArraySplice = answerArray.splice(answerSlot,1);
		var playlistItemsSplice = playlistItems.splice(randomNum,1);
		var title = getTitle(playlistItemsSplice[0].snippet.title);
		// Build the options
		$("#option-" + answerArraySplice + " span").html(title);
		$("#option-" + answerArraySplice + " input").val(videoId);
	  }
	  
    } else {
      $('#video-container').html('Sorry you have no uploaded videos');
    }
  });
}


// This function will check the response of the user and return a message of correct or wrong!
function SendResponse() {
	var value = $('input[name="answer"]:checked').val();
	if (value != null) {
		var videoUrl = ytplayer.getVideoUrl();
		var ytplayerv = getParameterByName(videoUrl,'v');
		
		if(value == ytplayerv) {
			alert("correct");
			$('#hideBox').hide();
		}
		else {
			alert("wrong!");
		}
	} else {
		alert("no value selected");
		}
}

// Utility functions:

// Get a random number from 0 to max
function getRandomInt (max) {
    return Math.floor(Math.random() * (max + 1));
}

// Removes the first part of the array for the title of the videos.
function getTitle(rawTitle) {
	var startIndex = rawTitle.lastIndexOf("]");
	return rawTitle.substring(startIndex + 2)
}

// Receives a url and the name of a parameter and returns the value of the parameter (query string)
function getParameterByName(videoUrl, name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(videoUrl);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

// Create a thumbnail for a video snippet.
/*function createDisplayThumbnail(videoSnippet) {
  var titleEl = $('<h3>');
  titleEl.addClass('video-title');
  $(titleEl).html(videoSnippet.title);
  var thumbnailUrl = videoSnippet.thumbnails.medium.url;

  var div = $('<div>');
  div.addClass('video-content');
  div.css('backgroundImage', 'url("' + thumbnailUrl + '")');
  div.append(titleEl);
  $('#video-container').append(div);
}*/

// Retrieve the next page of videos.
/*function nextPage() {
  requestVideoPlaylist(playlistId, nextPageToken);
}

// Retrieve the previous page of videos.
function previousPage() {
  requestVideoPlaylist(playlistId, prevPageToken);
}*/
	
	/*function load() {
        gapi.client.setApiKey('AIzaSyBrd7H-rEyn_bxcFnFUPbP8qAa7a-00qXo');
        gapi.client.load('youtube', 'v3', function() {
			handleAPILoaded();
		  });
      }*/
	  
// Loads the desired youtube video in the viewer
function loadYoutubeVideo(id) {
	
	ytplayer.loadVideoById({'videoId': id, 'startSeconds': 6});
}

// Function to bind the plays of the video
function onYouTubePlayerReady(playerId) {
    ytplayer = document.getElementById("ytplayer");
    ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
}

// Functions that runs on state change of the video player
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