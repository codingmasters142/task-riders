<?php
/**
 * Task Riders – site content and settings.
 * EDIT HERE – changes show up on every page immediately.
 */

const SITE = [
    'name'      => 'Task Riders',
    'domain'    => 'taskriders.in',
    'url'       => 'https://taskriders.in/',
    'email'     => 'taskriders.slg@gmail.com',
    'phone'     => '+91 97330 42987', // WhatsApp number
    'phone_raw' => '919733042987',
    'call'      => '+91 92462 40880', // number for phone calls
    'call_raw'  => '919246240880',
    'city'      => 'Siliguri, West Bengal',
    'instagram' => '#', // EDIT: https://instagram.com/yourpage
    'facebook'  => '#', // EDIT: https://facebook.com/yourpage
    'youtube'   => '#', // EDIT or leave '#'
    // Local business details for Google (structured data). Leave '' to skip. Must match your Google Business Profile exactly.
    'street'      => '', // EDIT: e.g. 'Shop 4, Hill Cart Road'
    'postcode'    => '', // EDIT: e.g. '734001'
    'lat'         => '', // EDIT: e.g. '26.7271' (right-click your shop in Google Maps to copy)
    'lng'         => '', // EDIT: e.g. '88.3953'
    'hours'       => '', // EDIT: e.g. 'Mo-Su 08:00-20:00'
    'price_range' => '', // EDIT: e.g. '₹₹' or '₹800–₹2,500 per day'
    'gbp'         => '', // EDIT: your Google Business Profile / Maps link
];

const WA_MESSAGE = 'Hi Task Riders, I want to rent a bike.';

// "Last updated" date shown in schema, sitemap and llms.txt – change when you revise content (YYYY-MM-DD)
const UPDATED = '2026-10-29';

// Pick-up points shown in the hero booking card. EDIT as needed.
const LOCATIONS = ['Siliguri', 'Bagdogra Airport', 'NJP Railway Station'];

// EDIT NUMBERS
const STATS = [
    ['500+', 'Happy Riders'],
    ['9+', 'Destinations'],
    ['24/7', 'Support'],
    ['4.8★', 'Rating'],
];

const BIKES = [
    [
        'name'     => 'Royal Enfield Hunter 350',
        'type'     => 'Bike',
        'image'    => 'images/bike-hunter.jpg',
        'alt'      => 'Royal Enfield roadster motorcycle for rent in Siliguri for Darjeeling rides',
        'engine'   => '349 cc',
        'summary'  => 'Light, easy handling, great for city & hills.',
        'features' => ['Lightest Royal Enfield', 'Nimble on hairpin bends', 'Ideal for Darjeeling & Kurseong'],
        'best_for' => 'Short hill rides, Darjeeling & Kurseong, city riding',
        'rider'    => 'Newer riders and lighter riders',
    ],
    [
        'name'     => 'Royal Enfield Meteor 350',
        'type'     => 'Bike',
        'image'    => 'images/bike-meteor.jpg',
        'alt'      => 'Royal Enfield cruiser motorcycle for long highway rides to Bhutan and the North East',
        'engine'   => '349 cc',
        'summary'  => 'Comfortable cruiser for long rides.',
        'features' => ['Relaxed cruiser seating', 'Smooth on long highways', 'Great for Bhutan & North East'],
        'best_for' => 'Long highway days to Bhutan & the North East, riding two-up',
        'rider'    => 'Riders who want relaxed, cruiser comfort',
    ],
    [
        'name'     => 'Royal Enfield Classic 350',
        'type'     => 'Bike',
        'image'    => 'images/bike-classic.jpg',
        'alt'      => 'Royal Enfield Classic 350 on rent for Sikkim and Himalayan mountain trips',
        'engine'   => '349 cc',
        'summary'  => 'Iconic touring bike for mountain trips.',
        'features' => ['The iconic thump', 'Steady touring comfort', 'Built for Sikkim passes'],
        'best_for' => 'Mountain touring in Sikkim and multi-day trips',
        'rider'    => 'Riders who want the classic Royal Enfield feel',
    ],
    [
        'name'     => 'TVS Ntorq 125',
        'type'     => 'Scooty',
        'image'    => 'images/scooty-ntorq.jpg',
        'alt'      => 'Scooty on rent in Siliguri and Darjeeling for local sightseeing',
        'engine'   => '124.8 cc',
        'summary'  => 'Easy, fuel-efficient for local sightseeing.',
        'features' => ['Gearless & easy to ride', 'Fuel-efficient', 'Perfect for town sightseeing'],
        'best_for' => 'Town sightseeing in Siliguri, Kurseong & nearby',
        'rider'    => 'Anyone who prefers a gearless scooter',
    ],
];

