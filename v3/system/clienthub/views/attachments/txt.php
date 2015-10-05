<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?=$title; ?></title>
		<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" />
	</head>
	<body>
		<div class="fluid-container">
		<div class="fluid-row span8 offset1">
			<h1 style="padding-top: 20px;"><?=$title; ?></h1><br>
			<pre style="border: 1px solid #000; padding: 7px; height: 450px; overflow-y:scroll;"><?=$content; ?></pre>
		</div>
		</div>
	</body>
</html>
