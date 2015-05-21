<?php

namespace ColdTrick\SiteAnnouncements;

class FilterMenu {
	
	/**
	 * Change the filter menu items for site announcements
	 *
	 * @param string          $hook        the name of the hook
	 * @param string          $type        the type of the hook
	 * @param \ElggMenuItem[] $returnvalue current returnvalue
	 * @param array           $params      supplied params
	 *
	 * @return \ElggMenuItem[]
	 */
	public static function register($hook, $type, $returnvalue, $params) {
		
		if (empty($params) || !is_array($params)) {
			return $returnvalue;
		}
		
		if (!elgg_in_context('announcements')) {
			return $returnvalue;
		}
		
		// reset menu items
		$returnvalue = array();
		
		$returnvalue[] = \ElggMenuItem::factory(array(
			'name' => 'all',
			'text' => elgg_echo('site_annoucements:filter:active'),
			'href' => 'announcements/all',
			'priority' => 100,
			'is_trusted' => true
		));
		
		$returnvalue[] = \ElggMenuItem::factory(array(
			'name' => 'archive',
			'text' => elgg_echo('site_annoucements:filter:archive'),
			'href' => 'announcements/archive',
			'priority' => 200,
			'is_trusted' => true
		));
		
		if (site_announcements_is_editor()) {
			$returnvalue[] = \ElggMenuItem::factory(array(
				'name' => 'scheduled',
				'text' => elgg_echo('site_annoucements:filter:scheduled'),
				'href' => 'announcements/scheduled',
				'priority' => 300,
				'is_trusted' => true
			));
			
			$returnvalue[] = \ElggMenuItem::factory(array(
				'name' => 'editors',
				'text' => elgg_echo('site_annoucements:filter:editors'),
				'href' => 'announcements/editors',
				'priority' => 400,
				'is_trusted' => true
			));
		}
		
		return $returnvalue;
	}
}