<?php
/**
 * Prepend of page/elements/body to show the current site announcements
 */

use Elgg\Database\QueryBuilder;
use Elgg\Database\Clauses\WhereClause;
use Elgg\Database\RelationshipsTable;

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
	'sort_by' => [
		'property' => 'startdate',
		'direction' => 'ASC',
		'signed' => true,
	],
	'full_view' => true,
	'pagination' => false,
];

// exclude read announcements
if (elgg_is_logged_in()) {
	$user_guid = elgg_get_logged_in_user_guid();
	
	$options['wheres'][] = function(QueryBuilder $qb, $main_alias) use ($user_guid) {
		$subquery = $qb->subquery(RelationshipsTable::TABLE_NAME, 'rc');
		$subquery->select("{$subquery->getTableAlias()}.guid_two")
			->where($qb->compare("{$subquery->getTableAlias()}.guid_one", '=', $user_guid, ELGG_VALUE_INTEGER))
			->andWhere($qb->compare("{$subquery->getTableAlias()}.relationship", '=', \SiteAnnouncement::READ_RELATIONSHIP, ELGG_VALUE_STRING));

		return $qb->compare("{$main_alias}.guid", 'NOT IN', $subquery->getSQL());
	};
} else {
	if (isset($_COOKIE['site_announcements'])) {
		$guids = elgg_string_to_array((string) $_COOKIE['site_announcements']);
		foreach ($guids as $index => $guid) {
			if (!is_numeric($guid)) {
				unset($guids[$index]);
			} else {
				$guids[$index] = (int) $guid;
			}
		}
		
		if (!empty($guids)) {
			$options['wheres'] = [
				function (QueryBuilder $qb, $main_alias) use ($guids) {
					return $qb->compare("{$main_alias}.guid", 'not in', $guids, ELGG_VALUE_GUID);
				}
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

elgg_import_esm('site_announcements/announcement');
echo elgg_format_element('div', ['id' => 'site-announcements-site'], $content);
