<div id='contents' class='wrap'>
<div id='left'>
{option:tooltip}<p class='tooltip'>{$tooltip}</p>{/option:tooltip}
<h2>List Profiles</h2>
{option:isResult}
{$results}
{/option:isResult}
</div>
</div>
<script type='text/javascript'>
$().ready(function(){
	$("#header ul li:contains('List')").addClass('selected');
	$(".delProfile").click(function(event){
		event.preventDefault();
		td = $(this).parent().parent();
		if (confirm("Confirm to delete?")){
			$.ajax({
				type: 'POST',
				url: '{$base_url}/delete.php' ,
				data: 'id=' + $(this).attr('id') + '&adminname={$adminname}&adminpw={$adminpw}',
				success: function(data){
					if(data == "1"){
						td.fadeOut();
					}else{
						alert('Deleting failed');
					}
				}
			});
		}
	});
});
</script>
</body>
</html>