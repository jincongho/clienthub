<?php error_reporting(E_WARNING); ini_set('display_errors', 'Off'); ?>
<?php
					if(isset($this->forms['profile']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['profile']->getAction(); ?>" method="<?php echo $this->forms['profile']->getMethod(); ?>"<?php echo $this->forms['profile']->getParametersHTML(); ?>>
						<?php echo $this->forms['profile']->getField('form')->parse();
						if($this->forms['profile']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['profile']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo $this->forms['profile']->getField('form_token')->getValue(); ?>" />
						<?php } ?>
	<p> 
        <label for="file">档案 File</label>
        <?php echo $this->variables['txtFile']; ?> <?php echo $this->variables['txtFileError']; ?>
    </p> 
    <p> 
        <label for="case">案情 Case</label>
        <?php echo $this->variables['txtCase']; ?> <?php echo $this->variables['txtCaseError']; ?>
    </p> 
    <?php if(!isset($this->variables['isSearch']) || count($this->variables['isSearch']) == 0 || $this->variables['isSearch'] == '' || $this->variables['isSearch'] === false): ?>
    <p> 
        <label for="photo">照片 Photo</label>
        <?php echo $this->variables['filePhoto']; ?> <?php
					if(isset($this->variables['filePhotoError']) && count($this->variables['filePhotoError']) != 0 && $this->variables['filePhotoError'] != '' && $this->variables['filePhotoError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['filePhotoError']; ?></span><?php } ?> 
    </p> 
    <p> 
        <label for="attachment">附件 Attachment</label>
        <?php echo $this->variables['fileAttachment']; ?> <?php
					if(isset($this->variables['fileAttachmentError']) && count($this->variables['fileAttachmentError']) != 0 && $this->variables['fileAttachmentError'] != '' && $this->variables['fileAttachmentError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['fileAttachmentError']; ?></span><?php } ?> 
    </p> 
    <?php endif; ?>
    <p> 
        <label for="name">姓名 Name</label>
        <?php echo $this->variables['txtName']; ?> <?php
					if(isset($this->variables['txtNameError']) && count($this->variables['txtNameError']) != 0 && $this->variables['txtNameError'] != '' && $this->variables['txtNameError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtNameError']; ?></span> <?php } ?>
    	<br /><p id="userexist" class="tooltip" style="display:none;"></span>
    </p>
    <p> 
        <label for="ic">身份证 IC</label>
        <?php echo $this->variables['txtIc']; ?> <?php echo $this->variables['txtIcError']; ?> 
    </p>
    <p> 
        <label for="gender">性别 Gender</label>
        <?php echo $this->variables['ddmGender']; ?> <?php
					if(isset($this->variables['ddmGenderError']) && count($this->variables['ddmGenderError']) != 0 && $this->variables['ddmGenderError'] != '' && $this->variables['ddmGenderError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['ddmGenderError']; ?></span><?php } ?> 
    </p> 
    <p>
    	<label for='placeofbirth'>出生地点 Place of Birth</label>
    	<?php echo $this->variables['txtPlaceofbirth']; ?> <?php echo $this->variables['txtPlaceofbirthError']; ?>
    </p>
    <p>
    	<label for='education'>学历 Education</label>
    	<?php echo $this->variables['txtEducation']; ?> <?php echo $this->variables['txtEducationError']; ?>
    </p>
    <p>
    	<label for='language'>语言 Language</label>
    	<?php echo $this->variables['txtLanguage']; ?> <?php echo $this->variables['txtLanguageError']; ?>
    </p>
    <p>
    	<label for='race'>种族 Race</label>
    	<?php echo $this->variables['txtRace']; ?> <?php echo $this->variables['txtRaceError']; ?>
    </p>
    <p>
    	<label for='faith'>信仰 Faith</label>
    	<?php echo $this->variables['txtFaith']; ?> <?php echo $this->variables['txtFaithError']; ?>
    </p>
    <p>
    	<label for='maritalstatus'>婚姻状况 Marital status</label>
    	<?php echo $this->variables['txtMaritalstatus']; ?> <?php echo $this->variables['txtMaritalstatusError']; ?>
    </p>
    <p>
    	<label for='nationality'>国籍 Nationality</label>
    	<?php echo $this->variables['txtNationality']; ?> <?php echo $this->variables['txtNationalityError']; ?>
    </p>
    <p>
    	<label for='profession'>职业 Profession</label>
    	<?php echo $this->variables['txtProfession']; ?> <?php echo $this->variables['txtProfessionError']; ?>
    </p>
    <p>
    	<label for='epf'>公积金 EPF</label>
    	<?php echo $this->variables['txtEpf']; ?> <?php echo $this->variables['txtEpfError']; ?>
    </p>
    <p>
    	<label for='banker'>银行 Banker</label>
    	<?php echo $this->variables['txtBanker']; ?> <?php echo $this->variables['txtBankerError']; ?>
    </p>
    <p>
    	<label for='address'>居住地址 Residential Address</label>
    	<?php echo $this->variables['txtAddress']; ?> <?php echo $this->variables['txtAddressError']; ?>
    </p>
    <p>
    	<label for='contactno'>联络号码 Contact No.</label>
    	<?php echo $this->variables['txtContactno']; ?> <?php echo $this->variables['txtContactnoError']; ?>
    </p>
    <p>
    	<label for='email'>电邮 Email</label>
    	<?php echo $this->variables['txtEmail']; ?> <?php
					if(isset($this->variables['txtEmailError']) && count($this->variables['txtEmailError']) != 0 && $this->variables['txtEmailError'] != '' && $this->variables['txtEmailError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtEmailError']; ?></span><?php } ?>
    </p>
    <p>
    	<label for='platesno'>车牌号码 Number plates</label>
    	<?php echo $this->variables['txtPlatesno']; ?> <?php echo $this->variables['txtPlatesnoError']; ?>
    </p><br/>
    <p>
    	<label for='assets'>资产 Assets</label>
    	<?php echo $this->variables['txtAssets']; ?> <?php echo $this->variables['txtAssetsError']; ?>
    </p>
    <p>
    	<label for='height'>身高 Height(cm)</label>
    	<?php echo $this->variables['txtHeight']; ?> <?php
					if(isset($this->variables['txtHeightError']) && count($this->variables['txtHeightError']) != 0 && $this->variables['txtHeightError'] != '' && $this->variables['txtHeightError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtHeightError']; ?></span></span><?php } ?>
    </p>
    <p>
    	<label for='weight'>体重 Body Weight(kg)</label>
    	<?php echo $this->variables['txtWeight']; ?> <?php
					if(isset($this->variables['txtWeightError']) && count($this->variables['txtWeightError']) != 0 && $this->variables['txtWeightError'] != '' && $this->variables['txtWeightError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtWeightError']; ?></span><?php } ?>
    </p>
    <p>
    	<label for='blood'>血型 Blood type</label>
    	<?php echo $this->variables['ddmBlood']; ?> <?php
					if(isset($this->variables['ddmBloodError']) && count($this->variables['ddmBloodError']) != 0 && $this->variables['ddmBloodError'] != '' && $this->variables['ddmBloodError'] !== false)
					{
						?><span class='error'><?php echo $this->variables['ddmBloodError']; ?></span><?php } ?>
    </p>
    <p>
    	<label for='eye'>眼睛色 Eye color</label>
    	<?php echo $this->variables['txtEye']; ?> <?php echo $this->variables['txtEyeError']; ?>
    </p>
    <p>
    	<label for='hair'>头发色	Hair color</label>
    	<?php echo $this->variables['txtHair']; ?> <?php echo $this->variables['txtHairError']; ?>
    </p>
    <p>
    	<label for='skin'>皮肤颜色 Skin color</label>
    	<?php echo $this->variables['txtSkin']; ?> <?php echo $this->variables['txtSkinError']; ?>
    </p>
    <p>
    	<label for='dna'>脱氧核糖核酸 DNA</label>
    	<?php echo $this->variables['txtDna']; ?> <?php echo $this->variables['txtDnaError']; ?>
    </p>
    <p>
    	<label for='casereport'>案情 Case Report</label>
    	<?php echo $this->variables['txtCasereport']; ?> <?php echo $this->variables['txtCasereportError']; ?>
    </p>
    <p>
    	<label for='family'>家人 Family</label>
    	<?php echo $this->variables['txtFamily']; ?> <?php echo $this->variables['txtFamilyError']; ?>
    </p>
    <?php
					if(isset($this->variables['isSearch']) && count($this->variables['isSearch']) != 0 && $this->variables['isSearch'] != '' && $this->variables['isSearch'] !== false)
					{
						?>
   	<p>
    	<label for='company'>公司 Company</label>
    	<?php echo $this->variables['txtCompany']; ?> <?php echo $this->variables['txtCompanyError']; ?><br />
    </p>
    <?php } ?>
    <?php if(!isset($this->variables['isSearch']) || count($this->variables['isSearch']) == 0 || $this->variables['isSearch'] == '' || $this->variables['isSearch'] === false): ?>
    <p>
    	<label for='company1'>公司 Company 1</label><br />
    	<?php echo $this->variables['txtCompany1']; ?> <?php echo $this->variables['txtCompany1Error']; ?><br />
    	<?php echo $this->variables['txtRegisterno1']; ?> <?php echo $this->variables['txtRegisterno1Error']; ?><br />
    	<?php echo $this->variables['txtCompanyno1']; ?> <?php echo $this->variables['txtCompanyno1Error']; ?><br />
    	<?php echo $this->variables['txtCompanyemail1']; ?> <?php
					if(isset($this->variables['txtCompanyemail1Error']) && count($this->variables['txtCompanyemail1Error']) != 0 && $this->variables['txtCompanyemail1Error'] != '' && $this->variables['txtCompanyemail1Error'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtCompanyemail1Error']; ?></span><?php } ?><br/>
    	<?php echo $this->variables['txtShareholder1']; ?><?php echo $this->variables['txtShareholder1Error']; ?><br />
    	<?php echo $this->variables['txtRegisteraddr1']; ?> <?php echo $this->variables['txtRegisteraddr1Error']; ?><br />
    	<?php echo $this->variables['txtBusinessaddr1']; ?> <?php echo $this->variables['txtBusinessaddr1Error']; ?>
    </p>
    <p>
    	<label for='company2'>公司 Company 2</label><br />
    	<?php echo $this->variables['txtCompany2']; ?> <?php echo $this->variables['txtCompany2Error']; ?><br />
    	<?php echo $this->variables['txtRegisterno2']; ?> <?php echo $this->variables['txtRegisterno2Error']; ?><br />
    	<?php echo $this->variables['txtCompanyno2']; ?> <?php echo $this->variables['txtCompanyno2Error']; ?><br />
    	<?php echo $this->variables['txtCompanyemail2']; ?> <?php
					if(isset($this->variables['txtCompanyemail2Error']) && count($this->variables['txtCompanyemail2Error']) != 0 && $this->variables['txtCompanyemail2Error'] != '' && $this->variables['txtCompanyemail2Error'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtCompanyemail2Error']; ?></span><?php } ?><br/>
    	<?php echo $this->variables['txtShareholder2']; ?><?php echo $this->variables['txtShareholder2Error']; ?><br />
    	<?php echo $this->variables['txtRegisteraddr2']; ?> <?php echo $this->variables['txtRegisteraddr2Error']; ?><br />
    	<?php echo $this->variables['txtBusinessaddr2']; ?> <?php echo $this->variables['txtBusinessaddr2Error']; ?>
    </p>
    <p>
    	<label for='company3'>公司 Company 3</label><br />
    	<?php echo $this->variables['txtCompany3']; ?> <?php echo $this->variables['txtCompany3Error']; ?><br />
    	<?php echo $this->variables['txtRegisterno3']; ?> <?php echo $this->variables['txtRegisterno3Error']; ?><br />
    	<?php echo $this->variables['txtCompanyno3']; ?> <?php echo $this->variables['txtCompanyno3Error']; ?><br />
    	<?php echo $this->variables['txtCompanyemail3']; ?> <?php
					if(isset($this->variables['txtCompanyemail3Error']) && count($this->variables['txtCompanyemail3Error']) != 0 && $this->variables['txtCompanyemail3Error'] != '' && $this->variables['txtCompanyemail3Error'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtCompanyemail3Error']; ?></span><?php } ?><br/>
    	<?php echo $this->variables['txtShareholder3']; ?><?php echo $this->variables['txtShareholder3Error']; ?><br />
    	<?php echo $this->variables['txtRegisteraddr3']; ?> <?php echo $this->variables['txtRegisteraddr3Error']; ?><br />
    	<?php echo $this->variables['txtBusinessaddr3']; ?> <?php echo $this->variables['txtBusinessaddr3Error']; ?>
    </p>
    <p>
    	<label for='company4'>公司 Company 4</label><br />
    	<?php echo $this->variables['txtCompany4']; ?> <?php echo $this->variables['txtCompany4Error']; ?><br />
    	<?php echo $this->variables['txtRegisterno4']; ?> <?php echo $this->variables['txtRegisterno4Error']; ?><br />
    	<?php echo $this->variables['txtCompanyno4']; ?> <?php echo $this->variables['txtCompanyno4Error']; ?><br />
    	<?php echo $this->variables['txtCompanyemail4']; ?> <?php
					if(isset($this->variables['txtCompanyemail4Error']) && count($this->variables['txtCompanyemail4Error']) != 0 && $this->variables['txtCompanyemail4Error'] != '' && $this->variables['txtCompanyemail4Error'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtCompanyemail4Error']; ?></span><?php } ?><br/>
    	<?php echo $this->variables['txtShareholder4']; ?><?php echo $this->variables['txtShareholder4Error']; ?><br />
    	<?php echo $this->variables['txtRegisteraddr4']; ?> <?php echo $this->variables['txtRegisteraddr4Error']; ?><br />
    	<?php echo $this->variables['txtBusinessaddr4']; ?> <?php echo $this->variables['txtBusinessaddr4Error']; ?>
    </p>
    <p>
    	<label for='company5'>公司 Company 5</label><br />
    	<?php echo $this->variables['txtCompany5']; ?> <?php echo $this->variables['txtCompany5Error']; ?><br />
    	<?php echo $this->variables['txtRegisterno5']; ?> <?php echo $this->variables['txtRegisterno5Error']; ?><br />
    	<?php echo $this->variables['txtCompanyno5']; ?> <?php echo $this->variables['txtCompanyno5Error']; ?><br />
    	<?php echo $this->variables['txtCompanyemail5']; ?> <?php
					if(isset($this->variables['txtCompanyemail5Error']) && count($this->variables['txtCompanyemail5Error']) != 0 && $this->variables['txtCompanyemail5Error'] != '' && $this->variables['txtCompanyemail5Error'] !== false)
					{
						?><span class='error'><?php echo $this->variables['txtCompanyemail5Error']; ?></span><?php } ?><br/>
    	<?php echo $this->variables['txtShareholder5']; ?><?php echo $this->variables['txtShareholder5Error']; ?><br />
    	<?php echo $this->variables['txtRegisteraddr5']; ?> <?php echo $this->variables['txtRegisteraddr5Error']; ?><br />
    	<?php echo $this->variables['txtBusinessaddr5']; ?> <?php echo $this->variables['txtBusinessaddr5Error']; ?>
    </p>
    <?php endif; ?>
    <p>
    	<label for='remarks'>备注Remarks</label><br />
    	<?php echo $this->variables['txtRemarks']; ?> <?php echo $this->variables['txtRemarksError']; ?>
    </p>
    <p><?php echo $this->variables['btnSubmit']; ?></p>
</form>
				<?php } ?>
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
			  url: "<?php echo $this->variables['base_url']; ?>/cm_api/checkuser.php",
			  dataType: 'json',
			  type: "POST",
			  data: "name=" + input.val() + "&adminname=<?php echo $this->variables['adminname']; ?>&adminpw=<?php echo $this->variables['adminpw']; ?>",
			  success: function(json){
				if(json.count > 1){
					$("#userexist").html(json.count + " users in db have same name. Search Them <a href='<?php echo $this->variables['base_url']; ?>/cm_admin/search.php?form=profile&submit=Submit&name=" + input.val() +"' target='_blank'>Here</a>!");
					$("#userexist").fadeIn();
				}else if(json.count == 1){
					$("#userexist").html(json.count + " user in db have same name. Check it out <a href='<?php echo $this->variables['base_url']; ?>/cm_admin/edit.php?id=" + json.profiles + "' target='_blank'>here</a>!");
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