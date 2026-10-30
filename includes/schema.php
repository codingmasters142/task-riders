<?php
/**
 * JSON-LD structured data (schema.org) for search engines and AI answer engines.
 */

define('BUSINESS_ID', abs_url('#business'));
define('WEBSITE_ID', abs_url('#website'));
const SUMMARY = 'Royal Enfield & scooty rental service based in Siliguri, West Bengal — the gateway to the hills — '
              . 'for rides to Darjeeling, Kurseong, Kalimpong, Gangtok, Pelling, North Sikkim, North East India, Bhutan and Nepal.';

function social_links(): array
{
    return array_values(array_filter([SITE['instagram'], SITE['facebook'], SITE['youtube'], SITE['gbp']], fn($u) => str_starts_with($u, 'http')));
}

function business_schema(): array
{
    $offers = [];
    foreach (BIKES as $b) {
        $offers[] = ['@type' => 'Offer', 'itemOffered' => [
            '@type' => 'Service', 'name' => $b['name'] . ' rental',
            'description' => "{$b['summary']} {$b['engine']}. " . implode(', ', $b['features']) . '.',
            'image' => abs_url($b['image']), 'provider' => ['@id' => BUSINESS_ID]]];
    }
    $areas = [['@type' => 'City', 'name' => 'Siliguri']];
    foreach (DESTINATIONS as $d) {
        $areas[] = ['@type' => 'Place', 'name' => $d['name']];
    }
    $schema = [
        '@type' => 'AutoRental', // schema.org LocalBusiness type for vehicle rental
        '@id' => BUSINESS_ID,
        'name' => SITE['name'],
        'url' => SITE['url'],
        'logo' => ['@type' => 'ImageObject', 'url' => abs_url('images/logo-512.png'), 'width' => 512, 'height' => 512],
        'image' => [abs_url('images/hero-1.jpg'), abs_url('images/logo-512.png')],
        'description' => SUMMARY,
        'email' => SITE['email'],
        'telephone' => '+' . SITE['call_raw'],
        'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Siliguri', 'addressRegion' => 'West Bengal', 'addressCountry' => 'IN'],
        'areaServed' => $areas,
        'contactPoint' => ['@type' => 'ContactPoint', 'telephone' => '+' . SITE['call_raw'], 'email' => SITE['email'],
                           'contactType' => 'reservations', 'areaServed' => 'IN'],
        'hasOfferCatalog' => ['@type' => 'OfferCatalog', 'name' => 'Bike & Scooty Rentals', 'itemListElement' => $offers],
        'knowsAbout' => ['Royal Enfield rental', 'Scooty rental', 'Himalayan motorcycle trips', 'Sikkim bike permits', 'Bhutan bike trips'],
    ];
    if ($social = social_links()) {
        $schema['sameAs'] = $social;
    }
    // Optional local details – only output once filled in config.php
    $address = ['streetAddress' => SITE['street'], 'postalCode' => SITE['postcode']];
    $schema['address'] += array_filter($address);
    if (SITE['lat'] !== '' && SITE['lng'] !== '') {
        $schema['geo'] = ['@type' => 'GeoCoordinates', 'latitude' => (float) SITE['lat'], 'longitude' => (float) SITE['lng']];
    }
    if (SITE['hours'] !== '') {
        $schema['openingHours'] = SITE['hours'];
    }
    if (SITE['price_range'] !== '') {
        $schema['priceRange'] = SITE['price_range'];
    }
    if (str_starts_with(SITE['gbp'], 'http')) {
        $schema['hasMap'] = SITE['gbp'];
    }
    return $schema;
}

function faq_schema(array $items): array
{
    return ['@type' => 'FAQPage', 'mainEntity' => array_map(fn($qa) => [
        '@type' => 'Question', 'name' => $qa[0], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $qa[1]]], $items)];
}

function guide_schema(array $g): array
{
    return ['@type' => 'BlogPosting', 'headline' => $g['title'], 'description' => $g['excerpt'], 'image' => abs_url($g['image']),
            'datePublished' => $g['date'], 'dateModified' => $g['updated'] ?? $g['date'], 'inLanguage' => 'en-IN',
            'author' => ['@id' => BUSINESS_ID], 'publisher' => ['@id' => BUSINESS_ID]];
}

