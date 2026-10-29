(function () {
  'use strict';

  var WHATSAPP = '919733042987';
  var EMAIL = 'taskriders.slg@gmail.com';
  // Free form-to-email service. The first enquiry sends an activation email to the inbox above — click it once.
  var FORM_ENDPOINT = 'https://formsubmit.co/ajax/' + EMAIL;

  function waLink(text) {
    return 'https://wa.me/' + WHATSAPP + '?text=' + encodeURIComponent(text);
  }
  function store(key, value) {
    try {
      if (value === undefined) return localStorage.getItem(key);
      localStorage.setItem(key, value);
    } catch (err) { return null; }
  }

  // ---------- Header: mobile menu + shadow ----------
  var header = document.querySelector('.header');
  var burger = document.querySelector('.burger');
  var nav = document.getElementById('nav');

  function setMenu(open) {
    nav.classList.toggle('is-open', open);
    header.classList.toggle('menu-open', open);
    burger.setAttribute('aria-expanded', String(open));
    burger.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    document.body.style.overflow = open ? 'hidden' : '';
  }
  burger.addEventListener('click', function () { setMenu(!nav.classList.contains('is-open')); });
  nav.querySelector('.nav__close').addEventListener('click', function () { setMenu(false); });
  nav.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') setMenu(false); });
  // Tap on the dimmed page outside the sidebar closes it
  document.addEventListener('click', function (e) {
    if (nav.classList.contains('is-open') && !nav.contains(e.target) && !burger.contains(e.target)) setMenu(false);
  });
  window.addEventListener('resize', function () { if (window.innerWidth > 1080) setMenu(false); });

  // ---------- Scroll: header shadow ----------
  function onScroll() { header.classList.toggle('is-scrolled', window.scrollY > 10); }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // ---------- Location selects (header + hero stay in sync) ----------
  var locSelects = document.querySelectorAll('[data-location]');
  var savedLoc = store('tr-location');
  function setLocation(value) {
    locSelects.forEach(function (s) {
      if (Array.prototype.some.call(s.options, function (o) { return o.value === value; })) s.value = value;
    });
  }
  if (savedLoc) setLocation(savedLoc);
  locSelects.forEach(function (s) {
    s.addEventListener('change', function () { setLocation(s.value); store('tr-location', s.value); });
  });

  // ---------- Hero slider ----------
  var slider = document.querySelector('[data-slider]');
  if (slider) {
    var slides = slider.querySelectorAll('.hero__slide');
    var dots = document.querySelectorAll('[data-dots] button');
    var current = 0;
    var timer;
    var show = function (n) {
      slides[current].classList.remove('is-active');
      dots[current].classList.remove('is-active');
      current = (n + slides.length) % slides.length;
      slides[current].classList.add('is-active');
      dots[current].classList.add('is-active');
    };
    var start = function () {
      clearInterval(timer);
      if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        timer = setInterval(function () { show(current + 1); }, 5000);
      }
    };
    dots.forEach(function (dot, i) { dot.addEventListener('click', function () { show(i); start(); }); });
    start();
  }

  // ---------- Date helpers ----------
  function localISO(d) {
    var off = d.getTimezoneOffset();
    return new Date(d.getTime() - off * 60000).toISOString();
  }
  function pretty(value) {
    var d = new Date(value);
    if (isNaN(d)) return value;
    return d.toLocaleString('en-IN', { day: 'numeric', month: 'short', year: 'numeric', hour: 'numeric', minute: '2-digit' });
  }
  function linkDates(from, to, min) {
    from.min = to.min = min;
    from.addEventListener('change', function () {
      to.min = from.value || min;
      if (to.value && to.value < to.min) to.value = '';
    });
  }

  // ---------- Hero search card → WhatsApp ----------
  var search = document.getElementById('search-card');
  if (search) {
    var sPick = search.elements.pickup;
    var sRet = search.elements['return'];
    var sErr = search.querySelector('.search-card__error');
    linkDates(sPick, sRet, localISO(new Date()).slice(0, 16));

    search.addEventListener('submit', function (e) {
      e.preventDefault();
      if (!sPick.value || !sRet.value || sRet.value <= sPick.value) {
        sErr.textContent = !sPick.value || !sRet.value
          ? 'Please choose your pick-up and return date & time.'
          : 'Return time must be after pick-up time.';
        sErr.hidden = false;
        return;
      }
      sErr.hidden = true;
      var msg = 'Hi Task Riders, I want to rent a bike.\n\n' +
        'Vehicle: ' + search.elements.vehicle.value + '\n' +
        'Pick-up location: ' + search.elements.location.value + '\n' +
        'Pick-up: ' + pretty(sPick.value) + '\n' +
        'Return: ' + pretty(sRet.value) + '\n\n' +
        'Is it available?';
      window.open(waLink(msg), '_blank', 'noopener');
    });
  }

  // ---------- Enquiry form ----------
  var form = document.getElementById('enquiry-form');
  if (!form) return;

  // Prefill destination / bike from links like contact.html?destination=Bhutan
  var params = new URLSearchParams(location.search);
  ['destination', 'bike'].forEach(function (key) {
    if (params.get(key) && form.elements[key]) form.elements[key].value = params.get(key);
  });

  var pick = form.elements.pickup_date;
  var ret = form.elements.return_date;
  linkDates(pick, ret, localISO(new Date()).slice(0, 10));

  var errorBox = form.querySelector('.form__error');
  var success = form.parentNode.querySelector('.form-success');
  var button = form.querySelector('button[type="submit"]');

  form.addEventListener('input', function (e) {
    if (e.target.classList.contains('is-invalid') && e.target.checkValidity()) e.target.classList.remove('is-invalid');
  });

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    errorBox.hidden = true;

    var invalid = [];
    Array.prototype.forEach.call(form.elements, function (el) {
      if (!el.willValidate || el.name === '_honey') return;
      var bad = !el.checkValidity();
      el.classList.toggle('is-invalid', bad);
      if (bad) invalid.push(el);
    });
    if (pick.value && ret.value && ret.value < pick.value) { ret.classList.add('is-invalid'); invalid.push(ret); }
    if (invalid.length) {
      errorBox.textContent = 'Please check the highlighted fields.';
      errorBox.hidden = false;
      invalid[0].focus();
      return;
    }

    var data = {};
    new FormData(form).forEach(function (v, k) { data[k] = v; });
    data._subject = 'New booking enquiry: ' + data.bike + ' (' + data.pickup_date + ' to ' + data.return_date + ')';
    data._template = 'table';
    data._replyto = data.email;

    button.disabled = true;
    button.textContent = 'Sending…';

    fetch(FORM_ENDPOINT, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify(data)
    })
      .then(function (res) { return res.json(); })
      .then(function (json) {
        if (String(json.success) !== 'true') throw new Error(json.message || 'Failed');
        form.hidden = true;
        success.hidden = false;
        success.focus();
      })
      .catch(function () {
        var msg = 'Hi Task Riders, booking enquiry:\n' +
          'Name: ' + data.name + '\nPhone: ' + data.phone + '\nBike: ' + data.bike +
          '\nDates: ' + data.pickup_date + ' to ' + data.return_date +
          '\nDestination: ' + (data.destination || '-') + (data.message ? '\nMessage: ' + data.message : '');
        errorBox.innerHTML = 'Sorry, we couldn\'t send your enquiry right now. ' +
          '<a href="' + waLink(msg) + '" target="_blank" rel="noopener">Send it on WhatsApp instead</a>.';
        errorBox.hidden = false;
      })
      .then(function () {
        button.disabled = false;
        button.textContent = 'Send Enquiry';
      });
  });
})();
