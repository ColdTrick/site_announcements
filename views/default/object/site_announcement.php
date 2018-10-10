<?php
/**
 * Display a single site announcement
 *
 * @uses $vars['entity'] the entity to show
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \ColdTrick\SiteAnnouncements\SiteAnnouncement) {
	return;
}

if (elgg_extract('full_view', $vars, false)) {
	
	$content = elgg_view('output/longtext', ['value' => $entity->description]);
	
	$announcement_type = $entity->announcement_type ?: 'hand-point-right';
		
	$message_options = [
		'icon' => $entity->getMessageTypeIconName(),
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
	
	$imprint = [
		[
			'icon_name' => $entity->getMessageTypeIconName(),
			'content' => $entity->getMessageTypeLabel(),
		],
		[
			'icon_name' => 'calendar-alt-regular',
			'content' => '<strong>' . elgg_echo('site_announcements:edit:startdate') . '</strong>: ' . date(elgg_echo('friendlytime:date_format'), $entity->startdate),
		],
		[
			'icon_name' => 'calendar-times-regular',
			'content' => '<strong>' . elgg_echo('site_announcements:edit:enddate') . '</strong>: ' . date(elgg_echo('friendlytime:date_format'), $entity->enddate),
		],
	];
	
	$params = [
		'entity' => $entity,
		'icon' => false,
		'content' => $entity->description,
		'access' => false,
		'byline' => false,
		'time' => false,
		'imprint' => $imprint,
	];
	$params = $params + $vars;
	echo elgg_view('object/elements/summary', $params);
}