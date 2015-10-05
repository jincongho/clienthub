<div id='contents' class='wrap'>
<div id='left'>
{option:tooltip}<p class='tooltip'>{$tooltip}</p>{/option:tooltip}
</div>
<div id='right'>
<h2>Information</h2>
<div id='rightcontents'>
<span>Records:  {$profiles_total} profiles in db. </span>
<span>Session will expired in:  <b>{$expired}</b> minutes. </span>
</div>
<h2>Tips</h2>
<div class='rightcontents'>
<span>"Tidy Up" helps you to optimize your database and spaces. Sure to do it once a week:)</span>
</div>
</div>
</div>
<script type='text/javascript'>
$().ready(function(){
	$("#header ul li:contains('Tidy')").addClass('selected');
});
</script>
</body>
</html>