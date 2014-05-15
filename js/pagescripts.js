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