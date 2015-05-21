<?php

$user_guid = (int) get_input('user_guid');
$user = get_user($user_guid);

if (empty($user)) {
	register_error(elgg_echo('error:missing_data'));
	forward(REFERER);
}

if ($user->isAdmin()) {
	register_error(elgg_echo('site_announcements:action:toggle_editor:error:is_admin', array($user->name)));
	forward(REFERER);
}

if (site_announcements_is_editor($user)) {
	elgg_unset_plugin_user_setting('editor', $user->getGUID(), 'site_announcements');
	system_message(elgg_echo('site_announcements:action:toggle_editor:unmake', array($user->name)));
} else {
	elgg_set_plugin_user_setting('editor', time(), $user->getGUID(), 'site_announcements');
	system_message(elgg_echo('site_announcements:action:toggle_editor:make', array($user->name)));
}

forward(REFERER);