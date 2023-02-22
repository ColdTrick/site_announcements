<?php
/**
 * List all users who are allowed to manage Site Announcements
 *
 * @uses $vars['options'] additional options
 */

use Elgg\Database\QueryBuilder;

$defaults = [
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
			$editors = $qb->subquery('metadata', 'eps');
			$editors->select('eps.entity_guid')
				->where($qb->compare('name', '=', 'plugin:user_setting:site_announcements:editor', ELGG_VALUE_STRING));
			
			$wheres[] = $qb->compare("{$main_alias}.guid", 'in', $editors->getSQL());
			
			return $qb->merge($wheres, 'OR');
		},
	],
	'no_results' => elgg_echo('site_announcements:editors:none'),
];

$options = (array) elgg_extract('options', $vars, []);
$options = array_merge($defaults, $options);

echo elgg_list_entities($options);
