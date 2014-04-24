<?php
/**
 * Display a single site announcement
 *
 * @uses $vars['entity'] the entity to show
 */

$entity = elgg_extract("entity", $vars);
$full_view = elgg_extract("full_view", $vars, false);

if (empty($entity) || !elgg_instanceof($entity, "object", "site_announcement")) {
	return;
}

$entity_menu = "";
if (!elgg_in_context("widgets")) {
	$entity_menu = elgg_view_menu("entity", array(
		"entity" => $entity,
		"handler" => "site_announcements",
		"class" => "elgg-menu-hz",
		"sort_by" => "priority"
	));
}

$entity_icon = elgg_view_entity_icon($entity, "topbar");

if ($full_view) {
	// show full view (on the site)
	$content = elgg_view("output/longtext", array("value" => $entity->description, "class" => "mtn"));
	
	$params = array(
		"entity" => $entity,
		"metadata" => $entity_menu,
		"content" => $content,
	);
	$params = $params + $vars;
	$full_body = elgg_view("object/elements/summary", $params);
	
	echo elgg_view_image_block($entity_icon, $full_body, array("class" => "elgg-state-notice"));
} else {
	// listing (in the admin area)
	$subtitle = "<strong>" . elgg_echo("site_announcements:edit:startdate") . "</strong>: " . date(elgg_echo("friendlytime:date_format"), $entity->startdate);
	$subtitle .= " <strong>" . elgg_echo("site_announcements:edit:enddate") . "</strong>: " . date(elgg_echo("friendlytime:date_format"), $entity->enddate);
	
	$params = array(
		"entity" => $entity,
		"metadata" => $entity_menu,
		"subtitle" => $subtitle,
		"content" => elgg_get_excerpt($entity->description),
	);
	$params = $params + $vars;
	$list_body = elgg_view("object/elements/summary", $params);

	echo elgg_view_image_block($entity_icon, $list_body);
}