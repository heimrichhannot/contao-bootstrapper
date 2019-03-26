(function($) {
    var BsSelect = {
        init: function() {
            this.initSelect();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        initSelect: function() {
            $('select:not(.tagsinput)').each(function() {
                var $select = $(this),
                    $options = $select.find('option'),
                    data = $select.data();

                var defaults = {
                    iconBase: 'fa',
                    tickIcon: 'fa-check',
                    style: 'btn-select',
                    size: 12,
                    liveSearch: $options.length >= 10,
                    mobile: (typeof Modernizr === 'object' && Modernizr.touchevents && /Mobi/i.test(navigator.userAgent)),
                    xsBreakpoint: 767
                };

                var config = $.extend({}, defaults, data);

                // mobile support
                if (config.mobile && screen.width <= config.xsBreakpoint) {
                    config.selectedTextFormat = 'count > 2';// display max of 2 options in button, than show count
                }

                if ($select.prop('multiple')) {
                    config.actionsBox = true;
                }

                $select.selectpicker(config);

                if (data.buttonHideTitle) {
                    BsSelect.hideButtonTitle($select);
                }

                // support removing element from button context, if .remove element does exists
                $select.parent('.bootstrap-select').on('click', '.btn-select', function(e) {
                    var $target = $(e.target),
                        val = $select.val();

                    if (!$target.hasClass('.remove') && $target.parent('.remove')) {
                        $target = $target.closest('.remove');
                    }

                    if (!$target.length || !$.isArray(val)) {
                        return true;
                    }

                    e.stopImmediatePropagation();
                    e.preventDefault();

                    var $remove = $select.parent('.bootstrap-select').find('.btn-select .remove'),
                        index = $remove.index($target);

                    var removeVal = val[index];

                    val = jQuery.grep(val, function(value) {
                        return value !== removeVal;
                    });

                    $select.selectpicker('val', val);
                    $select.selectpicker('render');
                    $select.trigger('change');
                });
            });
        },
        hideButtonTitle: function($select) {
            $select.parent('.bootstrap-select').find('.btn-select').removeAttr('title');

            // between change and title update is short delay --> timeout
            var changeTimeout;
            $select.on('changed.bs.select', function(event, clickedIndex, newValue, oldValue) {
                clearTimeout(changeTimeout);
                changeTimeout = window.setTimeout(function() {
                    $(event.target).parent('.bootstrap-select').find('.btn-select').removeAttr('title');
                }, 50);
            });
        },
        ajaxComplete: function() {
            this.initSelect();
        }
    };

    $(function() {
        BsSelect.init();
    });

})(jQuery);