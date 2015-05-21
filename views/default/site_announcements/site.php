<?php
/**
 * Prepend of page/elements/body to show the current site announcements
 */

$options = array(
	'type' => 'object',
	'subtype' => SITE_ANNOUNCEMENT_SUBTYPE,
	'limit' => false,
	'metadata_name_value_pairs' => array(
		array(
			'name' => 'startdate',
			'value' => time(),
			'operand' => '<='
		),
		array(
			'name' => 'enddate',
			'value' => time(),
			'operand' => '>'
		)
	),
	'order_by_metadata' => array(
		'name' => 'startdate',
		'as' => 'integer',
		'direction' => 'ASC'
	),
	'full_view' => true,
	'pagination' => false
);

// exclude read announcments
if (elgg_is_logged_in()) {
	$user_guid = elgg_get_logged_in_user_guid();
	$dbprefix = elgg_get_config('dbprefix');
	
	$options["wheres"] = array(
		"e.guid NOT IN (SELECT guid_two
		FROM {$dbprefix}entity_relationships rc
		WHERE rc.guid_one = {$user_guid}
		AND rc.relationship = '" . SITE_ANNOUNCEMENT_RELATIONSHIP . "')"
	);
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
			$options['wheres'] = array('e.guid NOT IN (' . implode(',', $guids) . ')');
		}
	}
}

elgg_push_context('site_announcements_header');
$content = elgg_list_entities_from_metadata($options);
elgg_pop_context();

if (!empty($content)) {
	echo elgg_format_element('div', array('id' => 'site-announcements-site'), $content);
}
