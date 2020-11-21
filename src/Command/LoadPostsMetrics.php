<?php
declare(strict_types=1);

namespace Barya\Stats\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class LoadPostsMetrics extends Command
{
    protected static $defaultName = 'app:load-posts-metrics';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fetchPostsCommand = $this->getApplication()->find('app:fetch-posts');
        $calculateMetricsCommand = $this->getApplication()->find('app:calculate-metrics');
        $emptyInput = new ArrayInput([]);

        $returnCode = $fetchPostsCommand->run($emptyInput, $output);
        if ($returnCode !== Command::SUCCESS) {
            $output->writeln('Posts was not fetched properly');
            return Command::FAILURE;
        }

        $returnCode = $calculateMetricsCommand->run($emptyInput, $output);
        if ($returnCode !== Command::SUCCESS) {
            $output->writeln('Metrics data was not calculated');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

}
