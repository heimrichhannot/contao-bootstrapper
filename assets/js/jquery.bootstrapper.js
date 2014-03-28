(function($){
	
	var Bootstrapper = {
			init : function(){
				this.toggleCollapseFromHash();
				this.openModalFromHash();
				this.initModalNavigation();
				this.initModalRemoteUpdate();
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
			initModalNavigation : function() {
				$('.modal').on('click', '.modal-next', function(e) {
					e.preventDefault();
					
					window.location = $(this).attr('href');
				});
			},
			initModalRemoteUpdate: function() {
				$('body').on('hidden.bs.modal', '.modal', function () {
					$(this).removeData('bs.modal');
				});
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
				$('select.tl_chosen').chosen({width: '100%'}); // 100% = responsive support
			}
	};
	
	$(document).ready(function(){
		Bootstrapper.init();
	});
	
})(jQuery);