<?php
declare(strict_types=1);

namespace Barya\Stats\Metric;


class SimpleMetricsPool implements MetricsPoolInterface
{
    /**
     * @var MetricInterface[]
     */
    private array $metrics;

    /**
     * @param MetricInterface[] $metrics
     */
    public function __construct($metrics) {
        $this->metrics = [];
        foreach ($metrics as $metric) {
            $this->metrics[$metric->name()] = $metric;
        }
    }

    public function order(): void {
        usort($this->metrics, function (MetricInterface  $a, MetricInterface $b) {
            return strcasecmp($a->name(), $b->name());
        });
    }

    /**
     * @return MetricInterface[]
     */
    public function getAll(): array {
        return $this->metrics;
    }

    public function getByName(string $name): ?MetricInterface {
        return $this->metrics[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function getCalculatedMetrics(): array {
        return array_filter($this->metrics, function($metric) {
            return $metric instanceof CalculatedMetricInterface;
        });
    }
}
