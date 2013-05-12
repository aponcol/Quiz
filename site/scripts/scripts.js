// JavaScript Document

	// Some variables to remember state.
var playlistId, nextPageToken, prevPageToken;

// Once the api loads call a function to get the uploads playlist id.
function handleAPILoaded() {
  requestVideoPlaylist("PL3E245DF445E37F50");
  //requestVideoPlaylist("PLE450FE833FA2B69E");
  //requestVideoPlaylist("PL31E85566E71354FD");
}

function SendResponse() {
		
		var value = $('input[name="answer"]:checked').val();
		console.log(value);
		if (value != null) {
			var videoUrl = ytplayer.getVideoUrl();
			var ytplayerv = getParameterByName(videoUrl,'v');
			console.log(value);
			console.log(ytplayerv);
			
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
		$("#option-" + answerArraySplice).html(title);
		$("input.option-"+ answerArraySplice).val(videoId);
	  }
	  
    } else {
      $('#video-container').html('Sorry you have no uploaded videos');
    }
  });
}


function getRandomInt (max) {
    return Math.floor(Math.random() * (max + 1));
}

function getTitle(rawTitle) {
	var startIndex = rawTitle.lastIndexOf("]");
	return rawTitle.substring(startIndex + 2)
}

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
function loadYoutubeVideo(id) {
	
	ytplayer.loadVideoById({'videoId': id, 'startSeconds': 6});
}

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