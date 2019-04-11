<?php
/**
 * Prepend of page/elements/body to show the current site announcements
 */

use Elgg\Database\QueryBuilder;
use Elgg\Database\Clauses\WhereClause;

$options = [
	'type' => 'object',
	'subtype' => \SiteAnnouncement::SUBTYPE,
	'limit' => false,
	'metadata_name_value_pairs' => [
		[
			'name' => 'startdate',
			'value' => time(),
			'operand' => '<=',
		],
		[
			'name' => 'enddate',
			'value' => time(),
			'operand' => '>',
		],
	],
	'order_by_metadata' => [
		'name' => 'startdate',
		'as' => 'integer',
		'direction' => 'ASC',
	],
	'full_view' => true,
	'pagination' => false,
];

// exclude read announcments
if (elgg_is_logged_in()) {
	$user_guid = elgg_get_logged_in_user_guid();
	
	$options['wheres'][] = function(QueryBuilder $qb, $main_alias) use ($user_guid) {
		$subquery = $qb->subquery('entity_relationships', 'rc');
		$subquery->select('guid_two')
			->where($qb->compare('rc.guid_one', '=', $user_guid, ELGG_VALUE_INTEGER))
			->andWhere($qb->compare('rc.relationship', '=', \SiteAnnouncement::READ_RELATIONSHIP, ELGG_VALUE_STRING));

		return $qb->compare("{$main_alias}.guid", "NOT IN", $subquery->getSQL());
	};
} else {
	if (isset($_COOKIE['site_announcements'])) {
		$guids = string_to_tag_array($_COOKIE['site_announcements']);
		foreach ($guids as $index => $guid) {
			if (!is_numeric($guid)) {
				unset($guids[$index]);
			} else {
				$guids[$index] = (int) $guid;
			}
		}
		
		if (!empty($guids)) {
			$options['wheres'] = [
				new WhereClause('e.guid NOT IN (' . implode(',', $guids) . ')'),
			];
		}
	}
}

$entities = elgg_get_entities($options);
if (empty($entities)) {
	return;
}

$content = '';
foreach ($entities as $entity) {
	$content .= elgg_view_entity($entity);
}

elgg_require_js('site_announcements/announcement');
echo elgg_format_element('div', ['id' => 'site-announcements-site'], $content);
