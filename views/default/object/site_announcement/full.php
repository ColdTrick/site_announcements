<?php
/**
 * Full view of a site announcement
 *
 * @uses $vars['entity'] the announcement to show
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \SiteAnnouncement) {
	return;
}

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
