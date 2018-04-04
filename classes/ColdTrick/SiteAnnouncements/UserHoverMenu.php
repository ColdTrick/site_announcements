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
	 * @return void|\ElggMenuItem[]
	 */
	public static function register($hook, $type, $returnvalue, $params) {
		
		if (!elgg_is_admin_logged_in()) {
			return;
		}
		
		$entity = elgg_extract('entity', $params);
		if (!$entity instanceof \ElggUser) {
			return ;
		}
		
		if ($entity->isAdmin()) {
			// user is already admin
			return;
		}
		
		$is_editor = Gatekeeper::isEditor($entity);
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'announcement_make_editor',
			'text' => elgg_echo('site_announcements:user_hover:make_editor'),
			'icon' => 'bullhorn',
			'href' => elgg_generate_action_url('site_announcements/toggle_editor', ['user_guid' => $entity->guid]),
			'item_class' => $is_editor ? 'hidden' : '',
			'section' => 'admin',
			'priority' => 400,
		]);
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'announcement_remove_editor',
			'text' => elgg_echo('site_announcements:user_hover:remove_editor'),
			'icon' => 'bullhorn',
			'href' => elgg_generate_action_url('site_announcements/toggle_editor', ['user_guid' => $entity->guid]),
			'item_class' => $is_editor ? '' : 'hidden',
			'section' => 'admin',
			'priority' => 401,
		]);
		
		return $returnvalue;
	}
}