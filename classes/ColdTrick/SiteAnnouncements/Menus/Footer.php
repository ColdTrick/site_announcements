<?php

namespace ColdTrick\SiteAnnouncements\Menus;

use Elgg\Menu\MenuItems;

/**
 * Add menu items to the footer menu
 */
class Footer {
	
	/**
	 * Add a footer menu item for site announcements
	 *
	 * @param \Elgg\Event $event 'register', 'menu:footer'
	 *
	 * @return null|MenuItems
	 */
	public static function register(\Elgg\Event $event): ?MenuItems {
		/* @var $returnvalue MenuItems */
		$returnvalue = $event->getValue();
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'site_announcements',
			'icon' => 'bullhorn',
			'text' => elgg_echo('site_announcements'),
			'href' => elgg_generate_url('collection:object:site_announcement:all'),
			'is_trusted' => true,
		]);
		
		return $returnvalue;
	}
}
