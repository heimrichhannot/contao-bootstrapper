(function ($) {
    BsScrollSmooth = {};
    var intOffset = 0,
        intDuration = 'slow',
        easing = 'swing';
    BsScrollSmooth = {
        onReady: function () {
            this.scrollSmooth();

            if (intCustomDuration = $('body').data('scroll-smooth-duration')) {
                intDuration = intCustomDuration;
            }

            if (intCustomEasing = $('body').data('scroll-smooth-duration')) {
                easing = intCustomEasing;
            }
        },
        setOffset: function () {
            var $body = $('body'),
                offset = $body.data('scroll-smooth-offset');

            if (typeof offset !== 'undefined') {
                intOffset = isNaN(parseFloat(offset)) ? 0 : parseFloat(offset);

                if (intOffset == 0) {
                    var $offset = $(offset);

                    if ($offset.length > 0) {
                        $offset.each(function () {
                            intOffset += this.scrollHeight || this.offsetHeight;
                        });
                    }
                }
            }
        },
        scrollSmooth: function () {
            var self = this;
            $(document).on('click', 'a[href*="#"]:not([data-toggle])', function (e) {
                var parser = document.createElement('a'),
                    href = $(this).attr('href');

                parser.href = href;

                var anchor = parser.href.split('#')[1];

                // if link url is different to current and link href does not only contain an #anchor, first load the page
                if ((('/#'+anchor) != parser.href.replace(window.location.origin, '')) && (parser.href.split('#')[0] != window.location.href.split('#')[0])) {
                   return true;
                }

                BsScrollSmooth.scrollToHash(e, parser.hash, href);
            });
        },
        scrollToHash : function(event, hash, href) {
            this.setOffset();

            if (hash == '' || href == '') return true;

            var $anchor = $(hash);

            if ($anchor.length > 0) {

                if (null !== event) {
                    event.preventDefault();
                }

                var context = 'html, body',
                    $modal = $anchor.parents('.modal');

                // scroll to anchor inside modal
                if ($modal.length > 0) {
                    context += ', .modal';
                }

                $(context).animate({scrollTop: ($anchor.offset().top - intOffset)}, intDuration, $.easing.hasOwnProperty(easing) ? easing : null, function () {
                    if ($(this).is('body')) return;

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
    };

    $(function () {
        BsScrollSmooth.onReady();
    });

})(jQuery);
