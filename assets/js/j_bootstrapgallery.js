(function ($) {
    $(document).ready(function () {
        var $blueimpHtml = $('<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev"><span>‹</span></a><a class="next"><span>›</span></a><a class="close"><span>×</span></a><a class="play-pause"><span></span></a><ol class="indicator"></ol></div>');

        $blueimpHtml.appendTo('body');

        $('a[data-lightbox]').each(function (k, item) {
            var $this = $(this),
                galleryId = $this.data('lightbox');


            // provide gallery functionality for slick slider
            if ($this.parents('.slick').length > 0){
                var $slick = $this.closest('.slick-slide');

                // skip cloned slick items
                if($slick.length > 0 && $slick.hasClass('slick-cloned')){
                    return true;
                }
            }

            if (!$this.data('gallery') && galleryId) {
                $this.attr('data-gallery', '#blueimp-gallery-' + galleryId);
            }
        });

        $('a[data-lightbox]').on('click', function(event){
            event = event || window.event;
            var target = event.target || event.srcElement,
                link = target.src ? target.parentNode : target,
                options = {index: link, event: event},
                gallery = $('[data-gallery=' + $(this).data('gallery') + ']'),
                links = [this];

            if(gallery.length > 0){
                links = gallery;
            }

            blueimp.Gallery(links, options);
            return false;
        });
    });


})(jQuery);