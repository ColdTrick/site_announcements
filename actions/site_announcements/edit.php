<?php
/**
 * save a site announcement
 */

use Elgg\Values;

elgg_make_sticky_form('site_announcement_edit');

$guid = (int) get_input('guid');
$description = get_input('description');
$access_id = (int) get_input('access_id');

$announcement_type = get_input('announcement_type');

$startdate = (int) get_input('startdate');
$starthour = (int) get_input('starthour');
$startmins = (int) get_input('startmins');

$enddate = (int) get_input('enddate');
$endhour = (int) get_input('endhour');
$endmins = (int) get_input('endmins');

$realstartdate = Values::normalizeTime($startdate);
$realstartdate->setTime($starthour, $startmins, 0);

$realenddate = Values::normalizeTime($enddate);
$realenddate->setTime($endhour, $endmins, 0);

if (empty($description) || empty($realstartdate) || empty($realenddate)) {
	return elgg_error_response(elgg_echo('site_announcement:action:edit:error:input'));
}

if ($realenddate <= $realstartdate) {
	return elgg_error_response(elgg_echo('site_announcement:action:edit:error:time'));
}

if (!empty($guid)) {
	$entity = get_entity($guid);
	if (!$entity instanceof \SiteAnnouncement) {
		return elgg_error_response(elgg_echo('noaccess'));
	}
} else {
	$entity = new \SiteAnnouncement();
	$entity->access_id = $access_id;
				
	if (!$entity->save()) {
		return elgg_error_response(elgg_echo('save:fail'));
	}
}

$entity->description = $description;
$entity->access_id = $access_id;

$entity->save();

$entity->startdate = $realstartdate->getTimestamp();
$entity->enddate = $realenddate->getTimestamp();
$entity->announcement_type = $announcement_type;

if (!$entity->save()) {
	return elgg_error_response(elgg_echo('site_announcement:action:edit:error:save'));
}

elgg_clear_sticky_form("site_announcement_edit");

return elgg_ok_response('', elgg_echo('site_announcement:action:edit:success'), elgg_generate_url('collection:object:site_announcement:all'));
