{include:{$tpl_path}/admin_header.tpl.php}
{option:tooltip}<p class='tooltip'>{$tooltip}</p>{/option:tooltip}
<h2>Search Profiles</h2>
{option:!isResult}{include:{$tpl_path}/admin_form.tpl.php}{/option:!isResult}
{option:isResult}
{$results}
<script type='text/javascript'>
$().ready(function(){
	$(".delProfile").click(function(event){
		event.preventDefault();
		var td = $(this).parent().parent();
		if (confirm("Confirm to delete?")){
			$.ajax({
				type: 'POST',
				url: '{$base_url}/cm_api/delete.php' ,
				data: 'id=' + $(this).attr('id') + '&adminname={$adminname}&adminpw={$adminpw}',
				success: function(data){
					if(data == "1"){
						td.fadeOut();
					}else{
						alert('Deleting Failed!');
					}
				}
			});
		}
	});
});
</script>
{/option:isResult}
{include:{$tpl_path}/admin_footer.tpl.php}