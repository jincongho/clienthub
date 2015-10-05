<?php
/**
 * Client Manager
 * 
 * View profile in a clean page.
 * @package Client Manager
 * @author Jin Cong<onionboy@live.com.my>
 */
define ( 'LOAD_TEMPLATE', true );
require 'loader.php';

if (! isset ( $_GET ['id'] )) {
	header ( "Location: " . BASE_URL );
}

$profile = $mysql->getRecord ( 'SELECT * FROM `profiles` WHERE `id` = \'' . ( int ) $_GET ['id'] . '\' AND `status` !=  \'trash\'' );
if (empty ( $profile )) { // if no relevant record
	$tpl->assign ( 'tooltip', 'Profile not available' );
} else {
	//generate img tag for photo
	if (isset ( $profile ['photo'] )) {
		$profile ['photo'] = '<img src="' . BASE_URL . '/images.php?id=' . $profile ['id'] . '" />';
	}
	
	//clear unused key
	unset ( $profile ['id'] );
	unset ( $profile ['photoext'] );
	
	$replaceLabel = array ('file' => '档案<br /> File', 'case' => '案情<br/> Case', 'photo' => '照片 <br />Photo', 'name' => '姓名<br /> Name', 'ic' => '身份证<br /> IC', 'gender' => '性别<br /> Gender', 'placeofbirth' => '出生地点<br/> Place of Birth', 'education' => '学历 <br />Education', 'language' => '语言<br /> Language', 'race' => '种族<br /> Race', 'faith' => '信仰<br /> Faith', 'maritalstatus' => '婚姻状态 <br />Marital Status', 'nationality' => '国籍 <br /> Nationality', 'profession' => '职业  <br />Profession', 'epf' => '公积金 EPF', 'banker' => '银行 Banker', 'address' => '地址 <br /> Address', 'contactno' => '联络号码 <br /> Contact No.', 'email' => '电邮 <br /> Email', 'platesno' => '车牌号码  <br />Plates No.', 'assets' => '资产 <br /> Assets', 'height' => '身高  <br />Height(cm)', 'weight' => '体重 <br /> Weight(kg)', 'blood' => '血型  <br />Blood Type', 'eye' => '眼睛色 <br /> Eye Color', 'hair' => '头发色 <br /> Hair Color', 'skin' => '肤色 <br /> Skin Color', 'dna' => '脱氧核糖核酸  <br />DNA', 'family' => '家人 <br /> Family', 'company' => '公司 <br /> Company', 'registerno' => '注册号码  <br />Registration No.', 'registeraddr' => '注册地址  <br />Registered Address', 'businessaddr' => '公司地址  <br />Company Address', 'companyno' => '公司号码  <br />Company Phone', 'companyemail' => '公司电邮 <br /> Company Email', 'remarks' => '备注 <br /> Remarks' );
	
	$profile_html = ''; //profile html
	foreach ( $profile as $key => $value ) {
		if ($key == 'company') {
			$value = explode ( ', ', $value );
			$count = - 1;
			for($i = 1; $i < 6; $i ++) {
				$profile_html .= genLab ( "公司名字$i company name ", $value [$count += 1] );
				$profile_html .= genLab ( "注册号码$i registration number ", $value [$count += 1] );
				$profile_html .= genLab ( "公司号码$i Company number ", $value [$count += 1] );
				$profile_html .= genLab ( "公司电邮$i Company email ", $value [$count += 1] );
				$profile_html .= genLab ( "公司股东$i Shareholder ", $value [$count += 1] );
				$profile_html .= genLab ( "注册地址$i Registered Address ", $value [$count += 1] );
				$profile_html .= genLab ( "营业地址$i Business Address ", $value [$count += 1] );
			}
		} elseif (isset ( $value )) {
			$profile_html .= '<p>';
			$profile_html .= '<label>' . $replaceLabel [$key] . '</label>';
			$profile_html .= '<span>' . $value . '</span>';
			$profile_html .= '</p>';
		}
	}
	
	$tpl->assign ( 'profile', $profile_html );
}

function genLab($label, $value) {
	if ($value) {
		$profile_html = '<p>';
		$profile_html .= '<label>' . $label . '</label>';
		$profile_html .= '<span>' . $value . '</span>';
		$profile_html .= '</p>';
		
		return $profile_html;
	} else {
		return NULL;
	}
}

$tpl->display ( ROOT_PATH . '/' . TEMPLATE_PATH . '/profile.tpl.php' );