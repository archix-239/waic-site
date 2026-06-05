/* ============================================================
   Women in AI Cameroon — Script principal
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Diaporama hero ---------- */
  const slides    = document.querySelectorAll('.hero-slide');
  const dots      = document.querySelectorAll('.hero-dot');
  let   slideIdx  = 0;
  let   slideTimer;

  function goToSlide(n) {
    slides[slideIdx]?.classList.remove('active');
    dots[slideIdx]?.classList.remove('active');
    slideIdx = (n + slides.length) % slides.length;
    slides[slideIdx]?.classList.add('active');
    dots[slideIdx]?.classList.add('active');
  }

  function startSlideshow() {
    slideTimer = setInterval(() => goToSlide(slideIdx + 1), 5000);
  }

  if (slides.length > 1) {
    startSlideshow();
    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        clearInterval(slideTimer);
        goToSlide(parseInt(dot.dataset.slide));
        startSlideshow();
      });
    });
  }

  /* ---------- Navbar scroll effect ---------- */
  const navbar = document.querySelector('.navbar');
  const backTop = document.querySelector('.back-top');

  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar?.classList.add('scrolled');
      backTop?.classList.add('visible');
    } else {
      navbar?.classList.remove('scrolled');
      backTop?.classList.remove('visible');
    }
  });

  /* ---------- Back to top ---------- */
  backTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  /* ---------- Hamburger menu ---------- */
  /* IMPORTANT : on cible UNIQUEMENT le menu de la navbar (pas la pagination WP qui partage le nom .nav-links) */
  const hamburger = document.querySelector('.navbar .hamburger');
  const navLinks  = document.querySelector('.navbar .nav-links');
  /* note : navbar est déjà déclaré ligne 8 (Navbar scroll effect) — pas de redéclaration */

  function closeMenu() {
    navLinks?.classList.remove('open');
    document.body.classList.remove('menu-open');
    hamburger?.setAttribute('aria-expanded', 'false');
    hamburger?.querySelectorAll('span').forEach(s => {
      s.style.transform = '';
      s.style.opacity = '';
    });
  }

  function openMenu() {
    navLinks?.classList.add('open');
    document.body.classList.add('menu-open');
    hamburger?.setAttribute('aria-expanded', 'true');
    const spans = hamburger.querySelectorAll('span');
    spans[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
    spans[1].style.opacity = '0';
    spans[2].style.transform = 'rotate(-45deg) translate(5px, -5px)';
  }

  hamburger?.addEventListener('click', (e) => {
    e.stopPropagation();
    navLinks?.classList.contains('open') ? closeMenu() : openMenu();
  });

  /* Close menu on link click (mobile) */
  navLinks?.querySelectorAll('a:not(.nav-item > a)').forEach(a => {
    a.addEventListener('click', () => {
      if (window.innerWidth <= 768) closeMenu();
    });
  });

  /* Close menu on click outside */
  document.addEventListener('click', (e) => {
    if (!navLinks?.classList.contains('open')) return;
    if (navbar?.contains(e.target)) return;
    closeMenu();
  });

  /* Close menu on escape key */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeMenu();
      closeAllDropdowns();
    }
  });

  /* Close menu on window resize to desktop */
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      if (window.innerWidth > 768) closeMenu();
    }, 100);
  });

  /* ---------- Dropdowns ---------- */
  const navItems = document.querySelectorAll('.navbar .nav-item');

  function closeAllDropdowns(except = null) {
    navItems.forEach(item => {
      if (item !== except) item.classList.remove('open');
    });
  }

  navItems.forEach(item => {
    const trigger = item.querySelector(':scope > a');
    const dropdown = item.querySelector('.nav-dropdown');
    if (!trigger || !dropdown) return;

    /* Desktop : hover géré en CSS, clic pour accessibilité clavier */
    trigger.addEventListener('click', (e) => {
      if (window.innerWidth > 768) {
        /* Sur desktop, le hover CSS suffit — le clic toggle pour accessibilité */
        e.preventDefault();
        const isOpen = item.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) item.classList.add('open');
      } else {
        /* Mobile : toggle le dropdown inline */
        e.preventDefault();
        const isOpen = item.classList.contains('open');
        closeAllDropdowns();
        if (!isOpen) item.classList.add('open');
      }
    });
  });

  /* Fermer les dropdowns au clic en dehors */
  document.addEventListener('click', (e) => {
    if (!navbar?.contains(e.target)) closeAllDropdowns();
  });

  /* ---------- Active nav link ---------- */
  const currentPage = window.location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-links a').forEach(a => {
    const href = a.getAttribute('href');
    if (href === currentPage || (currentPage === '' && href === 'index.html')) {
      a.classList.add('active');
    }
  });

  /* ---------- Intersection Observer (fade-in) ---------- */
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.program-card, .team-card, .news-card, .odd-card, .benefit-card, .contact-item').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(28px)';
    el.style.transition = 'opacity .6s ease, transform .6s ease';
    observer.observe(el);
  });

  /* ---------- Counter animation ---------- */
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  document.querySelectorAll('.counter-num').forEach(el => counterObserver.observe(el));


  /* ---------- Wave line replay on visibility ---------- */
  const waveReplaySelector = '.home-posthero-wave, .home-impact-wave, .home-newsletter-gwc__wave-divider, .home-bigstat-gwc__wave-divider, .home-news-grid-gwc__title-wave, .about-intro-gwc__wave, .about-gap-gwc__wave, .about-change-gwc__wave, .about-values-gwc__wave, .about-reports-gwc__wave, .team-spotlight-gwc__wave, .team-group-gwc__wave, .join-gwc-campaign__wave, .join-gwc-pillars__wave, .events-campaign-feature__wave, .programmes-career-intro__wave, .gwc-wave-svg';
  const waveReplayEls = document.querySelectorAll(waveReplaySelector);
  if (waveReplayEls.length) {
    waveReplayEls.forEach(el => el.classList.add('waicam-wave-replay'));

    const waveObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.remove('is-visible');
          void entry.target.getBoundingClientRect();
          entry.target.classList.add('is-visible');
        } else {
          entry.target.classList.remove('is-visible');
        }
      });
    }, { threshold: 0.55 });

    waveReplayEls.forEach(el => waveObserver.observe(el));
  }

  function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    const suffix = el.dataset.suffix || '';
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
      current += step;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      el.textContent = Math.floor(current).toLocaleString('fr-FR') + suffix;
    }, 16);
  }

  /* ---------- Tabs ---------- */
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.closest('.tabs-wrapper');
      if (!group) return;
      group.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
      group.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
      btn.classList.add('active');
      const target = group.querySelector('#' + btn.dataset.tab);
      target?.classList.add('active');
    });
  });

  /* ---------- Modal ---------- */
  document.querySelectorAll('[data-modal]').forEach(trigger => {
    trigger.addEventListener('click', () => {
      const modal = document.getElementById(trigger.dataset.modal);
      modal?.classList.add('open');
    });
  });

  document.querySelectorAll('.modal-close, .modal-overlay').forEach(el => {
    el.addEventListener('click', (e) => {
      if (e.target === el) {
        el.closest('.modal-overlay')?.classList.remove('open');
        if (el.classList.contains('modal-close')) el.closest('.modal-overlay')?.classList.remove('open');
      }
    });
  });

  /* ---------- Forms ---------- */
  document.querySelectorAll('form[data-form]').forEach(form => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const btn = form.querySelector('.btn-submit');
      const originalText = btn.innerHTML;
      btn.innerHTML = '<span>Envoi en cours...</span>';
      btn.disabled = true;

      setTimeout(() => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        const successDiv = form.querySelector('.form-success');
        if (successDiv) {
          form.querySelector('.form-fields')?.classList.add('hidden');
          successDiv.style.display = 'block';
        } else {
          showToast('✅ Message envoyé avec succès !');
          form.reset();
        }
      }, 1800);
    });
  });

  /* ---------- Toast ---------- */
  window.showToast = function(msg, duration = 3500) {
    let toast = document.querySelector('.toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.className = 'toast';
      document.body.appendChild(toast);
    }
    toast.innerHTML = `<span class="t-icon">✨</span> ${msg}`;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), duration);
  };

  /* ---------- Particles (hero) ---------- */
  const canvas = document.getElementById('particles-canvas');
  if (canvas) {
    const ctx = canvas.getContext('2d');
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    const particles = Array.from({ length: 50 }, () => ({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      r: Math.random() * 3 + 1,
      dx: (Math.random() - .5) * .6,
      dy: (Math.random() - .5) * .6,
      alpha: Math.random() * .5 + .1
    }));

    function drawParticles() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
        ctx.fillStyle = `rgba(255,255,255,${p.alpha})`;
        ctx.fill();
        p.x += p.dx; p.y += p.dy;
        if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
        if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
      });
      requestAnimationFrame(drawParticles);
    }
    drawParticles();

    window.addEventListener('resize', () => {
      canvas.width = canvas.offsetWidth;
      canvas.height = canvas.offsetHeight;
    });
  }

  /* ---------- Smooth scroll for anchor links ---------- */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const target = document.querySelector(a.getAttribute('href'));
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });

  /* ---------- Hidden class utility ---------- */
  const style = document.createElement('style');
  style.textContent = '.hidden { display: none !important; }';
  document.head.appendChild(style);
});
