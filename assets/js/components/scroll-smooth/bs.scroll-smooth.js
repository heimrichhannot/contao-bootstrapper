(function($) {
  var intOffset = 0,
      intDuration = 'slow',
      easing = 'swing',
      BsScrollSmooth = {
        onReady: function() {
          this.setOffset();
          this.scrollSmooth();

          if (intCustomDuration = $('body').data('scroll-smooth-duration')) {
            intDuration = intCustomDuration;
          }

          if (intCustomEasing = $('body').data('scroll-smooth-duration')) {
            easing = intCustomEasing;
          }
        },
        setOffset: function() {
          var $body = $('body'),
              offset = $body.data('scroll-smooth-offset');

          if (typeof offset !== 'undefined') {
            intOffset = isNaN(parseFloat(offset)) ? 0 : parseFloat(offset);

            if (intOffset == 0) {
              var $offset = $(offset);

              if ($offset.length > 0) {
                $offset.each(function() {
                  intOffset += $(this).actual('outerHeight');
                });
              }
            }
          }

          // add margin bottom from body
          intOffset -= parseFloat($body.css('marginBottom'));
        },
        scrollSmooth: function() {
          var self = this;
          $(document).on('click', 'a[href*="#"]:not([data-toggle])', function(e) {
            var parser = document.createElement('a'),
                href = $(this).attr('href');

            parser.href = href;

            // if link url is different to current, first load the page
            if (parser.href.split('#')[0] != window.location.href.split('#')[0]) {
              return true;
            }

            self.setOffset();

            scrollToHash(e, parser.hash, href);
          });

          function scrollToHash(event, hash, href) {

            if (hash == '' || href == '') return true;

            var $anchor = $(hash);

            if ($anchor.length > 0) {
              event.preventDefault();

              $('html, body').animate({scrollTop: ($anchor.offset().top - intOffset)}, intDuration, $.easing.hasOwnProperty(easing) ? easing : null, function() {
                if ($(this).is('body')) return;

                console.log(window.location.href + hash);

                if (history.pushState) {
                  history.pushState(null, null, window.location.href.split('#')[0] + hash);
                }
                else {
                  window.location.hash = hash;
                }
              });
            }

            return true;
          }
        },
      };

  $(function() {
    BsScrollSmooth.onReady();
  });

})(jQuery);