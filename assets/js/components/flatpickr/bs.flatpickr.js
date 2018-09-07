(function ($) {
    var FlatPickr = {
        init: function () {
            this.initFlatPickr();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        initFlatPickr: function () {
            var defaults = {
                allowInput: true,
                locale: $('html').attr('lang'),
                time_24hr: true
            };

            $('.datepicker, .timepicker').each(function () {
                var $this = $(this),
                    $form = $this.closest('form'),
                    $input = $this.find('input'),
                    data = $input.data(),
                    $linkedStart = 'undefined' !== typeof data && 'linkedStart' in data ? $form.find(data.linkedStart) : null,
                    $linkedEnd = 'undefined' !== typeof data && 'linkedEnd' in data ? $form.find(data.linkedEnd) : null,
                    options = $.extend({}, flatpickr.defaultConfig, defaults);

                function getDatimeFormat($input) {
                    var format;

                    if ($input.hasClass('datimepicker')) {
                        format = 'YYYY-MM-DDTHH:mm';
                    }
                    else if ($input.hasClass('datepicker')) {
                        format = 'YYYY-MM-DD';
                    }
                    else {
                        format = 'HH:mm';
                    }

                    return format;
                }

                function setNativeValue($mobileInput, dateStr) {

                    if ('undefined' === typeof data) {
                        return;

                    }

                    $mobileInput.val(moment(dateStr, (data['iso8601Format'] || data['momentDateFormat'])).format(getDatimeFormat($this)));
                }

                options.defaultDate = $input.val() ? $input.val() : new Date();

                for (var k in data) {
                    if (data.hasOwnProperty(k)) {
                        options[k] = data[k];
                    }
                }

                function setPlaceholder($mobileInput, placeholder) {
                    $mobileInput.attr('placeholder', placeholder);
                }

                function getDateFromInput($mobileInput) {
                    return $mobileInput.find('input:not(.flatpickr-mobile)').val();
                }

                function getPlaceholderFromInput($mobileInput) {
                    return $mobileInput.find('input:not(.flatpickr-mobile)').attr('placeholder');
                }

                options.onReady = function () {
                    var dateStr = getDateFromInput($this),
                        placeholder = getPlaceholderFromInput($this),
                        $mobileInput = $this.siblings('.flatpickr-mobile'),
                        selector = $this.find('input').attr('id');

                    if (null !== $linkedStart && $linkedStart.length > 0) {
                        $mobileInput = $('.' + selector + '.flatpickr-mobile');
                    }

                    if (null !== $linkedEnd && $linkedEnd.length > 0) {
                        $mobileInput = $('.' + selector + '.flatpickr-mobile');
                    }

                    if (dateStr !== '') {
                        setNativeValue($mobileInput, dateStr);
                    }

                    if (placeholder !== '') {
                        setPlaceholder($mobileInput, placeholder);
                    }

                    $mobileInput.wrap('<div class="input-group-wrapper ' + selector + '"></div>');
                };

                options.onChange = function (selectedDates, dateStr, instance) {
                    var date = selectedDates[0];

                    if (null !== $linkedStart && $linkedStart.length > 0) {
                        if ($linkedStart.val() !== '' && moment(date).isBefore(moment($linkedStart.val(), ($linkedStart.data('iso8601Format') || $linkedStart.data('momentDateFormat'))))) {
                            $linkedStart.val(dateStr);

                            // native support
                            setNativeValue($('.' + $linkedStart.attr('id') + '.flatpickr-mobile'), dateStr);
                        }
                    }

                    if (null !== $linkedEnd && $linkedEnd.length > 0) {
                        if ($linkedEnd.val() !== '' && moment(date).isAfter(moment($linkedEnd.val(), ($linkedEnd.data('iso8601Format') || $linkedEnd.data('momentDateFormat'))))) {
                            $linkedEnd.val(dateStr);

                            // native support
                            setNativeValue($('.' + $linkedEnd.attr('id') + '.flatpickr-mobile'), dateStr);
                        }
                    }

                    $input.val(dateStr);
                };

                $this.flatpickr(options);

                $input.on('keyup', function (e) {
                    if (e.keyCode === 13) {
                        $input.closest('form').submit();
                    }
                });
            });
        },
        ajaxComplete: function () {
            this.initFlatPickr();
        }
    };

    $(document).ready(function () {
        FlatPickr.init();
    });

})(jQuery);
