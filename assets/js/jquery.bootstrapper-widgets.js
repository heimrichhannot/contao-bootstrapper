(function ($) {

    var BotstrapperWidgets =
    {
        defaults: {
            'singleRadioSelectSelector': '.checkbox-single-select'
        },
        init: function () {
            this.singleRadioSelect();
        },
        singleRadioSelect: function () {
            $(BotstrapperWidgets.defaults.singleRadioSelectSelector).on('click', 'input:checkbox', function (e) {
                if ($(this).is(":checked")) {
                    var group = "input:checkbox[name='" + $(this).attr("name") + "']";
                    $(group).prop("checked", false);
                    $(this).prop("checked", true);
                } else {
                    $(this).prop("checked", false);
                }
            });
        }
    }

    $(document).ready(function () {
        BotstrapperWidgets.init();
    });

    $(document).ajaxComplete(function () {
        BotstrapperWidgets.init();
    });

})(jQuery);