(function($) {
  var BsSwitch = {
    init: function() {
      this.initSwitch();

      // ajax complete
      $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
    },
    initSwitch: function() {
      $('[data-switch="toggle"]').bootstrapSwitch();
    },
    ajaxComplete: function() {
      this.initSwitch();
    },
  };

  $(function() {
    if (typeof($.fn.bootstrapSwitch) != 'undefined') {
      BsSwitch.init();
    }
    ;
  });

})(jQuery);