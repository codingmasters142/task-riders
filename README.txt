TASK RIDERS – taskriders.in
===========================
PHP website (PHP 8+, Apache with mod_rewrite – works on XAMPP and normal shared hosting).
Upload the whole folder (including the hidden .htaccess file) to your hosting's web root.

TO EDIT CONTENT
  Everything lives in  includes/config.php :
  bikes, destinations (distances, permits, seasons), FAQ, ride guides, stats,
  phone, email, social links, pick-up points and the "last updated" date.
  Save the file – changes appear on every page immediately. No build step.

FILES
  index.php, bikes.php, destinations.php, how-it-works.php, faq.php, contact.php, about.php  – pages
  destination.php   – template for all 9 destination pages  (/darjeeling-bike-rental, …)
  guide.php         – template for the ride guides           (/guide-sikkim-permits, …)
  llms.php          – served as /llms.txt and /llms-full.txt (summary for AI assistants)
  sitemap.php       – served as /sitemap.xml
  404.php           – "page not found"
  includes/         – config.php (content), functions.php (sections), layout.php (header/footer), schema.php (SEO data)
  .htaccess         – clean URLs (/bikes instead of /bikes.php) and 301 redirects from the old .html addresses

LOGO:   images/logo.png (header/footer), images/logo-512.png, images/favicon.png
PHOTOS: replace any file in images/ with your own photo of the SAME name.
        Keep them under ~200 KB (compress at https://squoosh.app).

ENQUIRY FORM: sends to taskriders.slg@gmail.com via FormSubmit.co (free).
  The FIRST time someone submits, FormSubmit emails an activation link to
  taskriders.slg@gmail.com – click it once, after that enquiries arrive normally.
  Until then (or if it ever fails), the form offers a "Send on WhatsApp" fallback.
