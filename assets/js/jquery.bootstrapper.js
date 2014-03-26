(function($){
	
	var Bootstrapper = {
			init : function(){
				this.toggleCollapseFromHash();
				this.openModalFromHash();
				this.navFollowLinkIfItemsOpen();
				this.addChosenSupport();
			},
			toggleCollapseFromHash : function(){
				var $toggle = $(location.hash + '.collapse');
				
				if(!location.hash || $toggle.length < 1) return false;
				
				// close all open panels
				$toggle.closest('.panel-group').find('.collapse').removeClass('in');
				
				// toggle anchor panel id
				$toggle.addClass('in');
			},
			openModalFromHash : function() {
				$(location.hash).modal('show');
			},
			navFollowLinkIfItemsOpen : function(){
				// trigger click on open items
				$('.nav-collapse').on('click', '.trail a, .open a', function(e){
					if(this.href !== undefined){
						window.location = this.href;
					}
				});
			},
			addChosenSupport : function(){
				$('select.tl_chosen').chosen();
			}
	};
	
	$(document).ready(function(){
		Bootstrapper.init();
	});
	
})(jQuery);