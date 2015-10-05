<h1>Change Password</h1>
<hr>
<?php echo form_open("auth/change_password", array("class" => "form-horizontal"));?>
	<fieldset>
    	<div class="control-group <?php if(form_error("old")) echo "error"; ?>">
    		<label class="control-label" for="email">Old Password: </label>
    		<div class="controls">
    			<?=form_input($old_password); ?>
    			<span class="help-inline"><?=form_error("old"); ?></span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("new")) echo "error"; ?>">
    		<label class="control-label" for="email">New Password: </label>
    		<div class="controls">
    			<?=form_input($new_password); ?>
    			<span class="help-inline"><?=form_error("new"); ?></span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("new_confirm")) echo "error"; ?>">
    		<label class="control-label" for="email">New Password Confirm: </label>
    		<div class="controls">
    			<?=form_input($new_password_confirm); ?>
    			<span class="help-inline"><?=form_error("new_confirm"); ?></span>
    			<span class="help-block">at least <?=$min_password_length;?> characters long</span>
    		</div>
    	</div>
    	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Change</button>
    	</div>  
    </fieldset>
    <?=form_input($user_id);?> 
<?=form_close();?>
