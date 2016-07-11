(function($){
    var BsTooltips = {
        init : function(){
            this.initTooltip();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        initTooltip : function(){
            $('[data-toggle="tooltip"]').tooltip();
        },
        ajaxComplete : function(){
            this.initTooltip();
        }
    };

    $(function () {
        BsTooltips.init();
    })

})(jQuery);