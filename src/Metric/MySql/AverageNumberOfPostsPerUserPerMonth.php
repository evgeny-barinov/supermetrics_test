<?php
declare(strict_types=1);

namespace Barya\Stats\Metric\MySql;

use \Barya\Stats\Metric\MetricInterface;
use Barya\Stats\Metric\CalculatedMetricInterface;

class AverageNumberOfPostsPerUserPerMonth extends Metric implements MetricInterface, CalculatedMetricInterface
{
    /**
     * @inheritDoc
     */
    public function data() {
        $query = <<<QUERY
SELECT ROUND(AVG(s1.total_posts), 2) AS avg_monthly, s1.from_name
FROM total_posts_per_user_per_month AS s1 
GROUP BY s1.from_name
QUERY;

        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function calculate(): void {
        $query = <<<QUERY
INSERT INTO total_posts_per_user_per_month (
    SELECT COUNT(id) as total_posts, month, from_name FROM posts GROUP BY month, from_name
)
QUERY;

        $this->db->query($query)->execute();
    }

    public function name(): string {
        return 'Average Number Of Posts Per User Per Month';
    }
}
