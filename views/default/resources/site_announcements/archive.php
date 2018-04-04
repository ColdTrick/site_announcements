<?php
use ColdTrick\SiteAnnouncements\Gatekeeper;

/**
 * List all past announcements
 */

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_announcements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('site_announcements:archive'));

// add button
if (Gatekeeper::isEditor()) {
	elgg_register_title_button();
}

// build page elements
$title = elgg_echo('site_announcements:archive:title');

$content = elgg_list_entities([
	'type' => 'object',
	'subtype' => \ColdTrick\SiteAnnouncements\SiteAnnouncement::SUBTYPE,
	'order_by_metadata' => [
		'name' => 'enddate',
		'as' => 'integer',
		'direction' => 'DESC',
	],
	'metadata_name_value_pairs' => [
		[
			'name' => 'enddate',
			'value' => time(),
			'operand' => '<',
		],
	],
	'no_results' => elgg_echo('site_announcements:archive:none'),
]);

// build page
$page_data = elgg_view_layout('default', [
	'title' => $title,
	'content' => $content,
	'sidebar' => false,
	'filter_id' => 'site_announcements',
]);

// draw page
echo elgg_view_page($title, $page_data);
