{include:{$tpl_path}/admin_header.tpl.php}
{option:tooltip}<p class='tooltip'>{$tooltip}</p>{/option:tooltip}
{option:id}
<p class='tooltip'><a href="{$base_url}/cm_admin/profile.php?id={$id}">Print</a> | </a><a href="{$base_url}/cm_admin/edit.php?id={$id}&delete=1">Delete</a> this profile.</p>
<h2>Edit Profile</h2>
{/option:id}
{option:photo_path}<img src="{$photo_path}" /><br />{/option:photo_path}
{option:attach_path}<a href="{$attach_path}">Download Attachment</a><br />{/option:attach_path}
{option:lastupdate}<label>Last Update</label>{$lastupdate}{/option:lastupdate}
{include:{$tpl_path}/admin_form.tpl.php}
{include:{$tpl_path}/admin_footer.tpl.php}