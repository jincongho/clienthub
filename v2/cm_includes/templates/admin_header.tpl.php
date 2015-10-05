<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Client Manager 0.2 alpha</title>
<link href="{$css_path}/style.css" rel='stylesheet' />
<script type='text/javascript' src='{$js_path}/jquery-1.6.4.min.js'></script>
</head>
<body>
<div id="navigator" class="wrapper">
	{iteration:menu}
		<a href="{$menu.href}">
			<button class="navBtn">
				<img src="{$menu.image}" />
				<label>{$menu.label}</label>
			</button>
		</a>
	{/iteration:menu}
</div>
<div id="container" class="wrapper">
	<div id="contents">