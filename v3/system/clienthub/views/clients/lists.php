	<style>
	.gravatar{ height: 100px; width: 100px; }
	</style>
	<div class="row">
		<h1 class="span3">Clients</h1>
		<?php if($permits) { ?><a href="<?=site_url("clients/add"); ?>" class="btn btn-large pull-right"><i class="icon-plus"></i> Add Client</a><?php } ?>
	</div>
	<hr />
	<?php if(strlen($message) > 0): ?>
	<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
	<?php endif;?>
	<div class="row">
	<ul class="nav nav-pills spann3">
		<li class="<?php if($group === "active") echo "active"; ?>"><a href="<?=site_url("clients/lists/active/$sort/$desc/0"); ?>">Active</a></li>
		<li class="<?php if($group === "trash") echo "active"; ?>"><a href="<?=site_url("clients/lists/trash/$sort/$desc/0"); ?>">Trash</a></li>
	</ul>
	<?php if($permits && $group === "trash") { ?><a href="<?=site_url("clients/clear"); ?>" class="btn pull-right"><i class="icon-trash"></i> Clear Trash</a><?php } ?>
	</div>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th><a href="<?=site_url("clients/lists/$group/id/".(($desc === "desc") ? "asc" : "desc")."/$start"); ?>">#</a></th>
				<th>Gravatar</th>
				<th>Client Name</th>
				<th>Last Update</th>
				<?php
					foreach($in_list as $column){
						echo '<th>'.$meta[$column].'</th>';
					}
				?>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach($clients as $row){
				echo "<tr>";
				foreach($row as $key=>$col){
					if($key == "gravatar"){
						$col = "<img src='".base_url("assets/img/".(!empty($col) ? "gravatars/".$col : general("gravatar")))."' class='gravatar' />";
					}elseif($key == "status"){
						continue;
					}
					echo "<td>".$col."</td>";
				}
				echo "<td><a href='".site_url("clients/profile/".$row->id)."'><i class=\"icon-eye-open\"></i> View</a> ";
				if($permits) { echo "<br><a href='".site_url("clients/edit/".$row->id)."'><i class=\"icon-edit\"></i> Edit</a><br> <a href='".site_url("/clients/".($row->status == "active" ? "trash" : "recover")."/".$row->id)."'><i class=\"icon-trash\"></i> ".($row->status == "active" ? "Trash" : "Recover")."</a><br> <a href='".site_url("/attachments/download_all/".$row->id)."'><i class=\"icon-file\"></i> Attachments</a></td>"; }
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
	<div class="pagination pull-right">
		<ul>
		<?=$pagination; ?>
		</ul>
	</div>