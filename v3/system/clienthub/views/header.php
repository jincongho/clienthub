<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?=$title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jin Cong Ho <jincongho@gmail.com>">
    <style>
    @media (min-width: 981px) {
    	body {
      		padding-top: 60px;
    	}
  	}
    </style>
    <?=$css; ?>
    <?=$js; ?>
  </head>
  <body>
  <div class="navbar navbar-fixed-top">
  	<div class="navbar-inner">
  		<div class="container">
			<?=$brand; ?>
			<?=$topmenu; ?>
			<ul class="nav pull-right">
				<div class="btn-group pull-right">
					<a class="btn btn-info" href="<?=site_url("/user/profile"); ?>"><?=$username; ?></a>
					<a class="btn btn-info dropdown-toggle" href="#" data-toggle="dropdown"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?=site_url("/user/profile"); ?>"><i class="icon-user"></i> Profile</a></li>
						<li><a href="<?=site_url("/user/preference"); ?>"><i class="icon-wrench"></i> Preference</a></li>
						<li><a href="<?=site_url("/auth/change_password"); ?>"><i class="icon-lock"></i> Change Password</a></li>
						<li class="divider"></li>
						<li><a href="<?=site_url("logout"); ?>"><i class="icon-off"></i> Logout</a></li>
					</ul>
				</div>
				<form class="navbar-search pull-right" style="margin-right: 5px;">
					  <input class="search-query span2" id="quickaccess" type="text" placeholder="Profile Id" />
				</form>
			</ul>
    	</div>
  		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="span2 hidden-phone">
				<ul class="nav nav-list well">
					<li class="nav-header">Navigation</li>
					<li class="<?php if(substr(uri_string(), 0, 7) === "clients") echo "active"; ?>"><a href="<?=site_url("/clients"); ?>"><i class="icon-user"></i> Clients</a></li>
					<li class="<?php if(substr(uri_string(), 0, 4) === "auth") echo "active"; ?>"><a href="<?=site_url("/auth"); ?>"><i class="icon-user"></i> Staffs</a></li>
					<!--<li class="<?php if(substr(uri_string(), 0, 11) === "attachments") echo "active"; ?>" ><a href="<?=site_url("/attachments"); ?>"><i class="icon-file"></i> Attachments</a></li>-->
					<li class="divider"></li>
					<li class="nav-header">User</li>
					<li class="<?php if(substr(uri_string(), -7) === "profile") echo "active"; ?>"><a href="<?=site_url("/user/profile"); ?>"><i class="icon-user"></i> Profile</a></li>
					<li class="<?php if(substr(uri_string(), -10) === "preference") echo "active"; ?>"><a href="<?=site_url("/user/preference"); ?>"><i class="icon-wrench"></i> Preference</a></li>
				</ul>
			</div>
			<div class="span10">