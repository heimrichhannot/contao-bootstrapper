(function ($) {
    $(document).ready(function () {
        var $blueimpHtml = $('<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev"><span>‹</span></a><a class="next"><span>›</span></a><a class="close"><span>×</span></a><a class="play-pause"><span></span></a><ol class="indicator"></ol></div>');

        $blueimpHtml.appendTo('body');

        $('a[data-lightbox]').each(function (k, item) {
            var $this = $(this),
                galleryId = $this.data('lightbox');

            var $slick = $this.parents('.slick');

            // provide gallery functionality for slick slider
            if ($slick.length > 0) {
                var $slickSlide = $this.closest('.slick-slide');

                // add unique slick slider class, otherwise gallery will show images from other sliders on the same page
                galleryId += $.grep($slick.attr('class').split(' '), function (v, i) {
                    return v.indexOf('slick_uid_') === 0;
                }).join().replace('slick_uid_', '-');

                // skip cloned slick items
                if ($slickSlide.length > 0 && $slickSlide.hasClass('slick-cloned')) {
                    return true;
                }
            }

            if (!$this.data('gallery') && galleryId) {
                var title = $this.find('img').attr('alt');

                if ($this.closest('.image_container').find('.copyright').length > 0)
                {
                    title += ' (' + $this.closest('.image_container').find('.copyright').text().trim() + ')';
                }

                $this.attr('title', title);
                $this.attr('data-gallery', '#blueimp-gallery-' + galleryId);
            }
        });

        $('a[data-lightbox]').on('click', function (event) {

            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                $gallery = $('[data-gallery="' + $(this).data('gallery') + '"]'),
                links = [this];

            if ($gallery.length > 0) {
                links = $gallery;
            }

            var gallery = blueimp.Gallery(links, options);
            gallery.slide(links.index(this), 0); // slide to clicked image
            return false;
        });
    });


})(jQuery);