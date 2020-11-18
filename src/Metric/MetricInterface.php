<?php
declare(strict_types=1);

namespace Barya\Stats\Metric;


interface MetricInterface
{
    /**
     * @return mixed
     */
    public function data();

    public function name(): string;
}
