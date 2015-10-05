	<h1>Profile</h1>
	<hr>
	<?php if($message): ?>
	<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
	<?php endif; ?>
    <?php echo form_open("user/profile", array("class" => "form-horizontal"));?>
    <fieldset>
    	<div class="control-group <?php if(form_error("email")) echo "error"; ?>">
    		<label class="control-label" for="email">Login Email*</label>
    		<div class="controls">
    			<?=form_input($email); ?>
    			<span class="help-inline"><?=form_error("email"); ?></span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("first_name")) echo "error"; ?>">
    		<label class="control-label" for="first_name">First Name</label>
    		<div class="controls">
    			<?=form_input($first_name); ?>
    			<span class="help-inline"><?=form_error("first_name"); ?></span>
    		</div>
    	</div>
      	<div class="control-group <?php if(form_error("last_name")) echo "error"; ?>">
    		<label class="control-label" for="last_name">Last Name</label>
    		<div class="controls">
    			<?=form_input($last_name); ?>
    			<span class="help-inline"><?=form_error("last_name"); ?></span>
    		</div>
    	</div>
    	<div class="control-group">
    		<label class="control-label" for="company">Company</label>
    		<div class="controls">
    			<?=form_input($company); ?>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("phone")) echo "error"; ?>">
    		<label class="control-label" for="phone">Phone No.</label>
    		<div class="controls">
    			<?=form_input($phone); ?>
    			<p class="help-block"><?=form_error("phone", "", "<br>"); ?></p>
    		</div>
    	</div>
    	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Update</button>
    	</div>      
    </fieldset>
    <?php echo form_close();?>