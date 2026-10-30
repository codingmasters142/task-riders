<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'path'        => 'contact',
    'active'      => 'contact',
    'title'       => 'Contact & Book – Bike Rental in Siliguri | Task Riders',
    'description' => 'Book a Royal Enfield or scooty in Siliguri. Call or WhatsApp ' . SITE['phone'] . ' or email ' . SITE['email'] . '.',
    'page_type'   => 'ContactPage',
    'crumb'       => 'Contact',
    'calendar'    => true,
]);
echo page_hero('Contact &amp; Booking', 'Call or WhatsApp ' . e(SITE['phone']) . ', email ' . e(SITE['email']) . ', or send the enquiry form below — we reply fast.', 'Contact');
echo enquiry(), faq();
page_end();
