(function($){
	
	var Bootstrapper = {
			init : function(){
				this.toggleCollapseFromHash();
				this.openModalFromHash();
				this.initModalNavigation();
				this.initModalRemoteUpdate();
				this.navFollowLinkIfItemsOpen();
				this.addChosenSupport();
				this.initDateTimePicker();
			},
			initDateTimePicker : function(){
				var defaults = {
					language: $('html').attr('lang'),
					icons : {
						time: 'fa fa-clock-o',
						date: 'fa fa-calendar',
						up:   'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				};
				
				$('.datepicker').each(function(k, item){
					var $this = $(this);
					$this.datetimepicker($.extend({pickTime: false, format: $this.attr('data-format')}, defaults));
				});
				
				$('.timepicker').each(function(k, item){
					var $this = $(this);
					
					$this.datetimepicker($.extend({pickDate: false, minuteStepping : 15, format: $this.attr('data-format')}, defaults));
				});
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
				
				$('a[data-toggle="modal"][data-remote]').on('click', function(e) {
					e.preventDefault();
					
					var $this = $(this),
						$target = $($this.data('target'));
					
					$.ajax({url:$this.attr('href')}).done(function(data){
						$target.find('.modal-content').replaceWith(data).end().modal();
					});
					
					// Now return a false (negating the link action) to prevent Bootstrap's JS 3.1.1
					// from throwing a 'preventDefault' error due to us overriding the anchor usage.
					return false;
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