/*
    Made by: @kanalumaddela
*/
var servername_elem =  document.getElementById('server_name'),serverurl_elem =  document.getElementById('server_url'),mapname_elem =  document.getElementById('mapname'),maxplayers_elem =  document.getElementById('maxplayers'),steamid_elem =  document.getElementById('steam64'),gamemode_elem =  document.getElementById('gamemode');
var filestotal_elem =  document.getElementById('files_total'), filesneeded_elem =  document.getElementById('files_needed'),filesdownloaded_elem =  document.getElementById('files_downloaded'),clientstatus_elem =  document.getElementById('clientstatus');
var loadingbar_elem =  document.getElementById('loadingbar'),percentage_elem = document.getElementById('percentage'),circleload_elem = document.getElementById('circleload');
var message_elem = document.getElementById('messages');
var rule_elem = document.getElementById('rules');
var yt_elem = document.getElementById('youtube');
var staff_elem = document.getElementById('staff');
if (typeof(circleload_elem) != 'undefined' && circleload_elem != null) {
    var circleload = $('#circleload').circleProgress({
        value: 0,
        size: 175,
        emptyFill: 'rgba(0,0,0,0)',
        fill: {
            gradient: ["red", "orange"]
        }
    });
}

var files = new Object();
files.downloaded = 0;
function GameDetails( servername, serverurl, mapname, maxplayers, steamid, gamemode ) {
    if (typeof(servername_elem) != 'undefined' && servername_elem != null) {document.getElementById('server_name').innerHTML = servername;}
    if (typeof(serverurl_elem) != 'undefined' && serverurl_elem != null) {document.getElementById('server_url').innerHTML = serverurl;}
    if (typeof(mapname_elem) != 'undefined' && mapname_elem != null) {document.getElementById('mapname').innerHTML = mapname;}
    if (typeof(maxplayers_elem) != 'undefined' && maxplayers_elem != null) {document.getElementById('maxplayers').innerHTML = maxplayers;}
    if (typeof(steamid_elem) != 'undefined' && steamid_elem != null) {document.getElementById('steam64').innerHTML = steamid;}
    if (typeof(gamemode_elem) != 'undefined' && gamemode_elem != null) {document.getElementById('gamemode').innerHTML = gamemode;}
    getData(steamid,gamemode);
}
function SetStatusChanged( status ) {
    updatestatus(status);
    if (status == "Sending client info...") {
        updateprogress(100)
    }
}
function SetFilesTotal( total ) {
    if (typeof(filestotal_elem) != 'undefined' && filestotal_elem != null) {document.getElementById('files_total').innerHTML = total;}
    files.total = total;
}
function SetFilesNeeded( needed ) {
    if (typeof(filesneeded_elem) != 'undefined' && filesneeded_elem != null) {document.getElementById('files_needed').innerHTML = needed;}
    files.needed = needed;
}
function DownloadingFile( fileName ) {
    updatestatus(fileName);
    files.downloaded++;
    if (typeof(filesdownloaded_elem) != 'undefined' && filesdownloaded_elem != null) {document.getElementById('files_downloaded').innerHTML = files.downloaded;}
    var progress = files.downloaded/files.needed;
    if ( isNaN(progress) || progress >= 1 ) {
        updateprogress(100);
    } else {
        progress = progress*100;
        updateprogress(progress);
    }
}

function updatestatus(text) {
    if (typeof(clientstatus_elem) != 'undefined' && clientstatus_elem != null) {document.getElementById('clientstatus').innerHTML = text;}
}
function updateprogress(amount) {
    var percent_num = Math.round(amount);
    var percent_str = Math.round(amount) + "%";
    if (typeof(loadingbar_elem) != 'undefined' && loadingbar_elem != null) {document.getElementById('loadingbar').style.width = percent_str;}
    if (typeof(percentage_elem) != 'undefined' && percentage_elem != null) {document.getElementById('percentage').innerHTML = percent_str;}
    if (typeof(circleload_elem) != 'undefined' && circleload_elem != null) {
        circleload.circleProgress('value', (amount/100) );
    }
}
var message_counter = 0;
function getData(steamid, gamemode) {
    if (typeof gamemode == 'undefined') {
        gamemode = 'global';
    }
    url = './includes/userdata.php';
    if (typeof(steamid) != 'undefined') {
        url += '?steamid=' + steamid;
    }
    var type  = 'global';
    $.get(url, function(data, status){
        music_type = 0;
        background_type  = 0;
        var loadYTapi = 0;
        if ( typeof(data['player']) != 'undefined' ) {
            if ( data['player']['background_type'] != 0) {
                data['background_type'] = data['player']['background_type'];
                background_type = data['background_type'];
            }
            volume = data['player']['volume'];
            if (volume != 0) {
                if (data['player']['music_type'] == 1 && typeof(data['player']['youtube_playlist']) != 'undefined' && data['player']['youtube_playlist'] != '' ) {
                    music_type = 1;
                    youtube_playlist_id = data['player']['youtube_playlist']
                    $('<div id="youtube_music" class="plz-hide"></div>').appendTo('body');
                    loadYTapi = 1;
                }
            }
        }
        if (typeof(rule_elem) != 'undefined' && rule_elem != null && typeof(data['rules']) != 'undefined') {
            rulearray = data['rules'][type];
            if(data['gamemode_specific'] == 1 && typeof(data['backgrounds'][gamemode]) != 'undefined') {
                type = gamemode;
                rulearray = data['rules'][type];
            }
            updaterules(rulearray);
        }

        if (typeof(message_elem) != 'undefined' && message_elem != null && typeof(data['messages']) != 'undefined') {
            messagearray = data['messages'][type];
            if(data['gamemode_specific'] == 1 && typeof(data['backgrounds'][gamemode]) != 'undefined') {
                type = gamemode;
                messagearray = data['messages'][type];
            }
            if (data['message_random'] == 1) { shuffle(messagearray); }
            updatemessages(messagearray, data['message_duration']);
        }

        if (data['background_type'] == 3 && data['backgrounds'] != 'undefined') {
            backgroundarray = data['backgrounds'][type];
            if(data['gamemode_specific'] == 1 && typeof(data['backgrounds'][gamemode]) != 'undefined') {
                type = gamemode;
                backgroundarray = data['backgrounds'][type];
            }
            if (data['background_random'] == 1) { shuffle(backgroundarray); }
            updatebackgrounds(backgroundarray, data['background_duration']);
        }
        if (data['background_type'] == 4 && typeof(data['background_video']) != 'undefined') {
            $('<video id="video" class="fixed-background video" src="' + data['background_video'] + '" muted autoplay></video>').appendTo('body');
            $('#video').animate({opacity: 1}, 500);
        }
        if (data['background_type'] == 5 && typeof(data['background_yt']) != 'undefined') {
            background_type = data['background_type'];
            youtube_id = data['background_yt'];
            $('<div id="youtube_bg" class="fixed-background video"></div>').appendTo('body');
            loadYTapi = 1;
        }
        if (loadYTapi = 1) {
            loadYoutubeAPI();
        }
    });
}
function updaterules(rules) {
    for (x = 0; x < rules.length; x++) {
        $('#rules').delay(500).append('<li id="rule_' + (x+1) + '" class="rule animated fadeIn">' + rules[x] + '</li>');
    }
}
var msg_counter = -1;
function updatemessages(messages, duration) {
    if (typeof(duration) == 'undefined') { duration = 5000; }
    msg_counter++;
    if (msg_counter >= messages.length) { msg_counter = 0; }
    $("#messages").fadeOut( "slow", function(){
        $("#messages").html(messages[msg_counter]);
        $("#messages").fadeIn().delay(duration);
        updatemessages(messages, duration);
    });
}

