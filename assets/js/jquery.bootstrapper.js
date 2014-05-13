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
				
				// show news in modal window 
				this.setUrlHistoryFromModalLink();
				this.loadModalFromUrl();
				this.onCloseModal();
				this.initCarouselProgressBar();
			},
			initCarouselProgressBar : function(){
				
				var percent = 0,
					bar = $('.carousel-progress .progress-bar'),
					text = bar.find('.sr-only'),
					crsl = $('.carousel'),
					delay = 200,
					step = Math.floor(delay * 100 / parseInt(crsl.data('interval')));
				
				function progressBarCarousel() {
					
					if(percent > 0){
						bar.removeClass('carousel-transition');
					}
					
					if (percent >= 100) {
						text.text('100%');
						bar.css({width:'100%'});
						percent = 100;
						crsl.carousel('next');
						bar.addClass('carousel-transition');
						return false;
					}
					
					bar.css({width:percent+'%'});
					text.text(percent + '%');
					percent += step;
				}
				
				var barInterval = setInterval(progressBarCarousel, delay);
				
				// disable default interval
				crsl.carousel({
					interval: false,
					pause: false
				}).on('slid.bs.carousel', function () {
					percent=0;
				});
				
				// hover support
				crsl.hover(function(){
					clearInterval(barInterval);
				},function(){
					barInterval = setInterval(progressBarCarousel, delay);
				});
				
				// click support
				crsl.on('click', '.carousel-indicators', function(){
					percent = 0;
					clearInterval(barInterval);
					bar.addClass('carousel-transition').css({width:'0%'});
				});
				
				// gestures/touch support
				
				
			},
			onCloseModal : function(){
				$('.modal').on('hide.bs.modal', function (e) {

					var $this = $(this),
						$news = $this.find('.layout_full'),
						pageAlias = $('body').data('page-alias') == 'startseite' ? '' : $('body').data('page-alias'),
						modalHistoryDelete = $this.data('history-delete'),
						newsHistoryDelete = $news.data('history-delete'),
						newsHistoryBase = $news.data('history-base'),
						newHistory = location.href.replace('/' + (newsHistoryDelete ? newsHistoryDelete : modalHistoryDelete) , '');
					
					newHistory = pageAlias != newsHistoryBase ? newHistory.replace(newsHistoryBase, pageAlias) : newHistory;
						
					// reset history
					history.pushState(null, null, newHistory);
				});
			},
			setUrlHistoryFromModalLink : function(){
				$('[data-toggle="modal"]').on('click', function(e){
					
					e.stopPropagation();
					
					var $this = $(this);
					
					$('.modal').data('history-back', window.location);
					
					history.pushState(null, null, $this.attr('href'));
					
					
				});
			},
			loadModalFromUrl : function(){
				$('.modal.in').modal('show');
			},
			initDateTimePicker : function(){
				var defaults = {
					language: $('html').attr('lang'),
					startDate: new moment({ y: 1900 }),
					icons : {
						time: 'fa fa-clock-o',
						date: 'fa fa-calendar',
						up:   'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				};
				
				$('.datepicker').each(function(k, item){
					var $this = $(this),
						$input = $this.find('input');
					
					$this.datetimepicker($.extend({pickTime: false, format: $input.data('format')}, defaults));
				});
				
				$('.timepicker').each(function(k, item){
					var $this = $(this),
						$input = $this.find('input');
					
					$this.datetimepicker($.extend({pickDate: false, minuteStepping : $input.data('steps'), format: $input.data('format')}, defaults));
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
				var $toggle = $(location.hash);
				
				if(!location.hash || $toggle.length < 1 || !$toggle.hasClass('modal')) return false;
				
				$toggle.modal('show');
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