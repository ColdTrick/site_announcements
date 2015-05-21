<?php

namespace ColdTrick\SiteAnnouncements;

class PageMenu {
	
	/**
	 * add a page menu item for site announcements
	 *
	 * @param string          $hook        the name of the hook
	 * @param string          $type        the type of the hook
	 * @param \ElggMenuItem[] $returnvalue current returnvalue
	 * @param array           $params      supplied params
	 *
	 * @return \ElggMenuItem[]
	 */
	public static function register($hook, $type, $returnvalue, $params) {
		
		if (!elgg_in_context('admin')) {
			return $returnvalue;
		}
		
		$returnvalue[] = \ElggMenuItem::factory(array(
			'name' => 'site_announcements',
			'text' => elgg_echo('site_annoucements'),
			'href' => 'announcements/all',
			'is_trusted' => true,
			'section' => 'administer',
			'parent_name' => 'administer_utilities'
		));
		
		return $returnvalue;
	}
}