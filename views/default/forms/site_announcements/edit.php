<?php
/**
 * Create / edit a site announcement
 *
 * @uses $vars['entity'] for the edit of an existing announcement
 */

use Elgg\Values;

$entity = elgg_extract('entity', $vars);

$hour_options = range(0, 23);
$mins_options = range(0, 59);

$description = '';
if (!empty($entity)) {
	echo elgg_view('input/hidden', ['name' => 'guid', 'value' => $entity->guid]);
	
	$description = elgg_get_sticky_value('site_announcement_edit', 'description', $entity->description);
	
	$startdate = (int) elgg_get_sticky_value('site_announcement_edit', 'startdate', $entity->startdate);
	$enddate = (int) elgg_get_sticky_value('site_announcement_edit', 'enddate', $entity->enddate);
	
	$announcement_type = elgg_get_sticky_value('site_announcement_edit', 'announcement_type', $entity->announcement_type);
	$access_id = elgg_get_sticky_value('site_announcement_edit', 'access_id', $entity->access_id);
} else {
	
	$description = elgg_get_sticky_value('site_announcement_edit', 'description');
	
	$startdate = time();
	$enddate = time() + (7 * 24 * 60 * 60);
	
	$announcement_type = elgg_get_sticky_value('site_announcement_edit', 'announcement_type');
	$access_id = elgg_get_sticky_value('site_announcement_edit', 'access_id', elgg_get_default_access());
}

$startdate = Values::normalizeTime($startdate);
$enddate = Values::normalizeTime($enddate);

$starthour = (int) elgg_get_sticky_value('site_announcement_edit', 'starthour', $startdate->format('G'));
$startmins = (int) elgg_get_sticky_value('site_announcement_edit', 'startmins', $startdate->format('i'));

$endhour = (int) elgg_get_sticky_value('site_announcement_edit', 'endhour', $enddate->format('G'));
$endmins = (int) elgg_get_sticky_value('site_announcement_edit', 'endmins', $enddate->format('i'));

// clear sticky form
elgg_clear_sticky_form('site_announcement_edit');

echo elgg_view_field([
	'#type' => 'longtext',
	'#label' => elgg_echo('site_announcements:edit:text'),
	'name' => 'description',
	'value' => $description,
]);

echo '<div>';
echo '<label for="startdate">' . elgg_echo('site_announcements:edit:startdate') . '</label>';
echo elgg_view('input/date', ['name' => 'startdate', 'value' => $startdate, 'timestamp' => true, 'class' => 'mhs elgg-col-1of5']);
echo '@';
echo elgg_view('input/select', ['name' => 'starthour', 'value' => $starthour, 'options' => $hour_options, 'class' => 'mhs']);
echo ':';
echo elgg_view('input/select', ['name' => 'startmins', 'value' => $startmins, 'options' => $mins_options, 'class' => 'mls']);
echo '</div>';

echo '<div>';
echo '<label for="enddate">' . elgg_echo('site_announcements:edit:enddate') . '</label>';
echo elgg_view('input/date', ['name' => 'enddate', 'value' => $enddate, 'timestamp' => true, 'class' => 'mhs elgg-col-1of5']);
echo '@';
echo elgg_view('input/select', ['name' => 'endhour', 'value' => $endhour, 'options' => $hour_options, 'class' => 'mhs']);
echo ':';
echo elgg_view('input/select', ['name' => 'endmins', 'value' => $endmins, 'options' => $mins_options, 'class' => 'mls']);
echo '</div>';

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('site_announcements:type'),
	'name' => 'announcement_type',
	'value' => $announcement_type,
	'options_values' => [
		'' => elgg_echo('site_announcements:type:general'),
		'info' => elgg_echo('site_announcements:type:info'),
		'attention' => elgg_echo('site_announcements:type:attention'),
		'error' => elgg_echo('site_announcements:type:error'),
	],
]);

echo elgg_view_field([
	'#type' => 'access',
	'#label' => elgg_echo('access'),
	'name' => 'access_id',
	'value' => $access_id,
	'entity_type' => 'object',
	'entity_subtype' => \SiteAnnouncement::SUBTYPE,
	'entity' => $entity,
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);
