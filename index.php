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
  <script>
	var gt = 0;	//game type
	var n1 = n2 = n3 = n4 = 0;	//nouns
	var v1 = v2 = 0;	//verbs
	var a1 = a2 = a3 = a4 = 0;	//adjectives
	var o1 = o2 = o3 = o4 = 0;	//optional/chance additions

	function generatevalues(seed) {
		var generatedidea = "";
		
		if(seed) {
			Math.seedrandom(seed);
		}
		else {
			Math.seedrandom();
		}
		
		gt=Math.floor(Math.random() * 20);	//Gives game type a value between 0 and 9, providing 10 game type options
		n1=Math.floor(Math.random() * 100);	//Gives noun1 a value between 0 and 99, providing 100 noun options
		n2=Math.floor(Math.random() * 100);	//Gives noun2 a value between 0 and 99, providing 100 noun options
		v1=Math.floor(Math.random() * 100);	//Gives verb1 a value between 0 and 99, providing 100 noun options
		
		//Get Adjectives or decide if there will be adjectives
		o1=Math.floor(Math.random() * 100);
		if (o1 < 25) {
			a1 = a2 = -1;
		}
		if (o1 >= 25 && o1 < 50) {
			a1 = Math.floor(Math.random() * 100);
			a2 = -1;
		}
		if (o1 >= 50 && o1 < 75) {
			a2 = Math.floor(Math.random() * 100);
			a1 = -1;
		}
		if (o1 >= 50 && o1 < 75) {
			a1 = Math.floor(Math.random() * 100);
			a2 = Math.floor(Math.random() * 100);
		}
		if (o1 >= 75 && o1 <= 100) {
			a2 = Math.floor(Math.random() * 100);
			a1 = Math.floor(Math.random() * 100);
		}
		
		//Roll again for o1 to check for expanded scenarios
		o1=Math.floor(Math.random() * 10);
		if (o1 < 5) {
			//remove the possibility of extra/expanded scenarios
			n3 = n4 = v2 = a3 = a4 = o2 = o3 = -1;
		}
		else {
			n3=Math.floor(Math.random() * 100);	//Gives noun3 a value between 0 and 99, providing 100 noun options
			n4=Math.floor(Math.random() * 100);	//Gives noun4 a value between 0 and 99, providing 100 noun options
			v2=Math.floor(Math.random() * 100);	//Gives verb2 a value between 0 and 99, providing 100 noun options
			
			//Get Adjectives or decide if there will be adjectives
			o2=Math.floor(Math.random() * 100);
			if (o2 < 25) {
				a3 = a4 = -1;
			}
			if (o2 >= 25 && o2 < 50) {
				a3 = Math.floor(Math.random() * 100);
				a4 = -1;
			}
			if (o2 >= 50 && o2 < 75) {
				a4 = Math.floor(Math.random() * 100);
				a3 = -1;
			}
			if (o2 >= 50 && o2 < 75) {
				a3 = Math.floor(Math.random() * 100);
				a4 = Math.floor(Math.random() * 100);
			}
			if (o2 >= 75 && o2 <= 100) {
				a4 = Math.floor(Math.random() * 100);
				a3 = Math.floor(Math.random() * 100);
			}
			
			o3=Math.floor(Math.random() * 10);
		}
		
		o4=Math.floor(Math.random() * 10);	//Select the sentence structure.
		
		var types = [];
		var ajaxCall1 = $.get("values/gametypes.txt", function (data) { types = data.split("\n"); });
		var nouns = [];
		var ajaxCall2 = $.get("values/nouns.txt", function (data) { nouns = data.split("\n"); });
		var verbs = [];
		var ajaxCall3 = $.get("values/verbs.txt", function (data) { verbs = data.split("\n"); });
		var adjectives = [];
		var ajaxCall4 = $.get("values/adjectives.txt", function (data) { adjectives = data.split("\n"); });
		var locations = [];
		var ajaxCall5 = $.get("values/locations.txt", function (data) { locations = data.split("\n"); });
		var descriptions = [];
		var ajaxCall6 = $.get("values/descriptions.txt", function (data) { descriptions = data.split("\n"); });
		
		$.when(ajaxCall1, ajaxCall2, ajaxCall3, ajaxCall4, ajaxCall5, ajaxCall6).done(function () {
			if (types[gt].substr(0,1)==="a" || types[gt].substr(0,1)==="e" || types[gt].substr(0,1)==="i" || types[gt].substr(0,1)==="o" || types[gt].substr(0,1)==="u") {
				generatedidea += "An ";
			} else {
				generatedidea += "A ";
			}
			generatedidea += types[gt] + " game where ";
			if (a1 >= 0) {
				if (adjectives[a1].substr(0,1)==="a" || adjectives[a1].substr(0,1)==="e" || adjectives[a1].substr(0,1)==="i" || adjectives[a1].substr(0,1)==="o" || adjectives[a1].substr(0,1)==="u") {
					generatedidea += "an ";
				} else {
					generatedidea += "a ";
				}
				generatedidea += adjectives[a1] + " ";
			} else {
				if (nouns[n1].substr(0,1)==="a" || nouns[n1].substr(0,1)==="e" || nouns[n1].substr(0,1)==="i" || nouns[n1].substr(0,1)==="o" || nouns[n1].substr(0,1)==="u") {
					generatedidea += "an ";
				} else {
					generatedidea += "a ";
				}
			}
			generatedidea += nouns[n1] + " ";
			generatedidea += verbs[v1] + " ";
			if (a2 >= 0) {
				if (adjectives[a2].substr(0,1)==="a" || adjectives[a2].substr(0,1)==="e" || adjectives[a2].substr(0,1)==="i" || adjectives[a2].substr(0,1)==="o" || adjectives[a2].substr(0,1)==="u") {
					generatedidea += "an ";
				} else {
					generatedidea += "a ";
				}
				generatedidea += adjectives[a2] + " ";
			} else {
				if (nouns[n2].substr(0,1)==="a" || nouns[n2].substr(0,1)==="e" || nouns[n2].substr(0,1)==="i" || nouns[n2].substr(0,1)==="o" || nouns[n2].substr(0,1)==="u") {
					generatedidea += "an ";
				} else {
					generatedidea += "a ";
				}
			}
			generatedidea += nouns[n2];
			if (o4 >= 5) {
				generatedidea += " in ";
				if (a2 >= 0) {
					if (descriptions[a2].substr(0,1)==="a" || descriptions[a2].substr(0,1)==="e" || descriptions[a2].substr(0,1)==="i" || descriptions[a2].substr(0,1)==="o" || descriptions[a2].substr(0,1)==="u") {
						generatedidea += "an ";
					} else {
						generatedidea += "a ";
					}
					generatedidea += descriptions[a2] + " ";
				} else {
					if (locations[n2].substr(0,1)==="a" || locations[n2].substr(0,1)==="e" || locations[n2].substr(0,1)==="i" || locations[n2].substr(0,1)==="o" || locations[n2].substr(0,1)==="u") {
						generatedidea += "an ";
					} else {
						generatedidea += "a ";
					}
				}
				generatedidea += locations[n2];
			}
			switch (o3) {
				case 0: generatedidea += " while ";
					break;
				case 1: generatedidea += " because ";
					break;
				case 2: generatedidea += ", and ";
					break;
				case 3: generatedidea += " even though ";
					break;
				case 4: generatedidea += ", but ";
					break;
				case 5: generatedidea += ", however ";
					break;
				case 6: generatedidea += ", and then ";
					break;
				case 7: generatedidea += ". At the same time, ";
					break;
				case 8: generatedidea += ", which means that ";
					break;
				case 9: generatedidea += " while ";
					break;
			}
			if (n3 >= 0) {
				if (a3 >= 0) {
					if (adjectives[a3].substr(0,1)==="a" || adjectives[a3].substr(0,1)==="e" || adjectives[a3].substr(0,1)==="i" || adjectives[a3].substr(0,1)==="o" || adjectives[a3].substr(0,1)==="u") {
						generatedidea += "an ";
					} else {
						generatedidea += "a ";
					}
					generatedidea += adjectives[a3] + " ";
				} else {
					if (nouns[n3].substr(0,1)==="a" || nouns[n3].substr(0,1)==="e" || nouns[n3].substr(0,1)==="i" || nouns[n3].substr(0,1)==="o" || nouns[n3].substr(0,1)==="u") {
						generatedidea += "an ";
					} else {
						generatedidea += "a ";
					}
				}
				generatedidea += nouns[n3] + " ";
			}
			if (v2 >= 0) generatedidea += verbs[v2] + " ";
			if (n4 >= 0) {
				if (a4 >= 0) {
					if (adjectives[a4].substr(0,1)==="a" || adjectives[a4].substr(0,1)==="e" || adjectives[a4].substr(0,1)==="i" || adjectives[a4].substr(0,1)==="o" || adjectives[a4].substr(0,1)==="u") {
						generatedidea += "an ";
					} else {
						generatedidea += "a ";
					}
					generatedidea += adjectives[a4] + " ";
				} else {
					if (nouns[n4].substr(0,1)==="a" || nouns[n4].substr(0,1)==="e" || nouns[n4].substr(0,1)==="i" || nouns[n4].substr(0,1)==="o" || nouns[n4].substr(0,1)==="u") {
						generatedidea += "an ";
					} else {
						generatedidea += "a ";
					}
				}
				generatedidea += nouns[n4];
			}
			generatedidea += ".<br />";

			var el = document.getElementById('ideatext');
			el.innerHTML = generatedidea;
		});
	}
  </script>
</head>

<body>

<form id="setseed">
<p>Seed: <input id="seedbox" name="seed" value="<?php echo $seed; ?>"> <input id="seedchange" type="submit" value="Generate!">
</p>
</form>
<p style="font-weight:bold;"><a href=".">Re-Roll</a></p>

<div>
	<p id="ideatext"></p>
	<script>
		generatevalues('<?php echo $seed; ?>');
	</script>
</div>

</body>
</html>