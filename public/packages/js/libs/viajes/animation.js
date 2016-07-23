// DONE
$(document).on("ready",function(){
	
			$( document ).ajaxStart(function() {
				$('#content').show();
			});
			$( document ).ajaxStop(function() {
				$('#content').hide();
			});
			
	$('#content').hide();
});