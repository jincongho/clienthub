<h1>Preference</h1>
<hr>
<?php if(strlen($message) > 0): ?>
	<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
<?php endif; ?>
 	<?=form_open("user/preference", array("class" => "form-horizontal"));?>
    <fieldset>
    	<div class="control-group <?php if(form_error("per_page")) echo "error"; ?>">
    		<label class="control-label" for="per_page">Row Per Page: </label>
    		<div class="controls">
    			<?=form_input($per_page); ?>
    			<span class="help-inline"><?=form_error("per_page"); ?></span>
    		</div>
    	</div>
    	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Update</button>
    	</div>      
    </fieldset>
    <?php echo form_close();?>