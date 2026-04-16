<?php

namespace ColdTrick\SiteAnnouncements\Controllers;

use ColdTrick\SiteAnnouncements\Gatekeeper;
use Elgg\Controllers\GenericContentListing;
use Elgg\Database\MetadataTable;
use Elgg\Database\QueryBuilder;

/**
 * List site announcements
 */
class ContentListing extends GenericContentListing {
	
	/**
	 * {@inheritdoc}
	 */
	protected function getListingOptions(string $page, array $options): array {
		switch ($page) {
			case 'archive':
				$options['sort_by'] = [
					'property' => 'enddate',
					'direction' => 'DESC',
					'signed' => true,
				];
				
				$options['metadata_name_value_pairs'] = [
					[
						'name' => 'enddate',
						'value' => time(),
						'operand' => '<',
						'type' => ELGG_VALUE_INTEGER,
					],
				];
				
				$options['no_results'] = elgg_echo('site_announcements:archive:none');
				
				break;
			case 'editors':
				$options = [
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
				
				break;
			case 'scheduled':
				$options['sort_by'] = [
					'property' => 'startdate',
					'direction' => 'ASC',
					'signed' => true,
				];
				
				$options['metadata_name_value_pairs'] = [
					[
						'name' => 'startdate',
						'value' => time(),
						'operand' => '>',
						'type' => ELGG_VALUE_INTEGER,
					],
				];
				
				$options['no_results'] = elgg_echo('site_announcements:scheduled:none');
				
				break;
			case 'all':
			default:
				$options['sort_by'] = [
					'property' => 'startdate',
					'direction' => 'DESC',
					'signed' => true,
				];
				
				$options['metadata_name_value_pairs'] = [
					[
						'name' => 'startdate',
						'value' => time(),
						'operand' => '<=',
						'type' => ELGG_VALUE_INTEGER,
					],
					[
						'name' => 'enddate',
						'value' => time(),
						'operand' => '>',
						'type' => ELGG_VALUE_INTEGER,
					]
				];
				
				$options['no_results'] = elgg_echo('site_announcements:all:none');
				break;
		}
		
		return $options;
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function getPageOptions(string $page, array $options): array {
		if (!Gatekeeper::isEditor()) {
			elgg_unregister_menu_item('title', 'add');
		}
		
		$options = parent::getPageOptions($page, $options);
		
		$options['filter_id'] = 'site_announcements';
		
		return $options;
	}
	
	/**
	 * List archived site announcements
	 *
	 * @param array $options listing options
	 *
	 * @return string
	 */
	protected function listArchive(array $options): string {
		elgg_push_collection_breadcrumbs($options['type'], $options['subtype']);
		
		return elgg_view_page('', $this->getPageOptions('archive', [
			'title' => elgg_echo("collection:{$options['type']}:{$options['subtype']}:archive"),
			'content' => elgg_view('page/list/all', [
				'options' => $options,
				'page' => 'archive',
			]),
			'filter_value' => 'archive',
		]));
	}
	
	/**
	 * List scheduled site announcements
	 *
	 * @param array $options listing options
	 *
	 * @return string
	 */
	protected function listScheduled(array $options): string {
		elgg_push_collection_breadcrumbs($options['type'], $options['subtype']);
		
		return elgg_view_page('', $this->getPageOptions('scheduled', [
			'title' => elgg_echo("collection:{$options['type']}:{$options['subtype']}:scheduled"),
			'content' => elgg_view('page/list/all', [
				'options' => $options,
				'page' => 'scheduled',
			]),
			'filter_value' => 'scheduled',
		]));
	}
	
	/**
	 * List announcement editors
	 *
	 * @param array $options listing options
	 *
	 * @return string
	 */
	protected function listEditors(array $options): string {
		elgg_push_collection_breadcrumbs('object', \SiteAnnouncement::SUBTYPE);
		
		return elgg_view_page('', $this->getPageOptions('editors', [
			'title' => elgg_echo('collection:object:site_announcement:editors'),
			'content' => elgg_view('page/list/all', [
				'options' => $options,
				'page' => 'editors',
			]),
			'filter_value' => 'editors',
		]));
	}
}
