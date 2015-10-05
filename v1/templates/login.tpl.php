<div id='contents' class='wrap'>
<div id='left'>
{option:tooltip}<p class='tooltip'>{$tooltip}</p>{/option:tooltip}
<h2>Admin Login</h2>
{form:login}
	<p> 
        <label for="adminname">Admin Name</label>
        {$txtAdminname} {$txtAdminnameError}
    </p> 
    <p> 
        <label for="adminpw">Admin Password</label>
        {$txtAdminpw} {$txtAdminpwError}
    </p> 	
    <p>{$btnSubmit}</p> 
{/form:login}
</div>
</div>
</body>
</html>