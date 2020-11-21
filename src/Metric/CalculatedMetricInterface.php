<?php
declare(strict_types=1);

namespace Barya\Stats\Metric;


interface CalculatedMetricInterface
{
    public function calculate(): void;
}
