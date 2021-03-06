{form:profile}
	<p> 
        <label for="file">档案 File</label>
        {$txtFile} {$txtFileError}
    </p> 
    <p> 
        <label for="case">案情 Case</label>
        {$txtCase} {$txtCaseError}
    </p> 
    {option:!isSearch}
    <p> 
        <label for="photo">照片 Photo</label>
        {$filePhoto} {option:filePhotoError}<span class='error'>{$filePhotoError}</span>{/option:filePhotoError} 
    </p> 
    <p> 
        <label for="attachment">附件 Attachment</label>
        {$fileAttachment} {option:fileAttachmentError}<span class='error'>{$fileAttachmentError}</span>{/option:fileAttachmentError} 
    </p> 
    {/option:!isSearch}
    <p> 
        <label for="name">姓名 Name</label>
        {$txtName} {option:txtNameError}<span class='error'>{$txtNameError}</span> {/option:txtNameError}
    	<br /><p id="userexist" class="tooltip" style="display:none;"></span>
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
    	<label for='address'>居住地址 Residential Address</label>
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
    </p><br/>
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
    	<label for='casereport'>案情 Case Report</label>
    	{$txtCasereport} {$txtCasereportError}
    </p>
    <p>
    	<label for='family'>家人 Family</label>
    	{$txtFamily} {$txtFamilyError}
    </p>
    {option:isSearch}
   	<p>
    	<label for='company'>公司 Company</label>
    	{$txtCompany} {$txtCompanyError}<br />
    </p>
    {/option:isSearch}
    {option:!isSearch}
    <p>
    	<label for='company1'>公司 Company 1</label><br />
    	{$txtCompany1} {$txtCompany1Error}<br />
    	{$txtRegisterno1} {$txtRegisterno1Error}<br />
    	{$txtCompanyno1} {$txtCompanyno1Error}<br />
    	{$txtCompanyemail1} {option:txtCompanyemail1Error}<span class='error'>{$txtCompanyemail1Error}</span>{/option:txtCompanyemail1Error}<br/>
    	{$txtShareholder1}{$txtShareholder1Error}<br />
    	{$txtRegisteraddr1} {$txtRegisteraddr1Error}<br />
    	{$txtBusinessaddr1} {$txtBusinessaddr1Error}
    </p>
    <p>
    	<label for='company2'>公司 Company 2</label><br />
    	{$txtCompany2} {$txtCompany2Error}<br />
    	{$txtRegisterno2} {$txtRegisterno2Error}<br />
    	{$txtCompanyno2} {$txtCompanyno2Error}<br />
    	{$txtCompanyemail2} {option:txtCompanyemail2Error}<span class='error'>{$txtCompanyemail2Error}</span>{/option:txtCompanyemail2Error}<br/>
    	{$txtShareholder2}{$txtShareholder2Error}<br />
    	{$txtRegisteraddr2} {$txtRegisteraddr2Error}<br />
    	{$txtBusinessaddr2} {$txtBusinessaddr2Error}
    </p>
    <p>
    	<label for='company3'>公司 Company 3</label><br />
    	{$txtCompany3} {$txtCompany3Error}<br />
    	{$txtRegisterno3} {$txtRegisterno3Error}<br />
    	{$txtCompanyno3} {$txtCompanyno3Error}<br />
    	{$txtCompanyemail3} {option:txtCompanyemail3Error}<span class='error'>{$txtCompanyemail3Error}</span>{/option:txtCompanyemail3Error}<br/>
    	{$txtShareholder3}{$txtShareholder3Error}<br />
    	{$txtRegisteraddr3} {$txtRegisteraddr3Error}<br />
    	{$txtBusinessaddr3} {$txtBusinessaddr3Error}
    </p>
    <p>
    	<label for='company4'>公司 Company 4</label><br />
    	{$txtCompany4} {$txtCompany4Error}<br />
    	{$txtRegisterno4} {$txtRegisterno4Error}<br />
    	{$txtCompanyno4} {$txtCompanyno4Error}<br />
    	{$txtCompanyemail4} {option:txtCompanyemail4Error}<span class='error'>{$txtCompanyemail4Error}</span>{/option:txtCompanyemail4Error}<br/>
    	{$txtShareholder4}{$txtShareholder4Error}<br />
    	{$txtRegisteraddr4} {$txtRegisteraddr4Error}<br />
    	{$txtBusinessaddr4} {$txtBusinessaddr4Error}
    </p>
    <p>
    	<label for='company5'>公司 Company 5</label><br />
    	{$txtCompany5} {$txtCompany5Error}<br />
    	{$txtRegisterno5} {$txtRegisterno5Error}<br />
    	{$txtCompanyno5} {$txtCompanyno5Error}<br />
    	{$txtCompanyemail5} {option:txtCompanyemail5Error}<span class='error'>{$txtCompanyemail5Error}</span>{/option:txtCompanyemail5Error}<br/>
    	{$txtShareholder5}{$txtShareholder5Error}<br />
    	{$txtRegisteraddr5} {$txtRegisteraddr5Error}<br />
    	{$txtBusinessaddr5} {$txtBusinessaddr5Error}
    </p>
    {/option:!isSearch}
    <p>
    	<label for='remarks'>备注Remarks</label><br />
    	{$txtRemarks} {$txtRemarksError}
    </p>
    <p>{$btnSubmit}</p>
{/form:profile}
<script type='text/javascript'>
$().ready(function(){
	var runningRequest = false;
	$("input[id=name]").keyup(function(){
		var input = $(this);
		if(input.val() == ''){
			return false;
		}
		if(runningRequest){
			request.abort();
		}
		
		runningRequest = true;
		request = $.ajax({
			  url: "{$base_url}/cm_api/checkuser.php",
			  dataType: 'json',
			  type: "POST",
			  data: "name=" + input.val() + "&adminname={$adminname}&adminpw={$adminpw}",
			  success: function(json){
				if(json.count > 1){
					$("#userexist").html(json.count + " users in db have same name. Search Them <a href='{$base_url}/cm_admin/search.php?form=profile&submit=Submit&name=" + input.val() +"' target='_blank'>Here</a>!");
					$("#userexist").fadeIn();
				}else if(json.count == 1){
					$("#userexist").html(json.count + " user in db have same name. Check it out <a href='{$base_url}/cm_admin/edit.php?id=" + json.profiles + "' target='_blank'>here</a>!");
					$("#userexist").fadeIn();
				}else{
					if($("#userexist").css("display") != "none"){
						$("#userexist").html();
						$("#userexist").fadeOut();
					}
				}
			}
		});
		runningRequest = false;
	});
});
</script>