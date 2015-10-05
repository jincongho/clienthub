<h1>Search Profiles</h1>
<form class="form-search" action="" method="get">
	<input type="text" name="q" id="search" value="<?=$query; ?>" class="input-large search-query span4" autofocus>
	<select name="field" class="span2">
		<option value="name">Name</option>
		<?php 
		foreach($field as $select){
			echo "<option value='".$select->Field."' ".($select->Field == $target ? "selected" : "").">".$select->slug."</option>";
		}
		?>
	</select>
	<button type="submit" class="btn">Search</button>
</form>
<hr>
<?php if(count($results) > 0): ?>
<table class="table-condensed table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Id</th>
			<th>Gravatar</th>
			<th>Name</th>
			<?php
				if($target != "name")
					echo "<th>".$meta[$target]."</th>";
			?>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($results as $row){
			echo "<tr><td>{$row->id}</td><td><img style='height: 100px; width: 100px;' src='".gravatar($row->gravatar)."' /></td><td>{$row->name}</td>";
			if($target != "name"){
				echo "<td>{$row->$target}</td>";
			}
			echo "<td><a href='".site_url("clients/profile/".$row->id)."'><i class=\"icon-eye-open\"></i> View</a>";
			if($permits) {
				echo "<br><a href='".site_url("clients/edit/".$row->id)."'><i class=\"icon-edit\"></i> Edit</a><br> <a href='".site_url("/clients/".($row->status == "active" ? "trash" : "recover")."/".$row->id)."'><i class=\"icon-trash\"></i> ".($row->status == "active" ? "Trash" : "Recover")."</a><br> <a href='".site_url("/attachments/download_all/".$row->id)."'><i class=\"icon-file\"></i> Attachments</a></td>";
			}
				
			echo "</tr>";
		}
		?>
	</tbody>
</table>
<?php else:?>
No Relevant Results.
<?php endif; ?>