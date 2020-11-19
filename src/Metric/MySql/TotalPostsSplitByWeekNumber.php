<?php
declare(strict_types=1);

namespace Barya\Stats\Metric\MySql;

use \Barya\Stats\Metric\MetricInterface;

class TotalPostsSplitByWeekNumber extends Metric implements MetricInterface
{
    /**
     * @inheritDoc
     */
    public function data() {
        $query = <<<QUERY
SELECT COUNT(id) as total_posts, week
FROM posts
GROUP BY week 
ORDER BY week DESC
QUERY;

        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function name(): string {
        return 'Total Posts Split By Week Number';
    }
}
