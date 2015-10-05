<html>
<head>
<meta charset="UTF-8">
<title>Client Manager 0.2 alpha</title>
<link href="{$css_path}/style.css" rel='stylesheet' />
</head>
<body>
<div id="container" class="wrapper" style='margin-top: 50px;'>
	<div id="contents">
		<h2>Login</h2>
		{form:login}
			<p> 
		        <label for="username">Admin username: </label>
		        {$txtUsername} {$txtUsernameError}
		    </p> 
		    <p> 
		        <label for="password">Admin password: </label>
		        {$txtPassword} {$txtPasswordError}
		    </p>
		    <p> 
		        <label for="captcha">Captcha: </label><br />
		        <img id="captcha" src="{$securimage}/securimage_show.php" alt="CAPTCHA Image" /><br />
		        <object type="application/x-shockwave-flash" data="{$securimage}/securimage_play.swf?audio_file={$securimageEncode}securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
		    		<param name="movie" value="{$securimage}/securimage_play.swf?audio_file={$securimageEncode}securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
		    	</object>
		        <a href="#" onclick="document.getElementById('captcha').src = '{$securimage}/securimage_show.php?' + Math.random(); return false">
					<img src='{$securimage}/images/refresh.png' />
				</a>
		        {$txtCaptcha} {$txtCaptchaError}
		    </p> 
		    <p>{$btnSubmit}</p>
		{/form:login}
	</div>
</div>
</body>
</html>