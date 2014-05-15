<?php
$seed = isset($_GET['seed']) ? $_GET['seed'] : (string)rand();
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

<form id="setseed">
<div id="seedentry">Seed: <input id="seedbox" name="seed" value="<?php echo $seed; ?>"> <input id="seedchange" type="submit" value="Generate!">
</div>
<div id="rerollbox"><a href="." title="Re-Roll"><img id="reroll" src="images/dice.png" alt="Re-Roll" /></a>
</div>
</form>

<div id="ideabox">
	<p id="ideatext">
	<script>
		generatevalues('<?php echo $seed; ?>');
	</script>
	</p>
</div>

</body>
</html>