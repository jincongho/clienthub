<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
﻿<!DOCTYPE html>
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
				<p>Session will expired in <?php echo $this->variables['session']; ?> minutes.</p>
				<p>
					<form class="form-search form-inline" style="margin-bottom: 10px;" action="" method="get">
						<input id="appendedPrependedInput" style="height: 27px; font-size: 16px;" class="search-query span3" name="q" type="text" value="<?php
					if(isset($this->variables['query']) && count($this->variables['query']) != 0 && $this->variables['query'] != '' && $this->variables['query'] !== false)
					{
						?><?php echo $this->variables['query']; ?><?php } ?>" />
						<input class="btn btn-primary btn-large" name="submit" type="submit" id="submit" value="Search" />
					</form>
				</p>
				</div>
				<?php
					if(isset($this->variables['helper']) && count($this->variables['helper']) != 0 && $this->variables['helper'] != '' && $this->variables['helper'] !== false)
					{
						?>
					<p style="margin-left: 60px;" class="span3
					<?php
					if(isset($this->variables['count']) && count($this->variables['count']) != 0 && $this->variables['count'] != '' && $this->variables['count'] !== false)
					{
						?>alert alert-success<?php } ?>
					<?php if(!isset($this->variables['count']) || count($this->variables['count']) == 0 || $this->variables['count'] == '' || $this->variables['count'] === false): ?>alert alert-error<?php endif; ?>
					">
					<?php echo $this->variables['helper']; ?>
					</p>
				<?php } ?>
				<?php
					if(isset($this->variables['result']) && count($this->variables['result']) != 0 && $this->variables['result'] != '' && $this->variables['result'] !== false)
					{
						?><?php echo $this->variables['result']; ?><?php } ?>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="cm_contents/js/bootstrap.min.js"></script>	
</body>
</html>
