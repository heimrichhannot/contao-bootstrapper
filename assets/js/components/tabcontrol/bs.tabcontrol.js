(function($) {

    var BsTabControl = {
        self: null,
        config: {
            panel: null,
            panes: null,
            cookieDuration: 14 // in days
        },
        init: function(el) {
            this.config.panel = $(el);
            this.config.panes = this.config.panel.find('.ce_tabcontrol_pane');
            this.config.tabs = this.config.panel.find('[data-toggle="tab"]');

            $.extend(this.config, this.config.panel.data());

            self = this;

            self.registerEvents();
        },
        registerEvents: function() {
            self.config.tabs.on('show.bs.tab', function() {
                var index = $(this).data('cookie-value');
                self.setCookieIndex(index ? index : self.config.tabs.index(this));
            });
        },
        setCookieIndex: function(index) {
            if (!self.config.remember || self.config.cookie === '') {
                return false;
            }

            var date = new Date(),
                expires = '';

            if (self.config.cookieDuration) {
                date.setTime(date.getTime() + (self.config.cookieDuration * 24 * 60 * 60 * 1000));
                expires = '; expires=' + date.toUTCString();
            }

            document.cookie = self.config.cookie + '=' + index + expires + '; path=/';
        },
        getCookieIndex: function() {
            if (!self.config.remember || self.config.cookie === '') {
                return null;
            }

            var nameEQ = self.config.cookie + '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
    };

    $(function() {
        $('.ce_tabcontrol').each(function() {
            BsTabControl.init(this);
        });
    });

})(jQuery);