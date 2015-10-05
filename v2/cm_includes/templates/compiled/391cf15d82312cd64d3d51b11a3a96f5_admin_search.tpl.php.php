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
<?php
					if(isset($this->variables['tooltip']) && count($this->variables['tooltip']) != 0 && $this->variables['tooltip'] != '' && $this->variables['tooltip'] !== false)
					{
						?><p class='tooltip'><?php echo $this->variables['tooltip']; ?></p><?php } ?>
<h2>Search Profiles</h2>
<?php if(!isset($this->variables['isResult']) || count($this->variables['isResult']) == 0 || $this->variables['isResult'] == '' || $this->variables['isResult'] === false): ?><?php
				ob_start();
				?><?php echo $this->variables['tpl_path']; ?>/admin_form.tpl.php<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile()) $this->compile('I:\xampp\htdocs\clientManager_new\cm_includes\templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'I:\xampp\htdocs\clientManager_new\cm_includes\templates');
				if($return === false && $this->compile('I:\xampp\htdocs\clientManager_new\cm_includes\templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'I:\xampp\htdocs\clientManager_new\cm_includes\templates');
				}
?><?php endif; ?>
<?php
					if(isset($this->variables['isResult']) && count($this->variables['isResult']) != 0 && $this->variables['isResult'] != '' && $this->variables['isResult'] !== false)
					{
						?>
<?php echo $this->variables['results']; ?>
<script type='text/javascript'>
$().ready(function(){
	$(".delProfile").click(function(event){
		event.preventDefault();
		var td = $(this).parent().parent();
		if (confirm("Confirm to delete?")){
			$.ajax({
				type: 'POST',
				url: '<?php echo $this->variables['base_url']; ?>/cm_api/delete.php' ,
				data: 'id=' + $(this).attr('id') + '&adminname=<?php echo $this->variables['adminname']; ?>&adminpw=<?php echo $this->variables['adminpw']; ?>',
				success: function(data){
					if(data == "1"){
						td.fadeOut();
					}else{
						alert('Deleting Failed!');
					}
				}
			});
		}
	});
});
</script>
<?php } ?>
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