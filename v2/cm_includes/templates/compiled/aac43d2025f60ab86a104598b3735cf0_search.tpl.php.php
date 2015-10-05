<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ClientManager 0.2 alpha</title>
<style>
body{
	margin: 0px;
	padding; 0px;
	font-family: arial, Arial, Helvetica, sans-serif;
}

.wrapper{
	width: 960px;
	margin: 0px auto;
}

#session{
	color: #fff;
	font-size: 14px;
	font-style: italic;	
}

#header{
	margin-top: 35px;
	height: 100px;
	padding: 10px 0px;
	background: rgb(45, 45, 45);
}

#identifier{
	color: #b05b62;
	font-size: 24px;
	margin-top: 18px;
}

#query{
	width: 500px;
	padding: 5px;
	font-size: 16px;
	margin-top: 5px;
	border: 2px solid #666;
}

#query:hover, #query:active{
	border: 2px solid #09F;
}

#submit{
	cursor: pointer;
	color: #fff;
	border: 1px solid #3079ED;
	font-size: 16px;
	padding: 5px 10px;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
	font-weight: 900;
	background-color: #4D90FE;
	background-image: linear-gradient(top,#4d90fe,#4787ed);
}

#submit:hover{
	background-color: #2068ED;
	background-image: linear-gradient(top,#4d90fe,#4787ed);
}

#count{
	color: #999;
}
</style>
</head>
<body>
<div id='header'>
<div class="wrapper" style="padding-top: 5px;">
<span id="identifier">ClientManager Search - <span id="session">Session will expired in <?php echo $this->variables['session']; ?> minutes.</span></span>
<form action="" method="get">
<input name="q" type="text" id="query" size="20" value="<?php
					if(isset($this->variables['query']) && count($this->variables['query']) != 0 && $this->variables['query'] != '' && $this->variables['query'] !== false)
					{
						?><?php echo $this->variables['query']; ?><?php } ?>" x-webkit-speech />
<input name="submit" type="submit" id="submit" value="Submit" />
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
<span><?php echo $this->variables['lic']; ?></span>
</div>
</div>
</body>
</html>
