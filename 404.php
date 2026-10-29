<?php
require_once __DIR__ . '/includes/functions.php';

page_start([
    'path'        => '404',
    'title'       => 'Page not found | Task Riders',
    'description' => 'This page could not be found.',
    'status'      => 404,
]);
echo page_hero('Page not found', "Sorry, we couldn't find that page. Try one of these destinations instead.", '404');
echo destinations('section'), cta();
page_end();
