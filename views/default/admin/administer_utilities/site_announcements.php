<?php
/**
 * List all the current site announcements and offer the ability to add a new one
 */

elgg_load_js("lightbox");
elgg_load_css("lightbox");

$add_button = elgg_view("output/url", array(
	"text" => elgg_echo("add"),
	"href" => "#site-announcements-edit-form",
	"class" => "elgg-button elgg-button-action float-alt",
	"rel" => "toggle"
));

$content = elgg_view_form("site_announcements/edit", array("id" => "site-announcements-edit-form", "class" => "hidden mbl"));

// list current anncouncements
$options = array(
	"type" => "object",
	"subtype" => SITE_ANNOUNCEMENT_SUBTYPE,
	"limit" => false,
	"order_by_metadata" => array(
		"name" => "startdate",
		"as" => "integer",
		"direction" => "ASC"
	),
	"full_view" => false,
	"pagination" => false
);

$anncouncements = elgg_list_entities_from_metadata($options);
if (empty($anncouncements)) {
	$anncouncements = elgg_view("output/longtext", array("value" => elgg_echo("notfound")));
}

$content .= $anncouncements;

echo elgg_view_module("inline", elgg_echo("site_announcements:admin:list") . $add_button, $content);
