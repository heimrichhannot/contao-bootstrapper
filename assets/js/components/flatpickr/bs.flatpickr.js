(function($) {
    var FlatPickr = {
        init: function() {
            this.initFlatPickr();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        initFlatPickr: function() {
            var defaults = {
                allowInput: true,
                locale: $('html').attr('lang'),
                time_24hr: true
            };

            $('.datepicker, .timepicker').each(function() {
                var $this = $(this),
                    $form = $this.closest('form'),
                    $input = $this.find('input'),
                    data = $input.data(),
                    $linkedStart = $form.find(data.linkedStart),
                    $linkedEnd = $form.find(data.linkedEnd),
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
                    $mobileInput.val(moment(dateStr, (data['iso8601Format'] || data['momentDateFormat'])).format(getDatimeFormat($this)));
                }

                options.defaultDate = $input.val();

                for (var k in data) {
                    if (data.hasOwnProperty(k)) {
                        options[k] = data[k];
                    }
                }

                options.onReady = function() {
                    var dateStr = $this.find('input:not(.flatpickr-mobile)').val();

                    if (dateStr !== '') {
                        setNativeValue($this.siblings('.flatpickr-mobile'), dateStr);
                    }
                };

                options.onChange = function(selectedDates, dateStr, instance) {
                    var date = selectedDates[0];

                    if ($linkedStart.length > 0) {
                        if ($linkedStart.val() !== '' && moment(date).isBefore(moment($linkedStart.val(), ($linkedStart.data('iso8601Format') || $linkedStart.data('momentDateFormat'))))) {
                            $linkedStart.val(dateStr);

                            // native support
                            setNativeValue($linkedStart.closest('.flatpickr-input').next('.flatpickr-mobile'), dateStr);
                        }
                    }

                    if ($linkedEnd.length > 0) {
                        if ($linkedEnd.val() !== '' && moment(date).isAfter(moment($linkedEnd.val(), ($linkedEnd.data('iso8601Format') || $linkedEnd.data('momentDateFormat'))))) {
                            $linkedEnd.val(dateStr);

                            // native support
                            setNativeValue($linkedEnd.closest('.flatpickr-input').next('.flatpickr-mobile'), dateStr);
                        }
                    }

                    $input.val(dateStr);
                };

                $this.flatpickr(options);

                $input.on('keyup', function(e) {
                    if (e.keyCode === 13) {
                        $input.closest('form').submit();
                    }
                });
            });
        },
        ajaxComplete: function() {
            this.initFlatPickr();
        }
    };

    $(document).ready(function() {
        FlatPickr.init();
    });

})(jQuery);
