<?php namespace IITG\Leaderboard\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * This file belongs to leaderboard.
 *
 * Author: Rahul Kadyan, <hi@znck.me>
 * Find license in root directory of this project.
 */
class CrawlCommand extends Command
{
    protected function configure()
    {
        $this->setName('crawl')
            ->setDescription('Crawl the link')
            ->addArgument('url');
    }


    /**
     * @param \Symfony\Component\Console\Input\InputInterface   $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $scrappers = require root_dir('/src/scrappers.php');
        $url = $input->getArgument('url');
        $domain = array_get(parse_url($url), 'host');

        $scraper = array_get($scrappers, $domain);

        if (!$scraper) {
            $output->writeln('No scrapper defined for ' . $domain);
        }

        $scraper = new $scraper;
        $scraper->setStart($url);
        $scraper->run();
    }
}