<?php

return [
	'item:object:site_announcement' => "Site announcement",
	'entity:delete:object:site_announcement:success' => "The site announcement was removed",
	'collection:object:site_announcement' => "Site announcements",
	
	'site_announcements' => "Announcements",
	'site_announcements:archive' => "Archive",
	'site_announcements:scheduled' => "Scheduled",
	'site_announcements:editors' => "Announcers",

	// plugin settings
	'site_announcements:settings:archive_cleanup' => "Delete expired announcements after a number of days",
	'site_announcements:settings:archive_cleanup:help' => "If you don't want the archive to become too large, you can set a number of days after which expired announcements will be deleted. 0 or empty to not cleanup the announcements.",
	
	'site_announcements:all:title' => "Active announcements",
	'site_announcements:archive:title' => "Announcements archive",
	'site_announcements:add:title' => "Add announcement",
	'site_announcements:edit:title' => "Edit announcement",
	'site_announcements:scheduled:title' => "Scheduled announcements",
	'site_announcements:editors:title' => "Announcers",
	
	'site_announcements:filter:active' => "Active",
	'site_announcements:filter:archive' => "Archive",
	'site_announcements:filter:scheduled' => "Scheduled",
	'site_announcements:filter:editors' => "Announcers",
	
	'site_announcements:user_hover:make_editor' => "Make announcer",
	'site_announcements:user_hover:remove_editor' => "Remove announcer",
	
	'site_announcements:all:none' => "No active announcements",
	'site_announcements:archive:none' => "No archived announcements",
	'site_announcements:scheduled:none' => "No scheduled announcements",
	'site_announcements:editors:none' => "No annoucers",
	
	'site_announcements:menu:entity:mark' => "I've seen this",
	
	'site_announcements:type' => "Announcement type",
	'site_announcements:type:general' => "General",
	'site_announcements:type:info' => "Informational",
	'site_announcements:type:attention' => "Warning",
	'site_announcements:type:error' => "Error",
	
	'site_announcements:edit:text' => "Announcement",
	'site_announcements:edit:startdate' => "Startdate",
	'site_announcements:edit:enddate' => "Enddate",
	
	'site_announcement:action:edit:error:input' => "Please provide an announcement text, startdate and enddate",
	'site_announcement:action:edit:error:time' => "The enddate can't be before the startdate",
	'site_announcement:action:edit:error:save' => "An unknown error occurent while saving the announcement, please try again",
	'site_announcement:action:edit:success' => "The announcement was saved",
	
	'site_announcements:action:toggle_editor:error:is_admin' => "%s is an administrator and is already an announcer",
	'site_announcements:action:toggle_editor:unmake' => "%s is no longer an announcer",
	'site_announcements:action:toggle_editor:make' => "%s is now an announcer",
];
