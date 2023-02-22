<?php

namespace ColdTrick\SiteAnnouncements\Menus;

use Elgg\Menu\MenuItems;

/**
 * Add menu items to the admin_header menu
 */
class AdminHeader {
	
	/**
	 * Add a page menu item for site announcements
	 *
	 * @param \Elgg\Event $event 'register', 'menu:admin_header'
	 *
	 * @return null|MenuItems
	 */
	public static function register(\Elgg\Event $event): ?MenuItems {
		if (!elgg_is_admin_logged_in() || !elgg_in_context('admin')) {
			return null;
		}
		
		/* @var $returnvalue MenuItems */
		$returnvalue = $event->getValue();
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'site_announcements',
			'text' => elgg_echo('site_announcements'),
			'href' => elgg_generate_url('collection:object:site_announcement:all'),
			'is_trusted' => true,
			'parent_name' => 'administer_utilities',
		]);
		
		return $returnvalue;
	}
}
