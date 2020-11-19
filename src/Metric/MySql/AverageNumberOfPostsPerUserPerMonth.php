<?php
declare(strict_types=1);

namespace Barya\Stats\Metric\MySql;

use \Barya\Stats\Metric\MetricInterface;

class AverageNumberOfPostsPerUserPerMonth extends Metric implements MetricInterface
{
    /**
     * @inheritDoc
     */
    public function data() {
        $query = <<<QUERY
SELECT ROUND(AVG(s1.total_posts), 2) AS avg_monthly, s1.from_name 
FROM (
    SELECT COUNT(id) as total_posts, DATE_FORMAT(created_time, '%m.%Y') AS month, from_name 
    FROM posts GROUP BY month, from_name
) AS s1 
GROUP BY s1.from_name
QUERY;

        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function name(): string {
        return 'Average Number Of Posts Per User Per Month';
    }
}
