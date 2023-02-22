<?php
/**
 * Create / edit a site announcement
 *
 * @uses $vars['entity'] for the edit of an existing announcement
 */

$hour_options = range(0, 23);
$mins_options = range(0, 59);

$entity = elgg_extract('entity', $vars);
if ($entity instanceof \SiteAnnouncement) {
	echo elgg_view('input/hidden', ['name' => 'guid', 'value' => $entity->guid]);
}

echo elgg_view_field([
	'#type' => 'longtext',
	'#label' => elgg_echo('site_announcements:edit:text'),
	'name' => 'description',
	'value' => elgg_extract('description', $vars),
]);

echo '<div>';
echo '<label for="startdate">' . elgg_echo('site_announcements:edit:startdate') . '</label>';
echo elgg_view('input/date', [
	'name' => 'startdate',
	'value' => elgg_extract('startdate', $vars),
	'timestamp' => true,
	'class' => 'mhs elgg-col-1of5',
]);
echo '@';
echo elgg_view('input/select', [
	'name' => 'starthour',
	'value' => elgg_extract('starthour', $vars),
	'options' => $hour_options,
	'class' => 'mhs',
]);
echo ':';
echo elgg_view('input/select', [
	'name' => 'startmins',
	'value' => elgg_extract('startmins', $vars),
	'options' => $mins_options,
	'class' => 'mls',
]);
echo '</div>';

echo '<div>';
echo '<label for="enddate">' . elgg_echo('site_announcements:edit:enddate') . '</label>';
echo elgg_view('input/date', [
	'name' => 'enddate',
	'value' => elgg_extract('enddate', $vars),
	'timestamp' => true,
	'class' => 'mhs elgg-col-1of5',
]);
echo '@';
echo elgg_view('input/select', [
	'name' => 'endhour',
	'value' => elgg_extract('endhour', $vars),
	'options' => $hour_options,
	'class' => 'mhs',
]);
echo ':';
echo elgg_view('input/select', [
	'name' => 'endmins',
	'value' => elgg_extract('endmins', $vars),
	'options' => $mins_options,
	'class' => 'mls',
]);
echo '</div>';

echo elgg_view_field([
	'#type' => 'select',
	'#label' => elgg_echo('site_announcements:type'),
	'name' => 'announcement_type',
	'value' => elgg_extract('announcement_type', $vars),
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
	'value' => elgg_extract('access_id', $vars),
	'entity_type' => 'object',
	'entity_subtype' => \SiteAnnouncement::SUBTYPE,
	'entity' => $entity,
]);

$footer = elgg_view_field([
	'#type' => 'submit',
	'value' => elgg_echo('save'),
]);

elgg_set_form_footer($footer);
