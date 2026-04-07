const Router = {
  init() {
    const hash = window.location.hash.slice(1) || 'home';
    this.navigate(hash, false);
    window.addEventListener('hashchange', () => {
      this.navigate(window.location.hash.slice(1) || 'home', false);
    });
  },
  navigate(page, updateHash = true) {
    document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
    const target = document.getElementById('page-' + page);
    if (target) {
      target.classList.add('active');
      if (updateHash) window.location.hash = page;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    document.querySelectorAll('.nav-link').forEach(a => a.classList.remove('active'));
    const map = {
      home:'nav-home', about:'nav-ong', team:'nav-ong', partners:'nav-ong', testimonials:'nav-ong',
      programmes:'nav-actions', formations:'nav-actions',
      events:'nav-ressources', gallery:'nav-ressources', magazine:'nav-ressources', blog:'nav-ressources',
      boutique:'nav-boutique'
    };
    const el = document.getElementById(map[page]);
    if (el) el.classList.add('active');
  }
};

function navigateTo(p) { Router.navigate(p); }

function selectAmount(el) {
  document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('selected'));
  el.classList.add('selected');
}

function selectPayment(el) {
  document.querySelectorAll('.payment-btn').forEach(b => b.classList.remove('selected'));
  el.classList.add('selected');
}

// Testimonials Carousel
const Carousel = {
  perPage: 3,
  current: 0,
  cards: [],
  total: 0,

  init() {
    const track = document.getElementById('testimonials-track');
    if (!track) return;

    this.cards = Array.from(track.querySelectorAll('.t-card'));
    this.total = this.cards.length;

    this.render();

    document.getElementById('t-prev').addEventListener('click', () => {
      this.current = (this.current - this.perPage + this.total) % this.total;
      this.render();
    });

    document.getElementById('t-next').addEventListener('click', () => {
      this.current = (this.current + this.perPage) % this.total;
      this.render();
    });
  },

  render() {
    this.cards.forEach((card, i) => {
      const offset = (i - this.current + this.total) % this.total;
      card.style.display = offset < this.perPage ? '' : 'none';
    });
  }
};

// Mobile menu
function closeMobileMenu() {
  document.getElementById('mobile-menu').classList.remove('open');
  document.getElementById('hamburger').classList.remove('open');
  document.body.style.overflow = '';
}

document.addEventListener('DOMContentLoaded', () => {
  Router.init();
  Carousel.init();

  const hamburger = document.getElementById('hamburger');
  const mobileMenu = document.getElementById('mobile-menu');

  hamburger.addEventListener('click', () => {
    const isOpen = mobileMenu.classList.toggle('open');
    hamburger.classList.toggle('open', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });
});
