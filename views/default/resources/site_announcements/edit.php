<?php
/**
 * edit a new site announcement
 */

// get entity
$guid = (int) elgg_extract('guid', $vars);
elgg_entity_gatekeeper($guid, 'object', \SiteAnnouncement::SUBTYPE);

$entity = get_entity($guid);

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);

// draw page
echo elgg_view_page(elgg_echo('site_announcements:edit:title'), [
	'content' => elgg_view_form('site_announcements/edit', ['sticky_enabled' => true], [
		'entity' => $entity,
	]),
	'filter_id' => 'site_announcements/edit',
	'filter_value' => 'edit',
	'sidebar' => false,
]);
