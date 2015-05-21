<?php
/**
 * All helper functions are bundled here
 */

/**
 * Only site announcement editors can access this part
 *
 * @return void
 */
function site_announcements_editor_gatekeeper() {
	
	elgg_gatekeeper();
	
	if (!site_announcements_is_editor()) {
		register_error(elgg_echo('limited_access'));
		forward(REFERER);
	}
}

/**
 * Check if a user is an editor
 *
 * @param ElggUser $user (optional) the user to check, defaults to loggedin user
 *
 * @return bool
 */
function site_announcements_is_editor(ElggUser $user = null) {
	
	if (empty($user) || !($user instanceof ElggUser)) {
		$user = elgg_get_logged_in_user_entity();
	}
	
	if (empty($user)) {
		return false;
	}
	
	// admins are always editors
	if ($user->isAdmin()) {
		return true;
	}
	
	// check normal users
	$setting = elgg_get_plugin_user_setting('editor', $user->getGUID(), 'site_announcements');
	if (!empty($setting)) {
		return true;
	}
	
	return false;
}