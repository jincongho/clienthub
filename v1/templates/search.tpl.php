<div id='contents' class='wrap'>
<div id='left'>
{option:tooltip}<p class='tooltip'>{$tooltip}</p>{/option:tooltip}
<h2>Search Profiles</h2>
{option:!isResult}
{form:searchProfile}
	<p> 
        <label for="file">档案 File</label>
        {$txtFile} {$txtFileError}
    </p> 
    <p> 
        <label for="case">案情 Case</label>
        {$txtCase} {$txtCaseError}
    </p> 
    <p> 
        <label for="name">姓名 Name</label>
        {$txtName} {option:txtNameError}<span class='error'>{$txtNameError}</span> {/option:txtNameError}
    </p>
    <p> 
        <label for="ic">身份证 IC</label>
        {$txtIc} {$txtIcError} 
    </p>
    <p> 
        <label for="gender">性别 Gender</label>
        {$ddmGender} {option:ddmGenderError}<span class='error'>{$ddmGenderError}</span>{/option:ddmGenderError} 
    </p> 
    <p>
    	<label for='placeofbirth'>出生地点 Place of Birth</label>
    	{$txtPlaceofbirth} {$txtPlaceofbirthError}
    </p>
    <p>
    	<label for='education'>学历 Education</label>
    	{$txtEducation} {$txtEducationError}
    </p>
    <p>
    	<label for='language'>语言 Language</label>
    	{$txtLanguage} {$txtLanguageError}
    </p>
    <p>
    	<label for='race'>种族 Race</label>
    	{$txtRace} {$txtRaceError}
    </p>
    <p>
    	<label for='faith'>信仰 Faith</label>
    	{$txtFaith} {$txtFaithError}
    </p>
    <p>
    	<label for='maritalstatus'>婚姻状况 Marital status</label>
    	{$txtMaritalstatus} {$txtMaritalstatusError}
    </p>
    <p>
    	<label for='nationality'>国籍 Nationality</label>
    	{$txtNationality} {$txtNationalityError}
    </p>
    <p>
    	<label for='profession'>职业 Profession</label>
    	{$txtProfession} {$txtProfessionError}
    </p>
    <p>
    	<label for='epf'>公积金 EPF</label>
    	{$txtEpf} {$txtEpfError}
    </p>
    <p>
    	<label for='banker'>银行 Banker</label>
    	{$txtBanker} {$txtBankerError}
    </p>
    <p>
    	<label for='address'>居住地址 Residential Address</label><br />
    	{$txtAddress} {$txtAddressError}
    </p>
    
    <p>
    	<label for='contactno'>联络号码 Contact No.</label>
    	{$txtContactno} {$txtContactnoError}
    </p>
    <p>
    	<label for='email'>电邮 Email</label>
    	{$txtEmail} {option:txtEmailError}<span class='error'>{$txtEmailError}</span>{/option:txtEmailError}
    </p>
    <p>
    	<label for='platesno'>车牌号码 Number plates</label>
    	{$txtPlatesno} {$txtPlatesnoError}
    </p>
    <p>
    	<label for='assets'>资产 Assets</label>
    	{$txtAssets} {$txtAssetsError}
    </p>
    <p>
    	<label for='height'>身高 Height(cm)</label>
    	{$txtHeight} {option:txtHeightError}<span class='error'>{$txtHeightError}</span></span>{/option:txtHeightError}
    </p>
    <p>
    	<label for='weight'>体重 Body Weight(kg)</label>
    	{$txtWeight} {option:txtWeightError}<span class='error'>{$txtWeightError}</span>{/option:txtWeightError}
    </p>
    <p>
    	<label for='blood'>血型 Blood type</label>
    	{$ddmBlood} {option:ddmBloodError}<span class='error'>{$ddmBloodError}</span>{/option:ddmBloodError}
    </p>
    <p>
    	<label for='eye'>眼睛色 Eye color</label>
    	{$txtEye} {$txtEyeError}
    </p>
    <p>
    	<label for='hair'>头发色	Hair color</label>
    	{$txtHair} {$txtHairError}
    </p>
    <p>
    	<label for='skin'>皮肤颜色 Skin color</label>
    	{$txtSkin} {$txtSkinError}
    </p>
    <p>
    	<label for='dna'>脱氧核糖核酸 DNA</label>
    	{$txtDna} {$txtDnaError}
    </p>
    <p>
    	<label for='family'>家人 Family</label><br />
    	{$txtFamily} {$txtFamilyError}
    </p>
    <p>
    	<label for='company'>公司 Company</label>
    	{$txtCompany} {$txtCompanyError}
    </p>
    <p>
    	<label for='registerno'>注册号码 Registration No.</label>
    	{$txtRegisterno} {$txtRegisternoError}
    </p>
    <p>
    	<label for='registeraddr'>注册地址 Registered Address</label><br />
    	{$txtRegisteraddr} {$txtRegisteraddrError}
    </p>
    <p>
    	<label for='businessaddr'>营业地址 Business Address</label><br />
    	{$txtBusinessaddr} {$txtBusinessaddrError}
    </p>
    <p>
    	<label for='companyno'>公司号码 Company Phone</label>
    	{$txtCompanyno} {$txtCompanynoError}
    </p>
    <p>
    	<label for='companyemail'>公司电邮 Company Email</label>
    	{$txtCompanyemail} {option:txtCompanyemailError}<span class='error'>{$txtCompanyemailError}</span>{/option:txtCompanyemailError}
    </p>
    <p>
    	<label for='remarks'>备注Remarks</label><br />
    	{$txtRemarks} {$txtRemarksError}
    </p>
    <p>{$btnSubmit}</p>
{/form:searchProfile}
{/option:!isResult}
{option:isResult}
{$results}
{/option:isResult}
</div>
{option:!isResult}
<div id='right'>
<h2>Information</h2>
<div class='rightcontents'>
<span>Records:  {$profiles_total} profiles in db. </span>
<span>Session will expired in <b>{$expired}</b> minutes.</span>
</div>
<h2>Tips</h2>
<div class='rightcontents'>
<span>You can search profiles through the form leftside. System will find similar profiles with given info. eg: search for "male" in gender will return all profiles which has a gender of "male".</span>
</div>
</div>
{/option:!isResult}
</div>
<script type='text/javascript'>
$().ready(function(){
	$("#header ul li:contains('Search')").addClass('selected');
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