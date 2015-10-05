<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>

<?php
					if(isset($this->variables['previousURL']) && count($this->variables['previousURL']) != 0 && $this->variables['previousURL'] != '' && $this->variables['previousURL'] !== false)
					{
						?><a href="<?php echo $this->variables['previousURL']; ?>" title="<?php echo $this->variables['previousLabel']; ?>"><?php } ?>
	&laquo; previous
<?php
					if(isset($this->variables['previousURL']) && count($this->variables['previousURL']) != 0 && $this->variables['previousURL'] != '' && $this->variables['previousURL'] !== false)
					{
						?></a><?php } ?>


<?php
				if(isset(${'pages'})) $this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['old'] = ${'pages'};
				$this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['iteration'] = $this->variables['pages'];
				$this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['i'] = 1;
				$this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['count'] = count($this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['iteration'] as ${'pages'})
				{
					if(!isset(${'pages'}['first']) && $this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['i'] == 1) ${'pages'}['first'] = true;
					if(!isset(${'pages'}['last']) && $this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['i'] == $this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['count']) ${'pages'}['last'] = true;
					if(isset(${'pages'}['formElements']) && is_array(${'pages'}['formElements']))
					{
						foreach(${'pages'}['formElements'] as $name => $object)
						{
							${'pages'}[$name] = $object->parse();
							${'pages'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
	<?php
					if(isset(${'pages'}['page']) && count(${'pages'}['page']) != 0 && ${'pages'}['page'] != '' && ${'pages'}['page'] !== false)
					{
						?>
		<?php
					if(isset(${'pages'}['currentPage']) && count(${'pages'}['currentPage']) != 0 && ${'pages'}['currentPage'] != '' && ${'pages'}['currentPage'] !== false)
					{
						?><strong><?php echo ${'pages'}['pageNumber']; ?></strong><?php } ?>
		<?php
					if(isset(${'pages'}['otherPage']) && count(${'pages'}['otherPage']) != 0 && ${'pages'}['otherPage'] != '' && ${'pages'}['otherPage'] !== false)
					{
						?><a href="<?php echo ${'pages'}['url']; ?>"><?php echo ${'pages'}['pageNumber']; ?></a><?php } ?>
	<?php } ?>

	<?php
					if(isset(${'pages'}['noPage']) && count(${'pages'}['noPage']) != 0 && ${'pages'}['noPage'] != '' && ${'pages'}['noPage'] !== false)
					{
						?>&hellip;<?php } ?>
<?php
					$this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['old'])) ${'pages'} = $this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']['old'];
				else unset($this->iterations['cdabae5e9b270a0cc7c42655c9a94a5b_paging.tpl.php_1']);
				?>


<?php
					if(isset($this->variables['nextURL']) && count($this->variables['nextURL']) != 0 && $this->variables['nextURL'] != '' && $this->variables['nextURL'] !== false)
					{
						?><a href="<?php echo $this->variables['nextURL']; ?>" title="<?php echo $this->variables['nextLabel']; ?>"><?php } ?>
	 next &raquo;
<?php
					if(isset($this->variables['nextURL']) && count($this->variables['nextURL']) != 0 && $this->variables['nextURL'] != '' && $this->variables['nextURL'] !== false)
					{
						?></a><?php } ?>
