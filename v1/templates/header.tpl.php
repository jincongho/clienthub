<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{$title}</title>
<link rel='stylesheet' href='{$css_path}' />
{option:!login}
<script type='text/javascript' src='{$jquery_path}'></script>
<script type='text/javascript'>
$().ready(function(){
	menu("#header ul li:contains('Home')", '{$base_url}');
	menu("#header ul li:contains('Search')", '{$base_url}/search.php');
	menu("#header ul li:contains('List')", '{$base_url}/list.php');
	menu("#header ul li:contains('Tidy Up')", '{$base_url}/tidy.php');
	menu("#header h1", '{$base_url}');
	function menu(selector, url){
		$(selector).click(function(){
			window.location = url;
		});	
	}
});
</script>
{/option:!login}
</head>
<body>
<div id='header' class='wrap'>
<h1>{$title}</h1>
{option:!login}
<ul>
	<li>Home</li>
	<li>Tidy Up</li>
	<li>List</li>
	<li>Search</li>
</ul>
{/option:!login}
</div>
