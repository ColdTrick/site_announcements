<?php

namespace ColdTrick\SiteAnnouncements;

class UserHoverMenu {
	
	/**
	 * Add a menu item to the user hover menu
	 *
	 * @param string          $hook        the name of the hook
	 * @param string          $type        the type of the hook
	 * @param \ElggMenuItem[] $returnvalue current returnvalue
	 * @param array           $params      supplied params
	 *
	 * @return \ElggMenuItem[]
	 */
	public static function register($hook, $type, $returnvalue, $params) {
		
		if (!elgg_is_admin_logged_in()) {
			return $returnvalue;
		}
		
		if (empty($params) || !is_array($params)) {
			return $returnvalue;
		}
		
		$entity = elgg_extract("entity", $params);
		if (empty($entity) || !elgg_instanceof($entity, "user")) {
			return $returnvalue;
		}
		
		if ($entity->isAdmin()) {
			// user is already admin
			return $returnvalue;
		}
		
		$is_editor = site_announcements_is_editor($entity);
		
		$returnvalue[] = \ElggMenuItem::factory(array(
			'name' => 'announcement_make_editor',
			'text' => elgg_echo('site_announcements:user_hover:make_editor'),
			'href' => "action/site_announcements/toggle_editor?user_guid={$entity->getGUID()}",
			'item_class' => $is_editor ? 'hidden' : '',
			'section' => 'admin',
			'priority' => 400
		));
		
		$returnvalue[] = \ElggMenuItem::factory(array(
			'name' => 'announcement_remove_editor',
			'text' => elgg_echo('site_announcements:user_hover:remove_editor'),
			'href' => "action/site_announcements/toggle_editor?user_guid={$entity->getGUID()}",
			'item_class' => $is_editor ? '' : 'hidden',
			'section' => 'admin',
			'priority' => 401
		));
		
		return $returnvalue;
	}
}