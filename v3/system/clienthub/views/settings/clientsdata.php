	<h1>Customize Client Data Field</h1>
	<hr>
	<?php if(strlen($message) > 0): ?>
	<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">×</a><?=$message;?></div>
	<?php endif; ?>
	<form id="clientsdata" action="<?=site_url("settings/clientsdata"); ?>" method="post">
	<ul id="fieldsort" class="span4">
		<?php 
			foreach($fields as $field){
				//print_r($field);
		?>
		<li class="field">
			<b><span><?=$field->slug; ?></span> <i class="icon-plus pull-right"></i></b>
			<div class="fielddata">
				<input type="hidden" name="oldslug[]" value="<?=$field->Field; ?>" />
				<span>Field Name</span> <input type="text" name="fieldname[]" value="<?=$field->slug; ?>" placeholder="Field Name" /><br>			
				<span>Field Slug</span> <input type="text" name="fieldslug[]" value="<?=$field->Field; ?>" placeholder="Slug Name" /><br>
				<span>Field Type</span>
				<select name="fieldtype[]">
					<option <?php if($field->Type === "text") echo "selected"; ?> value="text">Text</option>
					<option <?php if($field->Type === "int") echo "selected"; ?> value="int" >Integer</option>
					<option <?php if($field->Type === "longtext") echo "selected"; ?> value="longtext">Textarea</option>
					<option <?php if($field->Type === "enum") echo "selected"; ?> value="enum">Selection</option>
					<option <?php if($field->Type === "tinyint") echo "selected"; ?> value="tinyint">Checkbox</option>
					<!--<option>File</option>-->
				</select><br>
				<div class="input_maxlength" <?php if(!in_array($field->Type, array("int"))) echo "style='display: none;'"; ?>><span>Max Length</span> <input type="text" name="maxlength[]" value="<?php if(isset($field->maxlength) && $field->maxlength > 0) echo $field->maxlength; ?>" placeholder="Max Length" /></div>
				<div class="input_selection" <?php if($field->Type != "enum") echo "style='display: none;'"; ?>><span>Selection</span> <input type="text" name="selection[]" value="<?php if(isset($field->selection)) echo $field->selection; ?>" placeholder="Selection, eg: a|b" /></div>
				<div class="input_default" <?php if($field->Type != "enum") echo "style='display: none;'"; ?>><span>Default Value</span> <input type="text" name="default[]" value="<?=$field->Default; ?>" placeholder="Default Value" /></div>
				<label class="checkbox">
					<input type="checkbox" name="notnull[<?=$field->Field; ?>]" value="true" <?php if($field->Null == "NO") echo "checked"; ?> /> Must be Filled
				</label>
			</div>
		</li>
		<?php 
			}
		?>
	</ul>
	<div class="form-actions span10">
		<button type="submit" class="btn btn-primary">Save Changes</button>
		<button id="addField" class="btn"><i class="icon-plus"></i> Add Field</button>
	</div>
	</form>
	<li id="clonefield" class="field" style="display: none;">
		<b><span>Give me field name!</span> <i class="icon-plus pull-right"></i></b>
		<div class="fielddata">
			<input type="hidden" name="oldslug[]" value="" />
			<span>Field Name</span> <input type="text" name="fieldname[]" placeholder="Field Name" /><br>
			<span>Field Slug</span> <input type="text" name="fieldslug[]" value="" placeholder="Slug Name" /><br>
			<span>Field Type</span>
			<select name="fieldtype[]">
					<option value="text">Text</option>
					<option value="int" >Integer</option>
					<option value="longtext">Textarea</option>
					<option value="enum">Selection</option>
					<option value="tinyint">Checkbox</option>
					<!--<option>File</option>-->
				</select><br>
				<div class="input_maxlength" style='display:none'><span>Max Length</span> <input type="text" name="maxlength[]" value="" placeholder="Max Length" /></div>
				<div class="input_selection" style='display: none;'><span>Selection</span> <input type="text" name="selection[]" value="" placeholder="Selection, eg: a|b" /></div>
				<div class="input_default" style='display: none;'><span>Default Value</span> <input type="text" name="default[]" value="" placeholder="Default Value" /></div>
				<label class="checkbox">
					<input type="checkbox" name="notnull[]" value="true" /> Must be Filled
				</label>
		</div>
	</li>
	<div id="modal" class="modal hide fade">
	  	<div class="modal-header">
	    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	    	<h3>Alert</h3>
	  	</div>
	  	<div class="modal-body">
	    	<p>All Field Slug Must Be Filled.</p>
	  	</div>
	  	<div class="modal-footer">
	    	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	  	</div>
	</div>
<script type="text/javascript">
	$().ready(function(){
		$("#fieldsort").sortable();
		$(".field").prepend("<i class='icon-remove'></i> ");
		
		$(document)
		.on("keyup", ".fielddata > input[name='fieldname[]']", function(){
			e = $(this);
			val = e.val();
			e
			.parent()
			.siblings("b")
			.children("span")
			.html((val.length > 0) ? val : "Give me field name!");
		})
		.on("change", ".fielddata > select[name='fieldtype[]']", function(){
			e = $(this);
			val = e.val();
			if(jQuery.inArray(val, ['int']) > -1){
				e.siblings(".input_maxlength").show().siblings(".input_selection").hide();
			}else if(val == "enum"){
				e.siblings(".input_maxlength").hide().siblings(".input_selection").show();
			}else{
				e.siblings(".input_maxlength").hide().siblings(".input_selection").hide();
			}
			if(jQuery.inArray(val, ['enum']) > -1){
				e.siblings(".input_default").show();
			}else{
				e.siblings(".input_default").hide();
			}
		})
		.on("click", "b > .icon-minus, b > .icon-plus", function(){
			i = $(this);
			data = i.parent().siblings("div");
			if(i.hasClass("icon-minus")){
				i.removeClass("icon-minus").addClass("icon-plus");
				data.hide();
			}else{
				i.removeClass("icon-plus").addClass("icon-minus");
				data.show();
			}
		})
		.on("click", ".icon-remove", function(){
			$(this).parent().effect("blind").remove();
		})
		.on("keyup", ".fielddata > input[name='fieldslug[]']", function(){
			val = $(this).val();
			$(this).siblings(".checkbox").children("input[type='checkbox']").prop("name", "notnull["+val+"]");
		});

		$("#clientsdata").submit(function(e){
			empty = false;
			$("#clientsdata .fielddata > input[name='fieldslug[]']").each(function(){
				current = $(this);
				if($.trim(current.val()) == '') { // check empty value
					current.parent(".fielddata").prev().children("span").css("color", "red");
					e.preventDefault();
					empty = true;
				}
			});	
			if(empty === true) $("#modal").modal("show");
		});
		
		$("#addField").click(function(e){
			e.preventDefault();
			$("#clonefield")
			.clone()
			.prop("id", null)
			.css("display", "list-item")
			.appendTo("#fieldsort");
		});
	});
</script>