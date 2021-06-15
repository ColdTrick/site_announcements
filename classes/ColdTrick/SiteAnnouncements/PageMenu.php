<?php

namespace ColdTrick\SiteAnnouncements;

class PageMenu {
	
	/**
	 * add a page menu item for site announcements
	 *
	 * @param \Elgg\Hook $hook 'register', 'menu:page'
	 *
	 * @return \ElggMenuItem[]
	 */
	public static function register(\Elgg\Hook $hook) {
		
		if (!elgg_in_context('admin')) {
			return;
		}
		
		$returnvalue = $hook->getValue();
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'site_announcements',
			'text' => elgg_echo('site_announcements'),
			'href' => elgg_generate_url('collection:object:site_announcement:all'),
			'is_trusted' => true,
			'section' => 'administer',
			'parent_name' => 'administer_utilities',
		]);
		
		return $returnvalue;
	}
}