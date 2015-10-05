<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_header.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates');
				if($return === false && $this->compile('/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates');
				}
?>
<?php
					if(isset($this->variables['tooltip']) && count($this->variables['tooltip']) != 0 && $this->variables['tooltip'] != '' && $this->variables['tooltip'] !== false)
					{
						?><p class='tooltip'><?php echo $this->variables['tooltip']; ?></p><?php } ?>
<?php
					if(isset($this->variables['id']) && count($this->variables['id']) != 0 && $this->variables['id'] != '' && $this->variables['id'] !== false)
					{
						?>
<p class='tooltip'><a href="<?php echo $this->variables['base_url']; ?>/cm_admin/profile.php?id=<?php echo $this->variables['id']; ?>">Print</a> | </a><a href="<?php echo $this->variables['base_url']; ?>/cm_admin/edit.php?id=<?php echo $this->variables['id']; ?>&delete=1">Delete</a> this profile.</p>
<h2>Edit Profile</h2>
<?php } ?>
<?php
					if(isset($this->variables['photo_path']) && count($this->variables['photo_path']) != 0 && $this->variables['photo_path'] != '' && $this->variables['photo_path'] !== false)
					{
						?><img src="<?php echo $this->variables['photo_path']; ?>" /><br /><?php } ?>
<?php
					if(isset($this->variables['attach_path']) && count($this->variables['attach_path']) != 0 && $this->variables['attach_path'] != '' && $this->variables['attach_path'] !== false)
					{
						?><a href="<?php echo $this->variables['attach_path']; ?>">Download Attachment</a><br /><?php } ?>
<?php
					if(isset($this->variables['lastupdate']) && count($this->variables['lastupdate']) != 0 && $this->variables['lastupdate'] != '' && $this->variables['lastupdate'] !== false)
					{
						?><label>Last Update</label><?php echo $this->variables['lastupdate']; ?><?php } ?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_form.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates');
				if($return === false && $this->compile('/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_footer.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates');
				if($return === false && $this->compile('/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/Applications/XAMPP/xamppfiles/htdocs/clientManager_new/cm_includes/templates');
				}
?>