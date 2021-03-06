(function($) {
  var BsInputSlider = {
    init: function() {

      this.initSlider();

      // ajax complete
      $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
    },
    initSlider: function() {

      $('.bootstrap-slider').each(function() {
        var $this = $(this),
            slider = $this.slider(),
            data = $this.data(),
            $rangeLabelFrom = $(data.sliderRangeLabelFrom),
            $rangeLabelTo = $(data.sliderRangeLabelTo);

        slider.slider().on('change', function(e) {

          if ($rangeLabelFrom.length && $rangeLabelFrom.data('sync') && $.isArray(e.value['newValue'])) {
            $rangeLabelFrom.find('.value').text(BsInputSlider.formatValue(e.value['newValue'][0]));
          }

          if ($rangeLabelTo.length && $rangeLabelTo.data('sync')) {
            $rangeLabelTo.find('.value').text(BsInputSlider.formatValue($.isArray(e.value['newValue']) ? e.value['newValue'][1] : e.value['newValue']));
          }
        });

      });
    },
    formatValue: function(value) {

      if (isNaN(parseFloat(value))) {
        return value;
      }

      // do only format floats
      if (Number(value) === value && value % 1 !== 0) {
        var $strFormat = '0.0';
        numeral.language($('html').attr('lang'));

        value = numeral(value).format($strFormat);
      }

      return value;
    },
    ajaxComplete: function() {
      this.initSlider();
    },
  };

  $(document).ready(function() {
    BsInputSlider.init();
  });

})(jQuery);