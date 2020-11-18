<?php
declare(strict_types=1);

namespace Barya\Stats\Command;

use Barya\Stats\Metric\MetricsPoolInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ShowStatsCommand extends BaseCommand
{
    protected static $defaultName = 'app:show-stats';

    private MetricsPoolInterface $pool;

    public function __construct(MetricsPoolInterface $pool) {
        parent::__construct();
        $this->pool = $pool;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->pool->order();
        foreach ($this->pool->getAll() as $metric) {
            $info = [
                'name' => $metric->name(),
                'data' => $metric->data()
            ];
            $output->writeln(json_encode($info, JSON_PRETTY_PRINT));
        }

        return Command::SUCCESS;
    }
}