function updatebackgrounds(backgrounds, duration) {
    $.backstretch(backgrounds, {duration: duration, fade: 750});
    $('<div class="fixed-background overlay"></div>').appendTo('body');
}
function loadYoutubeAPI() {
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}
var youtube_player;
var youtube_player2;
function onYouTubeIframeAPIReady() {
    if (typeof(youtube_playlist_id)  != 'undefined' && music_type == 1) {
        youtube_player = new YT.Player('youtube_music', {
            height: '0',
            width: '0',
            playerVars: {
                autoplay: 0,
                controls: 0,
                fs: 0,
                iv_load_policy: 3,
                // listType:'playlist',
                // list: youtube_playlist_id,
                modestbranding: 1,
                showinfo: 0
            },
            events: {
                'onReady': onYTMusicPlayerReady,
                'onStateChange': onMusicPlayerStateChange
            }
        });
    }
    if (background_type == 5 && typeof(youtube_id) != 'undefined') {
        youtube_player2 = new YT.Player('youtube_bg', {
            height: '480',
            width: '640',
            videoId: youtube_id,
            playerVars: {
                autoplay: 1,
                controls: 0,
                fs: 0,
                iv_load_policy: 3,
                modestbranding: 1,
                showinfo: 0
            },
            events: {
                'onReady': onYTBackgroundPlayerReady,
                'onStateChange': onBackgroundPlayerStateChange
            }
    });
    }
}
function onYTMusicPlayerReady(event) {
    music_index = 0;
    event.target.setVolume(volume);
    event.target.cuePlaylist({
        listType: 'playlist',
        list: youtube_playlist_id,
        index: music_index,
        suggestedQuality:'small'
    });
}
function onYTBackgroundPlayerReady(event) {
    event.target.setVolume(0);
    event.target.setPlaybackQuality('large');
    $('#youtube_bg').animate({opacity: 1}, 750);
    playVideo(event);
}
function onMusicPlayerStateChange(event) {
    if (event.data == YT.PlayerState.CUED) {
        event.target.playVideo();
    }
    if (event.data == YT.PlayerState.ENDED) {
        music_index++;
        event.target.loadPlaylist({
            list: youtube_playlist_id,
            index: music_index
        });
        var yt_array = event.target.getPlaylist();
        console.log(yt_array.length);
        if ( (music_index+1) > yt_array.length) { music_index = 0 }
        }
}
function onBackgroundPlayerStateChange(event) {
    console.log('onPlayerStateChange: ' + event.data);

    if (event.data == YT.PlayerState.ENDED) {
        event.target.nextVideo();
    }
}
function stopVideo(event) {
    event.target.stopVideo();
}
function playVideo(event) {
    console.log('play vid');
    event.target.playVideo();
}
function nextVideo(event) {
    event.target.nextVideo();
}
// thanks stackoverlfow
function shuffle(a) {
    for (let i = a.length; i; i--) {
        let j = Math.floor(Math.random() * i);
        [a[i - 1], a[j]] = [a[j], a[i - 1]];
    }
}
$.getJSON("./includes/stafflist.php", function(data) {
    if (typeof(data) != 'undefined') {
        $('body').append('<div id="staff"></div>');
        $('#staff').html('<h1 class="title">OUR STAFF</h1>');
        $.each(data, function( index, value ) {
            $('#staff').append('<div class="item"><img class="useravatar circle" src="'+value['avatar']+'" /><p>'+value['name']+'</p><p>'+value['rank']+'</p></div>');
        });
    }
});
