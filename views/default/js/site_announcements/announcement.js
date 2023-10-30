define(['jquery', 'elgg/Ajax'], function($, Ajax) {
	
	function mark_as_read(event) {
		event.preventDefault();
		
		var ajax = new Ajax(false);
		
		$message = $(this).closest('.elgg-message');
		$message.slideToggle();
		
		ajax.action($(this).attr('href'), {
			success: function() {
				$message.remove();
			}
		});
	}
	
	$(document).on('click', '.site-announcements-mark', mark_as_read);
});
