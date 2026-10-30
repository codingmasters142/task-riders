<?php
/**
 * Task Riders – helpers and reusable page sections.
 * Each section function returns an HTML string; pages echo them in order.
 */

require_once __DIR__ . '/config.php';

define('ROOT', dirname(__DIR__));
define('WA', 'https://wa.me/' . SITE['phone_raw'] . '?text=' . rawurlencode(WA_MESSAGE));

/* ------------------------------------------------------------ helpers */

/** HTML-escape a value. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/** Append the file's modified time so browsers fetch the new file after each change. */
function asset(string $path): string
{
    return $path . '?v=' . @filemtime(ROOT . '/' . $path);
}

function dest_url(array $d): string
{
    return $d['slug'] . '-bike-rental';
}

function find_by_slug(array $items, string $slug): ?array
{
    foreach ($items as $item) {
        if ($item['slug'] === $slug) {
            return $item;
        }
    }
    return null;
}

/** Full absolute URL for a clean page path ('' = home). */
function abs_url(string $path = ''): string
{
    return SITE['url'] . $path;
}

const ICONS = [
    'whatsapp' => '<path class="f" d="M17.5 14.4c-.3-.1-1.8-.9-2-1s-.5-.1-.7.1-.8 1-1 1.2-.4.2-.7.1a8.1 8.1 0 0 1-4-3.5c-.3-.5.3-.5.9-1.6.1-.2 0-.4 0-.5l-.9-2.2c-.2-.6-.5-.5-.7-.5h-.6a1.1 1.1 0 0 0-.8.4 3.4 3.4 0 0 0-1.1 2.5 5.9 5.9 0 0 0 1.2 3.1 13.5 13.5 0 0 0 5.2 4.6c1.9.8 2.7.9 3.6.7a3.1 3.1 0 0 0 2-1.4 2.5 2.5 0 0 0 .2-1.4c-.1-.2-.3-.3-.6-.4zM12 21.8a9.9 9.9 0 0 1-5-1.4l-.4-.2-3.7 1 1-3.6-.2-.4A9.9 9.9 0 1 1 12 21.8zm8.4-18.3A11.8 11.8 0 0 0 1.8 17.7L.1 24l6.4-1.7a11.8 11.8 0 0 0 5.6 1.4A11.8 11.8 0 0 0 20.4 3.5z"/>',
    'pin'      => '<path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="3"/>',
    'calendar' => '<rect x="3" y="4" width="18" height="17" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/>',
    'bike'     => '<circle cx="5.5" cy="17" r="3.5"/><circle cx="18.5" cy="17" r="3.5"/><path d="M15 6h2l3.5 11M5.5 17 9 10h6l-3 7h-6.5M9 10 8 7H6"/>',
    'chat'     => '<path d="M21 12a8 8 0 0 1-11.6 7.1L4 20.5l1.4-5A8 8 0 1 1 21 12z"/><path d="M8.5 11h.01M12 11h.01M15.5 11h.01"/>',
    'key'      => '<circle cx="7.5" cy="15.5" r="4.5"/><path d="m10.7 12.3 9.8-9.8M17 6l3 3M14.5 8.5l2 2"/>',
    'route'    => '<circle cx="6" cy="19" r="2.5"/><circle cx="18" cy="5" r="2.5"/><path d="M8.5 19H17a3.5 3.5 0 0 0 0-7H7a3.5 3.5 0 0 1 0-7h8.5"/>',
    'wrench'   => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.8-3.8a6 6 0 0 1-7.9 7.9l-6.9 6.9a2.1 2.1 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.9-7.9l-3.8 3.8z"/>',
    'helmet'   => '<path d="M3 15a9 9 0 0 1 18 0v2H3z"/><path d="M12 6v9M3 17h18v2H3z"/>',
    'doc'      => '<path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6M8 13h8M8 17h5"/>',
    'support'  => '<path d="M3 14v-2a9 9 0 0 1 18 0v2"/><path d="M21 15a2 2 0 0 1-2 2h-1v-5h1a2 2 0 0 1 2 2zM3 15a2 2 0 0 0 2 2h1v-5H5a2 2 0 0 0-2 2zM18 17v1a3 3 0 0 1-3 3h-3"/>',
    'check'    => '<path d="M20 6 9 17l-5-5"/>',
    'check-circle' => '<circle cx="12" cy="12" r="10"/><path d="m7.5 12.5 3 3 6-6"/>',
    'engine'   => '<path d="M4 9h3l2-2h5l2 2h2v3h2v4h-2v2h-4l-2 2H9l-2-2H4z"/>',
    'phone'    => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/>',
    'mail'     => '<rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/>',
    'arrow-right' => '<path d="M5 12h14M13 5l7 7-7 7"/>',
    'chevron'  => '<path d="m6 9 6 6 6-6"/>',
    'clock'    => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
    'close'    => '<path d="M18 6 6 18M6 6l12 12"/>',
];

