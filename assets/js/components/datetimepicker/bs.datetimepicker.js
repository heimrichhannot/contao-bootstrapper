(function ($) {
    var BsDatetimePicker = {
        init : function(){

            this.initDateTimePicker();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        initDateTimePicker : function(){
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
        ajaxComplete : function(){
            this.initDateTimePicker();
        }
    }

    $(document).ready(function () {
        BsDatetimePicker.init();
    });

})(jQuery);