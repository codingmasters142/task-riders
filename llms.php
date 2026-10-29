<?php
/**
 * Served as /llms.txt and /llms-full.txt (see .htaccess) – a plain-text summary for AI assistants.
 */
require __DIR__ . '/includes/functions.php';

header('Content-Type: text/plain; charset=utf-8');
$full = isset($_GET['full']);

function html_to_text(string $html): string
{
    $t = preg_replace('#<h2>(.*?)</h2>#', "\n### $1\n", $html);
    $t = preg_replace('#<li>(.*?)</li>#', '- $1', $t);
    $t = str_replace('</p>', "\n", $t);
    $t = strip_tags($t);
    $t = preg_replace('/^[ \t]+/m', '', $t);
    $t = preg_replace("/\n{3,}/", "\n\n", html_entity_decode($t, ENT_QUOTES, 'UTF-8'));
    return trim($t);
}

$url = SITE['url'];
$facts = implode("\n", [
    "- Business: " . SITE['name'] . " (" . SITE['domain'] . "), Royal Enfield & scooty rental",
    "- Based in: " . SITE['city'] . ", India",
    "- Phone / WhatsApp: " . SITE['phone'] . " (https://wa.me/" . SITE['phone_raw'] . ")",
    "- Email: " . SITE['email'],
    "- Pick-up points: " . implode(', ', LOCATIONS),
    "- Fleet: " . implode('; ', array_map(fn($b) => "{$b['name']} ({$b['engine']}) – " . rtrim($b['summary'], '.'), BIKES)),
    "- Destinations: " . implode(', ', array_column(DESTINATIONS, 'name')),
    "- Included: " . implode('; ', array_column(WHY, 1)),
    "- Rentals: daily and weekly",
    "- Documents: valid driving licence + ID proof (Aadhaar, Passport or Voter ID)",
    "- Fuel is not included",
    "- Prices are not published on the website – ask on WhatsApp for a quote",
    "- How to book: booking form at {$url}contact or WhatsApp " . SITE['phone'],
]);
$table = "| Destination | Distance from Siliguri | Riding time | Best time | Recommended bike |\n|---|---|---|---|---|\n"
       . implode("\n", array_map(fn($d) => "| {$d['name']} | ~{$d['km']} km | {$d['time']} | {$d['best_time']} | {$d['bike']} |", DESTINATIONS));

$out = "# " . SITE['name'] . ($full ? " – full site content" : '') . "\n\n> " . SUMMARY . "\n\nLast updated: " . UPDATED . "\n\n## Key facts\n\n{$facts}\n\n";

if (!$full) {
    $pages = [
        ['Home', '', 'Overview, booking card, fleet, destinations, booking steps, FAQ and ride guides.'],
        ['Bikes', 'bikes', 'The rental fleet and a bike comparison table.'],
        ['Destinations', 'destinations', 'All destinations with a distances-from-Siliguri table.'],
        ['How it Works', 'how-it-works', 'The 4-step booking process.'],
        ['FAQ', 'faq', 'Documents, helmets, fuel, permits, prices and how to book.'],
        ['Contact & Booking', 'contact', 'Booking enquiry form, phone, WhatsApp and email.'],
        ['About', 'about', 'About Task Riders.'],
    ];
    $out .= "## Distances from Siliguri (approximate)\n\n{$table}\n\n## Pages\n\n"
          . implode("\n", array_map(fn($p) => "- [{$p[0]}]({$url}{$p[1]}): {$p[2]}", $pages))
          . "\n\n## Destination guides\n\n"
          . implode("\n", array_map(fn($d) => "- [{$d['name']} bike rental]({$url}" . dest_url($d) . "): about {$d['km']} km / {$d['time']} from Siliguri. {$d['permit']}", DESTINATIONS))
          . "\n\n## Ride guides\n\n"
          . implode("\n", array_map(fn($g) => "- [{$g['title']}]({$url}{$g['slug']}): {$g['excerpt']}", GUIDES))
          . "\n\n## Optional\n\n- [Full site content]({$url}llms-full.txt): everything above plus all FAQ answers, destination details and full guide text.\n";
} else {
    $out .= "## Bikes\n\n" . implode("\n\n", array_map(fn($b) =>
                "### {$b['name']} ({$b['type']}, {$b['engine']})\n{$b['summary']} Best for: {$b['best_for']}. Ideal for: {$b['rider']}.\n"
                . implode("\n", array_map(fn($f) => "- $f", $b['features'])), BIKES))
          . "\n\n## Destinations\n\n{$table}\n\n" . implode("\n\n", array_map(fn($d) =>
                "### {$d['name']}\nURL: {$url}" . dest_url($d) . "\n\n{$d['intro']}\n\n"
                . "- Distance from Siliguri: about {$d['km']} km\n- Riding time: {$d['time']}\n- Altitude: {$d['altitude']}\n"
                . "- Route: {$d['route']}\n- Best time: {$d['best_time']}\n- Permits: {$d['permit']}\n- Recommended bike: {$d['bike']}", DESTINATIONS))
          . "\n\n## How to book\n\n" . implode("\n", array_map(fn($i, $s) => ($i + 1) . ". {$s[1]} – {$s[2]}", array_keys(STEPS), STEPS))
          . "\n\n## FAQ\n\n" . implode("\n\n", array_map(fn($qa) => "### {$qa[0]}\n{$qa[1]}", FAQ))
          . "\n\n" . implode("\n\n", array_map(fn($g) =>
                "## Guide: {$g['title']}\nURL: {$url}{$g['slug']}\n\nKey takeaways:\n"
                . implode("\n", array_map(fn($t) => "- $t", $g['takeaways'])) . "\n\n" . html_to_text($g['body']), GUIDES))
          . "\n";
}

echo $out;
