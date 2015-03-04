(function($){
	$(document).ready(function(){
			var $blueimpHtml = $('<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>');

			$blueimpHtml.appendTo('body');

			$('a[data-lightbox]').each(function(k, item){
				var $this = $(this),
					galleryId = $this.data('lightbox');

                // skip slick slider, done after init callback
                if($this.parents('.slick').length > 0) return true;

				if(!$this.data('gallery') && galleryId ){
					$this.attr('data-gallery', '#blueimp-gallery-' + galleryId);
				}
			});

            $('.slick').on('init', function(){

                // blueimp support for non-cloned slick items
                $(this).find('.slick-slide:not(.slick-cloned) a[data-lightbox]').each(function(){
                    var $this = $(this),
                        galleryId = $this.data('lightbox');

                    if(!$this.data('gallery') && galleryId ){
                        $this.attr('data-gallery', '#blueimp-gallery-' + galleryId);
                    }
                });

            });
	});
	
})(jQuery);