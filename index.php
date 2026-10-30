<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'title'       => 'Royal Enfield Rental in Siliguri & Darjeeling | Task Riders',
    'description' => 'Rent a Royal Enfield or scooty in Siliguri for Darjeeling, Gangtok, Sikkim, Bhutan, Nepal & the North East. Free helmet, permit help, 24/7 support.',
    'schema'      => [faq_schema(FAQ)],
    'preload'     => 'images/hero-1.jpg',
    'calendar'    => true,
]);
echo hero(), stats(), bikes(), destinations(), steps(), why(), enquiry(), faq(), guides();
page_end();
