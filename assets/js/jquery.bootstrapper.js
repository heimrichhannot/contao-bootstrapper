(function($){
	
	var Bootstrapper = {
			init : function(){
				this.toggleCollapseFromHash();
				this.navFollowLinkIfItemsOpen();
			},
			toggleCollapseFromHash : function(){
				var $toggle = $(location.hash + '.collapse');
				
				if($toggle.length < 1) return false;
				
				// close all open panels
				$toggle.closest('.panel-group').find('.collapse').removeClass('in');
				
				// toggle anchor panel id
				$toggle.addClass('in');
			},
			navFollowLinkIfItemsOpen : function(){
				// trigger click on open items
				$('.nav-collapse').on('click', '.trail a, .open a', function(e){
					if(this.href !== undefined){
						window.location = this.href;
					}
				});
			}
	};
	
	$(document).ready(function(){
		Bootstrapper.init();
	});
	
})(jQuery);