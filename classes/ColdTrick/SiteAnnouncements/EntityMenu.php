<?php

namespace ColdTrick\SiteAnnouncements;

class EntityMenu {
	
	/**
	 * Change the entity menu items for site announcements
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
		
		$entity = elgg_extract("entity", $params);
		if (empty($entity) || !elgg_instanceof($entity, "object", SITE_ANNOUNCEMENT_SUBTYPE)) {
			return $returnvalue;
		}
		
		if (elgg_in_context("site_announcements_header")) {
			// site menu
			$returnvalue = array();
			
			$returnvalue[] = \ElggMenuItem::factory(array(
				"name" => "mark",
				"text" => elgg_view_icon("delete"),
				"title" => elgg_echo("site_announcements:menu:entity:mark"),
				"href" => "action/site_announcements/mark?guid=" . $entity->getGUID(),
				"rel" => $entity->getGUID(),
				"is_action" => true
			));
		} else {
			// admin has different items than site
			$allowed_menu_items = array("access", "edit", "delete");
			
			foreach ($returnvalue as $index => $menu_item) {
				if (!in_array($menu_item->getName(), $allowed_menu_items)) {
					unset($returnvalue[$index]);
				}
			}
		}
		
		return $returnvalue;
	}
}