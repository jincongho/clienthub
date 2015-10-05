<div class="row">
	<h1 class="span6"><?=$profile['brief']->id.". ".$profile['brief']->name; ?></h1>
	<?php if($permits) { ?>
	<div class="btn-group pull-right">
		<a class="btn btn-large" href="<?=site_url('clients/edit/'.$id); ?>"><i class="icon-edit"></i></a>
		<a class="btn btn-large" href="<?=site_url('clients/trash/'.$id); ?>"><i class="icon-trash"></i></a>
	</div>
	<?php } ?>
</div>
<hr>
<img style="height: 100px; width: 100px;" src="<?php echo base_url("assets/img/".(!isset($profile['brief']->gravatar) ? general("gravatar") : "gravatars/".$profile['brief']->gravatar)); ?>" class="img-polaroid span2" />
<table class="table table-striped table-bordered span6">
	<tbody>
		<?php 
		foreach($profile['data'] as $key=>$value){
			echo "<tr><td>{$value['slug']}</td><td>{$value['value']}</td></tr>";
		}
		if(isset($attachments)){
			echo "<tr><td>Attachments 附件 [ <a href='".site_url("/attachments/download_all/".$id)."'>Download All</a> ]</td><td>";
			foreach($attachments as $id=>$row){
				echo "<a href='".site_url("/attachments/download/".$row->id)."'>".$row->filename."</a>";
				if(in_array($row->fileext, array(".pdf", ".jpeg", ".jpg", ".png", ".txt"))){
					echo " [<a target='_blank' href='".base_url("/attachments/view/".$row->id)."'>View Online</a>]";
				}
				echo "<br>";
			}
			echo "</><tr>";
		}
		?>
	</tbody>
</table>