function dest_schema(array $d): array
{
    return ['@type' => 'TouristDestination', '@id' => abs_url(dest_url($d) . '#destination'), 'name' => $d['name'],
            'description' => $d['intro'], 'image' => abs_url($d['image']), 'url' => abs_url(dest_url($d)),
            'touristType' => ['Motorcycle touring', 'Road trip'],
            'additionalProperty' => [
                ['@type' => 'PropertyValue', 'name' => 'Distance from Siliguri', 'value' => $d['km'], 'unitCode' => 'KMT'],
                ['@type' => 'PropertyValue', 'name' => 'Riding time from Siliguri', 'value' => $d['time']],
                ['@type' => 'PropertyValue', 'name' => 'Best time to ride', 'value' => $d['best_time']],
                ['@type' => 'PropertyValue', 'name' => 'Permits', 'value' => $d['permit']]]];
}

function destinations_schema(): array
{
    $items = [];
    foreach (DESTINATIONS as $i => $d) {
        $items[] = ['@type' => 'ListItem', 'position' => $i + 1, 'url' => abs_url(dest_url($d)), 'name' => $d['name']];
    }
    return ['@type' => 'ItemList', 'name' => 'Bike trip destinations from Siliguri', 'itemListElement' => $items];
}

function howto_schema(): array
{
    $steps = [];
    foreach (STEPS as $i => [, $t, $d]) {
        $steps[] = ['@type' => 'HowToStep', 'position' => $i + 1, 'name' => $t, 'text' => $d, 'url' => abs_url('how-it-works#how-it-works')];
    }
    return ['@type' => 'HowTo', 'name' => 'How to rent a bike from Task Riders in Siliguri',
            'description' => 'Book a Royal Enfield or scooty in four simple steps.',
            'supply' => [['@type' => 'HowToSupply', 'name' => 'Valid driving licence'],
                         ['@type' => 'HowToSupply', 'name' => 'ID proof (Aadhaar, Passport or Voter ID)']],
            'step' => $steps];
}

/**
 * Full @graph for a page: business + website + webpage (+ breadcrumb) + any extra nodes.
 * $crumb: 'Name' or [['Parent', 'parent-url'], 'Name'].
 */
function schema_graph(string $canonical, array $p): array
{
    $webpage = ['@type' => $p['page_type'], '@id' => $canonical . '#webpage', 'url' => $canonical, 'name' => $p['title'],
                'description' => $p['description'], 'isPartOf' => ['@id' => WEBSITE_ID], 'about' => ['@id' => BUSINESS_ID],
                'inLanguage' => 'en-IN', 'primaryImageOfPage' => ['@type' => 'ImageObject', 'url' => abs_url($p['image'])],
                'dateModified' => UPDATED];
    $extra = [];
    if ($p['crumb']) {
        $trail = is_array($p['crumb']) ? $p['crumb'] : [$p['crumb']];
        $items = [['Home', SITE['url']]];
        foreach ($trail as $c) {
            $items[] = is_array($c) ? [$c[0], abs_url($c[1])] : [$c, $canonical];
        }
        $webpage['breadcrumb'] = ['@id' => $canonical . '#breadcrumb'];
        $list = [];
        foreach ($items as $i => [$n, $u]) {
            $list[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $n, 'item' => $u];
        }
        $extra[] = ['@type' => 'BreadcrumbList', '@id' => $canonical . '#breadcrumb', 'itemListElement' => $list];
    }
    foreach ($p['schema'] as $node) {
        if (in_array($node['@type'], ['FAQPage', 'BlogPosting', 'HowTo'], true)) {
            $node['mainEntityOfPage'] ??= ['@id' => $canonical . '#webpage'];
        }
        $extra[] = $node;
    }
    $website = ['@type' => 'WebSite', '@id' => WEBSITE_ID, 'url' => SITE['url'], 'name' => SITE['name'], 'inLanguage' => 'en-IN',
                'publisher' => ['@id' => BUSINESS_ID]];
    return ['@context' => 'https://schema.org', '@graph' => array_merge([business_schema(), $website, $webpage], $extra)];
}
