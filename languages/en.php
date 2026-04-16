<?php

return [
	'item:object:site_announcement' => "Site announcement",
	'collection:object:site_announcement' => "Site announcements",
	
	'entity:delete:object:site_announcement:success' => "The site announcement was removed",
	'list:object:site_announcement:no_results' => 'No announcements found',
	
	'collection:object:site_announcement:all' => "Active announcements",
	'collection:object:site_announcement:archive' => "Announcements archive",
	'collection:object:site_announcement:scheduled' => "Scheduled announcements",
	'collection:object:site_announcement:editors' => "Announcers",
	
	'site_announcements' => "Announcements",

	// plugin settings
	'site_announcements:settings:archive_cleanup' => "Delete expired announcements after a number of days",
	'site_announcements:settings:archive_cleanup:help' => "If you don't want the archive to become too large, you can set a number of days after which expired announcements will be deleted. 0 or empty to not cleanup the announcements.",
	
	'site_announcements:add:title' => "Add announcement",
	'site_announcements:edit:title' => "Edit announcement",
	
	'site_announcements:filter:active' => "Active",
	'site_announcements:filter:archive' => "Archive",
	'site_announcements:filter:scheduled' => "Scheduled",
	'site_announcements:filter:editors' => "Announcers",
	
	'site_announcements:user_hover:make_editor' => "Make announcer",
	'site_announcements:user_hover:remove_editor' => "Remove announcer",
	
	'site_announcements:all:none' => "No active announcements",
	'site_announcements:archive:none' => "No archived announcements",
	'site_announcements:scheduled:none' => "No scheduled announcements",
	'site_announcements:editors:none' => "No announcers",
	
	'site_announcements:menu:entity:mark' => "I've seen this",
	
	'site_announcements:type' => "Announcement type",
	'site_announcements:type:general' => "General",
	'site_announcements:type:info' => "Informational",
	'site_announcements:type:attention' => "Warning",
	'site_announcements:type:error' => "Error",
	
	'site_announcements:edit:text' => "Announcement",
	'site_announcements:edit:startdate' => "Start date",
	'site_announcements:edit:enddate' => "End date",
	
	'site_announcement:action:edit:error:input' => "Please provide an announcement text, start date and end date",
	'site_announcement:action:edit:error:time' => "The end date can't be before the start date",
	'site_announcement:action:edit:error:save' => "An unknown error occurred while saving the announcement, please try again",
	'site_announcement:action:edit:success' => "The announcement was saved",
	
	'site_announcements:action:toggle_editor:error:is_admin' => "%s is an administrator and is already an announcer",
	'site_announcements:action:toggle_editor:unmake' => "%s is no longer an announcer",
	'site_announcements:action:toggle_editor:make' => "%s is now an announcer",
];
