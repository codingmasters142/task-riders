# SEO Audit – Task Riders (taskriders.in)

Audited: 29 October 2026, local copy at http://localhost/task-riders/ (XAMPP).
Scope: 19 indexable pages from the sitemap, plus robots.txt, sitemap.xml, llms.txt, 404 and redirect behaviour, and the PHP source.
Not covered (local copy only): real Core Web Vitals field data, HTTPS/SSL on the live host, live caching headers, Google Search Console indexation, and backlinks.

## Executive summary

**SEO Health Score: 75 / 100**
**Business type:** local service, vehicle rental (Royal Enfield and scooty hire in Siliguri, a service-area business).

The technical base is strong: clean URLs, canonicals, a correct sitemap, a real 404 status, 301s from old `.html`/`.php` addresses, a rich JSON-LD graph and `llms.txt`. Most of the lost points come from **trust and content depth**, not code.

### Top 5 issues
1. **No reviews or proof behind the "4.8★ Rating" and "500+ Happy Riders" stats.** Unverified claims hurt trust (E-E-A-T) and conversions.
2. **No prices anywhere.** "Bike rent price in Siliguri" style searches are the main commercial intent; pages can't answer them.
3. **Thin, templated destination pages.** The 9 `/…-bike-rental` pages share one template with roughly 250 unique words each. This risks being treated as near-duplicate "doorway" pages.
4. **Incomplete local business details.** No street address, PIN code, map, opening hours or Google Business Profile link. The schema has only city/region.
5. **Social links are `#` placeholders**, so the `sameAs` list is empty and the footer icons go nowhere.

### Top 5 quick wins
1. Fill in the real Instagram/Facebook/YouTube URLs in `includes/config.php`.
2. Shorten the destination page titles to under 60 characters.
3. Add `streetAddress`, `postalCode`, `geo`, `openingHours` and `priceRange` to the AutoRental schema.
4. Replace the 4 placeholder bike photos with real photos of your own fleet.
5. Add "from ₹X/day" starting prices to the bikes page and the bike cards.

## Category scores

| Category | Weight | Score |
|---|---|---|
| Technical SEO | 22% | 85 |
| Content quality | 23% | 58 |
| On-page SEO | 20% | 75 |
| Schema / structured data | 10% | 80 |
| Performance | 10% | 80 (lab estimate) |
| AI search readiness | 10% | 85 |
| Images | 5% | 70 |
| **Overall** | | **75** |

---

## Technical SEO — 85

**What works**
- All 19 sitemap URLs return 200; an unknown URL returns a real **404** with `noindex`.
- `/bikes.php` → `/bikes` and `/index.html` → `/` are 301 redirects, so old addresses keep their value.
- A self-referencing canonical on every page, absolute `https://taskriders.in/` URLs, `lang="en-IN"`.
- `robots.txt` allows search and AI crawlers and points to the sitemap.
- `includes/` is blocked from direct access; directory listing is off.
- Pages are small (20–50 KB HTML) and server-rendered, with no JavaScript needed to see the content.

**Findings**
| Severity | Finding | Fix |
|---|---|---|
| Medium | No security headers (HSTS, X-Content-Type-Options, Referrer-Policy, X-Frame-Options), and `X-Powered-By: PHP/8.2.12` is exposed. | Add a `mod_headers` block to `.htaccess`; set `expose_php = Off` or `Header unset X-Powered-By`. |
| Medium | Cache headers weren't sent locally (`mod_expires` is not enabled in XAMPP). They are unverified on the live host. | After going live, check that `curl -I https://taskriders.in/images/hero-1.jpg` shows `Cache-Control`/`Expires`. |
| Low | In `robots.txt`, Googlebot and Bingbot have their own `Allow: /` groups, so they ignore the `Disallow: /_build/` rule under `*`. | Remove the per-bot groups (they add nothing) or repeat the Disallow in each group. |
| Low | All sitemap `lastmod` dates equal the single global `UPDATED` value, so they don't reflect real per-page changes. | Fine for launch; later, give guides and destinations their own `updated` dates. |
| Info | HTTPS, a www→non-www redirect and HTTP→HTTPS can only be checked on the live domain. | Verify after deployment. |

## Content quality — 58

**What works**
- A clear "Quick answer" block and fact table on every destination page: distance, time, altitude, route, season, permits and recommended bike.
- Useful, specific local knowledge: Rangpo checkpoint, bhansar permit for Nepal, ILP states, Bhutan SDF.
- "Last updated" dates and "rules change" disclaimers on the guides.

**Findings**
| Severity | Finding | Fix |
|---|---|---|
| High | The "4.8★ Rating" and "500+ Happy Riders" stats have no source, and there are no reviews or testimonials on the site. | Link to your Google reviews or add 3–6 real, named testimonials. Remove the rating until it's backed by real reviews. Don't add `AggregateRating` schema for self-written reviews. |
| High | No pricing information. | Publish starting prices (per day and per week) for each bike, plus the deposit and what's included. |
| High | Destination pages are templated (~250 unique words each). Only the numbers and names change. | Add 150–300 words of genuinely unique content per destination: road conditions, fuel stops, where to stay, a sample itinerary and your own photos. Start with Darjeeling, Gangtok and Bhutan. |
| Medium | Who runs Task Riders isn't stated. The About page is 3 short paragraphs, and guides are authored by "the Task Riders team". | Add the owner's or founder's name, photo and riding experience, how long you've operated, and your shop/pick-up location. |
| Medium | All photos are Unsplash stock, including the 4 bike photos (marked as placeholders in `images/CREDITS.txt`). | Replace with real photos of your bikes, your shop and customers on rides. |
| Medium | Guides are short (~250 words of body text) and there are only 3. | Expand each to 800+ words and add guides for high-demand searches (e.g. "Siliguri to Darjeeling by bike", "Zuluk / Old Silk Route ride", "Royal Enfield rental documents"). |
| Low | Rental terms (deposit, damage, late return, cancellation, age limit) aren't stated. | Add a short "Rental terms" section to the FAQ. |