function icon(string $name, string $cls = 'i'): string
{
    return '<svg class="' . $cls . '" viewBox="0 0 24 24" aria-hidden="true">' . ICONS[$name] . '</svg>';
}

function head_label(string $label, string $title, string $sub = '', bool $center = true): string
{
    $sub_html = $sub !== '' ? '<p class="sec-sub">' . $sub . '</p>' : '';
    return '<div class="sec-head' . ($center ? ' sec-head--center' : '') . '"><span class="label">' . $label . '</span><h2>' . $title . '</h2>' . $sub_html . '</div>';
}

function wa_link(string $text, string $cls = 'btn btn--wa'): string
{
    return '<a href="' . e(WA) . '" class="' . $cls . '" target="_blank" rel="noopener">' . icon('whatsapp') . ' ' . $text . '</a>';
}

function faq_items(array $items): string
{
    $html = '';
    foreach ($items as $i => [$q, $a]) {
        $html .= '<details class="faq__item"' . ($i === 0 ? ' open' : '') . '><summary>' . e($q) . icon('chevron') . '</summary><p>' . e($a) . "</p></details>\n";
    }
    return $html;
}

function updated_line(string $date): string
{
    $pretty = date('d F Y', strtotime($date));
    return '<p class="updated">Last updated: <time datetime="' . e($date) . '">' . $pretty . '</time> · By the Task Riders team</p>';
}

/* ------------------------------------------------------------ sections */

function hero(): string
{
    $alts = ['Rider on a Royal Enfield below snow-capped Himalayan peaks',
             'Two motorcycles riding a winding Himalayan mountain road',
             'Biker celebrating with his motorcycle on a Himalayan pass'];
    $slides = $dots = '';
    foreach ($alts as $i => $alt) {
        $n = $i + 1;
        $first = $n === 1;
        $slides .= '<img src="images/hero-' . $n . '.jpg" alt="' . e($alt) . '" width="1600" height="900" class="hero__slide' . ($first ? ' is-active' : '') . '"'
                 . ($first ? ' fetchpriority="high"' : ' loading="lazy"') . '>';
        $dots .= '<button type="button" aria-label="Show slide ' . $n . '"' . ($first ? ' class="is-active"' : '') . '></button>';
    }
    $loc_opts = implode('', array_map(fn($l) => '<option>' . e($l) . '</option>', LOCATIONS));
    // Grouped under "Bike" and "Scooty" headings, using each vehicle's type from config.php
    $bike_opts = '';
    foreach (['Bike', 'Scooty'] as $type) {
        $bike_opts .= '<optgroup label="' . $type . '">';
        foreach (array_filter(BIKES, fn($b) => $b['type'] === $type) as $b) {
            $bike_opts .= '<option>' . e($b['name']) . '</option>';
        }
        $bike_opts .= '</optgroup>';
    }
    $perks = '';
    foreach ([['helmet', 'Free helmet'], ['support', '24/7 support'], ['doc', 'Permit help']] as [$ic, $t]) {
        $perks .= '<li>' . icon($ic) . $t . '</li>';
    }
    $city = e(explode(',', SITE['city'])[0]);
    $i_bike = icon('bike');
    $i_pin = icon('pin');
    $i_cal = icon('calendar');
    return <<<HTML
<section class="hero">
  <div class="hero__bg" data-slider>{$slides}</div>
  <div class="container hero__grid">
    <div class="hero__text">
      <span class="tagline">Ride • Explore • Repeat</span>
      <h1>Your next <span class="hl hl--rotate" data-words="adventure,journey,road trip,escape">adventure</span><br>starts here</h1>
      <p class="hero__lead">Well-serviced bikes from {$city} for Darjeeling, Gangtok, Bhutan, Nepal &amp; the North East.</p>
      <ul class="hero__perks">{$perks}</ul>
      <div class="hero__dots" data-dots>{$dots}</div>
    </div>

    <form class="search-card" id="search-card" novalidate>
        <h2 class="search-card__title">Book Your Ride</h2>
        <label class="field field--full">
          <span>{$i_bike} Bike / Scooty</span>
          <select name="vehicle" required><option value="">Select a bike or scooty</option>{$bike_opts}</select>
        </label>
        <label class="field field--full">
          <span>{$i_pin} Pick-up Location</span>
          <select name="location" data-location>{$loc_opts}</select>
        </label>
        <label class="field">
          <span>{$i_cal} Pick-up Date &amp; Time</span>
          <input type="datetime-local" name="pickup" required>
        </label>
        <label class="field">
          <span>{$i_cal} Return Date &amp; Time</span>
          <input type="datetime-local" name="return" required>
        </label>
        <p class="search-card__error" hidden role="alert"></p>
        <button type="submit" class="btn btn--yellow btn--block">Check Availability</button>
    </form>
  </div>
</section>
HTML;
}

