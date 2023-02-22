<?php
/**
 * List all currently active announcements
 */

use ColdTrick\SiteAnnouncements\Gatekeeper;

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);

// add button
if (Gatekeeper::isEditor()) {
	elgg_register_title_button('add', 'object', \SiteAnnouncement::SUBTYPE);
}

// draw page
echo elgg_view_page(elgg_echo('site_announcements:all:title'), [
	'content' => elgg_view('site_announcements/listing/all'),
	'filter_id' => 'site_announcements',
	'filter_value' => 'all',
	'sidebar' => false,
]);
