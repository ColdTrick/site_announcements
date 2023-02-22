<?php

namespace ColdTrick\SiteAnnouncements\Menus;

use ColdTrick\SiteAnnouncements\Gatekeeper;
use Elgg\Menu\MenuItems;

/**
 * Add menu items to the filter menu
 */
class Filter {
	
	/**
	 * Change the filter menu items for site announcements
	 *
	 * @param \Elgg\Event $event 'register', 'menu:filter:site_announcements'
	 *
	 * @return null|MenuItems
	 */
	public static function register(\Elgg\Event $event): ?MenuItems {
		
		/* @var $returnvalue MenuItems */
		$returnvalue = $event->getValue();
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'all',
			'text' => elgg_echo('site_announcements:filter:active'),
			'href' => elgg_generate_url('collection:object:site_announcement:all'),
			'priority' => 100,
			'is_trusted' => true,
			'selected' => $event->getParam('filter_value') === 'all',
		]);
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'archive',
			'text' => elgg_echo('site_announcements:filter:archive'),
			'href' => elgg_generate_url('collection:object:site_announcement:archive'),
			'priority' => 200,
			'is_trusted' => true,
		]);
		
		if (Gatekeeper::isEditor()) {
			$returnvalue[] = \ElggMenuItem::factory([
				'name' => 'scheduled',
				'text' => elgg_echo('site_announcements:filter:scheduled'),
				'href' => elgg_generate_url('collection:object:site_announcement:scheduled'),
				'priority' => 300,
				'is_trusted' => true,
			]);
			
			$returnvalue[] = \ElggMenuItem::factory([
				'name' => 'editors',
				'text' => elgg_echo('site_announcements:filter:editors'),
				'href' => elgg_generate_url('collection:object:site_announcement:editors'),
				'priority' => 400,
				'is_trusted' => true,
			]);
		}
		
		return $returnvalue;
	}
}
