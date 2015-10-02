<?php namespace IITG\Leaderboard\Scrappers;

use Symfony\Component\DomCrawler\Crawler;

/**
 * This file belongs to leaderboard.
 *
 * Author: Rahul Kadyan, <hi@znck.me>
 * Find license in root directory of this project.
 */
class CodeChefScrapper extends AbstractScrapper
{

    /**
     * Extract required information. For documentation, follow
     * http://symfony.com/doc/current/components/dom_crawler.html#accessing-node-values
     *
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     *
     * @return void
     */
    protected function parse(Crawler $crawler)
    {
        $crawler->filter('hx')->each(function (Crawler $crawler) {
            echo 'RANK:: ' . $crawler->text() . PHP_EOL;
        });
    }

    /**
     * Choose whether to select the link or ignore it.
     *
     * @param string $url HREF attribute on A tag.
     *
     * @return bool Return false to ignore the link. Any other value would be considered true (including null or empty
     *              string)
     */
    protected function filterLink($url)
    {
        return false;
    }


}