<?php namespace IITG\Leaderboard\Scrappers;

/**
 * This file belongs to leaderboard.
 *
 * Author: Rahul Kadyan, <hi@znck.me>
 * Find license in root directory of this project.
 */
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class AbstractScrapper
 *
 * @package IITG\Leaderboard
 */
abstract class AbstractScrapper
{
    /**
     * @type \Goutte\Client HTTP client.
     */
    protected $client;

    /**
     * @type string Follow these links. (CSS selector. For more details, follow
     *       https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Getting_started/Selectors)
     */
    protected $linkSelector = 'a';

    /**
     * @type array Process queue for scheduling scrapping tasks. (List of urls)
     */
    protected $queue = [];

    /**
     * AbstractScrapper constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Starting URL for the crawler.
     *
     * @return string
     */
    protected function start()
    {

    }

    public function setStart($url)
    {
        array_push($this->queue, $url);
    }

    /**
     * Extract required information. For documentation, follow
     * http://symfony.com/doc/current/components/dom_crawler.html#accessing-node-values
     *
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     *
     * @return void
     */
    protected abstract function parse(Crawler $crawler);

    /**
     * Run scrapper.
     *
     * @return void
     */
    public function run()
    {
        if (count($this->queue)) {
            array_push($this->queue, $this->start());
        }
        while ($this->next() !== false) {
            // Run infinitely.
        }
    }

    /**
     * Find links on the page.
     *
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     *
     * @return void
     */
    protected function follow(Crawler $crawler)
    {
        $crawler->filter($this->linkSelector)->each(function (Crawler $node) {
            if ($node->count()) {
                $url = $node->getNode(0)->getAttribute('href');
                if (false !== $this->filterLink($url)) {
                    array_push($this->queue, $this->absoluteUrl($url));
                }
            }
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
        return $url;
    }

    /**
     * Prepare absolute url for scrapper (HTTP client).
     *
     * @param string $url
     *
     * @return string Full url.
     */
    protected function absoluteUrl($url)
    {
        // TODO: return absolute URL.
        return $url;
    }

    /**
     * Crawl next link.
     *
     * @return bool false if nothing to process.
     */
    protected function next()
    {
        $url = array_shift($this->queue);

        if (!$url) {
            return false;
        }

        $crawler = new Crawler(null, $url); // $this->client->request('GET', $url);
        $crawler->addContent(file_get_contents($url));
        $this->follow($crawler);
        $this->parse($crawler);
    }

}
