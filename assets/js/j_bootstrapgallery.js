(function($){
	$(document).ready(function(){
			var $blueimpHtml = $('<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><h3 class="title"></h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>');

			$blueimpHtml.appendTo('body');

			$('a[data-lightbox]').each(function(k, item){
				var $this = $(this),
					galleryId = $this.data('lightbox');

				if(!$this.data('gallery') && galleryId ){
					$this.attr('data-gallery', '#blueimp-gallery-' + galleryId);
				}
			});
	});
	
})(jQuery);