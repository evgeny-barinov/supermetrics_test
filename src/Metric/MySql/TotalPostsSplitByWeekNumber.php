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
SELECT COUNT(id) as total_posts, WEEK(created_time) as week_number 
FROM posts 
GROUP BY week_number 
ORDER BY week_number DESC
QUERY;

        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function name(): string {
        return 'Total Posts Split By Week Number';
    }
}
