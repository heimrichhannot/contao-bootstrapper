(function($) {
    var BsCollapsePicker = {
        init: function() {
            this.toggleCollapseFromHash();
            this.openModalFromHash();
            this.toggleTabFromHash();
            this.setHashFromCollapse();

            // ajax complete
            $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
        },
        toggleCollapseFromHash: function() {
            var hash = location.hash.replace(/#/g, ''); // remove if more than # sign

            if (!hash) return false;

            var $toggle = $('#' + hash + '.collapse'),
                $link = $('[href=\'#' + hash + '\'], [data-target=\'#' + hash + '\']');

            if ($toggle.length < 1) return false;

            var $parent = $($link.data('parent'));

            // close all open panels
            if ($parent.length > 0) {
                $($link.data('parent')).find('.collapse').removeClass('in');
                $($link.data('parent')).find('[data-toggle=collapse]').addClass('collapsed');
            }

            // toggle anchor panel id
            $toggle.collapse('show');
            $link.removeClass('collapsed');

            // scroll to panel
            HASTE_PLUS.scrollTo($toggle, 100, 500);
        },
        openModalFromHash: function() {
            var hash = location.hash.replace(/#/g, '').replace(/is/g, 'or'); // remove if more than # sign

            if (!hash) return false;

            var $toggle = $('#' + hash);

            if ($toggle.length < 1 || !$toggle.hasClass('modal')) return false;

            $toggle.modal('show');
        },
        toggleTabFromHash: function() {
            var hash = location.hash.replace(/#/g, ''); // remove if more than # sign

            if (!hash) return false;

            var $pane = $('#' + hash),
                $link = $('[href=\'#' + hash + '\']');

            var $links = $link.closest('.tabcontrol_tabs'),
                $panes = $pane.closest('.tabcontrol_panes');

            // close all open panels
            if ($links.length > 0 && $panes.length > 0) {
                $links.find('a').parent().removeClass('active');
                $panes.find('.tab-pane').removeClass('in').removeClass('active');

                // toggle anchor panel id
                $pane.addClass('active').addClass('in');
                $link.parent().addClass('active');
            }
        },
        setHashFromCollapse: function() {
            var $collapse = $('.collapse');

            $collapse.each(function() {
                var $this = $(this);

                if ($this.hasClass('navbar-collapse'))
                    return;

                $this.on('shown.bs.collapse', function(e) {
                    if (this.id && window.history && window.history.pushState) {
                        history.pushState({}, document.title, location.pathname + location.search + '#' + this.id);
                    }
                });

                $this.on('hidden.bs.collapse', function(e) {
                    if (this.id && typeof history.replaceState !== 'undefined') {
                        history.replaceState({}, document.title, location.pathname + location.search);
                    }
                });
            });
        },
        ajaxComplete: function() {
        }
    };

    $(document).ready(function() {
        BsCollapsePicker.init();
    });

})(jQuery);