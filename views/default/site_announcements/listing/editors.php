<?php
/**
 * List all users who are allowed to manage Site Announcements
 *
 * @uses $vars['options'] additional options
 */

use Elgg\Database\MetadataTable;
use Elgg\Database\QueryBuilder;

$defaults = [
	'type' => 'user',
	'wheres' => [
		function (QueryBuilder $qb, $main_alias) {
			$wheres = [];
			
			// admins
			$admins = $qb->subquery(MetadataTable::TABLE_NAME, 'amd');
			$admins->select("{$admins->getTableAlias()}.entity_guid")
			   ->where($qb->compare("{$admins->getTableAlias()}.name", '=', 'admin', ELGG_VALUE_STRING))
			   ->andWhere($qb->compare("{$admins->getTableAlias()}.value", '=', 'yes', ELGG_VALUE_STRING));
			
			$wheres[] = $qb->compare("{$main_alias}.guid", 'in', $admins->getSQL());
			
			// editors
			$editors = $qb->subquery(MetadataTable::TABLE_NAME, 'eps');
			$editors->select("{$editors->getTableAlias()}.entity_guid")
				->where($qb->compare("{$editors->getTableAlias()}.name", '=', 'plugin:user_setting:site_announcements:editor', ELGG_VALUE_STRING));
			
			$wheres[] = $qb->compare("{$main_alias}.guid", 'in', $editors->getSQL());
			
			return $qb->merge($wheres, 'OR');
		},
	],
	'no_results' => elgg_echo('site_announcements:editors:none'),
];

$options = (array) elgg_extract('options', $vars, []);
$options = array_merge($defaults, $options);

echo elgg_list_entities($options);
