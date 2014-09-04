(function ($) {

    var Bootstrapper = {
        init: function () {
            this.toggleCollapseFromHash();
            this.openModalFromHash();
            this.initModalNavigation();
            this.initModalRemoteUpdate();
            this.initNavbar();
            this.navFollowLinkIfItemsOpen(); // must be initialized before supportNestedDropdowns, becaus supportNestedDropdowns adds class .open to links
            this.supportNestedDropdowns();
            this.addChosenSupport();
            this.initDateTimePicker();
			this.initSlider();

            // show news in modal window
            this.setUrlHistoryFromModalLink();
            this.loadModalFromUrl();
            this.onCloseModal();
            this.initCarouselProgressBar();
            this.initGalleryCarousel();
            this.addPlaceholderTagSupport();
            this.initJQueryValidation();
			this.initAjaxForms();
            this.initScrollClass();
            this.initSelect2();
        },
        initSelect2 : function(){
            $('select').select2({
                minimumResultsForSearch: 10
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
            if ($('form.jquery-validation').length > 0) {
                $('form.jquery-validation').validate({
                    errorClass: 'error',
                    focusInvalid: false
                });
            }
        },
		initAjaxForms: function() {
			$('body').on('submit', '.ajax-form', function(e) {
				var $form = $(this);
				e.preventDefault();

				$.ajax(
					$form.attr('action'),
					{
						data: $form.serializeArray(),
						method: $(this).attr('method'),
						success: function(data) {
							var $newContent = $($.parseHTML(data)).find($form.data('replace'));
							if ($newContent.length > 0) {
								$($form.data('replace')).html($newContent);
							}
						}
					}
				);
			});
		},
        initGalleryCarousel: function () {
            $('.ce_gallery ul').each(function () {
                var $this = $(this);
                if ($this.find('li').length > 1) {
                    $this.elastislide();
                }
            });
        },
        initCarouselProgressBar: function () {

            var percent = 0,
                bar = $('.carousel-progress .progress-bar'),
                text = bar.find('.sr-only'),
                crsl = $('.carousel'),
                delay = 200,
                step = Math.floor(delay * 100 / parseInt(crsl.data('interval')));

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
        onCloseModal: function () {
            $('.modal').on('hide.bs.modal', function (e) {

                var $this = $(this),
                    $news = $this.find('.layout_full'),
                    pageAlias = $('body').data('page-alias') == 'startseite' ? '' : $('body').data('page-alias'),
                    modalHistoryDelete = $this.data('history-delete'),
                    newsHistoryDelete = $news.data('history-delete'),
                    newsHistoryBase = $news.data('history-base'),
                    newHistory = location.href.replace('/' + (newsHistoryDelete ? newsHistoryDelete : modalHistoryDelete), '');

                newHistory = pageAlias != newsHistoryBase ? newHistory.replace(newsHistoryBase, pageAlias) : newHistory;

                // reset history
                history.pushState(null, null, newHistory);
            });
        },
        setUrlHistoryFromModalLink: function () {
            $('[data-toggle="modal"]').on('click', function (e) {

                e.stopPropagation();

                var $this = $(this);

                $('.modal').data('history-back', window.location);

                history.pushState(null, null, $this.attr('href'));


            });
        },
        loadModalFromUrl: function () {
            $('.modal.in').modal('show');
        },
        initDateTimePicker: function () {
            var defaults = {
                lang: $('html').attr('lang'),
                startDate: new Date(),
                icons: {
                    time: 'fa fa-clock-o',
                    date: 'fa fa-calendar',
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down'
                }
            };

            $('.datepicker').each(function (k, item) {
                var $this = $(this),
                    $input = $this.find('input');

                $this.datetimepicker($.extend({timepicker: false, format: $input.data('format')}, defaults));
            });

            $('.timepicker').each(function (k, item) {
                var $this = $(this),
                    $input = $this.find('input');

                $input.datetimepicker($.extend({datepicker: false, step: $input.data('steps'), format: $input.data('format')}, defaults));

                $this.find('.input-group-addon').click(function(){
                    $input.datetimepicker('show');
                });
            });
        },
		initSlider: function() {
			$('input.slider').slider();
		},
        toggleCollapseFromHash: function () {
            var $toggle = $(location.hash + '.collapse');

            if (!location.hash || $toggle.length < 1) return false;

            // close all open panels
            $toggle.closest('.panel-group').find('.collapse').removeClass('in');

            // toggle anchor panel id
            $toggle.addClass('in');
        },
        openModalFromHash: function () {
            var $toggle = $(location.hash);

            if (!location.hash || $toggle.length < 1 || !$toggle.hasClass('modal')) return false;

            $toggle.modal('show');
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
        addChosenSupport: function () {
            $('select.tl_chosen').chosen({width: '100%'}); // 100% = responsive support
        }
    };

    $(document).ready(function () {
        // determine if bootstrap 3 is loaded
        if ((typeof $().emulateTransitionEnd == 'function')) {
            Bootstrapper.init();
        }
    });

})(jQuery);