<?php

use ColdTrick\SiteAnnouncements\Gatekeeper;

$user_guid = (int) get_input('user_guid');
$user = get_user($user_guid);

if (empty($user)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

if ($user->isAdmin()) {
	return elgg_error_response(elgg_echo('site_announcements:action:toggle_editor:error:is_admin', [$user->getDisplayName()]));
}

if (Gatekeeper::isEditor($user)) {
	$user->removePluginSetting('site_announcements', 'editor');
	
	return elgg_ok_response('', elgg_echo('site_announcements:action:toggle_editor:unmake', [$user->getDisplayName()]));
}

$user->setPluginSetting('site_announcements', 'editor', time());

return elgg_ok_response('', elgg_echo('site_announcements:action:toggle_editor:make', [$user->getDisplayName()]));
