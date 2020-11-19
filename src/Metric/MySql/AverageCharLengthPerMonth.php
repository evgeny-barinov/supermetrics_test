<?php
declare(strict_types=1);

namespace Barya\Stats\Metric\MySql;

use \Barya\Stats\Metric\MetricInterface;

class AverageCharLengthPerMonth extends Metric implements MetricInterface
{
    /**
     * @inheritDoc
     */
    public function data() {
        $query = <<<QUERY
SELECT ROUND(AVG(`message_length`)) as avg_message_length, DATE_FORMAT(`created_time`, '%Y.%m') as month 
FROM posts GROUP BY month
QUERY;

        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function name(): string {
        return 'Average Character Length Per Month';
    }
}
