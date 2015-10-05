<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>


<table<?php
					if(isset($this->variables['summary']) && count($this->variables['summary']) != 0 && $this->variables['summary'] != '' && $this->variables['summary'] !== false)
					{
						?> summary="<?php echo $this->variables['summary']; ?>"<?php } ?><?php echo $this->variables['attributes']; ?>>
	<?php
					if(isset($this->variables['caption']) && count($this->variables['caption']) != 0 && $this->variables['caption'] != '' && $this->variables['caption'] !== false)
					{
						?><caption><?php echo $this->variables['caption']; ?></caption><?php } ?>
	<thead>
		<?php
					if(isset($this->variables['paging']) && count($this->variables['paging']) != 0 && $this->variables['paging'] != '' && $this->variables['paging'] !== false)
					{
						?>
			<tr>
				<td colspan="<?php echo $this->variables['numColumns']; ?>"><?php echo $this->variables['paging']; ?></td>
			</tr>
		<?php } ?>
		<tr>
			<?php
				if(isset(${'headers'})) $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['old'] = ${'headers'};
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['iteration'] = $this->variables['headers'];
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['i'] = 1;
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['count'] = count($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['iteration'] as ${'headers'})
				{
					if(!isset(${'headers'}['first']) && $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['i'] == 1) ${'headers'}['first'] = true;
					if(!isset(${'headers'}['last']) && $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['i'] == $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['count']) ${'headers'}['last'] = true;
					if(isset(${'headers'}['formElements']) && is_array(${'headers'}['formElements']))
					{
						foreach(${'headers'}['formElements'] as $name => $object)
						{
							${'headers'}[$name] = $object->parse();
							${'headers'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<th<?php echo ${'headers'}['attributes']; ?>>
					<?php
					if(isset(${'headers'}['sorting']) && count(${'headers'}['sorting']) != 0 && ${'headers'}['sorting'] != '' && ${'headers'}['sorting'] !== false)
					{
						?>
						<?php
					if(isset(${'headers'}['sorted']) && count(${'headers'}['sorted']) != 0 && ${'headers'}['sorted'] != '' && ${'headers'}['sorted'] !== false)
					{
						?>
							<a href="<?php echo ${'headers'}['sortingURL']; ?>" title="<?php echo ${'headers'}['sortingLabel']; ?>"><?php echo ${'headers'}['label']; ?><?php
					if(isset(${'headers'}['sortingIcon']) && count(${'headers'}['sortingIcon']) != 0 && ${'headers'}['sortingIcon'] != '' && ${'headers'}['sortingIcon'] !== false)
					{
						?> <img src="<?php echo ${'headers'}['sortingIcon']; ?>" /><?php } ?></a>
						<?php } ?>
						<?php
					if(isset(${'headers'}['notSorted']) && count(${'headers'}['notSorted']) != 0 && ${'headers'}['notSorted'] != '' && ${'headers'}['notSorted'] !== false)
					{
						?>
							<a href="<?php echo ${'headers'}['sortingURL']; ?>" title="<?php echo ${'headers'}['sortingLabel']; ?>"><?php echo ${'headers'}['label']; ?><?php
					if(isset(${'headers'}['sortingIcon']) && count(${'headers'}['sortingIcon']) != 0 && ${'headers'}['sortingIcon'] != '' && ${'headers'}['sortingIcon'] !== false)
					{
						?> <img src="<?php echo ${'headers'}['sortingIcon']; ?>" /><?php } ?></a>
						<?php } ?>
					<?php } ?>

					<?php
					if(isset(${'headers'}['noSorting']) && count(${'headers'}['noSorting']) != 0 && ${'headers'}['noSorting'] != '' && ${'headers'}['noSorting'] !== false)
					{
						?>
						<?php echo ${'headers'}['label']; ?>
					<?php } ?>
				</th>
			<?php
					$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['old'])) ${'headers'} = $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']['old'];
				else unset($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_1']);
				?>
		</tr>
	</thead>
	<tbody>
		<?php
				if(isset(${'rows'})) $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['old'] = ${'rows'};
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['iteration'] = $this->variables['rows'];
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['i'] = 1;
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['count'] = count($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['iteration'] as ${'rows'})
				{
					if(!isset(${'rows'}['first']) && $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['i'] == 1) ${'rows'}['first'] = true;
					if(!isset(${'rows'}['last']) && $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['i'] == $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['count']) ${'rows'}['last'] = true;
					if(isset(${'rows'}['formElements']) && is_array(${'rows'}['formElements']))
					{
						foreach(${'rows'}['formElements'] as $name => $object)
						{
							${'rows'}[$name] = $object->parse();
							${'rows'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<tr<?php echo ${'rows'}['attributes']; ?><?php echo ${'rows'}['oddAttributes']; ?><?php echo ${'rows'}['evenAttributes']; ?>>
				<?php
				if(isset(${'rows'}['columns'])) $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['old'] = ${'rows'}['columns'];
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['iteration'] = ${'rows'}['columns'];
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['i'] = 1;
				$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['count'] = count($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['iteration']);
				foreach((array) $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['iteration'] as ${'rows'}['columns'])
				{
					if(!isset(${'rows'}['columns']['first']) && $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['i'] == 1) ${'rows'}['columns']['first'] = true;
					if(!isset(${'rows'}['columns']['last']) && $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['i'] == $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['count']) ${'rows'}['columns']['last'] = true;
					if(isset(${'rows'}['columns']['formElements']) && is_array(${'rows'}['columns']['formElements']))
					{
						foreach(${'rows'}['columns']['formElements'] as $name => $object)
						{
							${'rows'}['columns'][$name] = $object->parse();
							${'rows'}['columns'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><td<?php echo ${'rows'}['columns']['attributes']; ?>><?php echo ${'rows'}['columns']['value']; ?></td><?php
					$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['i']++;
				}
				if(isset($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['old'])) ${'rows'}['columns'] = $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']['old'];
				else unset($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_3']['columns']);
				?>
			</tr>
		<?php
					$this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['old'])) ${'rows'} = $this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']['old'];
				else unset($this->iterations['3e523574f83e9b08bf05524ba00290f5_datagrid.tpl.php_2']);
				?>
	</tbody>
	<?php
					if(isset($this->variables['paging']) && count($this->variables['paging']) != 0 && $this->variables['paging'] != '' && $this->variables['paging'] !== false)
					{
						?>
		<tfoot>
			<tr<?php echo $this->variables['footerAttributes']; ?>>
				<td colspan="<?php echo $this->variables['numColumns']; ?>"><?php echo $this->variables['paging']; ?></td>
			</tr>
		</tfoot>
	<?php } ?>
</table>
