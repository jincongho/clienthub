	<div class="row">
		<h1 class="span1">Staff</h1>
		<a class="btn btn-large pull-right" href="<?=site_url('auth/create_staff'); ?>"><i class="icon-plus"></i> Add Staff</a>
	</div>
	<hr>
	<?php if($message): ?>
	<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
	<?php endif;?>
	
	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				<th>Id</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Groups</th>
				<?php if($is_sa) { ?>
				<th>Status</th>
				<th>Trash</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user):?>
			<tr>
				<td><?=$user->id; ?></td>
				<td><?=$user->first_name;?></td>
				<td><?=$user->last_name;?></td>
				<td><?=$user->email;?></td>
				<td>
					<?php 
					if(is_superadmin($user->id)){
						echo "superadmin";
					}else{
						foreach ($user->groups as $group):?>
						<?php 
							if($group->name == "admin"){
								$user->admin = true;
							}
							echo $group->name; 
						?><br />
	                <?php endforeach;} ?>
				</td>
				<?php if($is_sa) { ?>
				<td>
					<?php 
						if(!is_superadmin($user->id)){
							echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Deactivate') : anchor("auth/activate/". $user->id, 'Activate') ;
						}else{
							echo "Active";
						}
					?>
					<?php if(!is_superadmin($user->id)) { 
						if(isset($user->admin) && $user->admin == true){ ?>
							<br><a href="<?=site_url("/auth/remove_admin/$user->id");	?>">Remove Admin</a>
					<?php }else{ ?>
							<br><a href="<?=site_url("/auth/make_admin/$user->id");	?>">Make Admin</a>
					<?php } 
					} ?>
				</td>
				<td style="text-align: center;"><a href="<?=site_url("auth/trash/".$user->id); ?>"><i class="icon-trash"></i></a></td>
				<?php } ?>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>