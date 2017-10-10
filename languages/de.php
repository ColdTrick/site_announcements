<?php

return [
	'item:object:site_announcement' => "Seiten-Ankündigungen",
	
	'site_annoucements' => "Ankündigungen",
	'site_annoucements:archive' => "Archiv",
	'site_annoucements:scheduled' => "Geplant",
	'site_annoucements:editors' => "Ankündiger",
	'announcements:add' => "Ankündigungen hinzufügen",

	// plugin settings
	'site_announcements:settings:archive_cleanup' => "Entferne abgelaufene Ankündigungen nach einer Anzahl von Tagen",
	'site_announcements:settings:archive_cleanup:help' => "Wenn Du nicht möchtest, dass das Archiv zu groß wird kannst Du hier die Anzahl der Tage angeben, nach denen abgelaufene Ankündigungen gelöscht werden. Keine Angabe oder 0 unterbindet das Löschen.",
	
	'site_annoucements:all:title' => "Aktive Ankündigungen",
	'site_annoucements:archive:title' => "Ankündigungsarchiv",
	'site_annoucements:add:title' => "Ankündigung hinzufügen",
	'site_annoucements:edit:title' => "Ankündigung bearbeiten",
	'site_annoucements:scheduled:title' => "Geplante Ankündigungen",
	'site_annoucements:editors:title' => "Ankündiger",
	
	'site_annoucements:filter:active' => "Aktiv",
	'site_annoucements:filter:archive' => "Archiv",
	'site_annoucements:filter:scheduled' => "Geplant",
	'site_annoucements:filter:editors' => "Ankündiger",
	
	'site_announcements:user_hover:make_editor' => "Ankündiger erstellen",
	'site_announcements:user_hover:remove_editor' => "Ankündiger entfernen",
	
	'site_annoucements:all:none' => "Keine aktiven Ankündigungen",
	'site_annoucements:archive:none' => "Keine archivierten Ankündigungen",
	'site_annoucements:scheduled:none' => "Keine geplanten Ankündigungen",
	'site_annoucements:editors:none' => "Keine Ankündiger",
	
	'site_announcements:menu:entity:mark' => "Habe ich schon gesehen.",
	
	'site_announcements:type' => "Art der Ankündigung",
	'site_announcements:type:general' => "Allgemein",
	'site_announcements:type:info' => "Information",
	'site_announcements:type:attention' => "Warnung",
	
	'site_announcements:edit:text' => "Ankündigung",
	'site_announcements:edit:startdate' => "Anfangsdatum",
	'site_announcements:edit:enddate' => "Enddatum",
	
	'site_announcement:action:edit:error:input' => "Bitte gib einen Ankündigungstext, ein Anfangs- und ein Enddatum ein.",
	'site_announcement:action:edit:error:time' => "Das Enddatum darf nicht vor dem Anfangsdatum liegen.",
	'site_announcement:action:edit:error:save' => "Ein unbekannter Fehler ist während des Speicherns der Ankündigung aufgetreten. Bitte versuche es noch einmal.",
	'site_announcement:action:edit:success' => "Die Ankündigung wurde gespeichert.",
	
	'site_announcements:action:toggle_editor:error:is_admin' => "%s ist ein Administrator und ist somit ein Ankündiger.",
	'site_announcements:action:toggle_editor:unmake' => "%s ist nun nicht mehr ein Ankündiger.",
	'site_announcements:action:toggle_editor:make' => "%s ist nun ein Ankündiger.",
];
