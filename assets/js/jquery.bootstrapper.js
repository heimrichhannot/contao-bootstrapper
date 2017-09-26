(function($) {
  Bootstrapper = {
    init: function() {
      this.initFastClick();
      this.toggleCollapseFromHash();
      this.openModalFromHash();
      this.toggleTabFromHash();
      this.initModalNavigation();
      //this.initModalRemoteUpdate();
      this.initNavbar();
      this.navFollowLinkIfItemsOpen(); // must be initialized before supportNestedDropdowns, becaus supportNestedDropdowns adds class .open to links
      this.supportNestedDropdowns();

      this.initModal();
      this.loadModalFromUrl();
      this.onCloseModal();
      this.initCarouselProgressBar();
      this.addPlaceholderTagSupport();
      this.initJQueryValidation();
      this.initAjaxForms();
      this.initScrollClass();
      this.megaMenuEqualHeight();
      this.setHashFromCollapse();
      this.initFileUpload();
      this.slideUpCollapse();

      this.initIosLabelBugFix();

      this.initTinyMceModalBugFix();

      // ajax complete
      $(document).ajaxComplete($.proxy(this.ajaxComplete, this));
    },
    locale: 'de',
    ajaxComplete: function() {
      this.initJQueryValidation();
    },
    slideUpCollapse: function() {
      $('.collapse.slideup').on('show.bs.collapse', function() {
        $('html, body').animate({scrollTop: $(document).height()}, 'slow');
      });
    },
    initFileUpload: function() {
      // clear fileinput always (as long as value is provided by server)
      $('.fileinput [data-dismiss]').on('click', function() {
        var $fileInput = $(this).parent('.fileinput');
        $fileInput.fileinput('clear');
        $fileInput.find('input[type=file]').attr('value', '');
      });
    },
    megaMenuEqualHeight: function() {

      $(window).on('resize', function() {
        makeEqualHeight();
      });

      makeEqualHeight();

      function makeEqualHeight() {
        // if level_3 submenu higher than level_2, we need to determine the max height of both and set it
        // otherwise, menu items will overlap the parent wrapper, because absolute positioned items wont inflate the parent wrapper
        $('[data-equal-height="ul.nav"]').each(function() {

          var $this = $(this),
              minBreakpoint = $this.data('equal-height-breakpoint-min'),
              maxInnerHeight = 0,
              maxOuterHeight = 0;

          if (minBreakpoint && $(window).width() <= minBreakpoint) {
            $this.css('height', 'auto');
            $this.find('.submenu-wrapper').css('height', 'auto');
            return true;
          }

          $this.find($this.data('equal-height')).each(function() {
            var actualInnerHeight = $(this).actual('innerHeight');
            actualOuterHeight = $(this).actual('outerHeight', {includeMargin: true});

            if (actualOuterHeight > maxOuterHeight) {
              maxOuterHeight = actualOuterHeight;
            }

            if (actualInnerHeight > maxInnerHeight) {
              maxInnerHeight = actualInnerHeight;
            }
          });

          $this.height(maxOuterHeight);
          $this.find('.submenu-wrapper').height(maxInnerHeight);
        });
      }

    },
    supportNestedDropdowns: function() {
      $('ul.dropdown-menu').on('click', 'a[data-toggle="dropdown"]', function(event) {
        // Avoid following the href location when clicking
        event.preventDefault();
        // Avoid having the menu to close when clicking
        event.stopPropagation();
        // If a menu is already open we close it
        $('ul.dropdown-menu [data-toggle=dropdown]').parent().removeClass('open');
        // opening the one you clicked on
        $(this).parent().addClass('open');
      });
    },
    initScrollClass: function() {
      $(window).on('scroll', function(e) {

        var distanceY = $(window).scrollTop();

        $('[data-spy="scroll"]').each(function() {
          var $this = $(this),
              scrollClass = $this.data('scrollclass'),
              offset = $this.data('offset') ? $this.data('offset') : 1;

          if (scrollClass == null) return true; // continue

          if (distanceY > offset) {
            $this.addClass(scrollClass);
          } else {
            $this.removeClass(scrollClass);
          }
        });
      });
    },
    initNavbar: function() {
      $('.navbar-collapse').on('show.bs.collapse', function() {
        $(this).addClass('open'); //  support (non .collapsing transition)
        $('body').addClass('navbar-open'); // immediately css transition support (non .collapsing transition)
      });

      $('.navbar-collapse').on('shown.bs.collapse', function() {
        $('body').addClass('navbar-show');
      });

      $('.navbar-collapse').on('hide.bs.collapse', function() {
        $('body').removeClass('navbar-show navbar-open');
        $(this).removeClass('open'); // immediately css transition support (non .collapsing transition)
      });

      // initial set
      if ($('.navbar-collapse').hasClass('show')) {
        $('body').addClass('navbar-show navbar-open');
        $(this).addClass('open'); // immediately css transition support (non .collapsing transition)
      }
    },
    addPlaceholderTagSupport: function() {
      if (!Modernizr.input.placeholder) {
        $('input, textarea').placeholder();
      }
    },
    initJQueryValidation: function() {
      var $forms = $('form.jquery-validation');

      if ($forms.length > 0) {
        $.validator.addMethod
        (
            'checkbox', function(value, element) {
              var blnChecked = false,
                  $group = $(element).closest('.form-group');

              if ($group.find('.control-label:first .mandatory').length > 0) {
                $group.find('input[type=checkbox]').each(function() {
                  if (this.checked) {
                    blnChecked = true;
                    return false;
                  }
                });
                return blnChecked;
              }
              return true;
            },
            $.validator.format('Dieses Feld ist ein Pflichtfeld.')
        );

        $forms.each(function() {
          $(this).validate({
            errorClass: 'error',
            focusInvalid: false,
            errorPlacement: function(error, element) {
              var $inputGroup = element.closest('.input-group');

              if ($inputGroup.length > 0) {
                error.insertAfter($inputGroup);
              }
              else {
                error.appendTo(element.closest('.form-group'));
              }
            },
          });
        });
      }
    },
    initAjaxForms: function() {
      $('body').on('submit', '.ajax-form', function(e) {

        var $form = $(this),
            $formData = $form.serializeArray();

        e.preventDefault();

        $formData.push({
          name: 'isAjax',
          value: '1',
        });

        $.ajax(
            $form.attr('action'),
            {
              data: $formData,
              method: $(this).attr('method'),
              success: function(data) {

                var replace,
                    data = '<div>' + data + '</div>';

                if ($form.data('replace')) {
                  replace = $(data).find($form.data('replace'));
                  if (replace !== undefined) {
                    $($form.data('replace')).html(replace);
                  }

                } else {

                  // html page returned
                  replace = $(data).find('#' + $form.attr('id'));
                  if (replace.length < 1) {
                    $form.html(data); // module handle ajax request, replace inner html
                    replace = $form;
                  } else {
                    $form.replaceWith(replace);
                  }
                }

                // sroll to first alert message or first error field
                var alert = replace.find('.alert:first, .error:first');

                if (alert.length > 0) {
                  var alertOffset = alert.offset();

                  $('html,body').animate({
                    scrollTop: parseInt(alertOffset.top) - 70 + 'px',
                  }, 500);
                }
              },
            }
        );
      });
    },
    initCarouselProgressBar: function() {

      var percent = 0,
          bar = $('.carousel-progress .progress-bar'),
          text = bar.find('.sr-only'),
          crsl = $('.carousel'),
          delay = 200,
          step = Math.floor(delay * 100 / parseInt(crsl.data('interval')));

      if (crsl.length <= 0) return;

      function progressBarCarousel() {
        if (percent > 0) {
          bar.removeClass('carousel-transition');
        }

        if (percent >= 100) {
          text.text('100%');
          bar.css({width: '100%'});
          percent = 100;
          crsl.carousel('next');
          bar.addClass('carousel-transition');
          return false;
        }

        bar.css({width: percent + '%'});
        text.text(percent + '%');
        percent += step;
      }

      var barInterval = setInterval(progressBarCarousel, delay);

      // disable default interval
      crsl.carousel({
        interval: false,
        pause: false,
      }).on('slide.bs.carousel', function() {
        clearInterval(barInterval);
      }).on('slid.bs.carousel', function() {
        percent = 0;
        barInterval = setInterval(progressBarCarousel, delay);
      });

      // hover support
      crsl.hover(function() {
        clearInterval(barInterval);
      }, function() {
        barInterval = setInterval(progressBarCarousel, delay);
      });

      // click support
      crsl.on('click', '.carousel-control, .carousel-indicators', function() {
        percent = 0;
        clearInterval(barInterval);
        bar.addClass('carousel-transition').css({width: '0%'});
      });

      // gestures/touch support

    },
    initModal: function() {
      $('body').on('click', '[data-toggle="modal"]', function(e) {
        var $this = $(this),
            $modal = $($this.data('target')),
            $replace = $modal.find('.modal-dialog');

        if (typeof $this.attr('href') === 'undefined' || $this.attr('href').charAt(0) == '#')
          return true;

        // heimrichhannot/contao-modal works within ajax scope
        if (HASTE_PLUS.getParameterByName('ag', $this.attr('href')) == 'modal') {
          return true;
        }

        e.preventDefault();

        if (window.history) {
          history.pushState({url: $this.attr('href')}, null, $this.attr('href'));
          if ($this.data('title')) {
            document.title = $this.data('title');
          }
        }

        $.ajax({
          'url': $this.attr('href'),
          'data': {
            'scope': 'modal',
            'target': $modal.attr('id'),
          },
        }).done(function(responseText, textStatus, jqXHR) {
          try {
            dataJson = $.parseJSON(responseText);

            if (dataJson.type == 'redirect') {
              if (typeof history.replaceState !== 'undefined') {
                history.replaceState({url: dataJson.url}, null, dataJson.url);
              }
              $replace.load(dataJson.url, function(responseText, textStatus, jqXHR) {
                $modal.modal('show');
              });

              return false;
            }
          } catch (e) {
            // fail silently
          }

          $replace.html(responseText);
          $modal.modal('show');
        });

        return false;
      });
    },
    onCloseModal: function() {
      $(document).on('hide.bs.modal', '.modal', function(e) {
        var $this = $(this);

        // stop embedded videos like youtube
        $this.find('iframe').each(function() {
          var $this = $(this);

          // reset the src will stop the video
          $this.attr('src', $this.attr('src').replace('autoplay=1', 'autoplay=0'));
        });

        // stop embedded audio/video
        $this.find('audio, video').each(function() {
          this.pause();
        });

        if (window.history) {
          // set url to history-base-filtered if set (modal content replaced via ajax)
          history.replaceState({url: $this.data('history-base')}, null, $this.data('history-base'));

          if ($this.data('history-base-title')) {
            document.title = $this.data('history-base-title');
          }
        }
      });
    },
    loadModalFromUrl: function() {
      if ($('.modal.in').length > 0)
        $('.modal.in').modal('show');
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
    toggleCollapseFromHash: function() {
      var hash = location.hash.replace(/#/g, ''); // remove if more than # sign

      if (!hash) return false;

      var $toggle = $('#' + hash + '.collapse'),
          $link = $('[href=\'#' + hash + '\']');

      if ($toggle.length < 1) return false;

      var $parent = $($link.data('parent'));

      // close all open panels
      if ($parent.length > 0) {
        $($link.data('parent')).find('.collapse').removeClass('in');
        $($link.data('parent')).find('[data-toggle=collapse]').addClass('collapsed');
      }

      // toggle anchor panel id
      $toggle.addClass('in show');
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
    initModalNavigation: function() {
      $('.modal').on('click', '.modal-next', function(e) {
        e.preventDefault();

        window.location = $(this).attr('href');
      });
    },
    initModalRemoteUpdate: function() {
      $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
      });

      $('a[data-toggle="modal"][data-remote]').on('click', function(e) {
        e.preventDefault();

        var $this = $(this),
            $target = $($this.data('target'));

        $.ajax({url: $this.attr('href')}).done(function(data) {
          $target.find('.modal-content').replaceWith(data).end().modal();
        });

        // Now return a false (negating the link action) to prevent Bootstrap's JS 3.1.1
        // from throwing a 'preventDefault' error due to us overriding the anchor usage.
        return false;
      });
    },
    navFollowLinkIfItemsOpen: function() {
      // trigger click on open items
      $('.nav-collapse').on('click', 'a[data-toggle="dropdown"]', function(e) {
        var $this = $(this),
            $parent = $this.parent('li');

        // submenu is already open - follow parent link
        if (this.href !== undefined && $parent.hasClass('open')) {
          if (this.target.length) {
            window.open(this.href, this.target);
          } else {
            window.location = this.href;
          }

        }
      });
    },
    initFastClick: function() {
      FastClick.attach(document.body);
    },
    initIosLabelBugFix: function() {
      $('.ios .checkbox-label').each(function() {
        $(this).on('click', function() {
          var $input = $(this).siblings('input'),
              $inputAwesome = $(this).closest('.checkbox.checkbox-inline');

          if ($input.length > 0)
            $input.trigger('click');

          if ($inputAwesome.length > 0)
            $inputAwesome.find('input').trigger('click');
        });
      });

      $('.ios .radio-label').each(function() {
        $(this).on('click', function() {
          var $input = $(this).siblings('input'),
              $inputAwesome = $(this).closest('.radio.radio-inline');

          if ($input.length > 0)
            $input.trigger('click');

          if ($inputAwesome.length > 0)
            $inputAwesome.find('input').trigger('click');
        });
      });
    },
    initTinyMceModalBugFix: function() {
      $(document).on('focusin', function(e) {
        if ($(e.target).closest('.mce-window').length) {
          e.stopImmediatePropagation();
        }
      });
    },
    setLocale: function(locale) {
      this.locale = locale;
    },
    confirm: function(message, success, error) {
      bootbox.dialog({
        message: message,
        buttons: {
          error: {
            label: this.locale == 'en' ? 'No' : 'Nein',
            className: 'btn-default',
            callback: error,
          },
          success: {
            label: this.locale == 'en' ? 'Yes' : 'Ja',
            className: 'btn-primary',
            callback: success,
          },
        },
      });
    },
  };

  $(document).ready(function() {
    Bootstrapper.init();
  });

})(jQuery);
