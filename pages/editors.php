<?php
/**
 * List all announcement editors
 */

site_announcements_editor_gatekeeper();

// breadcrumb
elgg_push_breadcrumb(elgg_echo('site_annoucements'), 'announcements/all');
elgg_push_breadcrumb(elgg_echo('site_annoucements:editors'));

// add button
elgg_register_title_button();

// build page elements
$title = elgg_echo('site_annoucements:editors:title');

// get correct users
$dbprefix = elgg_get_config('dbprefix');
$editor_options = array(
	'type' => 'user',
	'plugin_id' => 'site_announcements',
	'plugin_user_setting_name' => 'editor',
	'limit' => false,
	'callback' => false
);

$options = array(
	'type' => 'user',
	'joins' => array("JOIN {$dbprefix}users_entity ue ON e.guid = ue.guid"),
	'wheres' => array('ue.admin = "yes"'),
	'no_results' => elgg_echo('site_annoucements:editors:none')
);

$editors = elgg_get_entities_from_plugin_user_settings($editor_options);
if (!empty($editors)) {
	$editor_guids = array();
	
	foreach ($editors as $row) {
		$editor_guids[] = (int) $row->guid;
	}
	
	$options['wheres'][0] .= ' OR e.guid IN (' . implode(',', $editor_guids) . ')';
}

$content = elgg_list_entities($options);

// build page
$page_data = elgg_view_layout('content', array(
	'title' => $title,
	'content' => $content
));

// draw page
echo elgg_view_page($title, $page_data);
