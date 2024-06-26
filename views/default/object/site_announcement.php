<?php
/**
 * Display a single site announcement
 *
 * @uses $vars['entity'] the entity to show
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \SiteAnnouncement) {
	return;
}

if (elgg_extract('full_view', $vars, false)) {
	$content = elgg_view('output/longtext', ['value' => $entity->description]);
	
	$announcement_type = $entity->announcement_type;
	
	$message_options = [
		'icon' => $entity->getMessageTypeIconName(),
		'class' => [
			"site-announcement-{$announcement_type}",
		],
		'link' => elgg_view('output/url', [
			'icon' => 'delete',
			'text' => false,
			'title' => elgg_echo('site_announcements:menu:entity:mark'),
			'href' => elgg_generate_action_url('site_announcements/mark', ['guid' => $entity->guid]),
			'class' => 'site-announcements-mark',
		]),
	];
	
	// error, success, warning, help, notice
	switch ($announcement_type) {
		case 'attention':
			$message_type = 'warning';
			break;
		case 'error':
			$message_type = 'error';
			break;
		case 'info':
			$message_type = 'notice';
			break;
		default:
			$message_options['title'] = false;
			$message_type = 'success';
			break;
	}
	
	echo elgg_view_message($message_type, $content, $message_options);
} else {
	$imprint = [
		'announcement_type' => [
			'icon_name' => $entity->getMessageTypeIconName(),
			'content' => $entity->getMessageTypeLabel(),
		],
		'startdate' => [
			'icon_name' => 'calendar-alt-regular',
			'content' => elgg_echo('site_announcements:edit:startdate') . ': ' . elgg_view('output/date', [
				'value' => $entity->startdate,
				'format' => elgg_echo('friendlytime:date_format'),
			]),
		],
		'enddate' => [
			'icon_name' => 'calendar-times-regular',
			'content' => elgg_echo('site_announcements:edit:enddate') . ': ' . elgg_view('output/date', [
				'value' => $entity->enddate,
				'format' => elgg_echo('friendlytime:date_format'),
			]),
		],
	];
	
	$params = [
		'entity' => $entity,
		'icon' => false,
		'content' => $entity->description,
		'access' => false,
		'byline' => false,
		'time' => false,
		'title' => false,
		'imprint' => $imprint,
	];
	$params = $params + $vars;
	echo elgg_view('object/elements/summary', $params);
}
