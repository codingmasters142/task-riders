<?php
// One template for every destination page: /<slug>-bike-rental (see .htaccess)
require __DIR__ . '/includes/functions.php';

$d = find_by_slug(DESTINATIONS, $_GET['slug'] ?? '');
if (!$d) {
    require __DIR__ . '/404.php';
    exit;
}

page_start([
    'path'        => dest_url($d),
    'active'      => 'destinations',
    'title'       => "{$d['name']} Bike Rental from Siliguri | Task Riders",
    'description' => "Rent a Royal Enfield in Siliguri for {$d['name']}: about {$d['km']} km, {$d['time']}. Route, best time, permits and the right bike for the ride.",
    'crumb'       => [['Destinations', 'destinations'], $d['name']],
    'schema'      => [dest_schema($d), faq_schema(dest_faq($d))],
    'image'       => $d['image'],
]);
echo page_hero('Bike Rental for ' . e($d['name']), e($d['desc']) . " — about {$d['km']} km from Siliguri.", $d['name'], ['Destinations', 'destinations']);
echo dest_page_body($d), destinations('section section--grey', $d['slug'], 'More Places to Ride'), cta();
page_end();
