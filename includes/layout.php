<?php
/**
 * Shared page layout: <head>, header, footer.
 *
 * Usage in a page:
 *   page_start(['path' => 'bikes', 'title' => '…', 'description' => '…', 'active' => 'bikes']);
 *   echo bikes();
 *   page_end();
 */

const NAV = [
    'bikes'        => 'Bikes',
    'destinations' => 'Destinations',
    'how-it-works' => 'How it Works',
    'faq'          => 'FAQ',
    'contact'      => 'Contact',
];

function page_start(array $p): void
{
    $p += ['path' => '', 'active' => '', 'schema' => [], 'preload' => null, 'page_type' => 'WebPage', 'crumb' => null,
           'image' => 'images/hero-1.jpg', 'og_type' => 'website', 'status' => 200];
    if ($p['status'] !== 200) {
        http_response_code($p['status']);
    }
    $canonical = abs_url($p['path']);
    $graph = json_encode(schema_graph($canonical, $p), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    $title = e($p['title']);
    $desc = e($p['description']);
    $image = abs_url($p['image']);
    $preload = $p['preload'] ? "\n<link rel=\"preload\" as=\"image\" href=\"{$p['preload']}\">" : '';
    $robots = $p['status'] === 200 ? 'index, follow, max-image-preview:large, max-snippet:-1' : 'noindex';
    $css = asset('css/style.css');
    echo <<<HTML
<!DOCTYPE html>
<html lang="en-IN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{$title}</title>
<meta name="description" content="{$desc}">
<meta name="theme-color" content="#FFD100">
<link rel="canonical" href="{$canonical}">
<link rel="icon" type="image/png" href="images/favicon.png">
<link rel="apple-touch-icon" href="images/logo-512.png">
<meta name="robots" content="{$robots}">
<meta name="geo.region" content="IN-WB">
<meta name="geo.placename" content="Siliguri">
<meta property="og:type" content="{$p['og_type']}">
<meta property="og:locale" content="en_IN">
<meta property="og:site_name" content="Task Riders">
<meta property="og:title" content="{$title}">
<meta property="og:description" content="{$desc}">
<meta property="og:url" content="{$canonical}">
<meta property="og:image" content="{$image}">
<meta name="twitter:card" content="summary_large_image">
<link rel="alternate" type="text/markdown" href="llms.txt" title="Task Riders summary for AI assistants">
<link rel="preload" href="fonts/poppins-400.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="fonts/poppins-700.woff2" as="font" type="font/woff2" crossorigin>{$preload}
<link rel="stylesheet" href="{$css}">
<script type="application/ld+json">
{$graph}
</script>
</head>
<body>

HTML;
    echo site_header($p['active']);
    echo "<main>\n";
}

function page_end(): void
{
    echo "\n</main>\n";
    echo site_footer();
    echo "\n<script src=\"" . asset('js/main.js') . "\" defer></script>\n</body>\n</html>\n";
}

function site_header(string $active): string
{
    $links = '';
    foreach (NAV as $href => $label) {
        $links .= '<a href="' . $href . '"' . ($href === $active ? ' aria-current="page"' : '') . '>' . $label . '</a>';
    }
    $close = icon('close');
    return <<<HTML
<header class="header">
  <div class="container header__inner">
    <button class="burger" type="button" aria-label="Open menu" aria-expanded="false" aria-controls="nav"><span></span><span></span><span></span></button>
    <a href="./" class="brand" aria-label="Task Riders home">
      <img src="images/logo.png" alt="Task Riders logo" width="73" height="73" onerror="this.style.display='none'">
      <span>Task <b>Riders</b></span>
    </a>

    <nav class="nav" id="nav" aria-label="Main">
      <div class="nav__head">
        <a href="./" class="brand" aria-label="Task Riders home"><img src="images/logo.png" alt="Task Riders logo" width="56" height="56" loading="lazy"><span>Task <b>Riders</b></span></a>
        <button type="button" class="nav__close" aria-label="Close menu">{$close}</button>
      </div>
      {$links}
      <a href="contact#enquiry" class="btn btn--yellow btn--sm nav__book">Book Now</a>
    </nav>

    <a href="contact#enquiry" class="btn btn--yellow btn--sm header__book">Book Now</a>
  </div>
</header>

HTML;
}

function site_footer(): string
{
    $locs = '';
    foreach (DESTINATIONS as $d) {
        $locs .= '<li><a href="' . dest_url($d) . '">' . e($d['name']) . '</a></li>';
    }
    $s = array_map('e', SITE);
    $wa = e(WA);
    $i = array_map('icon', ['insta' => 'insta', 'facebook' => 'facebook', 'youtube' => 'youtube', 'whatsapp' => 'whatsapp',
                            'phone' => 'phone', 'mail' => 'mail', 'pin' => 'pin']);
    return <<<HTML
<footer class="footer">
  <div class="container footer__grid">
    <div class="footer__brand">
      <a href="./" class="brand brand--light">
        <img src="images/logo.png" alt="Task Riders logo" width="56" height="56" loading="lazy" onerror="this.style.display='none'">
        <span>Task <b>Riders</b></span>
      </a>
      <p>Himalayan bike rentals from the hills.</p>
      <div class="social">
        <a href="{$s['instagram']}" aria-label="Instagram" target="_blank" rel="noopener">{$i['insta']}</a>
        <a href="{$s['facebook']}" aria-label="Facebook" target="_blank" rel="noopener">{$i['facebook']}</a>
        <a href="{$s['youtube']}" aria-label="YouTube" target="_blank" rel="noopener">{$i['youtube']}</a>
        <a href="{$wa}" aria-label="WhatsApp" target="_blank" rel="noopener">{$i['whatsapp']}</a>
      </div>
    </div>
    <div>
      <h4>Company</h4>
      <ul><li><a href="about">About</a></li><li><a href="bikes">Our Bikes</a></li><li><a href="how-it-works">How it Works</a></li><li><a href="faq">FAQ</a></li><li><a href="contact">Contact</a></li></ul>
    </div>
    <div>
      <h4>Locations</h4>
      <ul class="footer__locs">{$locs}</ul>
    </div>
    <div>
      <h4>Get in Touch</h4>
      <ul class="footer__contact">
        <li>{$i['phone']}<a href="tel:+{$s['call_raw']}">{$s['call']}</a></li>
        <li>{$i['whatsapp']}<a href="{$wa}" target="_blank" rel="noopener">{$s['phone']}</a></li>
        <li>{$i['mail']}<a href="mailto:{$s['email']}">{$s['email']}</a></li>
        <li>{$i['pin']}<span>{$s['city']}</span></li>
      </ul>
    </div>
  </div>
  <div class="footer__bottom"><div class="container">© 2026 Task Riders | <a href="{$s['url']}">{$s['domain']}</a></div></div>
</footer>

<a href="tel:+{$s['call_raw']}" class="call-float" aria-label="Call {$s['call']}">{$i['phone']}</a>
<a href="{$wa}" class="wa-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">{$i['whatsapp']}</a>
HTML;
}
