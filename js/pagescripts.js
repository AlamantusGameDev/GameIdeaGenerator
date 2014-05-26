function selectText(containerid) {
	if (document.selection) {
		var range = document.body.createTextRange();
		range.moveToElementText(document.getElementById(containerid));
		range.select();
	} else if (window.getSelection) {
		var range = document.createRange();
		range.selectNode(document.getElementById(containerid));
		window.getSelection().addRange(range);
	}
}

var hints = [];
var h = 0;
var hintsCall = $.get("values/hints.txt", function (data) { hints = data.split("\n"); });
$.when(hintsCall).done(function () {
	getNewHint();
});
function getNewHint() {
	h = Math.floor(Math.random() * hints.length);
	document.getElementById('hinttext').innerHTML = hints[h];
}

function addGenreDropdown() {		//Doesn't seem to work from this file
	var genres = [];
	var typesCall = $.get("values/gametypes.txt", function (data) { genres = data.split("\n"); });
	var dropdownbox = '<select name="genres"><option value=""></option>';
	$.when(typesCall).done(function () {
		for (var i = 0; i < genres.length; i++) {
			dropdownbox += '<option value="' + genres[i] + '">' + genres[i] + '</option>';
		}
		dropdownbox += '</select>';
		document.getElementById('genreselect').innerHTML = dropdownbox;
	});
}

function removeGenre() {
	if (document.getElementById('genre') == null) {
		setTimeout(removeGenre, 10);
	} else {
		document.getElementById('genre').innerHTML = "A ";
	}
}

function setCookie(cname,cvalue,exdays)
{
	var d = new Date();
	d.setTime(d.getTime()+(exdays*24*60*60*1000));
	var expires = "expires="+d.toGMTString();
	document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname)
{
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++) 
	{
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return "";
}

function pageLoadFunctions(lock, genre, remove) {
	if (lock == 'on') {
		document.getElementById('lock').checked = "true";
		document.getElementById('genreplaceholder').innerHTML = "<input type='hidden' id='genrefield' name='lockedgenre' value='"+genre+"' />";
	}
	
	if (remove == 'on') {
		document.getElementById('remove').checked = "true";
		removeGenre();
	}
}