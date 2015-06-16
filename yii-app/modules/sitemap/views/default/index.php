<?php
/**
 *
 * @var array $urls
 */

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <?php foreach ($urls as $url): ?>
        <url>
            <loc><?= yii\helpers\Url::to($url['loc'], true) ?></loc>
            <?php if (isset($url['lastmod'])): ?>
                <lastmod><?= is_string($url['lastmod']) ?
                        $url['lastmod'] : date(DATE_W3C, $url['lastmod']) ?></lastmod>
            <?php endif; ?>
            <?php if (isset($url['changefreq'])): ?>
                <changefreq><?= $url['changefreq'] ?></changefreq>
            <?php endif; ?>
            <?php if (isset($url['priority'])): ?>
                <priority><?= $url['priority'] ?></priority>
            <?php endif; ?>
            <?php if (isset($url['translations'])): ?>
                <?php foreach ($url['translations'] as $key => $link): ?>
                    <xhtml:link 
                     rel="alternate"
                     hreflang="<?= $key?>"
                     href="<?= $link ?>"
                     />
                <?php endforeach; ?>
            <?php endif; ?>
        </url>
    <?php endforeach; ?>
</urlset>
