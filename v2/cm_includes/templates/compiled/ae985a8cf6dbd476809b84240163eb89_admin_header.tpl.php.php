<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Client Manager 0.2 alpha</title>
<link href="<?php echo $this->variables['css_path']; ?>/style.css" rel='stylesheet' />
<script type='text/javascript' src='<?php echo $this->variables['js_path']; ?>/jquery-1.6.4.min.js'></script>
</head>
<body>
<div id="navigator" class="wrapper">
	<?php
				if(isset(${'menu'})) $this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['old'] = ${'menu'};
				$this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['iteration'] = $this->variables['menu'];
				$this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['i'] = 1;
				$this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['count'] = count($this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['iteration']);
				foreach((array) $this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['iteration'] as ${'menu'})
				{
					if(!isset(${'menu'}['first']) && $this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['i'] == 1) ${'menu'}['first'] = true;
					if(!isset(${'menu'}['last']) && $this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['i'] == $this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['count']) ${'menu'}['last'] = true;
					if(isset(${'menu'}['formElements']) && is_array(${'menu'}['formElements']))
					{
						foreach(${'menu'}['formElements'] as $name => $object)
						{
							${'menu'}[$name] = $object->parse();
							${'menu'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<a href="<?php echo ${'menu'}['href']; ?>">
			<button class="navBtn">
				<img src="<?php echo ${'menu'}['image']; ?>" />
				<label><?php echo ${'menu'}['label']; ?></label>
			</button>
		</a>
	<?php
					$this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['i']++;
				}
				if(isset($this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['old'])) ${'menu'} = $this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']['old'];
				else unset($this->iterations['ae985a8cf6dbd476809b84240163eb89_admin_header.tpl.php.php_1']);
				?>
</div>
<div id="container" class="wrapper">
	<div id="contents">