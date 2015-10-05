<h1>General</h1>
<hr>
<?php if(strlen($message) > 0): ?>
	<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
<?php endif; ?>
 	<?=form_open_multipart("settings/general", array("class" => "form-horizontal"));?>
    <fieldset>
    	<div class="control-group <?php if(form_error("site_title")) echo "error"; ?>">
    		<label class="control-label" for="site_title">Site Title: </label>
    		<div class="controls">
    			<?=form_input($site_title); ?>
    			<span class="help-inline"><?=form_error("site_title"); ?></span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("per_page")) echo "error"; ?>">
    		<label class="control-label" for="per_page">Default<br>Row Per Page: </label>
    		<div class="controls">
    			<?=form_input($per_page); ?>
    			<span class="help-inline"><?=form_error("per_page"); ?></span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("show_unset")) echo "error"; ?>">
    		<label class="control-label" for="show_unset">Show Unset Field in View: </label>
    		<div class="controls">
    			<?=form_input($show_unset); ?>
    			<span class="help-inline"><?=form_error("show_unset"); ?></span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("gravatar")) echo "error"; ?>">
    		<label class="control-label" for="gravatar">Default Gravatar: <br>( 100x100 jpg or png max: 2mb )</label>
    		<div class="controls">
    			<?=form_input($gravatar); ?>
    			<span class="help-inline"><?=form_error("gravatar"); ?></span>
    			<span class="help-block">    			
    				<img style="height: 100px; width: 100px;" src="<?=base_url("assets/img/".general("gravatar")); ?>" class="img-polaroid" />
    			</span>
    		</div>
    	</div>
    	<div class="control-group <?php if(form_error("in_list[]")) echo "error"; ?>">
    		<label class="control-label" for="show_unset">Fields Shown in List (Multiselect with Clicks + CTRL): </label>
    		<div class="controls">
    			<?=form_multiselect('in_list[]', $in_list['options'], $in_list['selected'], "style='height: 150px;'"); ?>
    			<span class="help-inline"><?=form_error("in_list[]"); ?></span>
    		</div>
    	</div>
    	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Update</button>
    	</div>      
    </fieldset>
    <?php echo form_close();?>