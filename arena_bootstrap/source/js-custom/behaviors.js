/**
 * @file
 * Provides jQuery behaviors.
 */

(function ($) {
  /**
   * Manipulate page elements to make them different.
   */
  Drupal.behaviors.legacyHeavyLifting = {
    attach: function (context, settings) {
      // WIP: from prototype-only.js.
      $('#secondary-nav li a', context).each(function () {
        if ($(this).attr('href') == '#') {
          $(this).addClass('inactive');
        }
        if (($(this).text() == $('h1').text()) ||
          ($(this).text() == $('.parent').text())) {

          $(this).addClass('active');
        }
      });
      $('#primary-nav li a', context).each(function () {
        if ($(this).attr('href') == '#') {
          $(this).addClass('inactive');
        }
      });

      // Remove default drupal classes on the fly.
      var search_form = $('#search-block-form');
      if (search_form.length) {
        search_form.find('input[type=text]').removeClass('form-control');
      }

      // WIP: from scripts.js.
      var windowWidth = $(window).width();
      var searchbar = $('#search-block-form');
      var mobile = windowWidth <= 700;
      var tablet = (windowWidth < 925) && (windowWidth > 700);

      function pageDimensions() {
        $('#search-block-form').css('height', 'auto');
        var windowHeight = $(window).height();
        var page_height = $('body').height();
        var level2Height = $('#navMeasurer').height();
        var minWinHeight = $('.firstLevel').height();
        var minContentHeight = minWinHeight - 160;
        // console.log('window height = ' + windowHeight);.
        // console.log('page height = ' + page_height);.
        // console.log('min-window height = ' + minWinHeight);.
        // console.log('level 2 Height = ' + level2Height);.
        if (!mobile) {
          if (level2Height > minWinHeight) {
            minWinHeight = level2Height;
          }
          $('#content, #sidebar').css('min-height', 0);
          if (windowHeight > minWinHeight) {
            $('#sidebar').height(windowHeight);
            minContentHeight = windowHeight - 160;
            // $('#sitecontainer').height(windowHeight);.
            if (!tablet) {
              $('.secondLevel').height(windowHeight);
              // $('#siteContainer').height('auto');.
            }
            if ($('body.home').length) {
              $('body').addClass('fill');
            }
          }
          else {
            // height();.
            $('#sidebar').css('min-height', minWinHeight);
            if (!tablet) {
              if (page_height > minWinHeight) {
                $('.secondLevel').height(page_height);
              }
              else {
                $('.secondLevel').height(minWinHeight);
              }
            }
            if ($('body.fill').length) {
              $('body').removeClass('fill');
            }
          }
          $('#content').css('min-height', minContentHeight);
          if (windowHeight > minWinHeight) {
            // Makes the nav stay put if the screen is tall enough.
            $('#sideWrapper').addClass('stick');
          }
          else {
            $('#sideWrapper').removeClass('stick');
          }
        }
        else {
          $('#content').css('min-height', '');
        }
      }

      function moveElement(element, target, action) {
        if (action == "prep") {
          target.prepend(element);
        }
        else if (action == "app") {
          target.append(element);
        }
        else if (action == "before") {
          target.before(element);
        }
        else if (action == "after") {
          target.after(element);
        }
      }

      function relocation() {
        if ($('html.mediaqueries').length) {
          windowWidth = $('html').width();
          mobile = windowWidth <= 683;
          tablet = (windowWidth < 925) && (windowWidth > 683);
          // Tablet.
          if (tablet) {
            if (!$('#secondary-nav').parent('li.active', '#primary-nav').length) {
              moveElement($('#secondary-nav'), $('li.active', '#primary-nav'), "app");
            }
            if (!$('#ARENAlogo').parent('#innerMain').length) {
              moveElement($('#ARENAlogo'), $('#innerMain'), "prep");
            }
            if (!$('header').parent('#main').length) {
              moveElement($('header'), $('#main'), "prep");
            }
            if (!$('#extraNav').siblings('#primary-nav').length) {
              moveElement($('#extraNav'), $('#primary-nav'), "after");
            }
            if (!searchbar.parent('.firstLevel', '#sidebar').length) {
              moveElement(searchbar, $('.firstLevel', '#sidebar'), "prep");
            }
            if (!$('#navMeasurer').parent('.secondLevel', '#sidebar').length) {
              moveElement($('#navMeasurer'), $('.secondLevel', '#sidebar'), "app");
            }
            if (!$('#navMeasurer').parent('#header .wrapper').length) {
              moveElement($('#tools'), $('#header .wrapper'), "app");
            }
          }
          // Mobile.
          else if (mobile) {
            if (!$('#ARENAlogo').parent('#sideWrapper').length) {
              moveElement($('#ARENAlogo'), $('#sideWrapper'), "prep");
            }
            if (!$('header').siblings('#skipToContent').length) {
              moveElement($('header'), $('#skipToContent'), "after");
            }
            if (!searchbar.siblings('#govlogo').length) {
              moveElement(searchbar, $('#govlogo'), "after");
            }
            if (!$('#extraNav').parent('#contentArea').length) {
              moveElement($('#extraNav'), $('#contentArea'), "app");
            }
            if (!$('#navMeasurer').parent('#innerContainer').length) {
              moveElement($('#navMeasurer'), $('#innerContainer'), "prep");
            }
            if (!$('#tools').siblings('#sideWrapper').length) {
              moveElement($('#tools'), $('#sideWrapper'), "after");
            }
            if (!$('#secondary-nav').parent('.region-sidebar-first', '#navMeasurer').length) {
              moveElement($('#secondary-nav'), $('.region-sidebar-first', '#navMeasurer'), "app");
            }
          }
          // Desktop.
          else {
            if (!$('#secondary-nav').parent('.region-sidebar-first', '#navMeasurer').length) {
              moveElement($('#secondary-nav'), $('.region-sidebar-first', '#navMeasurer'), "app");
            }
            if (!$('#ARENAlogo').parent('#innerMain').length) {
              moveElement($('#ARENAlogo'), $('#innerMain'), "prep");
            }
            if (!$('header').parent('#main').length) {
              moveElement($('header'), $('#main'), "prep");
            }
            if (!searchbar.parent('.firstLevel', '#sidebar').length) {
              moveElement(searchbar, $('.firstLevel', '#sidebar'), "prep");
            }
            if (!$('#extraNav').siblings('#primary-nav').length) {
              moveElement($('#extraNav'), $('#primary-nav'), "after");
            }
            if (!$('#navMeasurer').parent('.secondLevel', '#sidebar').length) {
              moveElement($('#navMeasurer'), $('.secondLevel', '#sidebar'), "app");
            }
            if (!$('#tools').siblings('#govlogo').length) {
              moveElement($('#tools'), $('#govlogo'), "after");
            }
          }
        }
      }

      function mobileOnly() {
        windowWidth = $(window).width();
        mobile = windowWidth <= 700;
        tablet = (windowWidth < 925) && (windowWidth > 700);
        var search_field = searchbar.find('input[type=text]');

        if (mobile) {
          // Search extension.
          search_field.on('blur', function () {
            setTimeout(function () {
              search_field.removeClass('open');
            }, 150);
          });
          searchbar.find('label').click(function () {
            if (search_field.hasClass('open')) {
              searchbar.submit();
            }
            else {
              setTimeout(function () {
                search_field.addClass('open');
              }, 150);
            }
          });
          if ($('table').length) {
            $('table').each(function () {
              if (!$(this).parent().hasClass('tableWrapper')) {
                $(this).wrap('<div class="tableWrapper"></div>');
              }
            });
          }
          // Nav extenders.
          $('#mobileNavOpener').click(function () {
            $('#innerContainer').addClass('shift');
          });
          $('#mobileCloseNav').click(function () {
            $('#innerContainer').removeClass('shift');
          });
          if (!$('.extender').length) {
            $('ul', '#secondary-nav').siblings('a').prepend('<span class="extender"><span>+</span></span>');
            $('.extender', '#secondary-nav').click(function () {
              if ($(this).hasClass('open')) {
                $(this).removeClass('open').find('span').text('+').closest('a').siblings('ul').slideUp();
              }
              else {
                $(this).addClass('open').find('span').html('&ndash;').closest('a').siblings('ul').slideDown();
              }
              return false;
            });

            $('li.active > a .extender', '#secondary-nav').addClass('open').find('span').html('&ndash;');
          }
          $('#sidebar').show();
          $('#ARENAlogo').show();
          setTimeout(function () {
            $('#primary-nav').find('li:even').each(function () {
              var first = $(this);
              var second = $(this).next();
              var both = first.add(second);
              both.find('a').height('auto');
              if (first.height() != second.height()) {
                both.addClass('activate');
                $('#primary-nav .activate a').equalHeights();
                $('.activate').removeClass('activate');
              }
            });
          }, 100);
        }
      }

      relocation();
      mobileOnly();
      pageDimensions();
      $(window).resize(function () {
        relocation();
        pageDimensions();
        mobileOnly();
      });
      function onFocus() {
        relocation();
      }

      // Check for Internet Explorer.
      if (/*@cc_on!@*/false) {
        document.onfocusin = onFocus;
      }
      else {
        window.onfocus = onFocus;
      }
      if ($('article dl').length) {
        $('dl').each(function () {
          $(this).find('dd').append('<div class="clearfix"></div>');
        });
      }
      if ($('#updates').length) {
        $('#updates').find('li:odd').addClass('alt');
      }
      if ($('#accordionListing').length) {
        $('#accordionListing > dt').append('<span class="toggler"><span class="arrow"></span></span>');
        $('#accordionListing > dt').click(function () {
          $('#accordionListing > dd').slideUp();
          if ($(this).hasClass('open')) {
            $(this).removeClass('open');
          }
          else {
            $('#accordionListing > dt').removeClass('open');
            $(this).addClass('open').next('dd').slideDown();
          }
        });
      }
      $('#comment-block').css('top', $('#tools').height());
      $('#tools #comment, #comment-block .close-comment').click(function () {
        $(this).toggleClass('active');
        if ($('#comment-block').is(':visible')) {
          $('#comment-block').fadeOut(100);
        }
        else {
          $('#comment-block').fadeIn(100);
        }
      });
      // Stylise the select boxes.
      if ($('select', '#main, .form').length) {
        $('select', '#main, .form').each(function () {
          $(this).wrap('<div class="styled-select"></div>');
          if ($(this).hasClass('error')) {
            $(this).parent().addClass('error');
          }
        });
      }
      if ($('input[type=checkbox]').length) {
        if ($('#states').length) {
          $('label[for="all"]').click(function () {
            $('#states input[type="checkbox"]:checked').removeAttr('checked').next('label').removeClass('on');
            $(this).addClass('on');
            $('#all').attr('checked', 'checked');
          });
          $('label:not([for="all"])').click(function () {
            // .removeClass('on');.
            $('#all').removeAttr('checked').prev('label');
          });
        }
        $('input[type=checkbox]:checked').each(function () {
          var id = $(this).attr('id');
          $(this).parent().find('label[for="' + id + '"]').addClass('on');
        });

        $('input[type=checkbox]').next('label').click(function () {
          if (!$(this).is('label[for="all"]')) {
            $(this).toggleClass('on');
            $('label[for="all"]').removeClass('on');
          }
        });
      }
      if ($('#pagination').length) {
        var btns = $('.prev,.next', '#pagination');
        var btn_height = btns.height();
        if (btn_height > 30) {
          btns.css('line-height', btn_height + 'px');
        }
        $('#pagination .prev').parent().addClass('prev');
        $('#pagination .next').parent().addClass('next');
      }
    }
  };

  Drupal.behaviors.legacyModernizr = {
    attach: function (context, settings) {
      if ($('.sortableTablebyyearnosearch', context).length) {
        oTable = $('.sortableTablebyyearnosearch').DataTable({
          'bLengthChange': true,
          'bProcessing': true,
          'iDisplayLength': 10,
          'bAutoWidth': false,
          'order': [[2, "desc"]],
          'sDom': 'lrtip'
        });
        $('#dtcustomsearch').keyup(function () {
          oTable.search($(this).val()).draw();
        });
      }
      if ($('.sortableTable', context).length) {
        $('.sortableTable').DataTable({
          'bLengthChange': true,
          'bProcessing': true,
          'iDisplayLength': 10,
          'bAutoWidth': false
        });
      }
      if ($('.sortableTablebyyear',context).length) {
        $('.sortableTablebyyear').DataTable({
          'bLengthChange': true,
          'bProcessing': true,
          'iDisplayLength': 10,
          'bAutoWidth': false,
          'order': [[2, "desc"]]
        });
      }
    }
  };
  Drupal.behaviors.domMinipulations = {
    attach: function (context) {
      "use strict";

      // Remove ARENA prefix from news tags.
      if ($('#block-views-02f4db35c84c97b0f399a765c5be5a70',context).length) {
        $('.views-field-type > span', context).each(function() {
          var $this = $(this);
          $this.text($this.text().substr(5));
        });
      }

      // Remove ARENA prefix from Home page view.
      if ($('#block-views-ae4644b120ce5d473e2a7fb79c12fe9a',context).length) {
        $('.category',context).each(function() {
          var $this = $(this);
          $this.text($this.text().substr(5));
        });
      }

      // Add active class to the projects sub menus.
      if ($('#block-menu-menu-arena-projects-menu', context).length) {
        $('#block-menu-menu-arena-projects-menu .leaf > a', context).each(function () {
          var $this = $(this);
          var link = $this.attr('href').split('/');
          var link_class = link[2];
          if ($('#block-system-main').find('article').hasClass(link_class)) {
            $this.parent().addClass('active');
            $('#primary-nav').find('li.menu-mlid-4141').addClass('active-trail');
          }
        });
      }

      // Add active class to the news-media sub menus.
      var news_menu = '#block-menu-menu-news-media-menu';
      if ($(news_menu, context).length) {
        $(news_menu).find('.leaf > a', context).each(function () {
          var $this = $(this);
          var link = $this.attr('href').split('/');
          var link_class = link[2];
          $this.parent().addClass(link_class);
          $('#primary-nav').find('li.menu-mlid-4131').addClass('active-trail');
        });
        var path = window.location.pathname;
        var link = path.split('/');
        var first_path = link[1];
        switch (first_path) {
          case 'news':
            $(news_menu).find('li.news').addClass('active');
            break;
          case 'media':
            $(news_menu).find('li.media-releases').addClass('active');
            break;
          case 'speech_presentation':
            $(news_menu).find('li.speeches-presentations').addClass('active');
            break;
          default:
            $(news_menu).find('li.e-newsletters').addClass('active');
        }
      }
    }
  };

  Drupal.behaviors.psitDatatables = {
    attach: function (context) {
      // Add datatables plugin to any relevant tables.
      var $tables = $('.psit-table-view-datatables table', context);

      $tables.each(function (index, table) {
        $(table).DataTable();
      });
    }
  };

})(jQuery);

