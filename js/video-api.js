//
//  Youtube IFrame initialization
//
var tag = document.createElement('script');

//Insert script at top
tag.src = "https://www.youtube.com/iframe_api";
var tubescript = document.getElementsByTagName('script')[0];
tubescript.parentNode.insertBefore(tag, tubescript);

//Youtube API downlaoded callback
var player, _default_vid = '', _start_vid = false, _playlist = false
function onYouTubeIframeAPIReady() {
  player = new YT.Player('youtube-player', {
   // height: '360',
   // width: '640',
    height: '450',
    width: '800',
    videoId: _default_vid,
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange,
      'onError': onPlayerError
    }
  });
}

//
//  Callbacks
//
//Player read callback
function onPlayerReady(event)
{
  if (_start_vid) event.target.playVideo();
  else if (_playlist)
  {
    load_playlist();
  } 
}

//Player stat change callback
function onPlayerStateChange(event)
{
  if (event.data == 0)
  {
    if (typeof(is_random) != "undefined" && is_random !== null && is_random == 1) loadSerie();
  }
}

function onPlayerError(event)
{
  loadSerie();
}

function play_video(code)
{
  player.stopVideo();
  player.setLoop(true);
  player.loadVideoById(code, 0, "large");
}

function load_playlist()
{
  player.loadPlaylist({
      'listType': 'playlist',
      'list': _playlist,
      'index': 0,
      'startSeconds': 0,
      'suggestedQuality': 'default'
  });
}