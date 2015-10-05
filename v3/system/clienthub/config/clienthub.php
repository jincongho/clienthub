<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * SuperAdmin
 * 
 * Specify user id in array: array(1, 8, 5)
 * Superadmin will have full permissions
 */
$config['superadmin'] = array(1, 9);

/*
 * Attachments
 * 
 * Specify with extension seperated with pipelines
 * eg: mp3|mp4|pdf
 * Allowed filetypes for uploaded attachments
 */
$config['attachments'] = "mp3|mp4|wav|flv|pdf|txt|doc|zip|rar|jpg|png|jpeg|gif|docx|ppt|xlsx";

/*
 * Attachsize
 * 
 * Specify in kb, eg: 1024*30 is 30mb
 * Attachments maximum size
 */
$config['attachsize'] = 1024*35;

/**
 * Clienthub Version
 * 
 */

$config['version']	= "1.0.0";