function stats(): string
{
    $items = '';
    foreach (STATS as [$n, $l]) {
        $items .= '<li><strong>' . e($n) . '</strong><span>' . e($l) . '</span></li>';
    }
    return '<section class="stats"><div class="container"><ul class="stats__list">' . $items . '</ul></div></section>';
}

function bike_card(array $b): string
{
    $feats = '';
    foreach ($b['features'] as $f) {
        $feats .= '<li>' . icon('check') . e($f) . '</li>';
    }
    $e = 'e';
    $src = asset($b['image']); // versioned so replaced photos show immediately
    $engine_icon = icon('engine');
    $btn = wa_link('Enquire Now', 'btn btn--wa btn--sm');
    return <<<HTML
    <article class="bike-card">
      <div class="bike-card__img"><img src="{$src}" alt="{$e($b['alt'])}" width="800" height="600" loading="lazy"></div>
      <div class="bike-card__body">
        <div class="bike-card__meta"><span class="chip">{$e($b['type'])}</span><span class="engine">{$engine_icon}{$e($b['engine'])}</span></div>
        <h3>{$e($b['name'])}</h3>
        <p>{$e($b['summary'])}</p>
        <ul class="feat">{$feats}</ul>
        {$btn}
      </div>
    </article>
HTML;
}

function bikes(string $sec_cls = 'section'): string
{
    $cards = implode('', array_map('bike_card', BIKES));
    $head = head_label('Our Fleet', 'Choose Your Ride', 'Royal Enfields for the mountains, a scooty for the town — serviced before every trip.');
    return <<<HTML
<section class="{$sec_cls}" id="bikes">
  <div class="container">
    {$head}
    <div class="bike-row">{$cards}</div>
  </div>
</section>
HTML;
}

function dest_card(array $d): string
{
    return '<a class="dest-card" href="' . dest_url($d) . '" id="' . $d['slug'] . '">'
         . '<img src="' . $d['image'] . '" alt="' . e($d['alt']) . '" width="600" height="760" loading="lazy">'
         . '<div class="dest-card__body"><h3>' . e($d['name']) . '</h3><p>' . e($d['desc']) . ' · ' . $d['km'] . ' km</p>'
         . '<span class="dest-card__cta">Plan this ride ' . icon('arrow-right') . '</span></div></a>';
}

function destinations(string $sec_cls = 'section section--grey', ?string $exclude = null, string $title = 'Destinations We Cover'): string
{
    $cards = '';
    foreach (DESTINATIONS as $d) {
        if ($d['slug'] !== $exclude) {
            $cards .= dest_card($d);
        }
    }
    $head = head_label('Where to Ride', $title, 'Start from Siliguri — the gateway to the hills — and ride anywhere in the Eastern Himalayas.');
    return <<<HTML
<section class="{$sec_cls}" id="destinations">
  <div class="container">
    {$head}
    <div class="dest-grid">{$cards}</div>
  </div>
</section>
HTML;
}

