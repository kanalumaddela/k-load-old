/*
    Made by: @kanalumaddela
*/
if (typeof(mapname_elem) != 'undefined' && mapname_elem != null) {document.getElementById('mapname').innerHTML = 'ttt_minecraft_b5';}
if (typeof(maxplayers_elem) != 'undefined' && maxplayers_elem != null) {document.getElementById('maxplayers').innerHTML = '24';}
if (typeof(gamemode_elem) != 'undefined' && gamemode_elem != null) {document.getElementById('gamemode').innerHTML = 'terrortown';}

var democounter = 0;
var demoprogress = setInterval(function() {
        democounter > 100 ? (democounter = 0, updateprogress(democounter)) : updateprogress(democounter), democounter++
    }, 250);