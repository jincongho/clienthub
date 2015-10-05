<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_header.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('G:\xampp\htdocs\clientManager_new\cm_includes\templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'G:\xampp\htdocs\clientManager_new\cm_includes\templates');
				if($return === false && $this->compile('G:\xampp\htdocs\clientManager_new\cm_includes\templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'G:\xampp\htdocs\clientManager_new\cm_includes\templates');
				}
?>
<?php
					if(isset($this->variables['tooltip']) && count($this->variables['tooltip']) != 0 && $this->variables['tooltip'] != '' && $this->variables['tooltip'] !== false)
					{
						?><p class='tooltip'><?php echo $this->variables['tooltip']; ?></p><?php } ?>
<?php if(!isset($this->variables['tooltip']) || count($this->variables['tooltip']) == 0 || $this->variables['tooltip'] == '' || $this->variables['tooltip'] === false): ?><h2>Create a new Profile</h2><?php endif; ?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_form.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('G:\xampp\htdocs\clientManager_new\cm_includes\templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'G:\xampp\htdocs\clientManager_new\cm_includes\templates');
				if($return === false && $this->compile('G:\xampp\htdocs\clientManager_new\cm_includes\templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'G:\xampp\htdocs\clientManager_new\cm_includes\templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_footer.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('G:\xampp\htdocs\clientManager_new\cm_includes\templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'G:\xampp\htdocs\clientManager_new\cm_includes\templates');
				if($return === false && $this->compile('G:\xampp\htdocs\clientManager_new\cm_includes\templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'G:\xampp\htdocs\clientManager_new\cm_includes\templates');
				}
?>