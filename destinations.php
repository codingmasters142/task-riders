<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'path'        => 'destinations',
    'active'      => 'destinations',
    'title'       => 'Bike Trip Distances from Siliguri | Task Riders',
    'description' => 'Distances, riding times, permits and best seasons for bike trips from Siliguri to Darjeeling, Gangtok, Sikkim, Bhutan, Nepal and North East India.',
    'page_type'   => 'CollectionPage',
    'crumb'       => 'Destinations',
    'schema'      => [destinations_schema()],
]);
echo page_hero('Destinations We Cover', 'From Siliguri you can ride to Darjeeling (~65 km), Gangtok (~115 km), Kalimpong, Pelling, North Sikkim, the North East, Bhutan and Nepal. Pick a destination for route, permit and season details.', 'Destinations');
echo destinations('section'), distance_table(), guides('section'), cta();
page_end();
