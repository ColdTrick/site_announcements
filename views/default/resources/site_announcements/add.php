<?php
/**
 * create a new site announcement
 */

// breadcrumb
elgg_push_collection_breadcrumbs('object', \SiteAnnouncement::SUBTYPE);

// draw page
echo elgg_view_page(elgg_echo('site_announcements:add:title'), [
	'content' => elgg_view_form('site_announcements/edit', ['sticky_enabled' => true]),
	'filter_id' => 'site_announcements/edit',
	'filter_value' => 'add',
	'sidebar' => false,
]);
