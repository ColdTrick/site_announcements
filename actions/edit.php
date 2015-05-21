<?php
/**
 * save a site announcement
 */

site_announcements_editor_gatekeeper();

elgg_make_sticky_form("site_announcement_edit");

$guid = (int) get_input("guid");
$description = get_input("description");
$access_id = (int) get_input("access_id");

$announcement_type = get_input("announcement_type");

$startdate = (int) get_input("startdate");
$starthour = (int) get_input("starthour");
$startmins = (int) get_input("startmins");

$enddate = (int) get_input("enddate");
$endhour = (int) get_input("endhour");
$endmins = (int) get_input("endmins");

$realstartdate = mktime($starthour, $startmins, 0, date("n", $startdate), date("j", $startdate), date("Y", $startdate));
$realenddate = mktime($endhour, $endmins, 0, date("n", $enddate), date("j", $enddate), date("Y", $enddate));

$forward_url = REFERER;

if (!empty($description) && !empty($realstartdate) && !empty($realenddate)) {
	if ($realenddate > $realstartdate) {
		if (!empty($guid)) {
			$entity = get_entity($guid);
			if (empty($entity) || !elgg_instanceof($entity, "object", SITE_ANNOUNCEMENT_SUBTYPE)) {
				unset($entity);
				
				register_error(elgg_echo("noaccess"));
			}
		} else {
			$entity = new ElggObject();
			$entity->subtype = SITE_ANNOUNCEMENT_SUBTYPE;
			$entity->access_id = $access_id;
			$entity->owner_guid = elgg_get_site_entity()->getGUID();
			$entity->container_guid = elgg_get_site_entity()->getGUID();
			
			if (!$entity->save()) {
				unset($entity);
				
				register_error(elgg_echo("save:fail"));
			}
		}
		
		if (!empty($entity)) {
			$entity->description = $description;
			$entity->access_id = $access_id;
			
			$entity->save();
			
			$entity->startdate = $realstartdate;
			$entity->enddate = $realenddate;
			$entity->announcement_type = $announcement_type;
			
			if ($entity->save()) {
				elgg_clear_sticky_form("site_announcement_edit");
				
				$forward_url = "announcements/all";
				
				system_message(elgg_echo("site_announcement:action:edit:success"));
				
			} else {
				register_error(elgg_echo("site_announcement:action:edit:error:save"));
			}
		}
	} else {
		register_error(elgg_echo("site_announcement:action:edit:error:time"));
	}
} else {
	register_error(elgg_echo("site_announcement:action:edit:error:input"));
}

forward($forward_url);