## On-page SEO — 75

**What works**
- Exactly one H1 on every page, with a sensible H2/H3 structure.
- Unique titles and descriptions on all pages.
- Strong internal linking: the footer links all 9 destinations, the distance table links each destination, and related destinations/guides are cross-linked.
- Breadcrumbs (visible and in schema) on inner pages.

**Findings**
| Severity | Finding | Fix |
|---|---|---|
| Medium | Destination titles are 79–90 characters (`… – Distance, Route & Permits | Task Riders`), and `/destinations` is 103. Google truncates around 60. | Use e.g. `Darjeeling Bike Rental from Siliguri | Task Riders` (≈50 chars) in `destination.php`. |
| Medium | Meta descriptions are too long on home (189), `/destinations` (182), and the North Sikkim, Bhutan and Nepal pages (179–183). Guide descriptions are short (71–83). | Keep them to 120–160 characters. Write fuller guide descriptions. |
| Low | There's no ride-guides index page. Guide breadcrumbs read "Ride Guides", but it isn't a link. | Add a `/guides` hub page and link it from the nav or footer. |
| Low | The `meta keywords` tag is ignored by Google. | Harmless; you can remove it. |

## Schema / structured data — 80

**What works**
- One connected `@graph` per page: `AutoRental` (LocalBusiness), `WebSite`, `WebPage`, `BreadcrumbList`, plus `TouristDestination`, `FAQPage`, `BlogPosting`, `HowTo` and `ItemList` where relevant.
- All JSON-LD blocks parse as valid JSON.
- An `OfferCatalog` lists each bike.

**Findings**
| Severity | Finding | Fix |
|---|---|---|
| High | `address` has only locality, region and country. There's no `streetAddress`, `postalCode`, `geo`, `openingHoursSpecification`, `priceRange` or `hasMap`. | Add them in `business_schema()` (`includes/schema.php`). They must match your Google Business Profile exactly. |
| Medium | `sameAs` is empty because the social URLs are `#`. | Fill in the real profile URLs, plus your Google Business Profile URL. |
| Low | The offers have no price (`priceSpecification`). | Add one once prices are published. |
| Info | Google now shows FAQ rich results only for government/health sites and has dropped HowTo rich results. | Keep the markup (it helps AI answers), but don't expect FAQ dropdowns in Google. |

## Performance — 80 (lab estimate, no field data)

**What works**
- Self-hosted, preloaded Poppins fonts; one CSS file (30 KB) and one deferred JS file (8 KB).
- The hero image is preloaded with `fetchpriority="high"`; other images use `loading="lazy"`.
- `width`/`height` are set on every image and match the real file sizes, which prevents layout shift (CLS).

**Findings**
| Severity | Finding | Fix |
|---|---|---|
| Medium | Hero images are 180–190 KB JPGs at 1600 px with no `srcset`, so phones download the desktop size. | Serve WebP/AVIF and add `srcset` with 800 px and 1200 px versions. This is the main LCP win on mobile. |
| Low | 4 font weights; only 2 are preloaded. | Check whether 500 and 600 are really needed. |
| Info | Measure real LCP/INP/CLS with PageSpeed Insights once the site is live. | — |

## Images — 70

- All images have descriptive `alt` text and correct dimensions.
- No modern formats (WebP/AVIF) and no responsive `srcset`.
- The bike photos are stock placeholders. Real fleet photos matter for trust and for Google Images/Maps.

## AI search readiness — 85

**What works**
- `/llms.txt` and `/llms-full.txt` with key facts and a distance table; it also states clearly that prices aren't published.
- `robots.txt` explicitly allows GPTBot, ClaudeBot, PerplexityBot, Google-Extended and others.
- "Quick answer" blocks and data tables are easy for AI answers to quote.

**Findings**
| Severity | Finding | Fix |
|---|---|---|
| Medium | Few brand signals outside the site (no social profiles linked, no listings). AI engines lean on third-party mentions. | Create and link a Google Business Profile, Justdial/Tripadvisor listings, and Instagram/YouTube with ride content. |
| Low | No prices or reviews, so AI answers to "cheapest bike rental Siliguri" can't cite you. | Covered by the content fixes above. |

## Local SEO notes

As a Siliguri service-area business, the **Google Business Profile** matters as much as the website. Make sure you have one: category "Motorcycle rental agency", pick-up points as service areas, real photos, and steady reviews. Use the exact same name, phone and address on the site, in the schema and on the profile.

## Limitations

Audit run against the local XAMPP copy. Live-only checks (HTTPS, real cache headers, CrUX/Core Web Vitals, Search Console indexation, backlinks) were not possible and should be re-run after deployment.