function distance_table(string $sec_cls = 'section section--grey'): string
{
    $rows = '';
    foreach (DESTINATIONS as $d) {
        $rows .= '<tr><th scope="row"><a href="' . dest_url($d) . '">' . e($d['name']) . '</a></th><td>' . $d['km'] . ' km</td><td>'
               . e($d['time']) . '</td><td>' . e($d['best_time']) . '</td><td>' . e($d['bike']) . "</td></tr>\n";
    }
    $head = head_label('Plan Your Ride', 'Distances from Siliguri by Bike', 'Approximate road distance, riding time, best season and recommended bike for each destination.');
    return <<<HTML
<section class="{$sec_cls}" id="distances">
  <div class="container">
    {$head}
    <div class="table-wrap">
      <table class="data-table">
        <caption class="sr-only">Bike riding distances and times from Siliguri</caption>
        <thead><tr><th scope="col">Destination</th><th scope="col">Distance</th><th scope="col">Riding time</th><th scope="col">Best time</th><th scope="col">Recommended bike</th></tr></thead>
        <tbody>{$rows}</tbody>
      </table>
    </div>
    <p class="table-note">Distances and times are approximate and depend on route, traffic and weather.</p>
  </div>
</section>
HTML;
}

function bike_table(string $sec_cls = 'section section--grey'): string
{
    $rows = '';
    foreach (BIKES as $b) {
        $rows .= '<tr><th scope="row">' . e($b['name']) . '</th><td>' . e($b['type']) . '</td><td>' . e($b['engine']) . '</td><td>'
               . e($b['best_for']) . '</td><td>' . e($b['rider']) . "</td></tr>\n";
    }
    $head = head_label('Compare', 'Which Bike Should I Rent?', 'A quick comparison to help you pick the right ride for your trip.');
    return <<<HTML
<section class="{$sec_cls}" id="compare">
  <div class="container">
    {$head}
    <div class="table-wrap">
      <table class="data-table">
        <caption class="sr-only">Comparison of rental bikes at Task Riders</caption>
        <thead><tr><th scope="col">Bike</th><th scope="col">Type</th><th scope="col">Engine</th><th scope="col">Best for</th><th scope="col">Ideal for</th></tr></thead>
        <tbody>{$rows}</tbody>
      </table>
    </div>
  </div>
</section>
HTML;
}

function dest_faq(array $d): array
{
    return [
        ["How far is {$d['name']} from Siliguri by bike?",
         "About {$d['km']} km — {$d['time']} of riding. Route: " . str_replace('→', 'to', $d['route']) . '.'],
        ["Do I need a permit to ride to {$d['name']}?", $d['permit']],
        ["What is the best time to ride to {$d['name']}?", "The best time is {$d['best_time']}."],
        ["Which rental bike is best for {$d['name']}?", "We recommend the {$d['bike']}."],
    ];
}

function dest_page_body(array $d): string
{
    $facts = [['Distance from Siliguri', "About {$d['km']} km"], ['Riding time', $d['time']], ['Altitude', $d['altitude']],
              ['Route', $d['route']], ['Best time to ride', $d['best_time']], ['Permits', $d['permit']], ['Recommended bike', $d['bike']]];
    $rows = '';
    foreach ($facts as [$k, $v]) {
        $rows .= '<tr><th scope="row">' . e($k) . '</th><td>' . e($v) . '</td></tr>';
    }
    $e = 'e';
    $faqs = faq_items(dest_faq($d));
    $name = e($d['name']);
    $book = 'contact?destination=' . rawurlencode($d['name']) . '#enquiry';
    $wa = wa_link('WhatsApp Us', 'btn btn--wa btn--block');
    return <<<HTML
<section class="section">
  <div class="container dest-detail">
    <div class="dest-detail__main">
      <div class="answer"><span class="answer__label">Quick answer</span><p>{$e($d['intro'])}</p></div>
      <h2>{$name} ride at a glance</h2>
      <div class="table-wrap"><table class="facts"><tbody>{$rows}</tbody></table></div>
      <p class="table-note">Figures are approximate. Road and permit rules can change — WhatsApp us for the latest before you ride.</p>
      <h2>{$name} bike trip FAQ</h2>
      <div class="faq">{$faqs}</div>
    </div>
    <aside class="dest-detail__side">
      <img src="{$d['image']}" alt="{$e($d['alt'])}" width="600" height="760" loading="lazy">
      <div class="side-card">
        <h3>Ride to {$name}</h3>
        <p>Royal Enfield &amp; scooty rentals from Siliguri, with a free helmet and 24/7 support.</p>
        <a href="{$e($book)}" class="btn btn--yellow btn--block">Book a bike for {$name}</a>
        {$wa}
      </div>
    </aside>
  </div>
</section>
HTML;
}

