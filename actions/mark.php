<?php
/**
 * mark an announcement as read
 */

$guid = (int) get_input("guid");

if (!empty($guid)) {
	$entity = get_entity($guid);
	if (!empty($entity)) {
		if (elgg_instanceof($entity, "object", SITE_ANNOUNCEMENT_SUBTYPE)) {
			if (elgg_is_logged_in()) {
				// logged in user are different from logged out users
				add_entity_relationship(elgg_get_logged_in_user_guid(), SITE_ANNOUNCEMENT_RELATIONSHIP, $entity->getGUID());
			} else {
				$guids = array();
				if (isset($_COOKIE["site_announcements"])) {
					$guids = string_to_tag_array($_COOKIE["site_announcements"]);
				}
				
				$guids[] = $entity->getGUID();
				$expire = time() + (30 * 24 * 60 * 60); // in 30 days
				setcookie(site_announcements, implode(",", $guids), $expire, "/");
			}
		} else {
			register_error(elgg_echo("ClassException:ClassnameNotClass", array($guid, elgg_echo("item:object:site_announcement"))));
		}
	} else {
		register_error(elgg_echo("InvalidParameterException:NoEntityFound"));
	}
} else {
	register_error(elgg_echo("InvalidParameterException:MissingParameter"));
}

forward(REFERER);