<?php
declare(strict_types=1);

namespace Barya\Stats\Metric;


interface MetricsPoolInterface
{
    public function order(): void;

    /**
     * @return MetricInterface[]
     */
    public function getAll(): array;

    public function getByName(string $name): ?MetricInterface;

    /**
     * @return CalculatedMetricInterface[]
     */
    public function getCalculatedMetrics(): array;
}
