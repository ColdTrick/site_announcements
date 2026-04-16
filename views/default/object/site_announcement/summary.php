<?php
/**
 * Summary (listing) view of a site announcement
 *
 * @uses $vars['entity'] the announcement to show
 */

$entity = elgg_extract('entity', $vars);
if (!$entity instanceof \SiteAnnouncement) {
	return;
}

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
