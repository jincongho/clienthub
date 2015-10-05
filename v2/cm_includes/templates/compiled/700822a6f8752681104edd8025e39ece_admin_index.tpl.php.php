<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_header.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('I:\xampp\htdocs\clientManager_new\cm_includes\templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'I:\xampp\htdocs\clientManager_new\cm_includes\templates');
				if($return === false && $this->compile('I:\xampp\htdocs\clientManager_new\cm_includes\templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'I:\xampp\htdocs\clientManager_new\cm_includes\templates');
				}
?>
<p>
<h2>Client Manager's Info</h2>
<label for="info_total">Db Profiles Total: </label><span id="info_total"><?php echo $this->variables['total']; ?> profiles.</span><br />
<label for="info_expired">Session Time Left: </label><span id="info_expired"><?php echo $this->variables['expired']; ?> minutes left.</span>
</p>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_footer.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('I:\xampp\htdocs\clientManager_new\cm_includes\templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'I:\xampp\htdocs\clientManager_new\cm_includes\templates');
				if($return === false && $this->compile('I:\xampp\htdocs\clientManager_new\cm_includes\templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'I:\xampp\htdocs\clientManager_new\cm_includes\templates');
				}
?>