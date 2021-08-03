<?php
/**
 * List all announcement editors
 */

use Elgg\Database\QueryBuilder;

// breadcrumb
elgg_push_collection_breadcrumbs('object', SiteAnnouncement::SUBTYPE);

// add button
elgg_register_title_button('announcements', 'add', 'object', \SiteAnnouncement::SUBTYPE);

// build page elements
// get correct users
$content = elgg_list_entities([
	'type' => 'user',
	'wheres' => [
		function (QueryBuilder $qb, $main_alias) {
			$wheres = [];
			
			// admins
			$admins = $qb->subquery('metadata', 'amd');
			$admins->select('amd.entity_guid')
				->where($qb->compare('name', '=', 'admin', ELGG_VALUE_STRING))
				->andWhere($qb->compare('value', '=', 'yes', ELGG_VALUE_STRING));
			
			$wheres[] = $qb->compare("{$main_alias}.guid", 'in', $admins->getSQL());
			
			// editors
			$editors = $qb->subquery('private_settings', 'eps');
			$editors->select('eps.entity_guid')
				->where($qb->compare('name', '=', 'plugin:user_setting:site_announcements:editor', ELGG_VALUE_STRING));
			
			$wheres[] = $qb->compare("{$main_alias}.guid", 'in', $editors->getSQL());
			
			return $qb->merge($wheres, 'OR');
		},
	],
	'no_results' => elgg_echo('site_announcements:editors:none'),
]);

// draw page
echo elgg_view_page(elgg_echo('site_announcements:editors:title'), [
	'content' => $content,
	'filter_id' => 'site_announcements',
	'filter_value' => 'editors',
	'sidebar' => false,
]);
