<?php
// One template for every ride guide: /<slug> (see .htaccess)
require __DIR__ . '/includes/functions.php';

$g = find_by_slug(GUIDES, $_GET['slug'] ?? '');
if (!$g) {
    require __DIR__ . '/404.php';
    exit;
}

page_start([
    'path'        => $g['slug'],
    'title'       => "{$g['title']} | Task Riders",
    'description' => $g['excerpt'],
    'crumb'       => $g['title'],
    'schema'      => [guide_schema($g)],
    'image'       => $g['image'],
    'og_type'     => 'article',
]);
echo page_hero(e($g['title']), e($g['excerpt']), 'Ride Guides');
?>
<section class="section">
  <div class="container container--narrow">
    <article class="prose">
      <?= updated_line($g['updated'] ?? $g['date']) ?>
      <div class="answer"><span class="answer__label">Key takeaways</span><ul><?php foreach ($g['takeaways'] as $t): ?><li><?= e($t) ?></li><?php endforeach; ?></ul></div>
      <img class="guide-hero" src="<?= $g['image'] ?>" alt="<?= e($g['alt']) ?>" width="800" height="500">
      <?= $g['body'] ?>
    </article>
    <div class="guide-cta"><?= wa_link('Plan this ride with us') ?><a href="bikes" class="btn btn--outline">See our bikes</a></div>
  </div>
</section>
<?php
echo guides('section section--grey', $g['slug']);
page_end();
