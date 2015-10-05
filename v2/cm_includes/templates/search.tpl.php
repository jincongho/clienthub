<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>ClientManager v1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Jin Cong Ho">
	<link href="cm_contents/css/bootstrap.min.css" rel="stylesheet">
	<link href="cm_contents/css/bootstrap-responsive.min.css" rel="stylesheet">
</head>
<body>
	<div class="fluid-ontainer">
		<div class="row">
			<div class="span8">
				<div class="hero-unit" style="padding-bottom: 0px;margin-bottom: 5px; background: none;">
				<h1>Client Manager</h1>
				<p>Session will expired in {$session} minutes.</p>
				<p>
					<form class="form-search form-inline" style="margin-bottom: 10px;" action="" method="get">
						<input id="appendedPrependedInput" style="height: 27px; font-size: 16px;" class="search-query span3" name="q" type="text" value="{option:query}{$query}{/option:query}" />
						<input class="btn btn-primary btn-large" name="submit" type="submit" id="submit" value="Search" />
					</form>
				</p>
				</div>
				{option:helper}
					<p style="margin-left: 60px;" class="span3
					{option:count}alert alert-success{/option:count}
					{option:!count}alert alert-error{/option:!count}
					">
					{$helper}
					</p>
				{/option:helper}
				{option:result}{$result}{/option:result}
			</div>
		</div>
	</div>
	<script type="text/javascript" src="cm_contents/js/bootstrap.min.js"></script>	
</body>
</html>
