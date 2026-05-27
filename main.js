const $ = (s, p = document) => p.querySelector(s);
const $$ = (s, p = document) => [...p.querySelectorAll(s)];

function toggleMobileMenu() {
  const links = $('.nav-links');
  if (links) links.classList.toggle('show');
}

function toggleTheme() {
  const isDark = document.body.classList.toggle('light-mode');
  localStorage.setItem('theme', isDark ? 'light' : 'dark');
}

function loadTheme() {
  if (localStorage.getItem('theme') === 'light') {
    document.body.classList.add('light-mode');
  }
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateBackToTopButton() {
  const btn = $('.back-to-top');
  if (!btn) return;
  btn.classList.toggle('show', window.scrollY > 260);
}

function initScrollAnimations() {
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => e.isIntersecting && e.target.classList.add('animate-in'));
  }, { threshold: 0.12 });
  $$('[data-scroll]').forEach((el) => io.observe(el));
}

function animateCounters() {
  $$('.stat-number').forEach((el) => {
    const target = Number(el.dataset.target || el.textContent.replace(/\D/g, ''));
    if (!target) return;
    let cur = 0;
    const step = Math.max(1, Math.floor(target / 35));
    const tick = () => {
      cur += step;
      if (cur >= target) {
        el.textContent = `${target}+`;
        return;
      }
      el.textContent = `${cur}+`;
      requestAnimationFrame(tick);
    };
    tick();
  });
}

function initParticles() {
  const wrap = $('#particles');
  if (!wrap) return;
  for (let i = 0; i < 28; i++) {
    const p = document.createElement('span');
    p.className = 'particle';
    p.style.left = `${Math.random() * 100}%`;
    p.style.animationDelay = `${Math.random() * 8}s`;
    p.style.opacity = `${0.25 + Math.random() * 0.6}`;
    wrap.appendChild(p);
  }
}

function initFilterGroup(buttonSelector, itemSelector, dataKey = 'category') {
  const buttons = $$(buttonSelector);
  const items = $$(itemSelector);
  if (!buttons.length || !items.length) return;

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const filter = btn.dataset.filter || 'all';
      buttons.forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');
      items.forEach((item) => {
        const show = filter === 'all' || item.dataset[dataKey] === filter;
        item.style.display = show ? '' : 'none';
      });
    });
  });
}

function initMenuSearch() {
  const input = $('#menuSearch');
  if (!input) return;
  input.addEventListener('input', (e) => {
    const q = e.target.value.toLowerCase().trim();
    $$('.menu-item-card').forEach((item) => {
      const text = (item.dataset.search || '').toLowerCase();
      const ok = text.includes(q);
      item.style.display = ok ? '' : 'none';
    });
  });
}

function initCountdowns() {
  $$('[data-countdown]').forEach((box) => {
    const target = new Date(box.dataset.countdown).getTime();
    if (!target) return;
    const render = () => {
      const diff = target - Date.now();
      if (diff <= 0) {
        box.textContent = 'Live now';
        return;
      }
      const d = Math.floor(diff / 86400000);
      const h = Math.floor((diff % 86400000) / 3600000);
      const m = Math.floor((diff % 3600000) / 60000);
      box.innerHTML = `<div class="countdown-wrap"><span class="countdown-box">${d}d</span><span class="countdown-box">${h}h</span><span class="countdown-box">${m}m</span></div>`;
    };
    render();
    setInterval(render, 60000);
  });
}

function initTestimonialsSlider() {
  const cards = $$('.testimonial-card[data-slide]');
  if (!cards.length) return;
  let i = 0;
  const show = () => cards.forEach((c, idx) => c.style.display = idx === i ? 'block' : 'none');
  show();
  setInterval(() => { i = (i + 1) % cards.length; show(); }, 3500);
}

function initBookingSteps() {
  const form = $('#bookingWizard');
  if (!form) return;
  const steps = $$('.step', form);
  const progress = $('.form-progress > span', form);
  let idx = 0;

  const setStep = (next) => {
    idx = Math.max(0, Math.min(next, steps.length - 1));
    steps.forEach((s, i) => s.classList.toggle('active', i === idx));
    if (progress) progress.style.width = `${((idx + 1) / steps.length) * 100}%`;
  };

  $$('.next-step', form).forEach((b) => b.addEventListener('click', () => setStep(idx + 1)));
  $$('.prev-step', form).forEach((b) => b.addEventListener('click', () => setStep(idx - 1)));
  setStep(0);
}

function initFeedbackRating() {
  const stars = $$('.star-row button');
  const input = $('#ratingValue');
  if (!stars.length || !input) return;
  stars.forEach((star, i) => {
    star.addEventListener('click', () => {
      input.value = String(i + 1);
      stars.forEach((s, idx) => s.classList.toggle('active', idx <= i));
    });
  });

  $$('.emoji-btn').forEach((btn) => {
    btn.addEventListener('click', () => {
      $$('.emoji-btn').forEach((b) => b.classList.remove('active'));
      btn.classList.add('active');
      const field = $('#emojiReaction');
      if (field) field.value = btn.dataset.emoji || '';
    });
  });
}

function showNotification(message, type = 'info') {
  const toast = document.createElement('div');
  toast.textContent = message;
  toast.style.cssText = `position:fixed;left:20px;bottom:20px;padding:12px 16px;border-radius:10px;color:#fff;z-index:9999;background:${type === 'success' ? '#16a34a' : '#2563eb'};`;
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 2600);
}

function bookGame(name) {
  showNotification(`Booking started for ${name}`, 'success');
  window.location.href = `book-event.html?event=${encodeURIComponent(name)}`;
}

function registerEvent(name) { bookGame(name); }

function shareEvent(name) {
  const url = window.location.href;
  if (navigator.share) {
    navigator.share({ title: `Pixel n Plate - ${name}`, url }).catch(() => {});
  } else {
    navigator.clipboard.writeText(url);
    showNotification('Event link copied');
  }
}

document.addEventListener('DOMContentLoaded', () => {
  loadTheme();
  initParticles();
  initScrollAnimations();
  animateCounters();
  initFilterGroup('.gallery .filter-btn', '.gallery-item');
  initFilterGroup('.menu-filter .filter-btn', '.menu-item-card');
  initMenuSearch();
  initCountdowns();
  initTestimonialsSlider();
  initBookingSteps();
  initFeedbackRating();

  const urlEvent = new URLSearchParams(window.location.search).get('event');
  const eventSelect = $('#event');
  if (urlEvent && eventSelect) eventSelect.value = urlEvent;

  window.addEventListener('scroll', updateBackToTopButton);
  updateBackToTopButton();
});
