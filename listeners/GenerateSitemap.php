<?php namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;
use samdark\sitemap\Sitemap;

class GenerateSitemap
{
    public function handle(Jigsaw $jigsaw)
    {
        $baseUrl = $jigsaw->getConfig('baseUrl');

        if (!$baseUrl) {
            echo("\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n");
            return;
        }

        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/sitemap.xml');

        /**
         * Add Custom Paths
         */

//        $pages = [
//            '', 'page-123', 'support'
//        ];
//
//        foreach ($pages as $page) {
//            $sitemap->addItem($baseUrl . '/' . $page, time(), Sitemap::DAILY);
//        }

        $jigsaw->getCollection('pages')->each(function ($page) use ($baseUrl, $sitemap) {
            $sitemap->addItem(rtrim($baseUrl, '/') . '/' . $page->getFilename(), time(), Sitemap::DAILY);
        });

        $sitemap->write();
    }
}
