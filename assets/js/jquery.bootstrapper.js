(function ($) {

    var Bootstrapper = {
        init: function () {
            this.initFastClick();
            this.toggleCollapseFromHash();
            this.openModalFromHash();
            this.toggleTabFromHash();
            this.initModalNavigation();
            //this.initModalRemoteUpdate();
            this.initNavbar();
            this.navFollowLinkIfItemsOpen(); // must be initialized before supportNestedDropdowns, becaus supportNestedDropdowns adds class .open to links
            this.supportNestedDropdowns();
            this.initDateTimePicker();

            this.initSlider();
            // show news in modal window
            //this.initModal();
            //this.loadModalFromUrl();
            //this.onCloseModal();
            this.initCarouselProgressBar();
            this.addPlaceholderTagSupport();
            this.initJQueryValidation();
            this.initAjaxForms();
            this.initScrollClass();
            this.megaMenuEqualHeight();
            this.setHashFromCollapse();

            this.followAnchor();
            this.initFileUpload();
            this.slideUpCollapse();

			this.initIosLabelBugFix();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        ajaxComplete : function() {
            this.initDateTimePicker();
        },
        slideUpCollapse : function(){
            $('.collapse.slideup').on('show.bs.collapse', function () {
                $("html, body").animate({ scrollTop: $(document).height() }, "slow");
            });
        },
        initFileUpload : function(){
            // clear fileinput always (as long as value is provided by server)
            $('.fileinput [data-dismiss]').on('click', function(){
                var $fileInput = $(this).parent('.fileinput');
                $fileInput.fileinput('clear');
                $fileInput.find('input[type=file]').attr('value', '');
            });
        },
        megaMenuEqualHeight: function () {

            // if level_3 submenu higher than level_2, we need to determine the max height of both and set it
            // otherwise, menu items will overlap the parent wrapper, because absolute positioned items wont inflate the parent wrapper
            $('[data-equal-height="ul.nav"]').each(function () {

                var $this = $(this),
                    maxInnerHeight = 0,
                    maxOuterHeight = 0;

                $this.find($this.data('equal-height')).each(function () {
                    var actualInnerHeight = $(this).actual('innerHeight');
                    actualOuterHeight = $(this).actual('outerHeight', {includeMargin: true});

                    if (actualOuterHeight > maxOuterHeight) {
                        maxOuterHeight = actualOuterHeight;
                    }

                    if (actualInnerHeight > maxInnerHeight) {
                        maxInnerHeight = actualInnerHeight;
                    }
                });

                $this.height(maxOuterHeight);
                $this.find('.submenu-wrapper').height(maxInnerHeight);
            });
        },
        supportNestedDropdowns: function () {
            $('ul.dropdown-menu').on('click', 'a[data-toggle="dropdown"]', function (event) {
                // Avoid following the href location when clicking
                event.preventDefault();
                // Avoid having the menu to close when clicking
                event.stopPropagation();
                // If a menu is already open we close it
                $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
                // opening the one you clicked on
                $(this).parent().addClass('open');
            });
        },
        initScrollClass: function () {
            $(window).on('scroll', function (e) {

                var distanceY = $(window).scrollTop();

                $('[data-spy="scroll"]').each(function () {
                    var $this = $(this),
                        scrollClass = $this.data('scrollclass'),
                        offset = $this.data('offset') ? $this.data('offset') : 1;

                    if (scrollClass == null) return true; // continue

                    if (distanceY > offset) {
                        $this.addClass(scrollClass);
                    } else {
                        $this.removeClass(scrollClass);
                    }
                });
            });
        },
        initNavbar: function () {
            $('.navbar-collapse').on('shown.bs.collapse', function () {
                $('body').addClass('navbar-xs-open');
            });

            $('.navbar-collapse').on('hide.bs.collapse', function () {
                $('body').removeClass('navbar-xs-open');
            });
        },
        addPlaceholderTagSupport: function () {
            if (!Modernizr.input.placeholder) {
                $('input, textarea').placeholder();
            }
        },
        initJQueryValidation: function () {
			var $forms = $('form.jquery-validation');

			if ($forms.length > 0) {
				$.validator.addMethod
				(
					'checkbox', function (value, element) {
						var blnChecked = false,
							$group = $(element).closest('.form-group');

						if ($group.find('.control-label:first .mandatory').length > 0) {
							$group.find('input[type=checkbox]').each(function () {
								if (this.checked) {
									blnChecked = true;
									return false;
								}
							});
							return blnChecked;
						}
						return true;
					},
					jQuery.validator.format('Dieses Feld ist ein Pflichtfeld.')
				);

				$forms.each(function () {
					$(this).validate({
						errorClass: 'error',
						focusInvalid: false,
						errorPlacement: function(error, element) {
                            error.appendTo(element.closest('.form-group'));
						}
					});
				});
			}
		},
        initAjaxForms: function () {
            $('body').on('submit', '.ajax-form', function (e) {

                var $form = $(this),
                    $formData = $form.serializeArray();

                e.preventDefault();

                $formData.push({
                    name: 'isAjax',
                    value: '1'
                });

                $.ajax(
                    $form.attr('action'),
                    {
                        data: $formData,
                        method: $(this).attr('method'),
                        success: function (data) {

                            var replace,
                                data = '<div>' + data + '</div>';

                            if ($form.data('replace')) {
                                replace = $(data).find($form.data('replace'));
                                if (replace !== undefined) {
                                    $($form.data('replace')).html(replace);
                                }

                            } else {

                                // html page returned
                                replace = $(data).find('#' + $form.attr('id'));
                                if (replace.length < 1) {
                                    $form.html(data); // module handle ajax request, replace inner html
                                    replace = $form;
                                } else {
                                    $form.replaceWith(replace);
                                }
                            }

                            // sroll to first alert message or first error field
                            var alert = replace.find('.alert:first, .error:first');

                            if(alert.length > 0){
                                var alertOffset = alert.offset();

                                $('html,body').animate({
                                    scrollTop: parseInt(alertOffset.top) - 70 + 'px'
                                }, 500);
                            }
                        }
                    }
                );
            });
        },
        initCarouselProgressBar: function () {

            var percent = 0,
                bar = $('.carousel-progress .progress-bar'),
                text = bar.find('.sr-only'),
                crsl = $('.carousel'),
                delay = 200,
                step = Math.floor(delay * 100 / parseInt(crsl.data('interval')));

            if (crsl.length <= 0) return;

            function progressBarCarousel() {
                if (percent > 0) {
                    bar.removeClass('carousel-transition');
                }

                if (percent >= 100) {
                    text.text('100%');
                    bar.css({width: '100%'});
                    percent = 100;
                    crsl.carousel('next');
                    bar.addClass('carousel-transition');
                    return false;
                }

                bar.css({width: percent + '%'});
                text.text(percent + '%');
                percent += step;
            }

            var barInterval = setInterval(progressBarCarousel, delay);

            // disable default interval
            crsl.carousel({
                interval: false,
                pause: false
            })
                .on('slide.bs.carousel', function () {
                    clearInterval(barInterval);
                })
                .on('slid.bs.carousel', function () {
                    percent = 0;
                    barInterval = setInterval(progressBarCarousel, delay);
                });

            // hover support
            crsl.hover(function () {
                clearInterval(barInterval);
            }, function () {
                barInterval = setInterval(progressBarCarousel, delay);
            });

            // click support
            crsl.on('click', '.carousel-control, .carousel-indicators', function () {
                percent = 0;
                clearInterval(barInterval);
                bar.addClass('carousel-transition').css({width: '0%'});
            });

            // gestures/touch support


        },
        initModal: function() {
            $('[data-toggle="modal"]').each(function() {
                var $this = $(this),
                    $modal = $($this.data('target'));

                $this.data('href', $this.attr('href'));
                $this.attr('href', '#');

                // change history base
                if (!$modal.hasClass('in')) {
                    $modal.data('history-base-filtered', window.location.href);
                }
            });

            $('body').on('click', '[data-toggle="modal"]', function (e) {
                e.preventDefault();
                var $this = $(this),
                    $modal = $($this.data('target')),
                    $replace = $modal.find('.modal-dialog');

                $replace.load($this.data('href'), function (responseText, textStatus, jqXHR) {
                    history.pushState(null, null, $this.data('href'));
                });
            });
        },
        onCloseModal: function () {
            $('.modal').on('hide.bs.modal', function (e) {

                var $this = $(this);

                // stop embedded videos like youtube
                $this.find('iframe').each(function(){
                    var $this = $(this);

                    // reset the src will stop the video
                    $this.attr('src', $this.attr('src').replace('autoplay=1', 'autoplay=0'));
                });

                // stop embedded audio/video
                $this.find('audio, video').each(function(){
                    this.pause();
                });

                // set url to history-base-filtered if set (modal content replaced via ajax)
                if($this.data('history-base-filtered'))
                {
                    history.pushState(null, null, $this.data('history-base-filtered'));
                }
                // redirect to base url (modal window opened via direct event url)
                else{
                    history.pushState(null, null, $this.data('history-base'));
                }
            });
        },
        loadModalFromUrl: function () {
            if ($('.modal.in').length > 0)
                $('.modal.in').modal('show');
        },
        initDateTimePicker: function () {
            var defaults = {
                locale: $('html').attr('lang'),
                icons: {
                    time: 'fa fa-time',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-screenshot',
                    clear: 'fa fa-trash'
                }
            };

            $('.datepicker, .timepicker').each(function (k, item) {
                var $this = $(this),
                    $input = $this.find('input'),
                    minDate = $input.data('mindate'),
                    maxDate = $input.data('maxdate'),
                    linkedUnlock = $input.data('linked-unlock') == true,
                    $linkedStart = $($input.data('linked-start')),
                    $linkedEnd = $($input.data('linked-end'));

                $this.datetimepicker($.extend({format: $input.data('format')}, defaults));

                // set min date
                if (moment(minDate, $input.data('format')).isValid()) {
                    $this.data("DateTimePicker").minDate(moment(minDate, $input.data('format')));
                }

                // set max date
                if (moment(maxDate, $input.data('format')).isValid()) {
                    $this.data("DateTimePicker").maxDate(moment(maxDate, $input.data('format')));
                }

                // is end -> link to start
                if ($linkedStart.length > 0) {
                    // set default min date
                    if (moment($linkedStart.val(), $input.data('format')).isValid()) {
                        $this.data("DateTimePicker").minDate(moment($linkedStart.val(), $input.data('format')));
                    }

                    // on change - update start
                    $this.on("dp.change", function (e) {
                        if (moment(e.date).isValid()) {

                            // intelligent adjustment of start
                            if(linkedUnlock){
                                // set start to same date as end, if end is before start
                                if(e.date.isBefore($linkedStart.closest('.datepicker').data("DateTimePicker").date())) {
                                    $linkedStart.closest('.datepicker').data("DateTimePicker").date(e.date);
                                }
                                // set max date
                            } else{
                                $linkedStart.closest('.datepicker').data("DateTimePicker").maxDate(e.date);
                            }
                        }
                    });
                }

                // is start -> linked to end
                if ($linkedEnd.length > 0) {

                    if (moment($linkedEnd.val(), $input.data('format')).isValid()) {
                        $this.data("DateTimePicker").maxDate(moment($linkedEnd.val(), $input.data('format')));
                    }

                    // on change - update end
                    $this.on("dp.change", function (e) {
                        if (moment(e.date).isValid()) {

                            // intelligent adjustment of end
                            if(linkedUnlock){
                                // set end to same date as start, if start is after end
                                if(e.date.isAfter($linkedEnd.closest('.datepicker').data("DateTimePicker").date())) {
                                    $linkedEnd.closest('.datepicker').data("DateTimePicker").date(e.date);
                                }
                                // set min date
                            } else{
                                $linkedEnd.closest('.datepicker').data("DateTimePicker").minDate(e.date);
                            }
                        }
                    });
                }
            });
        },
        initSlider: function () {
            $('input.slider').slider();
        },
        setHashFromCollapse : function()
		{
			var $collapse = $('.collapse');
			var openHash = '';

			$collapse.on('show.bs.collapse', function ()
			{
				if(this.id)
				{
					history.pushState(null, null, location.href.replace(location.hash, '') + '#' + this.id);
					openHash = this.id;
					var $childs = $( $(this).prev('.toggler').find('[data-toggle=collapse]').data('parent') ).find('.panel-collapse');
					$childs.each(function()
					{
						if (this.id != openHash)
						{
							$(this).collapse('hide');
						}
					})
				}
			});
			$collapse.on('hide.bs.collapse', function ()
			{
				if(this.id)
				{
					if (openHash == this.id)
					{
						history.replaceState({}, document.title, location.href.replace(location.hash, ''));
					}
					else
					{
						history.replaceState({}, document.title, location.href.replace(location.hash, '') + '#' + openHash);
					}
				}
			});
        },
        followAnchor : function(){

            $('a[href*=#]:not([data-toggle])').on('click', function () {
                var parser = document.createElement('a');
                parser.href = $(this).attr('href');

                return scrollToHash(parser.hash);
            });

            function scrollToHash(hash){

                if(hash == '') return true;

                var $anchor = $(hash);

                if($anchor.length > 0){
                    $('html,body').animate({scrollTop:$anchor.offset().top}, 500);
                    window.location.hash = hash;
                    return false;
                }

                return true;
            }
        },
        toggleCollapseFromHash: function () {
            var hash = location.hash.replace(/#/g, ""); // remove if more than # sign

            if (!hash) return false;

            var $toggle = $('#' + hash + '.collapse'),
                $link = $("[href='#" + hash + "']");

            if($toggle.length < 1) return false;

            var $parent = $($link.data('parent'));

            // close all open panels
            if($parent.length > 0){
                $($link.data('parent')).find('.collapse').removeClass('in');
                $($link.data('parent')).find('[data-toggle=collapse]').addClass('collapsed');
            }

            // toggle anchor panel id
            $toggle.addClass('in');
            $link.removeClass('collapsed');

            // scroll to panel
            $('html,body').animate({scrollTop:$toggle.offset().top}, 500);
        },
        openModalFromHash: function () {
            var hash = location.hash.replace(/#/g, "").replace(/is/g, "or"); // remove if more than # sign

            if (!hash) return false;

            var $toggle = $('#' + hash);

            if($toggle.length < 1 || !$toggle.hasClass('modal')) return false;

            $toggle.modal('show');
        },
        toggleTabFromHash: function () {
            var hash = location.hash.replace(/#/g, ""); // remove if more than # sign

            if (!hash) return false;

            var $pane = $('#' + hash),
                $link = $("[href='#" + hash + "']");

            var $links = $link.closest('.tabcontrol_tabs'),
                $panes = $pane.closest('.tabcontrol_panes');

            // close all open panels
            if($links.length > 0 && $panes.length > 0){
                $links.find('a').parent().removeClass('active');
                $panes.find('.tab-pane').removeClass('in').removeClass('active');

                // toggle anchor panel id
                $pane.addClass('active').addClass('in');
                $link.parent().addClass('active');
            }
        },
        initModalNavigation: function () {
            $('.modal').on('click', '.modal-next', function (e) {
                e.preventDefault();

                window.location = $(this).attr('href');
            });
        },
        initModalRemoteUpdate: function () {
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });

            $('a[data-toggle="modal"][data-remote]').on('click', function (e) {
                e.preventDefault();

                var $this = $(this),
                    $target = $($this.data('target'));

                $.ajax({url: $this.attr('href')}).done(function (data) {
                    $target.find('.modal-content').replaceWith(data).end().modal();
                });

                // Now return a false (negating the link action) to prevent Bootstrap's JS 3.1.1
                // from throwing a 'preventDefault' error due to us overriding the anchor usage.
                return false;
            });
        },
        navFollowLinkIfItemsOpen: function () {
            // trigger click on open items
            $('.nav-collapse').on('click', 'a[data-toggle="dropdown"]', function (e) {
                var $this = $(this),
                    $parent = $this.parent('li');

                // submenu is already open - follow parent link
                if (this.href !== undefined && $parent.hasClass('open')) {
                    if (this.target.length) {
                        window.open(this.href, this.target);
                    } else {
                        window.location = this.href;
                    }

                }
            });
        },
        initFastClick: function () {
            FastClick.attach(document.body);
        },
		initIosLabelBugFix: function() {
			$('.ios .checkbox-label, .ios .radio-label').each(function() {
				$(this).on('click', function() {
					$(this).siblings('input').trigger('click');
				})
			});
		},
    };

    $(document).ready(function () {
        Bootstrapper.init();
    });

})(jQuery);
