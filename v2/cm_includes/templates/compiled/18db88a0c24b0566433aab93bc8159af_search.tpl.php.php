<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
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
<div id='header'>
<div class="wrapper" style="padding-top: 5px;">
<span id="identifier">ClientManager Search - <span id="session">Session will expired in <?php echo $this->variables['session']; ?> minutes.</span></span>
<form class="form-search" action="" method="get">
<input class="form-query" name="q" type="text" id="query" size="20" value="<?php
					if(isset($this->variables['query']) && count($this->variables['query']) != 0 && $this->variables['query'] != '' && $this->variables['query'] !== false)
					{
						?><?php echo $this->variables['query']; ?><?php } ?>" x-webkit-speech />
<input class="btn btn-primary" name="submit" type="submit" id="submit" value="Submit" />
</form>
<?php
					if(isset($this->variables['count']) && count($this->variables['count']) != 0 && $this->variables['count'] != '' && $this->variables['count'] !== false)
					{
						?><span id="count">About <?php echo $this->variables['count']; ?> Results.</span><?php } ?>
</div>
</div>
<div id="results">
<div class="wrapper"><br />
<?php
					if(isset($this->variables['result']) && count($this->variables['result']) != 0 && $this->variables['result'] != '' && $this->variables['result'] !== false)
					{
						?><?php echo $this->variables['result']; ?><?php } ?>
</div>
</div>
<script type="text/javascript" src="cm_contents/js/bootstrap.min.js"></script>
</body>
</html>
