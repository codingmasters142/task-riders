(function () {
  'use strict';

  var WHATSAPP = '919246240880';
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

  // ---------- Hero heading: rotating word ----------
  var rotator = document.querySelector('[data-words]');
  if (rotator && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    var words = rotator.getAttribute('data-words').split(',');
    var wordIndex = 0;
    setInterval(function () {
      rotator.classList.add('is-out');
      setTimeout(function () {
        wordIndex = (wordIndex + 1) % words.length;
        rotator.textContent = words[wordIndex];
        rotator.classList.remove('is-out');
      }, 350);
    }, 2500);
  }

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

  // ---------- Date pickers (flatpickr) ----------
  function calendar(input, opts) {
    return flatpickr(input, Object.assign({
      dateFormat: 'D, d M Y',
      minDate: 'today',
      disableMobile: true, // same friendly calendar on phones
      monthSelectorType: 'static'
    }, opts));
  }
  // Date + time in one field, with a Done button to close the calendar
  var withTime = {
    enableTime: true,
    dateFormat: 'D, d M Y, h K',
    minuteIncrement: 60,
    defaultHour: 10,
    defaultMinute: 0,
    onReady: function (dates, str, fp) {
      var done = document.createElement('button');
      done.type = 'button';
      done.className = 'cal-done';
      done.textContent = 'Done';
      done.addEventListener('click', function () { fp.close(); });
      fp.calendarContainer.appendChild(done);
    }
  };
  // Pick-up + return pair: return can't be before pick-up, and opens right after pick-up is chosen
  function linkDates(from, to, opts) {
    var fpTo = calendar(to, opts);
    var fpFrom = calendar(from, Object.assign({}, opts, {
      onChange: function (dates) {
        if (!dates.length) return;
        fpTo.set('minDate', dates[0]);
        if (fpTo.selectedDates[0] && fpTo.selectedDates[0] < dates[0]) fpTo.clear();
      },
      onClose: function (dates) {
        if (dates.length && !fpTo.selectedDates.length) setTimeout(function () { fpTo.open(); }, 50);
      }
    }));
    return { from: fpFrom, to: fpTo };
  }

  // ---------- Hero search card → WhatsApp ----------
  var search = document.getElementById('search-card');
  if (search) {
    var sPick = search.elements.pickup;
    var sRet = search.elements['return'];
    var sErr = search.querySelector('.search-card__error');
    var sDates = linkDates(sPick, sRet, withTime);

    search.addEventListener('submit', function (e) {
      e.preventDefault();
      var sVehicle = search.elements.vehicle;
      var timeBad = sPick.value && sRet.value && sDates.to.selectedDates[0] <= sDates.from.selectedDates[0];
      if (!sVehicle.value || !sPick.value || !sRet.value || timeBad) {
        sErr.textContent = !sVehicle.value
          ? 'Please select a bike or scooty.'
          : !sPick.value || !sRet.value
            ? 'Please choose your pick-up and return date & time.'
            : 'Return time must be after pick-up time.';
        sErr.hidden = false;
        return;
      }
      sErr.hidden = true;
      var msg = 'Hi Task Riders, I want to rent a bike.\n\n' +
        'Vehicle: ' + search.elements.vehicle.value + '\n' +
        'Pick-up location: ' + search.elements.location.value + '\n' +
        'Pick-up: ' + sPick.value + '\n' +
        'Return: ' + sRet.value + '\n\n' +
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
  linkDates(pick, ret);

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
    [pick, ret].forEach(function (el) {
      el.classList.toggle('is-invalid', !el.value);
      if (!el.value) invalid.push(el);
    });
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
