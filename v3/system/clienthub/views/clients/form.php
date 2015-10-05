<div class="row">
	<h1 class="span6"><?=$title; ?></h1>
	<?php if(isset($brief->name)) { ?>
	<div class="btn-group pull-right">
		<a class="btn btn-large" href="<?=site_url('clients/profile/'.$brief->id); ?>"><i class="icon-eye-open"></i></a>
		<a class="btn btn-large" href="<?=site_url('clients/trash/'.$brief->id); ?>"><i class="icon-trash"></i></a>
	</div>
	<?php } ?>
</div>
<hr>
<?php if(strlen($message) > 0): ?>
	<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
<?php endif;?>
<ul class="nav nav-tabs">
  	<li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
  	<li><a href="#attachments" data-toggle="tab">Attachments</a></li>
</ul>
<?php echo form_open_multipart(uri_string(), array("class" => "form-horizontal"));?>
    <fieldset>
    <div class="tab-content">
	    <div class="tab-pane active" id="profile">
		    <div class="control-group <?php if(form_error("name")) echo "error"; ?>">
		    	<label class="control-label" for="name">Name*</label>
		    	<div class="controls">
		     		<input type="text" id="name" name="name" value="<?=set_value("name", isset($brief->name) ? $brief->name : null); ?>">
		     		<span class="help-inline"><?=form_error("name"); ?></span>
		    	</div>
		  	</div>
		  	<div class="control-group <?php if(form_error("gravatar")) echo "error"; ?>">
	    		<label class="control-label" for="gravatar">Gravatar: <br>( 100x100 jpg or png max: 5mb )</label>
	    		<div class="controls">
	    			<?=form_input(array(
						"name" 	=> "gravatar",
						"id"	=> "gravatar",
						"type"	=> "file"		
					)); ?>
	    			<span class="help-inline"><?=form_error("gravatar"); ?></span>
	    			<span class="help-block">    			
	    				<img style="height: 100px; width: 100px;" src="<?php echo base_url("assets/img/".(!isset($brief) ? general("gravatar") : ($brief->gravatar ? "gravatars/".$brief->gravatar : general("gravatar")))); ?>" class="img-polaroid" />
	    			</span>
	    		</div>
	    	</div>
		    <?php 
		    foreach($fields as $field){
		   	?>
	   		<div class="control-group <?php if(form_error($field->Field)) echo "error"; ?>">
	    		<label class="control-label" for="<?=$field->Field; ?>"><?=$field->slug; ?><?php if($field->Null == "NO") echo "*"; ?></label>
	    		<div class="controls">
	    			<?php
	    				$value = (isset($field->value)) ?  $field->value : $field->Default;
	    				if($field->Type === "int" || $field->Type === "text"){
	    					$max = ($field->maxlength < 1) ? null : $field->maxlength;
	    					echo form_input(array(
	    							"name" 	=> $field->Field,
	    							"id" 	=> $field->Field,
	    							"value" => set_value($field->Field, $value),
	    							"maxlength" => $max
	    						));
	    				}elseif($field->Type === "enum"){
	    					$selection = array();
	    					$parse = explode("|", $field->selection);
	    					if($field->Default === null) $selection[""] = "";
	    					foreach($parse as $option){
	    						$selection[$option] = $option;
	    					}
	    					echo form_dropdown($field->Field, $selection, $value);
	    				}elseif($field->Type === "longtext"){
	    					echo form_textarea(array(
	    							"name" 	=> $field->Field,
	    							"id" 	=> $field->Field,
	    							"value" => $value
	    						));
	    				}elseif($field->Type === "tinyint"){
	    					echo form_checkbox($field->Field, $value, ($value == "1" ? "1" : "0"));
	    				}
	    			?>
	    			<span class="help-inline"><?=form_error($field->Field); ?></span>
	    		</div>
	    	</div>
		   	<?php
		    }
		    ?>
	    </div>
	    <div class="tab-pane" id="attachments">
	    	<div class="control-group <?php if(form_error("attachments[]")) echo "error"; ?>">
	    		<label class="control-label" for="gravatar">Attachments: <br>( Music, Videos, Documents, others )</label>
	    		<div class="controls">
	    			<div id="attachfields">
	    			<?=form_input(array(
						"name" 	=> "attachments[]",
						"type"	=> "file"		
					)); ?>
					</div>
	    			<span class="help-inline"><?=form_error("attachments[]"); ?></span>
	    			<span class="help-block">
	    				<?php 
	    				if(isset($attachments)){
	    					foreach($attachments as $id=>$row){
	    						echo "<span style='display: block;'><a target='_blank' href='".site_url("/attachments/view/".$row->id)."'>".$row->filename."</a> [<a href='".site_url("attachments/delete/".$row->id)."' class='delete'> Delete </a>]</span>";
	    					}
	    				}
	    				?>
	    				<a id="addfile" class="btn">Add File</a>
	    			</span>
	    		</div>
	    	</div>
	    </div>
    </div>
    <div class="form-actions">
		<button type="submit" class="btn btn-primary"><?=$title; ?></button>
    </div>  
    </fieldset>
</form>
<script type="text/javascript">
	$().ready(function(){
		$(".delete").click(function(e){
			d = $(this);
			$.ajax({
				url: d.prop("href"),
				context: document.body
			}).done(function() { 
				d.parent("span").remove();
			});
			e.preventDefault();
		});
		$("#addfile").click(function(e){
			$('<br><?=form_input(array(
					"name" 	=> "attachments[]",
					"type"	=> "file"		
		)); ?>').clone().appendTo("#attachfields");
			e.preventDefault();
		});
	});
</script>