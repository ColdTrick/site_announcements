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
		
		if (empty($params) || !is_array($params)) {
			return $returnvalue;
		}
		
		$input_params = elgg_extract('input_params', $params);
		if (empty($input_params) || !is_array($input_params)) {
			return $returnvalue;
		}
		
		$type = elgg_extract('entity_type', $input_params);
		$subtype = elgg_extract('entity_subtype', $input_params);
		if (($type !== 'object') || ($subtype !== SITE_ANNOUNCEMENT_SUBTYPE)) {
			return $returnvalue;
		}
		
		$allowed_values = array(
			ACCESS_LOGGED_IN,
			ACCESS_PUBLIC
		);
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
			return $returnvalue;
		}
		
		if (empty($params) || !is_array($params)) {
			return $returnvalue;
		}
		
		$user = elgg_extract('user', $params);
		$subtype = elgg_extract('subtype', $params);
		
		if (empty($user) || !elgg_instanceof($user, 'user')) {
			return $returnvalue;
		}
		
		if (empty($subtype) || ($subtype !== SITE_ANNOUNCEMENT_SUBTYPE)) {
			return $returnvalue;
		}
		
		if (site_announcements_is_editor($user)) {
			return true;
		}
		
		return $returnvalue;
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
			return $returnvalue;
		}
		
		if (empty($params) || !is_array($params)) {
			return $returnvalue;
		}
		
		$user = elgg_extract('user', $params);
		$entity = elgg_extract('entity', $params);
		
		if (empty($user) || !elgg_instanceof($user, 'user')) {
			return $returnvalue;
		}
		
		if (empty($entity) || !elgg_instanceof($entity, 'object', SITE_ANNOUNCEMENT_SUBTYPE)) {
			return $returnvalue;
		}
		
		if (site_announcements_is_editor($user)) {
			return true;
		}
		
		return $returnvalue;
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
		
		if (empty($params) || !is_array($params)) {
			return $returnvalue;
		}
		
		$entity = elgg_extract('entity', $params);
		
		if (empty($entity) || !elgg_instanceof($entity, 'object', SITE_ANNOUNCEMENT_SUBTYPE)) {
			return $returnvalue;
		}
		
		return false;
	}
}