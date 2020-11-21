<?php
declare(strict_types=1);

namespace Barya\Stats\Command;

use Barya\Stats\Metric\CalculatedMetricInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class CalculateMetricsDataCommand extends Command
{
    protected static $defaultName = 'app:calculate-metrics';

    /**
     * @var CalculatedMetricInterface[]
     */
    private array $metrics;

    /**
     * @param CalculatedMetricInterface[] $metrics
     */
    public function __construct(array $metrics) {
        parent::__construct();
        $this->metrics = $metrics;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->metrics as $metric) {
            $metric->calculate();
        }

        return Command::SUCCESS;
    }

}
