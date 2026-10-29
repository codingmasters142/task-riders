<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'path'        => 'faq',
    'active'      => 'faq',
    'title'       => 'Bike Rental FAQ – Documents, Permits & Prices | Task Riders',
    'description' => 'Answers to common questions about renting a Royal Enfield or scooty in Siliguri: documents, helmets, fuel, Sikkim permits, Bhutan & Nepal trips and prices.',
    'crumb'       => 'FAQ',
    'schema'      => [faq_schema(FAQ)],
]);
echo page_hero('Frequently Asked Questions', 'Everything you need to know before your ride.', 'FAQ');
echo faq('section'), cta();
page_end();
