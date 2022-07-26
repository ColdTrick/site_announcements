<?php
/**
 * List all past announcements
 */

use ColdTrick\SiteAnnouncements\Gatekeeper;

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);

// add button
if (Gatekeeper::isEditor()) {
	elgg_register_title_button('announcements', 'add', 'object', \SiteAnnouncement::SUBTYPE);
}

// build page elements
$content = elgg_list_entities([
	'type' => 'object',
	'subtype' => \SiteAnnouncement::SUBTYPE,
	'sort_by' => [
		'property' => 'enddate',
		'direction' => 'DESC',
		'signed' => true,
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

// draw page
echo elgg_view_page(elgg_echo('site_announcements:archive:title'), [
	'content' => $content,
	'sidebar' => false,
	'filter_id' => 'site_announcements',
	'filter_value' => 'archive',
]);