// Each destination gets its own page: /<slug>-bike-rental
// Distances / times are approximate road figures from Siliguri – EDIT if your experience differs.
const DESTINATIONS = [
    [
        'slug' => 'darjeeling', 'name' => 'Darjeeling', 'image' => 'images/dest-darjeeling.jpg',
        'alt' => 'Darjeeling toy train passing through tea gardens', 'desc' => 'Tea gardens, toy train & Kanchenjunga views',
        'km' => 65, 'time' => '2.5–3 hours', 'altitude' => 'about 2,050 m',
        'route' => 'Siliguri → Rohini Road → Kurseong → Ghum → Darjeeling (or the Hill Cart Road via Tindharia)',
        'best_time' => 'March–May and October–December', 'permit' => 'No permit needed.',
        'bike' => 'Royal Enfield Classic 350 or Hunter 350',
        'intro' => 'Darjeeling is about 65 km from Siliguri — a 2.5 to 3 hour climb through tea estates to around 2,050 m. '
                 . "It's the most popular day or weekend ride from Siliguri, and no permit is needed.",
    ],
    [
        'slug' => 'kurseong', 'name' => 'Kurseong', 'image' => 'images/dest-kurseong.jpg',
        'alt' => 'Green tea garden hills on the road to Kurseong', 'desc' => 'Misty tea estates, a perfect half-day climb',
        'km' => 32, 'time' => 'about 1.5 hours', 'altitude' => 'about 1,450 m',
        'route' => 'Siliguri → Rohini Road → Kurseong',
        'best_time' => 'All year; clearest views October–April', 'permit' => 'No permit needed.',
        'bike' => 'Royal Enfield Hunter 350 or TVS Ntorq 125',
        'intro' => 'Kurseong is only about 32 km from Siliguri — roughly 1.5 hours up the scenic Rohini Road through tea gardens. '
                 . "It's an easy half-day ride and a great first hill ride on a rented bike or scooty.",
    ],
    [
        'slug' => 'kalimpong', 'name' => 'Kalimpong', 'image' => 'images/dest-kalimpong.jpg',
        'alt' => 'Aerial view of green hills and town in Kalimpong', 'desc' => 'Monasteries & Teesta valley curves',
        'km' => 70, 'time' => '2.5–3 hours', 'altitude' => 'about 1,250 m',
        'route' => 'Siliguri → Sevoke (Coronation Bridge) → NH10 along the Teesta → Teesta Bazaar → Kalimpong',
        'best_time' => 'March–May and October–December', 'permit' => 'No permit needed.',
        'bike' => 'Royal Enfield Hunter 350 or Classic 350',
        'intro' => 'Kalimpong is about 70 km from Siliguri, around 2.5 to 3 hours along the Teesta river on NH10 and then up into the hills. '
                 . 'No permit is needed, and it pairs well with Darjeeling or Gangtok on a longer loop.',
    ],
    [
        'slug' => 'gangtok', 'name' => 'Gangtok', 'image' => 'images/dest-gangtok.jpg',
        'alt' => 'Gangtok city spread across a Sikkim hillside', 'desc' => "Sikkim's capital via the river-side NH10",
        'km' => 115, 'time' => '4–5 hours', 'altitude' => 'about 1,650 m',
        'route' => 'Siliguri → Sevoke → NH10 along the Teesta → Rangpo (Sikkim check post) → Singtam → Gangtok',
        'best_time' => 'March–May and October–December',
        'permit' => "Indian citizens don't need a permit for Gangtok. Foreign nationals need a Restricted Area Permit (RAP) for Sikkim.",
        'bike' => 'Royal Enfield Classic 350',
        'intro' => 'Gangtok is about 115 km from Siliguri, usually 4 to 5 hours on NH10 along the Teesta river, entering Sikkim at Rangpo. '
                 . "Indian riders don't need a permit for Gangtok itself; it's also the base for East and North Sikkim trips.",
    ],
    [
        'slug' => 'pelling', 'name' => 'Pelling', 'image' => 'images/dest-pelling.jpg',
        'alt' => 'Hilltop statue and winding road near Pelling, West Sikkim', 'desc' => 'Front-row views of Kanchenjunga',
        'km' => 135, 'time' => '5–6 hours', 'altitude' => 'about 2,150 m',
        'route' => 'Siliguri → Sevoke → Melli → Jorethang → Legship → Geyzing → Pelling',
        'best_time' => 'March–May and October–December',
        'permit' => "Indian citizens don't need a permit. Foreign nationals need a Restricted Area Permit (RAP) for Sikkim.",
        'bike' => 'Royal Enfield Classic 350',
        'intro' => 'Pelling in West Sikkim is about 135 km from Siliguri, around 5 to 6 hours via Melli and Jorethang. '
                 . "It's known for close-up Kanchenjunga views, and Indian riders don't need a permit.",
    ],
    [
        'slug' => 'north-sikkim', 'name' => 'North Sikkim', 'image' => 'images/dest-north-sikkim.jpg',
        'alt' => 'High-altitude lake below snow peaks in North Sikkim', 'desc' => 'High passes, glacial lakes & snow',
        'km' => 235, 'time' => '2 days (overnight in Gangtok)', 'altitude' => 'about 2,700 m at Lachung; over 5,000 m at Gurudongmar Lake',
        'route' => 'Siliguri → Gangtok → Mangan → Chungthang → Lachen or Lachung',
        'best_time' => 'April–June and October–November',
        'permit' => 'A Protected Area Permit is required for Lachen, Lachung, Yumthang and Gurudongmar, arranged through a registered tour operator. Some areas are closed to foreign nationals.',
        'bike' => 'Royal Enfield Classic 350',
        'intro' => 'North Sikkim — Lachen, Lachung, Yumthang Valley and Gurudongmar Lake — is roughly 235 km from Siliguri and is best ridden over 2 days with a night in Gangtok. '
                 . "It's a protected area, so a permit is required; contact us before planning this ride.",
    ],
    [
        'slug' => 'north-east', 'name' => 'North East India', 'image' => 'images/dest-northeast.jpg',
        'alt' => 'Green valley and waterfall in North East India', 'desc' => 'Epic loops through the Seven Sisters',
        'km' => 450, 'time' => '9–11 hours to Guwahati', 'altitude' => 'varies from plains to high mountain passes',
        'route' => 'Siliguri → NH27 east through the Dooars and lower Assam → Guwahati, the gateway to the Seven Sisters',
        'best_time' => 'October–April',
        'permit' => "Indian visitors need an Inner Line Permit (ILP) for Arunachal Pradesh, Nagaland, Mizoram and Manipur. Assam and Meghalaya don't need one.",
        'bike' => 'Royal Enfield Meteor 350 or Classic 350',
        'intro' => 'Guwahati, the gateway to North East India, is about 450 km from Siliguri — a long 9 to 11 hour day on NH27. '
                 . 'From there, multi-day loops cover Meghalaya, Arunachal Pradesh and beyond; some states need an Inner Line Permit.',
    ],
    [
        'slug' => 'bhutan', 'name' => 'Bhutan', 'image' => 'images/dest-bhutan.jpg',
        'alt' => "Tiger's Nest monastery on a cliff in Bhutan", 'desc' => 'Dzongs, prayer flags & smooth mountain roads',
        'km' => 160, 'time' => 'about 4–5 hours to Phuentsholing', 'altitude' => 'about 2,300 m at Thimphu',
        'route' => 'Siliguri → NH27 east through the Dooars → Jaigaon / Phuentsholing border → Thimphu',
        'best_time' => 'March–May and October–November',
        'permit' => "Indian riders need an entry permit (passport or Voter ID), a vehicle permit for the bike, and must pay Bhutan's daily Sustainable Development Fee (SDF).",
        'bike' => 'Royal Enfield Meteor 350 or Classic 350',
        'intro' => 'The Bhutan border at Jaigaon–Phuentsholing is about 160 km from Siliguri, around 4 to 5 hours through the Dooars. '
                 . "Indian riders need an entry permit, a vehicle permit and the daily SDF; contact us first for the bike's paperwork.",
    ],
    [
        'slug' => 'nepal', 'name' => 'Nepal', 'image' => 'images/dest-nepal.jpg',
        'alt' => 'Hill village with snow-capped Himalaya in Nepal', 'desc' => 'Hill towns & Himalayan highways',
        'km' => 35, 'time' => 'about 1 hour to the Kakarbhitta border', 'altitude' => 'about 1,200 m at Ilam',
        'route' => 'Siliguri → Panitanki (India) / Kakarbhitta (Nepal) border → Mechi Highway → Ilam and beyond',
        'best_time' => 'October–November and March–April',
        'permit' => "Indian citizens don't need a visa (carry a passport or Voter ID). An Indian vehicle needs a customs permit (bhansar) at the border.",
        'bike' => 'Royal Enfield Classic 350 or Meteor 350',
        'intro' => 'The Nepal border at Panitanki–Kakarbhitta is only about 35 km from Siliguri, around an hour away. '
                 . "Indian riders don't need a visa, but the bike needs a customs (bhansar) permit at the border — we help with the paperwork.",
    ],
];

