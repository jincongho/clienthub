<?php
define ( 'LOAD_TEMPLATE', true );
define ( 'LOAD_MYSQL', true );
require 'cm_includes/entry.php';

$trimed = trim($_GET['q']);

if (isset ( $_GET ['q'] ) && !empty($trimed)) {
	$search = tableParser ( 'profiles', 'search', array ('q' => $_GET ['q'] ) );
	$tpl->assign ( 'query', $_GET ['q'] );
	if ($search) {
		$html = "<table class='table'>
	<thead>
		<tr class='row'>
		  <th class='span2'>Profile Pic</th>
		  <th class='span6'>Details</th>
		</tr>
	</thead>
	<tbody>";
		foreach ( $search as $count => $values ) {
			if ($count <= SEARCH_LIMIT) {
				$result = getResult ( $values, $_GET ['q'] );
				$html .= "<tr class='row'>
      <td class='span2'>".$result ['photo']."</td>
      <td class='span5'>".$result ['info']."<br />".$result ['data']."<br /><span style='color: #449944'>Last Update: ".$result ['lastupdate']."</span></td>
    </tr>";
			}
		}
		$html .= "</tbody></table>";
		$tpl->assign ( "count", count ( $search ) );
		$tpl->assign ( "helper", "About " . count( $search ) . " Results. " );
		$tpl->assign ( "result", $html );
	} else {
		$tpl->assign ( "helper", "No Relevant Results." );
	}
}

$tpl->assign ( 'session', round ( (SpoonSession::get ( 'expiredTime' ) - time ()) / 60, 1 ) );
$tpl->display ( CM_ROOT . '/cm_includes/templates/search.tpl.php' );

function getResult(array $values, $search) {
	$return ['photo'] = isset ( $values ['photo'] ) ? '<img src="' . CM_URL . '/cm_api/images.php?thumbnail=1&id=' . $values ['id'] . '" />' : '';	empty ( $values ['ic'] ) && $values ['ic'] = "-";
	$return ['info'] = '<b>' . $values ['name'] . '</b> [' . $values ['ic'] . '] - <a href="' . CM_URL . '/cm_admin/profile.php?id=' . $values ['id'] . '">Print</a>';
	$return ['info'] .= (isset ( $values ['attachment'] ) && strlen ( $values ['attachment'] ) > 0) ? ' | <a href="' . CM_URL . '/cm_api/attachments.php?id=' . $values ['id'] . '">Attachment</a>' : '';
	$return ['lastupdate'] = date ( DATE_RFC822, $values ['lastupdate'] );
	if ($values ['ic'] == "-") {
		unset ( $values ['ic'] );
	}
	unset ( $values ['id'], $values ['photo'], $values ['photoext'], $values ['status'], $values ['lastupdate'], $values ['attachment'], $values ['attachext'] );
	$return ['data'] = "";
	foreach ( $values as $key => $value ) {
		if ($key == "company") {
			$value = trim ( str_replace ( ", ", " ", $value ) );
		}
		if ($value != NULL) {
			$return ['data'] .= ucfirst ( $key ) . ": " . str_ireplace ( $search, "<b>" . $search . "</b>", $value ) . " ";
		}
	}
	return $return;
}