function steps(string $sec_cls = 'section'): string
{
    $items = '';
    foreach (STEPS as $i => [$ic, $t, $d]) {
        $items .= '<li class="step"><span class="step__num">' . sprintf('%02d', $i + 1) . '</span><div class="step__icon">' . icon($ic)
                . '</div><h3>' . e($t) . '</h3><p>' . e($d) . "</p></li>\n";
    }
    $head = head_label('Easy Booking', 'How to Book Your Ride?', 'Four simple steps from enquiry to open road.');
    return <<<HTML
<section class="{$sec_cls}" id="how-it-works">
  <div class="container">
    {$head}
    <ol class="steps">{$items}</ol>
  </div>
</section>
HTML;
}

function why(string $sec_cls = 'section section--grey'): string
{
    $items = '';
    foreach (WHY as [$ic, $t, $d]) {
        $items .= '<li class="why-card"><div class="why-card__icon">' . icon($ic) . '</div><div><h3>' . e($t) . '</h3><p>' . e($d) . '</p></div></li>';
    }
    $head = head_label('Why Us', 'Why Ride with Task Riders?', 'Local riders who know these roads — we keep you rolling from the plains to the passes.', false);
    return <<<HTML
<section class="{$sec_cls}" id="why">
  <div class="container why">
    <div class="why__img"><img src="images/why-ride.jpg" alt="Motorcycle parked on a Himalayan mountain highway" width="800" height="960" loading="lazy"></div>
    <div class="why__content">
      {$head}
      <ul class="why__list">{$items}</ul>
    </div>
  </div>
</section>
HTML;
}

function enquiry(string $sec_cls = 'section'): string
{
    // Pre-select bike / destination from links like contact?destination=Bhutan
    $sel_bike = $_GET['bike'] ?? '';
    $sel_dest = $_GET['destination'] ?? '';
    $bike_opts = $dest_opts = '';
    foreach (BIKES as $b) {
        $bike_opts .= '<option' . ($b['name'] === $sel_bike ? ' selected' : '') . '>' . e($b['name']) . '</option>';
    }
    foreach (DESTINATIONS as $d) {
        $dest_opts .= '<option' . ($d['name'] === $sel_dest ? ' selected' : '') . '>' . e($d['name']) . '</option>';
    }
    $head = head_label('Book Now', 'Send a Booking Enquiry', "Fill in your details and we'll get back to you shortly. Prefer chat? WhatsApp us anytime.", false);
    $i_phone = icon('phone');
    $i_mail = icon('mail');
    $i_pin = icon('pin');
    $i_ok = icon('check-circle');
    $wa_btn = wa_link('WhatsApp Us');
    $wa = e(WA);
    $s = array_map('e', SITE);
    return <<<HTML
<section class="{$sec_cls}" id="enquiry">
  <div class="container enquiry">
    <div class="enquiry__info">
      {$head}
      <ul class="contact-list">
        <li>{$i_phone}<div><span>Call / WhatsApp</span><a href="tel:+{$s['phone_raw']}">{$s['phone']}</a></div></li>
        <li>{$i_mail}<div><span>Email</span><a href="mailto:{$s['email']}">{$s['email']}</a></div></li>
        <li>{$i_pin}<div><span>Based in</span><strong>{$s['city']}</strong></div></li>
      </ul>
      {$wa_btn}
    </div>

    <div class="enquiry__form">
      <form class="form" id="enquiry-form" novalidate>
        <div class="form__row">
          <label>Name*<input type="text" name="name" required autocomplete="name" maxlength="80"></label>
          <label>Phone*<input type="tel" name="phone" required autocomplete="tel" inputmode="tel" pattern="[0-9+\-\s]{8,16}" maxlength="16"></label>
        </div>
        <label>Email*<input type="email" name="email" required autocomplete="email" maxlength="120"></label>
        <div class="form__row">
          <label>Bike*<select name="bike" required><option value="">Select a bike</option>{$bike_opts}</select></label>
          <label>Destination<select name="destination"><option value="">Select destination</option>{$dest_opts}<option>Other / Not sure yet</option></select></label>
        </div>
        <div class="form__row">
          <label>Pickup Date*<input type="date" name="pickup_date" required></label>
          <label>Return Date*<input type="date" name="return_date" required></label>
        </div>
        <label>Message<textarea name="message" rows="4" maxlength="1000" placeholder="Number of riders, route plan, any questions…"></textarea></label>
        <input type="text" name="_honey" class="hp" tabindex="-1" autocomplete="off" aria-hidden="true">
        <p class="form__error" hidden role="alert"></p>
        <button type="submit" class="btn btn--yellow btn--block">Send Enquiry</button>
      </form>
      <div class="form-success" hidden tabindex="-1">
        {$i_ok}
        <h3>Thank you, we'll contact you soon!</h3>
        <p>Need a faster reply? <a href="{$wa}" target="_blank" rel="noopener">Message us on WhatsApp</a>.</p>
      </div>
    </div>
  </div>
</section>
HTML;
}