const STEPS = [
    ['bike', 'Choose your bike & dates', 'Pick a Royal Enfield or scooty and tell us your travel dates.'],
    ['chat', 'Confirm on WhatsApp / form', 'Send an enquiry — we confirm availability quickly.'],
    ['key', 'Pick up your keys', "Quick document check (Driving Licence + ID) and you're set."],
    ['route', 'Ride & return', 'Explore the hills and drop the bike back on time.'],
];

const WHY = [
    ['wrench', 'Well-serviced Royal Enfields', 'Every bike is checked and serviced before every trip.'],
    ['helmet', 'Free helmet with every bike', 'Clean, ISI-marked helmets included at no extra cost.'],
    ['doc', 'Permit help for Sikkim, Bhutan & Nepal', 'We guide you through the paperwork for cross-border rides.'],
    ['support', '24/7 on-road support', 'One call or WhatsApp away, wherever the road takes you.'],
];

const FAQ = [
    ['What documents are needed?',
     'A valid driving licence and an ID proof (Aadhaar, Passport or Voter ID). Please carry the originals at pickup.'],
    ['Is a helmet provided?',
     'Yes, a helmet is free with every booking.'],
    ['Can I take the bike to Bhutan / Nepal?',
     "Yes. Contact us before your trip and we'll help you with the permits and paperwork needed."],
    ['Is fuel included?',
     'No, fuel is extra. Bikes are handed over with enough fuel to reach the nearest pump.'],
    ['How do I book?',
     'Fill the enquiry form on this site or WhatsApp us on +91 97330 42987.'],
    ['Where can I rent a Royal Enfield for Darjeeling or Sikkim?',
     'Task Riders rents the Royal Enfield Hunter 350, Meteor 350, Classic 350 and the TVS Ntorq 125 scooty from Siliguri, '
     . 'the gateway to Darjeeling, Sikkim, Bhutan and Nepal. Book through the enquiry form or on WhatsApp.'],
    ['How far are Darjeeling and Gangtok from Siliguri by bike?',
     'Darjeeling is about 65 km (2.5–3 hours) and Gangtok is about 115 km (4–5 hours) from Siliguri. '
     . 'Kurseong is about 32 km and Kalimpong about 70 km.'],
    ['Do I need a permit to ride to Sikkim?',
     "Indian citizens don't need a permit for Gangtok, Pelling and most of Sikkim. Protected areas such as Nathula, Tsomgo Lake, "
     . 'Lachen, Lachung and Gurudongmar need a permit arranged through a registered tour operator. Foreign nationals need a Restricted Area Permit.'],
    ['Can I rent a bike for a week or longer?',
     'Yes. We offer flexible daily and weekly rentals.'],
    ['How much does it cost to rent a bike?',
     "Rates depend on the bike and the number of days. Send us your bike and dates on WhatsApp and we'll share a quote."],
    ['Do you offer support during the ride?',
     'Yes, we offer 24/7 on-road support by phone and WhatsApp.'],
];

