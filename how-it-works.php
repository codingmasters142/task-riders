<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'path'        => 'how-it-works',
    'active'      => 'how-it-works',
    'title'       => 'How to Rent a Bike in Siliguri – Simple 4-Step Booking | Task Riders',
    'description' => 'Book a Royal Enfield or scooty in 4 easy steps: choose your bike, confirm on WhatsApp, pick up after a quick document check, and ride.',
    'crumb'       => 'How it Works',
    'schema'      => [howto_schema()],
]);
echo page_hero('How it Works', 'Renting a bike from Task Riders takes four steps: choose your bike and dates, confirm on WhatsApp or the form, pick up after a quick licence and ID check, then ride and return.', 'How it Works');
echo steps(), why(), cta();
page_end();
