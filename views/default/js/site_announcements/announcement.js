define(function(require) {
	var $ = require('jquery');
	var Ajax = require('elgg/Ajax');
	
	var mark_as_read = function(event) {
		event.preventDefault();
		
		var guid = $(this).attr('rel');
		var ajax = new Ajax(false);
		
		$message = $(this).closest('.elgg-message');
		$message.slideToggle();
		
		ajax.action($(this).attr('href'), {
			success: function() {
				$message.remove();
			}
		});
	};
	
	$(document).on('click', '.site-announcements-mark', mark_as_read);
});
