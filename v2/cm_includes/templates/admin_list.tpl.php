{include:{$tpl_path}/admin_header.tpl.php}
{option:!isResult}
<p class='tooltip'>{$tooltip}</p>
{/option:!isResult} 
{option:isResult}
<h2>List Profiles</h2>
{$results} 
{/option:isResult}
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
{include:{$tpl_path}/admin_footer.tpl.php}