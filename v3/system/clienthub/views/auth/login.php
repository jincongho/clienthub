<!DOCTYPE html>
<html lang="en">
  	<head>
	    <meta charset="utf-8">
	    <title><?=general("site_title"); ?> Login</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link href="<?=base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" />
	    <link href="<?=base_url("assets/css/bootstrap-responsive.min.css"); ?>" rel="stylesheet" />
		<script type="text/javascript" src="<?=base_url("assets/js/jquery-1.8.0.min.js"); ?>"></script>
		<script type="text/javascript" src="<?=base_url("assets/js/bootstrap.min.js"); ?>"></script>
		<style type="text/css">
			::selection{ background-color: #E13300; color: white; }
			::moz-selection{ background-color: #E13300; color: white; }
			::webkit-selection{ background-color: #E13300; color: white; }
			body {
				background-color: #fff;
				margin: 40px;
				font: 13px/20px normal Helvetica, Arial, sans-serif;
				color: #4F5155;
			}
			#title {
				color: #444;
				text-align: center;
				background-color: transparent;
				font-size: 32px;
				margin: 0;
				padding: 12px;
			}
			/*#container {
				left: 50%;
				width: 400px;
				margin-left: -200px;
				padding: 30px 0;
				border: 1px solid #D0D0D0;
				position: fixed;
				min-height: 210px;
			}*/
			#container{
				width: 350px;
				margin-left: -175px;
				left: 50%;
				position: fixed;
			}
			#loginform {
				padding: 10px 0 20px 0;
				margin: 0 auto;
				width: 220px;
			}
			#loginform input[type=text], #loginform input[type=password]{
				width: 180px;
				font-size: 16px;
			}
			</style>
	</head>
	<body>
		<div class="well" id="container">
			<h1 id="title"><?=general("site_title"); ?> Login</h1>
				<?php if(!empty($message)){ ?>
				<div class="alert alert-error"><?=$message; ?></div>
				<?php } ?>
						
				<?=form_open("login", array('id' => 'loginform'));?>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-envelope"></i></span><?=form_input($identity);?>
					</div>
					<div class="input-prepend">
						<span class="add-on"><i class="icon-lock"></i></span><?=form_input($password);?>
					</div>
					<label for="remember" class="checkbox">
					<?=form_checkbox('remember', '1', FALSE);?> Remember Me
					</label>
					<?=form_submit('submit', 'Login', 'class="btn btn-primary"');?>
				<?=form_close();?>
		</div>

		<script type="text/javascript">
			$().ready(function(){
				$("#identity").tooltip({title : "Enter your email.", placement : "right"});
				$("#password").tooltip({title : "Enter your password.", placement : "right"});
			});
		</script>
	</body>
</html>
