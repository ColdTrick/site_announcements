<?php

namespace ColdTrick\SiteAnnouncements;

use Elgg\Exceptions\HttpException;
use Elgg\Exceptions\Http\GatekeeperException;
use Elgg\Request;
use Elgg\Router\Middleware\Gatekeeper as CoreGatekeeper;

/**
 * Site announcement editor gatekeeper
 */
class Gatekeeper extends CoreGatekeeper {
	
	/**
	 * Only site announcement editors can access this part
	 *
	 * @param Request $request Request
	 *
	 * @return void
	 * @throws GatekeeperException
	 * @throws HttpException
	 */
	public function __invoke(Request $request): void {
		parent::__invoke($request);
		
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
	public static function isEditor(\ElggUser $user = null): bool {
		if (!$user instanceof \ElggUser) {
			$user = elgg_get_logged_in_user_entity();
		}
		
		if (!$user instanceof \ElggUser) {
			return false;
		}
		
		// admins are always editors
		if ($user->isAdmin()) {
			return true;
		}
		
		// check normal users
		return !empty($user->getPluginSetting('site_announcements', 'editor'));
	}
}
