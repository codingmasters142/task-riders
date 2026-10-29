<?php
/**
 * Served as /sitemap.xml (see .htaccess).
 */
require __DIR__ . '/includes/functions.php';

header('Content-Type: application/xml; charset=utf-8');

$paths = array_merge(
    ['', 'bikes', 'destinations'],
    array_map('dest_url', DESTINATIONS),
    ['how-it-works', 'faq', 'contact', 'about'],
    array_column(GUIDES, 'slug')
);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($paths as $p) {
    echo '  <url><loc>' . e(abs_url($p)) . '</loc><lastmod>' . UPDATED . "</lastmod></url>\n";
}
echo "</urlset>\n";
