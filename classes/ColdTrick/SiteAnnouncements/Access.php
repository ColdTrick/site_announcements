<?php

namespace ColdTrick\SiteAnnouncements;

class Access {
	
	/**
	 * Change the access options for site announcements
	 *
	 * @param \Elgg\Hook $hook 'access:collections:write', 'user'
	 *
	 * @return array
	 */
	public static function userWriteCollections(\Elgg\Hook $hook) {

		$input_params = $hook->getParam('input_params');
		if (empty($input_params) || !is_array($input_params)) {
			return;
		}
		
		$type = elgg_extract('entity_type', $input_params);
		$subtype = elgg_extract('entity_subtype', $input_params);
		if (($type !== 'object') || ($subtype !== \SiteAnnouncement::SUBTYPE)) {
			return;
		}
		
		$allowed_values = [
			ACCESS_LOGGED_IN,
			ACCESS_PUBLIC,
		];
		
		$returnvalue = $hook->getValue();
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
	 * @param \Elgg\Hook $hook 'container_permissions_check', 'object'
	 *
	 * @return bool
	 */
	public static function containerPermissionsCheck(\Elgg\Hook $hook) {
		if ($hook->getValue()) {
			// already allowed
			return;
		}
		
		$user = $hook->getUserParam();
		if (!$user instanceof \ElggUser) {
			return;
		}
		
		$subtype = $hook->getParam('subtype');
		if ($subtype !== \SiteAnnouncement::SUBTYPE) {
			return;
		}
		
		if (!Gatekeeper::isEditor($user)) {
			return;
		}
		
		return true;
	}
	
	/**
	 * Check the write permissions
	 *
	 * @param \Elgg\Hook $hook 'permissions_check', 'object'
	 *
	 * @return bool
	 */
	public static function permissionsCheck(\Elgg\Hook $hook) {
		
		if ($hook->getValue()) {
			// already allowed
			return;
		}
		
		$user = $hook->getUserParam();
		if (!$user instanceof \ElggUser) {
			return;
		}
		
		$entity = $hook->getEntityParam();
		if (!$entity instanceof \SiteAnnouncement) {
			return;
		}
		
		if (!Gatekeeper::isEditor($user)) {
			return;
		}
		
		return true;
	}
	
	/**
	 * Check the can comment
	 *
	 * @param \Elgg\Hook $hook 'permissions_check:comment', 'object'
	 *
	 * @return bool
	 */
	public static function commentPermissionsCheck(\Elgg\Hook $hook) {
		$entity = $hook->getEntityParam();
		if (!$entity instanceof \SiteAnnouncement) {
			return;
		}
		
		return false;
	}
}
