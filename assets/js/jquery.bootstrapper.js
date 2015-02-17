(function ($) {

    var Bootstrapper = {
        init: function () {
            this.initFastClick();
            this.toggleCollapseFromHash();
            this.openModalFromHash();
            this.initModalNavigation();
            //this.initModalRemoteUpdate();
            this.initNavbar();
            this.navFollowLinkIfItemsOpen(); // must be initialized before supportNestedDropdowns, becaus supportNestedDropdowns adds class .open to links
            this.supportNestedDropdowns();
            this.addChosenSupport();
            this.initDateTimePicker();

            this.initSlider();
            // show news in modal window
            //this.setUrlHistoryFromModalLink();
            this.loadModalFromUrl();
            //this.onCloseModal();
            this.initCarouselProgressBar();
            this.initGalleryCarousel();
            this.addPlaceholderTagSupport();
            this.initJQueryValidation();
            this.initAjaxForms();
            this.initScrollClass();
            //this.initSelect2();
            this.megaMenuEqualHeight();
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
        initSelect2: function () {
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
                                } else {
                                    $form.replaceWith(replace);
                                }
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
            // move backward in history so url will be replaced with back link
            $('.modal').on('hide.bs.modal', function (e) {

                var $this = $(this);

                // back
                if($this.data('history-back')){
                    window.history.go(-1);
                }
            });
        },
        setUrlHistoryFromModalLink: function () {
            $('[data-toggle="modal"]').on('click', function (e) {

                var $this = $(this),
                    $target = $($(this).data('target'));

                $target.data('history-back', window.location);
                history.pushState(null, null, $this.attr('href'));
            });
        },
        loadModalFromUrl: function () {
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
                    $linkedStart = $($input.data('linked-start')),
                    $linkedEnd = $($input.data('linked-end'));

                $this.datetimepicker($.extend({format: $input.data('format')}, defaults));

                // is end -> link to start
                if($linkedStart.length > 0){
                    // set default min date
                    if(moment($linkedStart.val(), $input.data('format')).isValid()){
                        $this.data("DateTimePicker").minDate(moment($linkedStart.val(), $input.data('format')));
                    }

                    // on change - update start
                    $this.on("dp.change",function (e) {
                        $linkedStart.closest('.datepicker').data("DateTimePicker").maxDate(e.date);
                    });
                }

                // is start -> linked to end
                if($linkedEnd.length > 0){

                    if(moment($linkedEnd.val(), $input.data('format')).isValid())
                    {
                        $this.data("DateTimePicker").maxDate(moment($linkedEnd.val(), $input.data('format')));
                    }

                    // on change - update end
                    $this.on("dp.change",function (e) {
                        $linkedEnd.closest('.datepicker').data("DateTimePicker").minDate(e.date);
                    });
                }
            });
        },
        initSlider: function () {
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
            $('.tl_chosen').chosen({
                search_contains: true,
                no_results_text: 'Keine Ergebnisse für',
                placeholder_text_multiple: ' ',
                placeholder_text_single: ' ',
                width: '100%'
            }).change(function (event, selectedValue) {
                // workaround for updating list values (https://github.com/harvesthq/chosen/issues/1504)
                $(this).trigger('chosen:updated');
            });
        },
        initFastClick: function () {
            FastClick.attach(document.body);
        }
    };

    $(document).ready(function () {
        // determine if bootstrap 3 is loaded
        if ((typeof $().emulateTransitionEnd == 'function')) {
            Bootstrapper.init();
        }
    });

})(jQuery);

