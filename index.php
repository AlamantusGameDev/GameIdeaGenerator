<?php
$seed = isset($_POST['seed']) ? htmlspecialchars($_POST['seed']) : (string)rand();
$genrelock = isset($_POST['genrelock']) ? $_POST['genrelock'] : 'off';
$genre = isset($_POST['genre']) ? $_POST['genre'] : '';
if ($seed == "") {
	$seed = (string)rand();
}
?>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Insanity Jam Official Idea Generator</title>
  <meta name="description" content="Custom-built Idea Generator for use in the semi-anual Insanity Jam game development jam.">
  <meta name="author" content="Alamantus GameDev">

  <link rel="stylesheet" href="css/styles.css">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/seedrandom.min.js"></script>
  <script src="js/generator.js"></script>
</head>

<body>
<div id="container">
<form id="setseed" method="post">
<div id="seedentry">Seed: <input id="seedbox" name="seed" value="<?php echo $seed; ?>" onclick="this.select()" /> <input id="seedchange" type="submit" value="Generate!" />
<br /><small class="clickable" onclick="javascript:$('#rescuedseed').toggleClass('hidden');">(Click here if the box is blank to recover the seed.)</small><br />
<span id="rescuedseed" class="hidden" onclick="selectText('rescuedseed')"><?php echo $seed; ?></span>
</div>
<div id="genrelock">Lock Genre <input name="genrelock" id="lock" type="checkbox" onclick="if(this.checked){var g=document.getElementById('genre').innerHTML; document.getElementById('genreplaceholder').innerHTML='<input type=\'hidden\' id=\'genrefield\' name=\'genre\' value=\'' + g + '\' />';}else{document.getElementById('genreplaceholder').innerHTML='';}" /><span id="genreplaceholder"></span>
</div>
<div id="rerollbox"><input id="reroll" type="image" src="images/dice.png" name="submit" onclick="document.getElementById('seedbox').value='';" title="Re-Roll">
</div>
</form>

<div id="ideabox">
<table id="ideacontainer">
	<tr><td>
	<p id="ideatext" onclick="selectText('ideatext')">
	<script>
		generatevalues('<?php echo $seed; ?>', '<?php echo $genre; ?>');
	</script>
	</p>
	</td></tr>
</table>
</div>

<div id="hintbox">
<div id="hint"><h3>Hint:</h3>
<p id="hinttext">Clicking the text <small>(from a computer)</small> will select it so you can easily copy it!</p>
</div>
</div>

  <script>
	if ('<?php echo $genrelock; ?>' == 'on') {
		document.getElementById('lock').checked = "true";
		document.getElementById('genreplaceholder').innerHTML = "<input type='hidden' id='genrefield' name='genre' value='<?php echo $genre; ?>' />";
	}
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
  </script>
</div>
</body>
</html>