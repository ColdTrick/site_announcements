<?php

namespace ColdTrick\SiteAnnouncements;

/**
 * Extend access options
 */
class Access {
	
	/**
	 * Change the access options for site announcements
	 *
	 * @param \Elgg\Event $event 'access:collections:write', 'user'
	 *
	 * @return null|array
	 */
	public static function userWriteCollections(\Elgg\Event $event): ?array {
		$input_params = $event->getParam('input_params');
		if (empty($input_params) || !is_array($input_params)) {
			return null;
		}
		
		$type = elgg_extract('entity_type', $input_params);
		$subtype = elgg_extract('entity_subtype', $input_params);
		if ($type !== 'object' || $subtype !== \SiteAnnouncement::SUBTYPE) {
			return null;
		}
		
		$allowed_values = [
			ACCESS_LOGGED_IN,
			ACCESS_PUBLIC,
		];
		
		$returnvalue = $event->getValue();
		foreach ($returnvalue as $index => $value) {
			if (!in_array($index, $allowed_values)) {
				unset($returnvalue[$index]);
			}
		}
		
		return $returnvalue;
	}
	
	/**
	 * Check the container write permissions
	 *
	 * @param \Elgg\Event $event 'container_permissions_check', 'object'
	 *
	 * @return null|bool
	 */
	public static function containerPermissionsCheck(\Elgg\Event $event): ?bool {
		if ($event->getValue()) {
			// already allowed
			return null;
		}
		
		$user = $event->getUserParam();
		if (!$user instanceof \ElggUser) {
			return null;
		}
		
		$subtype = $event->getParam('subtype');
		if ($subtype !== \SiteAnnouncement::SUBTYPE) {
			return null;
		}
		
		if (!Gatekeeper::isEditor($user)) {
			return null;
		}
		
		return true;
	}
	
	/**
	 * Check write permissions
	 *
	 * @param \Elgg\Event $event 'permissions_check', 'object'
	 *
	 * @return null|bool
	 */
	public static function permissionsCheck(\Elgg\Event $event): ?bool {
		if ($event->getValue()) {
			// already allowed
			return null;
		}
		
		$user = $event->getUserParam();
		if (!$user instanceof \ElggUser) {
			return null;
		}
		
		$entity = $event->getEntityParam();
		if (!$entity instanceof \SiteAnnouncement) {
			return null;
		}
		
		if (!Gatekeeper::isEditor($user)) {
			return null;
		}
		
		return true;
	}
}
