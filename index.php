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

  <link rel="stylesheet" href="css/styles.css?v=1.0">

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="js/seedrandom.min.js"></script>
  <script src="js/generator.js"></script>
</head>

<body>

<form id="setseed">
<p>Seed: <input id="seedbox" name="seed" value="<?php echo $seed; ?>"> <input id="seedchange" type="submit" value="Generate!">
</p>
</form>
<p style="font-weight:bold;"><a href=".">Re-Roll</a></p>

<div>
	<p id="ideatext">
	<script>
		generatevalues('<?php echo $seed; ?>');
	</script>
	</p>
</div>

</body>
</html>