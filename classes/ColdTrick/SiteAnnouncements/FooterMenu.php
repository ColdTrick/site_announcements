<?php

namespace ColdTrick\SiteAnnouncements;

class FooterMenu {
	
	/**
	 * add a footer menu item for site announcements
	 *
	 * @param \Elgg\Hook $hook 'register', 'menu:footer'
	 *
	 * @return \ElggMenuItem[]
	 */
	public static function register(\Elgg\Hook $hook) {
		$returnvalue = $hook->getValue();
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'site_announcements',
			'text' => elgg_echo('site_announcements'),
			'href' => 'announcements/all',
			'is_trusted' => true,
		]);
		
		return $returnvalue;
	}
}
