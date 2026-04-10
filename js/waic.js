$(function () {

  /* ── PRELOADER ── */
  function hidePreloader() {
    $('#preloader').addClass('hidden');
    setTimeout(function () { $('#preloader').remove(); }, 600);
  }
  // Timeout de secours : max 2.5s peu importe l'état des ressources
  var preloaderTimeout = setTimeout(hidePreloader, 2500);
  $(window).on('load', function () {
    clearTimeout(preloaderTimeout);
    setTimeout(hidePreloader, 400);
  });

  /* ── WOW.js + IntersectionObserver fallback ── */
  if (typeof WOW !== 'undefined') {
    new WOW({ offset: 80, mobile: false }).init();
  } else {
    // Fallback natif si WOW.js ne charge pas (CDN inaccessible)
    var animatedEls = document.querySelectorAll('[class*="wow"]');
    if ('IntersectionObserver' in window && animatedEls.length) {
      var scrollObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            var el = entry.target;
            var delay = el.dataset.wowDelay || '0ms';
            var duration = el.dataset.wowDuration || '1000ms';
            el.style.transitionDelay = delay;
            el.style.animationDelay = delay;
            el.style.animationDuration = duration;
            el.classList.add('animate__animated', 'animate__fadeInUp');
            el.style.visibility = 'visible';
            scrollObserver.unobserve(el);
          }
        });
      }, { threshold: 0.15 });
      animatedEls.forEach(function(el) {
        el.style.visibility = 'hidden';
        scrollObserver.observe(el);
      });
    }
  }

  /* ── JARALLAX ── */
  if (typeof jarallax !== 'undefined') {
    jarallax(document.querySelectorAll('.jarallax'), { speed: 0.3 });
  }

  /* ── HERO SWIPER ── */
  if ($('.heroSwiper').length) {
    new Swiper('.heroSwiper', {
      loop: true,
      effect: 'fade',
      autoplay: { delay: 5500, disableOnInteraction: false },
      pagination: { el: '#heroPagination', clickable: true },
      navigation: { nextEl: '#heroNext', prevEl: '#heroPrev' },
      speed: 800,
    });
  }

  /* ── PARTNERS SWIPER ── */
  if ($('.partnersSwiper').length) {
    new Swiper('.partnersSwiper', {
      loop: true,
      autoplay: { delay: 3000, disableOnInteraction: false },
      speed: 600,
      slidesPerView: 2,
      spaceBetween: 40,
      breakpoints: {
        480: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        1024: { slidesPerView: 5 },
      },
    });
  }

  /* ── TESTIMONIALS OWL CAROUSEL ── */
  if ($('.testimonials-carousel').length) {
    $('.testimonials-carousel').owlCarousel({
      loop: true,
      autoplay: true,
      autoplayTimeout: 6000,
      margin: 24,
      nav: true,
      dots: false,
      smartSpeed: 500,
      navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
      responsive: {
        0: { items: 1 },
        768: { items: 1 },
        992: { items: 2 },
      },
    });
  }

  /* ── STICKY NAV ── */
  /* Visible uniquement en desktop (≥992px) — le CSS gère le display:none sur tablette/mobile */
  $(window).on('scroll.stickyNav', function () {
    var scrollTop = $(this).scrollTop();
    if (scrollTop > 120) {
      $('#stickyNav').addClass('active');
    } else {
      $('#stickyNav').removeClass('active');
    }
    /* scroll-to-top button */
    $('#scrollTop').toggleClass('visible', scrollTop > 400);
  });

  /* Fermer le menu mobile si on redimensionne vers desktop */
  $(window).on('resize.menuReset', function () {
    if ($(window).width() > 991) {
      closeMobileMenu();
    }
  });

  /* ── SCROLL TO TOP ── */
  $('#scrollTop').on('click', function () {
    $('html, body').animate({ scrollTop: 0 }, 500);
  });

  /* ── MOBILE MENU ── */
  function openMobileMenu() {
    $('#mobileMenu').addClass('open');
    $('#mobileOverlay').addClass('active');
    $('body').css('overflow', 'hidden');
  }
  function closeMobileMenu() {
    $('#mobileMenu').removeClass('open');
    $('#mobileOverlay').removeClass('active');
    $('body').css('overflow', '');
  }

  $('#mobileToggler, #mobileStickyToggler').on('click', function (e) {
    e.preventDefault();
    openMobileMenu();
  });
  $('#mobileMenuClose, #mobileOverlay').on('click', closeMobileMenu);

  /* ── EVENTS TABS ── */
  $('.events-tabs__nav li').on('click', function () {
    var tab = $(this).data('tab');
    $('.events-tabs__nav li').removeClass('active');
    $(this).addClass('active');
    var $panel = $('#' + tab);
    // Re-trigger CSS animation on each switch
    $('.events-tab-panel').removeClass('active');
    $panel.addClass('active');
    $panel[0].style.animation = 'none';
    $panel[0].offsetHeight; // reflow
    $panel[0].style.animation = '';
  });

  /* ── PROGRESS BARS (animate on scroll) ── */
  var progressAnimated = false;
  function animateProgress() {
    if (progressAnimated) return;
    var $section = $('.impact-split');
    if (!$section.length) return;
    var sectionTop = $section.offset().top;
    var windowBottom = $(window).scrollTop() + $(window).height();
    if (windowBottom > sectionTop + 100) {
      progressAnimated = true;
      $('.progress-bar-item__fill').each(function () {
        var $fill = $(this);
        var target = $fill.data('width');
        $fill.animate({ width: target + '%' }, 1500);
      });
      /* counter numbers in progress */
      $('.count-num').each(function () {
        var $num = $(this);
        var target = parseInt($num.data('target'));
        $({ n: 0 }).animate({ n: target }, {
          duration: 1500,
          step: function () { $num.text(Math.floor(this.n)); },
          complete: function () { $num.text(target); },
        });
      });
    }
  }

  /* ── STATS COUNTERS ── */
  var countersAnimated = false;
  function animateCounters() {
    if (countersAnimated) return;
    var $section = $('.stats-section');
    if (!$section.length) return;
    var sectionTop = $section.offset().top;
    var windowBottom = $(window).scrollTop() + $(window).height();
    if (windowBottom > sectionTop + 100) {
      countersAnimated = true;
      $('.counter').each(function () {
        var $this = $(this);
        var target = parseInt($this.data('target'));
        $({ n: 0 }).animate({ n: target }, {
          duration: 2000,
          easing: 'swing',
          step: function () { $this.text(Math.floor(this.n).toLocaleString()); },
          complete: function () { $this.text(target.toLocaleString()); },
        });
      });
    }
  }

  $(window).on('scroll', function () {
    animateProgress();
    animateCounters();
  });
  // Trigger on load too
  animateProgress();
  animateCounters();

  /* ── VIDEO POPUP ── */
  if ($('.video-popup').length && $.fn.magnificPopup) {
    $('.video-popup').magnificPopup({ type: 'iframe', mainClass: 'mfp-fade' });
  }

  /* ── MOBILE MENU ACCORDION ── */
  (function () {
    var currentPage = window.location.pathname.split('/').pop() || 'index.html';
    $('.mobile-menu__nav a[href]').each(function () {
      var href = $(this).attr('href');
      if (href && href !== '#' && href === currentPage) {
        var $li = $(this).closest('li');
        $li.addClass('current');
        var $mobParent = $li.closest('.mob-submenu').closest('.mob-parent');
        if ($mobParent.length) {
          $mobParent.addClass('open current');
          $mobParent.find('>.mob-submenu').addClass('open');
        }
      }
    });
  })();

  $('.mob-parent > a').on('click', function (e) {
    e.preventDefault();
    var $parent = $(this).closest('.mob-parent');
    var $submenu = $parent.find('>.mob-submenu');
    var isOpen = $parent.hasClass('open');
    $('.mob-parent').not($parent).removeClass('open').find('>.mob-submenu').removeClass('open');
    $parent.toggleClass('open', !isOpen);
    $submenu.toggleClass('open', !isOpen);
  });

  /* ── CLOSE MOBILE MENU ON LINK CLICK ── */
  /* Only close on real page links, not accordion toggles */
  $('.mobile-menu__nav a[href!="#"]').on('click', closeMobileMenu);

  /* ── GALLERY FILTERS ── */
  if ($('.gallery-filter-btn').length) {
    $('.gallery-filter-btn').on('click', function () {
      var filter = $(this).data('filter');
      $('.gallery-filter-btn').removeClass('active');
      $(this).addClass('active');

      var $items = $('.gallery-item');
      if (filter === 'all') {
        $items.fadeIn(300);
      } else {
        $items.each(function () {
          if ($(this).data('filter') === filter) {
            $(this).fadeIn(300);
          } else {
            $(this).fadeOut(200);
          }
        });
      }
    });

    /* Magnific Popup for gallery */
    if ($.fn.magnificPopup) {
      $('#galleryGrid').magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: { enabled: true },
        mainClass: 'mfp-fade',
      });
    }
  }

  /* ── DONATE AMOUNT BUTTONS ── */
  if ($('.donate-amount-btn').length) {
    $('.donate-amount-btn').on('click', function () {
      var amount = $(this).data('amount');
      $('.donate-amount-btn').removeClass('active');
      $(this).addClass('active');

      if (amount === 'custom') {
        $('#customAmountField').slideDown(200);
      } else {
        $('#customAmountField').slideUp(200);
        /* Update submit button label */
        var formatted = parseInt(amount).toLocaleString('fr-FR') + ' FCFA';
        $('button[type="button"].waic-btn--primary').filter(':contains("Faire un don")').text('Faire un don de ' + formatted + ' ').append('<i class="fas fa-heart"></i>');
      }
    });
  }

  /* ── PASSWORD TOGGLE ── */
  $('.input-password__toggle').on('click', function () {
    var $input = $(this).siblings('input');
    var type = $input.attr('type') === 'password' ? 'text' : 'password';
    $input.attr('type', type);
    $(this).find('i').toggleClass('fa-eye fa-eye-slash');
  });

  /* ── MEMBER PAGE — tab switcher ── */
  if ($('.member-tab-btn').length) {
    function switchMemberPanel(targetId) {
      var $panels = $('.member-panel');
      var $btns   = $('.member-tab-btn');
      $panels.removeClass('active');
      $btns.removeClass('active');
      $('#' + targetId).addClass('active');
      $btns.filter('[data-target="' + targetId + '"]').addClass('active');
      /* scroll to tab bar */
      var $tabs = $('.member-tabs');
      if ($tabs.length) {
        $('html,body').animate({scrollTop: $tabs.offset().top - 100}, 400);
      }
    }

    /* Tab button clicks */
    $('.member-tab-btn').on('click', function () {
      switchMemberPanel($(this).data('target'));
    });

    /* Inline "Créer un compte" / "Se connecter" links inside panels */
    $(document).on('click', '[data-switch]', function (e) {
      e.preventDefault();
      switchMemberPanel($(this).data('switch'));
    });

    /* "Choisir ce plan" tier card buttons */
    $('.member-plan-btn').on('click', function (e) {
      e.preventDefault();
      var plan = $(this).data('plan');
      /* Pre-select the matching radio */
      $('input[name="memberType"][value="' + plan + '"]').prop('checked', true);
      /* Switch to register panel */
      switchMemberPanel('registerPanel');
    });
  }

  /* ── MEMBER PAGE — FAQ accordion ── */
  if ($('.member-faq__question').length) {
    $('.member-faq__question').on('click', function () {
      var $item = $(this).closest('.member-faq__item');
      var isOpen = $item.hasClass('open');
      /* Close all */
      $('.member-faq__item').removeClass('open')
        .find('.member-faq__answer').css('max-height', '');
      /* Open clicked unless it was already open */
      if (!isOpen) {
        $item.addClass('open');
        var $ans = $item.find('.member-faq__answer');
        $ans.css('max-height', $ans[0].scrollHeight + 'px');
      }
    });
  }

  /* ── EVENTS TAB BUTTONS (events.html style) ── */
  if ($('.events-tab-btn').length) {
    $('.events-tab-btn').on('click', function () {
      var tab = $(this).data('tab');
      $('.events-tab-btn').removeClass('active').addClass('waic-btn--outline').removeClass('waic-btn--primary');
      $(this).addClass('active waic-btn--primary').removeClass('waic-btn--outline');

      var $panel = $('#' + tab);
      $('.events-tab-panel').removeClass('active');
      $panel.addClass('active');
      $panel[0].style.animation = 'none';
      $panel[0].offsetHeight; // reflow
      $panel[0].style.animation = '';
    });
  }

});
