<?php

use ColdTrick\SiteAnnouncements\Gatekeeper;

$user_guid = (int) get_input('user_guid');
$user = get_user($user_guid);

if (empty($user)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

if ($user->isAdmin()) {
	return elgg_error_response(elgg_echo('site_announcements:action:toggle_editor:error:is_admin', [$user->name]));
}

if (Gatekeeper::isEditor($user)) {
	elgg_unset_plugin_user_setting('editor', $user->guid, 'site_announcements');
	return elgg_ok_response('', elgg_echo('site_announcements:action:toggle_editor:unmake', [$user->name]));
}

elgg_set_plugin_user_setting('editor', time(), $user->guid, 'site_announcements');

return elgg_ok_response('', elgg_echo('site_announcements:action:toggle_editor:make', [$user->name]));
