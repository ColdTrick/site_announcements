<?php

namespace ColdTrick\SiteAnnouncements;

use Elgg\GatekeeperException;
use Elgg\Request;

class Gatekeeper {
	
	/**
	 * Only site announcement editors can access this part
	 *
	 * @param Request $request Request
	 *
	 * @return void
	 * @throws GatekeeperException
	 */
	public function __invoke(Request $request) {
		$request->elgg()->gatekeeper->assertAuthenticatedUser();
		
		if (!self::isEditor()) {
			throw new GatekeeperException(elgg_echo('limited_access'));
		}
	}
	
	/**
	 * Check if a user is an editor
	 *
	 * @param \ElggUser $user (optional) the user to check, defaults to loggedin user
	 *
	 * @return bool
	 */
	public static function isEditor(\ElggUser $user = null) {
		
		if (!$user instanceof \ElggUser) {
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
		return !empty(elgg_get_plugin_user_setting('editor', $user->guid, 'site_announcements'));
	}
}
