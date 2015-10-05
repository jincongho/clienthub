<style>
	#total div{
		margin-left: 50px;
	}
	#total div:first-child{
		margin-left: 0px;	
	}
	
</style>
<h1>Search Profiles</h1>
<form class="form-search" action="" method="get">
  	<select name="field" class="span2">
			<option value="name">Name</option>
			<?php 
			foreach($field as $select){
				echo "<option value='".$select->Field."'>".$select->slug."</option>";
			}
			?>
	</select>
	<div class="input-append">
		<input type="text" name="q" id="search" class="input-large search-query span2" autofocus />
	  	<button type="submit" class="btn">Search</button>
	</div>
</form>
<hr>
<div class="row">
<div id="total" class="span8">
	<div class="span1">
		<h1><?=$total_clients; ?></h1>
		<h6>Clients</h6>
	</div>
	<div class="span1">
		<h1><?=$total_staff; ?></h1>
		<h6>Staffs</h6>
	</div>
	<div class="span1">
		<h1><?=$total_attach; ?></h1>
		<h6>Attachments</h6>
	</div>
</div>
</div>