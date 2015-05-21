<?php

?>
//<script>
elgg.provide("elgg.site_announcements");

elgg.site_announcements.init = function() {

	$("#site-announcements-site li.elgg-menu-item-mark a").live("click", function(event) {
		event.preventDefault();

		var guid = $(this).attr("rel");
		
		elgg.action($(this).attr("href"), {
			success: function(res) {
				$("#elgg-object-" + guid).remove();
			}
		});
	});

	elgg.ui.registerTogglableMenuItems('announcement-make-editor', 'announcement-remove-editor');
}

//register init hook
elgg.register_hook_handler("init", "system", elgg.site_announcements.init);