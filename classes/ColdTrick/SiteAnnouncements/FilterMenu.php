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
		
		$returnvalue[] = \ElggMenuItem::factory([
			'name' => 'all',
			'text' => elgg_echo('site_announcements:filter:active'),
			'href' => elgg_generate_url('collection:object:site_announcement:all'),
			'priority' => 100,
			'is_trusted' => true,
			'selected' => elgg_extract('filter_value', $params) === 'all',
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