// Ride guides – each gets its own page: /<slug>
const GUIDES = [
    [
        'slug'      => 'guide-darjeeling-to-gangtok',
        'title'     => 'Darjeeling to Gangtok Bike Trip Guide',
        'image'     => 'images/blog-1.jpg',
        'alt'       => 'Winding road through green tea hills on the Darjeeling to Gangtok ride',
        'excerpt'   => 'Route, riding time, fuel stops and tips for one of the best hill rides in the East.',
        'meta'      => 'Darjeeling to Gangtok by bike: about 95–100 km and 4–5 hours. Route via Teesta Bazaar and Rangpo, fuel stops, best bike and riding tips.',
        'read'      => '4 min read',
        'date'      => '2026-10-29', // published date (YYYY-MM-DD)
        'takeaways' => ['About 95–100 km and 4–5 hours with stops',
                        'Route: Darjeeling – Ghum – Lopchu – Peshok – Teesta Bazaar – NH10 – Rangpo – Gangtok',
                        'Best bike: Royal Enfield Classic 350 or Hunter 350',
                        'Avoid riding NH10 in heavy monsoon rain; start early'],
        'body'      => <<<'HTML'
<p>The ride from Darjeeling to Gangtok is about <strong>95–100 km</strong> and usually takes <strong>4–5 hours</strong> with stops. You drop from the cool tea hills of Darjeeling down to the Teesta river, then climb again into Sikkim — two very different worlds in a single day.</p>

<h2>The route</h2>
<p>The most popular route runs <strong>Darjeeling → Ghum → Lopchu → Peshok → Teesta Bazaar</strong>, then follows the Teesta river on NH10 via <strong>Rangpo and Singtam</strong> up to <strong>Gangtok</strong>. Rangpo is the main entry checkpoint into Sikkim.</p>
<ul>
  <li><strong>Lopchu & Peshok:</strong> tea estates and a long descent with tight hairpins — take it slow.</li>
  <li><strong>Teesta Bazaar:</strong> good stop for tea and snacks by the river.</li>
  <li><strong>NH10:</strong> scenic but busy with trucks and taxis; road works are common.</li>
</ul>

<h2>Best bike for this ride</h2>
<p>The <strong>Royal Enfield Classic 350</strong> or <strong>Hunter 350</strong> are ideal — enough torque for the climbs and easy to handle on the bends. Riding two-up with luggage? Pick the Classic.</p>

<h2>Tips</h2>
<ul>
  <li>Start early — mornings have the clearest views and the lightest traffic.</li>
  <li>Fill up before you leave and again at Teesta Bazaar, Rangpo or Singtam.</li>
  <li>During the monsoon (June–September), check road status before you go — NH10 is prone to landslides.</li>
  <li>Carry your licence, ID and bike papers for the Rangpo checkpoint.</li>
</ul>
<p class="guide-note">Road and permit rules change from time to time. WhatsApp us before your trip and we'll share the latest road updates.</p>
HTML,
    ],
    [
        'slug'      => 'guide-sikkim-permits',
        'title'     => 'Sikkim Permits for Bikers',
        'image'     => 'images/blog-2.jpg',
        'alt'       => 'Snow-covered high mountain road in North Sikkim',
        'excerpt'   => 'Which places in Sikkim need a permit, how to get one and what to carry.',
        'meta'      => 'Sikkim permits for bikers: which places need one (Tsomgo, Nathula, Lachen, Lachung, Gurudongmar), how to get it and what to carry.',
        'read'      => '3 min read',
        'date'      => '2026-10-29',
        'takeaways' => ['Indian citizens need no permit for Gangtok, Pelling and most of Sikkim',
                        'Permits are needed for Tsomgo Lake, Nathula, Zuluk, Lachen, Lachung, Yumthang and Gurudongmar',
                        'Permits are arranged through registered local tour operators',
                        'Foreign nationals need a Restricted Area Permit (RAP)'],
        'body'      => <<<'HTML'
<p>Most of Sikkim is open to Indian riders, but some high-altitude and border areas are <strong>protected</strong> and need a permit. Here's a quick overview to help you plan.</p>

<h2>No permit needed (Indian citizens)</h2>
<p>Gangtok, Pelling, Ravangla, Namchi and most of South and West Sikkim. Just carry your ID and bike documents for checkpoints such as <strong>Rangpo</strong>.</p>

<h2>Permit needed</h2>
<ul>
  <li><strong>East Sikkim:</strong> Tsomgo (Changu) Lake, Nathula Pass, Zuluk and the Old Silk Route.</li>
  <li><strong>North Sikkim:</strong> Lachen, Lachung, Yumthang Valley, Gurudongmar Lake.</li>
</ul>
<p>Permits for these areas are generally arranged through a <strong>registered local tour operator</strong>. You'll typically need ID proof, passport-size photos and your route and dates.</p>

<h2>Foreign nationals</h2>
<p>Foreign visitors need a <strong>Restricted Area Permit (RAP)</strong> to enter Sikkim, and many protected areas have extra rules or are closed to foreigners. Apply well in advance.</p>

<h2>Riding a rented bike</h2>
<p>Some protected areas have rules about which vehicles are allowed in. <strong>Talk to us before you plan North or East Sikkim</strong> — we'll tell you what's possible with your bike and help with the paperwork.</p>

<p class="guide-note">Permit rules change often and areas may close due to weather or road conditions. Always confirm the latest rules before your trip.</p>
HTML,
    ],
    [
        'slug'      => 'guide-bhutan-best-time',
        'title'     => 'Best Time to Ride in Bhutan',
        'image'     => 'images/blog-3.jpg',
        'alt'       => 'Traditional Bhutanese dzong below cloudy mountains',
        'excerpt'   => 'Season-by-season guide to planning your Bhutan motorcycle trip from Siliguri.',
        'meta'      => 'Best time to ride a motorcycle in Bhutan: March–May and October–November. Season-by-season guide, permits and SDF for riders from Siliguri.',
        'read'      => '3 min read',
        'date'      => '2026-10-29',
        'takeaways' => ['Best seasons: March–May and October–November',
                        'Avoid the June–September monsoon if you can',
                        'Enter from Siliguri via Jaigaon – Phuentsholing (about 160 km)',
                        'Indian riders need an entry permit, a vehicle permit and the daily SDF'],
        'body'      => <<<'HTML'
<p>Bhutan has some of the smoothest, quietest mountain roads in the Himalayas. From Siliguri, riders usually enter through <strong>Jaigaon – Phuentsholing</strong>. Picking the right season makes all the difference.</p>

<h2>Spring (March – May) — best</h2>
<p>Pleasant days, rhododendrons in bloom and good visibility. One of the two best windows to ride.</p>

<h2>Autumn (October – November) — best</h2>
<p>Clear skies after the monsoon and the sharpest mountain views. Also festival season, so book early.</p>

<h2>Monsoon (June – September) — avoid if you can</h2>
<p>Heavy rain, slippery roads and landslides on the highways. If you must ride, keep spare days in your plan.</p>

<h2>Winter (December – February) — for experienced riders</h2>
<p>Crisp and clear, but cold mornings and possible snow or ice on high passes like Dochula and Chele La.</p>

<h2>Before you go</h2>
<ul>
  <li>Indian riders need a valid <strong>passport or Voter ID</strong> for the entry permit.</li>
  <li>A <strong>vehicle permit</strong> is needed to ride your bike inside Bhutan.</li>
  <li>Visitors pay a daily <strong>Sustainable Development Fee (SDF)</strong> — check the current rate.</li>
</ul>
<p>Planning a Bhutan ride? <strong>Contact us first</strong> and we'll help with the documents your rented bike needs.</p>

<p class="guide-note">Bhutan's entry rules and fees are updated from time to time. Please check the latest official information before you travel.</p>
HTML,
    ],
];
