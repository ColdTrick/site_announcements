<?php

namespace ColdTrick\SiteAnnouncements;

class UserHoverMenu {
	
	/**
	 * Add a menu item to the user hover menu
	 *
	 * @param \Elgg\Hook $hook 'register', 'menu:user_hover'
	 *
	 * @return void|\ElggMenuItem[]
	 */
	public static function register(\Elgg\Hook $hook) {
		
		if (!elgg_is_admin_logged_in()) {
			return;
		}
		
		$entity = $hook->getEntityParam();
		if (!$entity instanceof \ElggUser) {
			return ;
		}
		
		if ($entity->isAdmin()) {
			// user is already admin
			return;
		}
		
		$is_editor = Gatekeeper::isEditor($entity);
		
		$returnvalue = $hook->getValue();
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'announcement_make_editor',
			'text' => elgg_echo('site_announcements:user_hover:make_editor'),
			'icon' => 'bullhorn',
			'href' => elgg_generate_action_url('site_announcements/toggle_editor', ['user_guid' => $entity->guid]),
			'item_class' => $is_editor ? 'hidden' : '',
			'section' => 'admin',
			'priority' => 400,
			'data-toggle' => 'announcement-remove-editor',
		]);
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'announcement_remove_editor',
			'text' => elgg_echo('site_announcements:user_hover:remove_editor'),
			'icon' => 'bullhorn',
			'href' => elgg_generate_action_url('site_announcements/toggle_editor', ['user_guid' => $entity->guid]),
			'item_class' => $is_editor ? '' : 'hidden',
			'section' => 'admin',
			'priority' => 401,
			'data-toggle' => 'announcement-make-editor',
		]);
		
		return $returnvalue;
	}
}