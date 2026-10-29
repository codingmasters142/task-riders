<?php
require __DIR__ . '/includes/functions.php';

page_start([
    'path'        => 'about',
    'title'       => 'About Task Riders – Himalayan Bike Rentals from Siliguri',
    'description' => 'Task Riders rents well-serviced Royal Enfields and scooties from Siliguri for rides to Darjeeling, Sikkim, Bhutan, Nepal and the North East.',
    'page_type'   => 'AboutPage',
    'crumb'       => 'About',
]);
echo page_hero('About Task Riders', 'Himalayan bike rentals from the hills.', 'About');
?>
<section class="section">
  <div class="container container--narrow prose">
    <p class="lead">Task Riders is a bike rental service based in <strong>Siliguri</strong> — the gateway to the Eastern Himalayas. We help riders explore Darjeeling, Sikkim, Bhutan, Nepal and the North East on well-maintained Royal Enfields and easy-going scooties.</p>
    <p>Our bikes are serviced before every trip, every rental comes with a free helmet, and our team is on call 24/7 while you're on the road. Planning a ride to Sikkim, Bhutan or Nepal? We'll help you with the permits and paperwork too.</p>
    <p>Whether it's a quick spin up to Kurseong or a two-week loop through the mountains, we want you to ride with confidence.</p>
  </div>
</section>
<?php
echo stats(), why(), cta();
page_end();
