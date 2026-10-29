# Action Plan – Task Riders (taskriders.in)

Score today: **75 / 100**.

_Code fixes applied on 29 Oct 2026: titles, descriptions, schema fields (fill them in `SITE` in `includes/config.php`), security headers, robots.txt, keywords tag removed._ No critical (indexing-blocking) issues were found.

## High (this week)
- [ ] Back up or remove the "4.8★ Rating" and "500+ Happy Riders" stats (`STATS` in `includes/config.php`). Add real reviews/testimonials or link your Google reviews.
- [ ] Publish starting prices per bike (per day / per week, deposit, what's included) on `/bikes` and the bike cards.
- [ ] Add the full business address, PIN code, geo coordinates, opening hours and price range to `business_schema()` in `includes/schema.php`. Show the address and a map on `/contact`.
- [ ] Add 150–300 unique words plus your own photos to the Darjeeling, Gangtok and Bhutan destination pages first, then the other six.

## Medium (next 2–4 weeks)
- [ ] Fill in the real Instagram/Facebook/YouTube URLs in `SITE` (`includes/config.php`) and add the Google Business Profile URL to `sameAs`.
- [x] Shorten the destination titles in `destination.php` to under 60 characters; shorten the `/destinations` title.
- [x] Bring meta descriptions to 120–160 characters (home, destinations, North Sikkim, Bhutan, Nepal, all 3 guides).
- [ ] Replace the 4 placeholder bike photos with real fleet photos.
- [ ] Expand the About page: owner name and photo, years operating, shop location.
- [ ] Convert the hero and other images to WebP and add `srcset` (800/1200/1600 px).
- [x] Add security headers to `.htaccess` and hide `X-Powered-By`.
- [ ] Expand the guides to 800+ words; add 3–5 new guides; create a `/guides` hub page.

## Low (backlog)
- [ ] Add a "Rental terms" FAQ section (deposit, damage, late return, cancellation, minimum age).
- [x] Tidy `robots.txt` (drop the per-bot `Allow` groups or repeat the Disallow).
- [ ] ~~Remove `meta keywords`~~ (done); review whether font weights 500 and 600 are needed.
- [ ] Give pages their own `updated` dates instead of one global `UPDATED`.

## After going live
- [ ] Check HTTPS, HTTP→HTTPS and www→non-www redirects, and cache headers.
- [ ] Submit `https://taskriders.in/sitemap.xml` in Google Search Console and Bing Webmaster Tools.
- [ ] Run PageSpeed Insights on the home page and one destination page.
- [ ] Set up or verify the Google Business Profile (category: Motorcycle rental agency).
