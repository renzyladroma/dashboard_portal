/**
		 * Main scripts file
		 */
		(function($) {
		  'use strict';
		  /* Define some variables */
		  var app = $('.app'),
			searchState = false,
			menuState = false;

		  function toggleMenu() {
			if (menuState) {
			  app.removeClass('move-left move-right');
			  setTimeout(function() {
				app.removeClass('offscreen');
			  }, 150);
			} else {
			  app.addClass('offscreen move-right');
			}
			menuState = !menuState;
		  }


		  /******** Sidebar toggle menu ********/
		  $('[data-toggle=sidebar]').on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			toggleMenu();
		  });
		  $('.main-panel').on('click', function(e) {
			var target = e.target;
			if (menuState && target !== $('[data-toggle=sidebar]') && !$('.header-secondary')) {
			  toggleMenu();
			}
		  });
		  
		  /******** Sidebar menu ********/
  $('.sidebar-panel nav a').on('click', function(e) {
    var $this = $(this),
      links = $this.parents('li'),
      parentLink = $this.closest('li'),
      otherLinks = $('.sidebar-panel nav li').not(links),
      subMenu = $this.next();
    if (!subMenu.hasClass('sub-menu')) {
      toggleMenu();
      return;
    }
    otherLinks.removeClass('open');
    if (subMenu.is('ul') && (subMenu.height() === 0)) {
      parentLink.addClass('open');
    } else if (subMenu.is('ul') && (subMenu.height() !== 0)) {
      parentLink.removeClass('open');
    }
    if (subMenu.is('ul')) {
      return;
    }
    e.stopPropagation();
    return;
  });
  $('.sidebar-panel').find('> li > .sub-menu').each(function() {
    if ($(this).find('ul.sub-menu').length > 0) {
      $(this).addClass('multi-level');
    }
  });

		  
		})(jQuery);