<?php
/**
 * All plugin hook handlers are bundled here
 */

/**
 * Add menu items to the admin menu
 *
 * @param string         $hook        'register'
 * @param string         $type        'menu:page'
 * @param ElggMenuItem[] $returnvalue the current menu items
 * @param array          $params      supplied params
 *
 * @return ElggMenuItem[]
 */
function site_announcements_register_page_menu_hook($hook, $type, $returnvalue, $params) {
	
	if (elgg_in_context("admin") && elgg_is_admin_logged_in()) {
		$returnvalue[] = ElggMenuItem::factory(array(
			"name" => "site_announcements",
			"text" => elgg_echo("admin:administer_utilities:site_announcements"),
			"href" => "admin/administer_utilities/site_announcements",
			"section" => "administer",
			"parent_name" => "administer_utilities"
		));
	}
	
	return $returnvalue;
}

/**
 * remove menu items from the entity menu
 *
 * @param string         $hook        'register'
 * @param string         $type        'menu:entity'
 * @param ElggMenuItem[] $returnvalue the current menu items
 * @param array          $params      supplied params
 *
 * @return ElggMenuItem[]
 */
function site_announcements_register_entity_menu_hook($hook, $type, $returnvalue, $params) {
	
	if (!empty($params) && is_array($params)) {
		$entity = elgg_extract("entity", $params);
		
		if (!empty($entity) && elgg_instanceof($entity, "object", "site_announcement")) {
			
			// admin has different items than site
			if (elgg_in_context("admin")) {
				$allowed_menu_items = array("access", "edit", "delete");
				
				foreach ($returnvalue as $index => $menu_item) {
					if (!in_array($menu_item->getName(), $allowed_menu_items)) {
						unset($returnvalue[$index]);
					}
				}
			} else {
				// site menu
				$returnvalue = array();
			}
		}
		
	}
	
	return $returnvalue;
}
