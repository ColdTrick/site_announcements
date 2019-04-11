<?php

namespace ColdTrick\SiteAnnouncements;

class Access {
	
	/**
	 * Change the access options for site announcements
	 *
	 * @param string $hook        the name of the hook
	 * @param string $type        the type of the hook
	 * @param array  $returnvalue current returnvalue
	 * @param array  $params      supplied params
	 *
	 * @return array
	 */
	public static function userWriteCollections($hook, $type, $returnvalue, $params) {

		$input_params = elgg_extract('input_params', $params);
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
	 * @param string $hook        the name of the hook
	 * @param string $type        the type of the hook
	 * @param array  $returnvalue current returnvalue
	 * @param array  $params      supplied params
	 *
	 * @return bool
	 */
	public static function containerPermissionsCheck($hook, $type, $returnvalue, $params) {
		if ($returnvalue) {
			// already allowed
			return;
		}
		
		$user = elgg_extract('user', $params);
		if (!$user instanceof \ElggUser) {
			return;
		}
		
		$subtype = elgg_extract('subtype', $params);
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
	 * @param string $hook        the name of the hook
	 * @param string $type        the type of the hook
	 * @param array  $returnvalue current returnvalue
	 * @param array  $params      supplied params
	 *
	 * @return bool
	 */
	public static function permissionsCheck($hook, $type, $returnvalue, $params) {
		
		if ($returnvalue) {
			// already allowed
			return;
		}
		
		$user = elgg_extract('user', $params);
		if (!$user instanceof \ElggUser) {
			return;
		}
		
		$entity = elgg_extract('entity', $params);
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
	 * @param string $hook        the name of the hook
	 * @param string $type        the type of the hook
	 * @param array  $returnvalue current returnvalue
	 * @param array  $params      supplied params
	 *
	 * @return bool
	 */
	public static function commentPermissionsCheck($hook, $type, $returnvalue, $params) {
		$entity = elgg_extract('entity', $params);
		if (!$entity instanceof \SiteAnnouncement) {
			return;
		}
		
		return false;
	}
}
