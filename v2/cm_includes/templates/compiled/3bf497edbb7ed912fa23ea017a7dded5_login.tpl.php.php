<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<html>
<head>
<meta charset="UTF-8">
<title>Client Manager 0.2 alpha</title>
<link href="<?php echo $this->variables['css_path']; ?>/style.css" rel='stylesheet' />
</head>
<body>
<div id="container" class="wrapper" style='margin-top: 50px;'>
	<div id="contents">
		<h2>Login</h2>
		<?php
					if(isset($this->forms['login']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['login']->getAction(); ?>" method="<?php echo $this->forms['login']->getMethod(); ?>"<?php echo $this->forms['login']->getParametersHTML(); ?>>
						<?php echo $this->forms['login']->getField('form')->parse();
						if($this->forms['login']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['login']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo $this->forms['login']->getField('form_token')->getValue(); ?>" />
						<?php } ?>
			<p> 
		        <label for="username">Admin username: </label>
		        <?php echo $this->variables['txtUsername']; ?> <?php echo $this->variables['txtUsernameError']; ?>
		    </p> 
		    <p> 
		        <label for="password">Admin password: </label>
		        <?php echo $this->variables['txtPassword']; ?> <?php echo $this->variables['txtPasswordError']; ?>
		    </p>
		    <p> 
		        <label for="captcha">Captcha: </label><br />
		        <img id="captcha" src="<?php echo $this->variables['securimage']; ?>/securimage_show.php" alt="CAPTCHA Image" /><br />
		        <object type="application/x-shockwave-flash" data="<?php echo $this->variables['securimage']; ?>/securimage_play.swf?audio_file=<?php echo $this->variables['securimageEncode']; ?>securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
		    		<param name="movie" value="<?php echo $this->variables['securimage']; ?>/securimage_play.swf?audio_file=<?php echo $this->variables['securimageEncode']; ?>securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
		    	</object>
		        <a href="#" onclick="document.getElementById('captcha').src = '<?php echo $this->variables['securimage']; ?>/securimage_show.php?' + Math.random(); return false">
					<img src='<?php echo $this->variables['securimage']; ?>/images/refresh.png' />
				</a>
		        <?php echo $this->variables['txtCaptcha']; ?> <?php echo $this->variables['txtCaptchaError']; ?>
		    </p> 
		    <p><?php echo $this->variables['btnSubmit']; ?></p>
		</form>
				<?php } ?>
	</div>
</div>
</body>
</html>