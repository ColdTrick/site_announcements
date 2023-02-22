<?php

namespace ColdTrick\SiteAnnouncements\Menus;

use ColdTrick\SiteAnnouncements\Gatekeeper;
use Elgg\Menu\MenuItems;

/**
 * Add menu items to the user_hover menu
 */
class UserHover {
	
	/**
	 * Add a menu item to the user hover menu
	 *
	 * @param \Elgg\Event $event 'register', 'menu:user_hover'
	 *
	 * @return null|MenuItems
	 */
	public static function register(\Elgg\Event $event): ?MenuItems {
		
		if (!elgg_is_admin_logged_in()) {
			return null;
		}
		
		$entity = $event->getEntityParam();
		if (!$entity instanceof \ElggUser) {
			return null;
		}
		
		if ($entity->isAdmin()) {
			// user is already admin
			return null;
		}
		
		$is_editor = Gatekeeper::isEditor($entity);
		
		/* @var $returnvalue MenuItems */
		$returnvalue = $event->getValue();
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'announcement_make_editor',
			'icon' => 'bullhorn',
			'text' => elgg_echo('site_announcements:user_hover:make_editor'),
			'href' => elgg_generate_action_url('site_announcements/toggle_editor', ['user_guid' => $entity->guid]),
			'item_class' => $is_editor ? 'hidden' : '',
			'section' => 'admin',
			'priority' => 400,
			'data-toggle' => 'announcement-remove-editor',
		]);
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'announcement_remove_editor',
			'icon' => 'bullhorn',
			'text' => elgg_echo('site_announcements:user_hover:remove_editor'),
			'href' => elgg_generate_action_url('site_announcements/toggle_editor', ['user_guid' => $entity->guid]),
			'item_class' => $is_editor ? '' : 'hidden',
			'section' => 'admin',
			'priority' => 401,
			'data-toggle' => 'announcement-make-editor',
		]);
		
		return $returnvalue;
	}
}
