<?php

$pagination = array(
			"num_tag_open" => "<li>",
			"num_tag_close" => "</li>",
			"cur_tag_open" => "<li class=\"active\"><a>",
			"cur_tag_close" => "</a></li>",
			"first_link" => "First",
			"first_tag_open" => "<li>",
			"first_tag_close" => "</li>",
			"last_link" => "Last",
			"last_tag_open" => "<li>",
			"last_tag_close" => "</li>",
			"prev_link" => "&laquo;",
			"prev_tag_open" => "<li>",
			"prev_tag_close" => "</li>",
			"next_link" => "&raquo;",
			"next_tag_open" => "<li>",
			"next_tag_close" => "</li>",
			"uri_segment" => 6
		);
		
foreach($pagination as $key=>$value){
	$config[$key] = $value;
}