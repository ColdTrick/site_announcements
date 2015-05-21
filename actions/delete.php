<?php
/**
 * delete a site announcement
 */

site_announcements_editor_gatekeeper();

$guid = (int) get_input("guid");

if (!empty($guid)) {
	$entity = get_entity($guid);
	if (!empty($entity) && $entity->canEdit()) {
		if (elgg_instanceof($entity, "object", SITE_ANNOUNCEMENT_SUBTYPE)) {
			$title = elgg_get_excerpt($entity->description, 50);

			if ($entity->delete()) {
				system_message(elgg_echo("entity:delete:success", array($title)));
			} else {
				register_error(elgg_echo("entity:delete:fail", array($title)));
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