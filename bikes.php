<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'path'        => 'bikes',
    'active'      => 'bikes',
    'title'       => 'Royal Enfield & Scooty on Rent in Siliguri | Task Riders',
    'description' => 'Royal Enfield Hunter 350, Meteor 350, Classic 350 and TVS Ntorq 125 on rent in Siliguri for Darjeeling, Gangtok, Sikkim & Bhutan bike trips.',
    'page_type'   => 'CollectionPage',
    'crumb'       => 'Bikes',
    'image'       => 'images/bike-classic.jpg',
]);
echo page_hero('Our Bikes', 'Task Riders rents four bikes from Siliguri: the Royal Enfield Hunter 350, Meteor 350 and Classic 350, and the TVS Ntorq 125 scooty — all serviced before every trip, with a free helmet.', 'Bikes');
echo bikes(), bike_table(), why('section'), cta();
page_end();