function faq(string $sec_cls = 'section section--grey'): string
{
    $items = faq_items(FAQ);
    $head = head_label('FAQ', 'Frequently Asked Questions', 'Quick answers before you ride.');
    return <<<HTML
<section class="{$sec_cls}" id="faq">
  <div class="container container--narrow">
    {$head}
    <div class="faq">{$items}</div>
  </div>
</section>
HTML;
}

function guides(string $sec_cls = 'section', ?string $exclude = null): string
{
    $cards = '';
    foreach (GUIDES as $g) {
        if ($g['slug'] === $exclude) {
            continue;
        }
        $cards .= '<article class="guide-card">'
                . '<a href="' . $g['slug'] . '" class="guide-card__img"><img src="' . $g['image'] . '" alt="' . e($g['alt']) . '" width="800" height="500" loading="lazy"></a>'
                . '<div class="guide-card__body"><span class="guide-card__meta">' . icon('clock') . e($g['read']) . '</span>'
                . '<h3><a href="' . $g['slug'] . '">' . e($g['title']) . '</a></h3><p>' . e($g['excerpt']) . '</p>'
                . '<a href="' . $g['slug'] . '" class="link-arrow">Read guide ' . icon('arrow-right') . "</a></div></article>\n";
    }
    $head = head_label('Ride Guides', 'Plan Your Himalayan Ride', 'Routes, permits and seasons — tips from riders who know these roads.');
    return <<<HTML
<section class="{$sec_cls}" id="guides">
  <div class="container">
    {$head}
    <div class="guide-grid">{$cards}</div>
  </div>
</section>
HTML;
}

function cta(): string
{
    $wa = wa_link('WhatsApp Us');
    return <<<HTML
<section class="cta">
  <div class="container cta__inner">
    <div><h2>Ready to ride the Himalayas?</h2><p>Send an enquiry or chat with us on WhatsApp — we reply fast.</p></div>
    <div class="cta__actions"><a href="contact#enquiry" class="btn btn--dark">Book Now</a>{$wa}</div>
  </div>
</section>
HTML;
}

/** Inner-page banner. $title / $sub may contain HTML entities; $parent = ['Name', 'url']. */
function page_hero(string $title, string $sub, string $crumb, ?array $parent = null): string
{
    $mid = $parent ? '<a href="' . $parent[1] . '">' . e($parent[0]) . '</a><span>/</span>' : '';
    $crumb = e($crumb);
    return <<<HTML
<section class="page-hero">
  <div class="container">
    <nav class="crumbs" aria-label="Breadcrumb"><a href="./">Home</a><span>/</span>{$mid}{$crumb}</nav>
    <h1>{$title}</h1>
    <p>{$sub}</p>
  </div>
</section>
HTML;
}

require_once __DIR__ . '/schema.php';
require_once __DIR__ . '/layout.php';
