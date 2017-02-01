define(function(require) {
	var $ = require('jquery');
	var Ajax = require('elgg/Ajax');
	
	var mark_as_read = function(event) {
		event.preventDefault();
		
		var guid = $(this).attr('rel');
		var ajax = new Ajax(false);
		
		ajax.action($(this).attr('href'), {
			success: function() {
				$('#site-announcements-site #elgg-object-' + guid).remove();
			}
		});
	};
	
	$(document).on('click', '#site-announcements-site li.elgg-menu-item-mark a', mark_as_read);
});
