<?php
/**
 * Display a single site announcement
 *
 * @uses $vars['entity'] the entity to show
 */

$entity = elgg_extract("entity", $vars);
$full_view = elgg_extract("full_view", $vars, false);

if (!$entity instanceof \ColdTrick\SiteAnnouncements\SiteAnnouncement) {
	return;
}

$entity_icon = elgg_view_entity_icon($entity, "topbar");

if ($full_view) {
	
	$content = elgg_view("output/longtext", ["value" => $entity->description]);
	
	$announcement_type = $entity->announcement_type;
	if (empty($announcement_type)) {
		$announcement_type = 'hand-point-right';
	}
	
	$message_options = [
		'icon' => $announcement_type,
		'class' => " site-announcement-" . $announcement_type
	];
	
	switch($announcement_type) {
		case 'attention':
			$message_type = 'warning';
			break;
		case 'info':
			$message_type = 'notice';
			break;
		default:
			$message_options['title'] = false;
			$message_type = 'success';
		
	}
	//error, success, warning, help, notice
	
	echo elgg_view_message($message_type, $content, $message_options);
} else {
	// listing
	$subtitle = "<strong>" . elgg_echo("site_announcements:edit:startdate") . "</strong>: " . date(elgg_echo("friendlytime:date_format"), $entity->startdate);
	$subtitle .= " <strong>" . elgg_echo("site_announcements:edit:enddate") . "</strong>: " . date(elgg_echo("friendlytime:date_format"), $entity->enddate);
	
	$params = array(
		"entity" => $entity,
		"subtitle" => $subtitle,
		"content" => $entity->description,
	);
	$params = $params + $vars;
	$list_body = elgg_view("object/elements/summary", $params);

	echo elgg_view_image_block($entity_icon, $list_body);
}