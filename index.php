<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'title'       => 'Task Riders – Royal Enfield & Scooty Rental in Darjeeling, Sikkim, Gangtok',
    'description' => 'Rent Royal Enfield Hunter, Meteor, Classic 350 or TVS Ntorq scooty from Siliguri for Darjeeling, Gangtok, Sikkim, Bhutan, Nepal & the North East. Free helmet, permit help, 24/7 support.',
    'schema'      => [faq_schema(FAQ)],
    'preload'     => 'images/hero-1.jpg',
]);
echo hero(), stats(), bikes(), destinations(), steps(), why(), enquiry(), faq(), guides();
page_end();
