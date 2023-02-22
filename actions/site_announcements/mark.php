<?php
/**
 * mark an announcement as read
 */

$guid = (int) get_input('guid');

if (empty($guid)) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

$entity = get_entity($guid);
if (!$entity instanceof \SiteAnnouncement) {
	return elgg_error_response(elgg_echo('error:missing_data'));
}

if (elgg_is_logged_in()) {
	// logged in user are different from logged out users
	$entity->markAsRead();
	return elgg_ok_response();
}

$guids = [];
if (isset($_COOKIE['site_announcements'])) {
	$guids = elgg_string_to_array((string) $_COOKIE['site_announcements']);
}

$guids[] = $entity->guid;

$cookie = new \ElggCookie('site_announcements');
$cookie->value = implode(',', $guids);
$cookie->setExpiresTime('+30 days');
elgg_set_cookie($cookie);

return elgg_ok_response();
