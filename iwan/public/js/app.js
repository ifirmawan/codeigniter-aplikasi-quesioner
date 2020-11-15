$(document).ready(function(){
/* ==========================================================================
	Scroll
	========================================================================== */

	/*if (!("ontouchstart" in document.documentElement)) {

		document.documentElement.className += " no-touch";

		var jScrollOptions = {
			autoReinitialise: true,
			autoReinitialiseDelay: 100
		};

		$('.scrollable .box-typical-body').jScrollPane(jScrollOptions);
		$('.side-menu').jScrollPane(jScrollOptions);
		$('.side-menu-addl').jScrollPane(jScrollOptions);
		$('.scrollable-block').jScrollPane(jScrollOptions);
	} */

/* ==========================================================================
    Header search
    ========================================================================== */

	$('.site-header .site-header-search').each(function(){
		var parent = $(this),
			overlay = parent.find('.overlay');

		overlay.click(function(){
			parent.removeClass('closed');
		});

		parent.clickoutside(function(){
			if (!parent.hasClass('closed')) {
				parent.addClass('closed');
			}
		});
	});

/* ==========================================================================
    Header mobile menu
    ========================================================================== */

	// Dropdowns
	$('.site-header-collapsed .dropdown').each(function(){
		var parent = $(this),
			btn = parent.find('.dropdown-toggle');

		btn.click(function(){
			if (parent.hasClass('mobile-opened')) {
				parent.removeClass('mobile-opened');
			} else {
				parent.addClass('mobile-opened');
			}
		});
	});

	$('.dropdown-more').each(function(){
		var parent = $(this),
			more = parent.find('.dropdown-more-caption'),
			classOpen = 'opened';

		more.click(function(){
			if (parent.hasClass(classOpen)) {
				parent.removeClass(classOpen);
			} else {
				parent.addClass(classOpen);
			}
		});
	});

	// Left mobile menu
	$('.hamburger').click(function(){
		if ($('body').hasClass('menu-left-opened')) {
			$(this).removeClass('is-active');
			$('body').removeClass('menu-left-opened');
			$('html').css('overflow','auto');
		} else {
			$(this).addClass('is-active');
			$('body').addClass('menu-left-opened');
			$('html').css('overflow','hidden');
		}
	});

	$('.mobile-menu-left-overlay').click(function(){
		$('.hamburger').removeClass('is-active');
		$('body').removeClass('menu-left-opened');
		$('html').css('overflow','auto');
	});

	// Right mobile menu
	$('.site-header .burger-right').click(function(){
		if ($('body').hasClass('menu-right-opened')) {
			$('body').removeClass('menu-right-opened');
			$('html').css('overflow','auto');
		} else {
			$('.hamburger').removeClass('is-active');
			$('body').removeClass('menu-left-opened');
			$('body').addClass('menu-right-opened');
			$('html').css('overflow','hidden');
		}
	});

	$('.mobile-menu-right-overlay').click(function(){
		$('body').removeClass('menu-right-opened');
		$('html').css('overflow','auto');
	});

/* ==========================================================================
    Header help
    ========================================================================== */

	$('.help-dropdown').each(function(){
		var parent = $(this),
			btn = parent.find('>button'),
			popup = parent.find('.help-dropdown-popup'),
			jscroll
		;

		btn.click(function(){
			if (parent.hasClass('opened')) {
				parent.removeClass('opened');
				jscroll.destroy();
			} else {
				parent.addClass('opened');

				if (!("ontouchstart" in document.documentElement)) {
					setTimeout(function(){
						jscroll = parent.find('.jscroll').jScrollPane(jScrollOptions).data().jsp;
					},0);
				}
			}
		});

		$('html').click(function(event) {
		    if (
		        !$(event.target).closest('.help-dropdown-popup').length
		        &&
		        !$(event.target).closest('.help-dropdown>button').length
		        &&
		        !$(event.target).is('.help-dropdown-popup')
		        &&
		        !$(event.target).is('.help-dropdown>button')
		    ) {
				if (parent.hasClass('opened')) {
					parent.removeClass('opened');
					jscroll.destroy();
		        }
		    }
		});
	});

/* ==========================================================================
    Side menu list
    ========================================================================== */

	$('.side-menu-list li.with-sub').each(function(){
		var parent = $(this),
			clickLink = parent.find('>span'),
			subMenu = parent.find('>ul');

		clickLink.click(function() {
			if (parent.hasClass('opened')) {
				parent.removeClass('opened');
				subMenu.slideUp();
				subMenu.find('.opened').removeClass('opened');
			} else {
				if (clickLink.parents('.with-sub').size() == 1) {
					$('.side-menu-list .opened').removeClass('opened').find('ul').slideUp();
				}
				parent.addClass('opened');
				subMenu.slideDown();
			}
		});
	});


/* ==========================================================================
    Dashboard
    ========================================================================== */

	$(window).resize(function(){
		$('body').click('click');
	});

	// Collapse box
	$('.box-typical-dashboard').each(function(){
		var parent = $(this),
			btnCollapse = parent.find('.action-btn-collapse');

		btnCollapse.click(function(){
			if (parent.hasClass('box-typical-collapsed')) {
				parent.removeClass('box-typical-collapsed');
			} else {
				parent.addClass('box-typical-collapsed');
			}
		});
	});

	// Full screen box
	$('.box-typical-dashboard').each(function(){
		var parent = $(this),
			btnExpand = parent.find('.action-btn-expand'),
			classExpand = 'box-typical-full-screen';

		btnExpand.click(function(){
			if (parent.hasClass(classExpand)) {
				parent.removeClass(classExpand);
				$('html').css('overflow','auto');
			} else {
				parent.addClass(classExpand);
				$('html').css('overflow','hidden');
			}
		});
	});


/* ==========================================================================
	Nestable
	========================================================================== */

	$('.dd-handle').hover(function(){
		$(this).prev('button').addClass('hover');
		$(this).prev('button').prev('button').addClass('hover');
	}, function(){
		$(this).prev('button').removeClass('hover');
		$(this).prev('button').prev('button').removeClass('hover');
	});



/* ==========================================================================
	Header notifications
	========================================================================== */

	// Tabs hack
	$('.dropdown-menu-messages a[data-toggle="tab"]').click(function (e) {
		e.stopPropagation();
		e.preventDefault();
		$(this).tab('show');

		// Scroll
		if (!("ontouchstart" in document.documentElement)) {
			jspMessNotif = $('.dropdown-notification.messages .tab-pane.active').jScrollPane(jScrollOptions).data().jsp;
		}
	});

	// Scroll
	var jspMessNotif,
		jspNotif;

	$('.dropdown-notification.messages').on('show.bs.dropdown', function () {
		if (!("ontouchstart" in document.documentElement)) {
			jspMessNotif = $('.dropdown-notification.messages .tab-pane.active').jScrollPane(jScrollOptions).data().jsp;
		}
	});

	$('.dropdown-notification.messages').on('hide.bs.dropdown', function () {
		if (!("ontouchstart" in document.documentElement)) {
			jspMessNotif.destroy();
		}
	});

	$('.dropdown-notification.notif').on('show.bs.dropdown', function () {
		if (!("ontouchstart" in document.documentElement)) {
			jspNotif = $('.dropdown-notification.notif .dropdown-menu-notif-list').jScrollPane(jScrollOptions).data().jsp;
		}
	});

	$('.dropdown-notification.notif').on('hide.bs.dropdown', function () {
		if (!("ontouchstart" in document.documentElement)) {
			jspNotif.destroy();
		}
	});

/* ==========================================================================
	Steps progress
	========================================================================== */

	function stepsProgresMarkup() {
		$('.steps-icon-progress').each(function(){
			var parent = $(this),
				cont = parent.find('ul'),
				padding = 0,
				padLeft = (parent.find('li:first-child').width() - parent.find('li:first-child .caption').width())/2,
				padRight = (parent.find('li:last-child').width() - parent.find('li:last-child .caption').width())/2;

			padding = padLeft;

			if (padLeft > padRight) padding = padRight;

			cont.css({
				marginLeft: -padding,
				marginRight: -padding
			});
		});
	}

	stepsProgresMarkup();

	$(window).resize(function(){
		stepsProgresMarkup();
	});

/* ========================================================================== */

	$('.control-panel-toggle').on('click', function() {
		var self = $(this);
		
		if (self.hasClass('open')) {
			self.removeClass('open');
			$('.control-panel').removeClass('open');
		} else {
			self.addClass('open');
			$('.control-panel').addClass('open');
		}
	});

	$('.control-item-header .icon-toggle, .control-item-header .text').on('click', function() {
		var content = $(this).closest('li').find('.control-item-content');

		if (content.hasClass('open')) {
			content.removeClass('open');
		} else {
			$('.control-item-content.open').removeClass('open');
			content.addClass('open');
		}
	});

	$.browser = {};
	$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
	$.browser.msie = /msie/.test(navigator.userAgent.toLowerCase());
	$.browser.mozilla = /firefox/.test(navigator.userAgent.toLowerCase());

	if ($.browser.chrome) {
		$('body').addClass('chrome-browser');
	} else if ($.browser.msie) {
		$('body').addClass('msie-browser');
	} else if ($.browser.mozilla) {
		$('body').addClass('mozilla-browser');
	}


});