<?php
declare(strict_types=1);

namespace Barya\Stats\Metric\MySql;

use \Barya\Stats\Metric\MetricInterface;

class LongestPostByCharLengthPerMonth extends Metric implements MetricInterface
{

    /**
     * @inheritDoc
     */
    public function data() {
        $query = <<<QUERY
SELECT p.id, p.message_length, DATE_FORMAT(p.created_time, '%m.%Y') AS month FROM posts AS p 
INNER JOIN ( 
    SELECT MAX(p1.`message_length`) AS max_length, DATE_FORMAT(p1.created_time, '%m.%Y') AS month 
    FROM posts p1 GROUP BY month 
) AS p2 
ON 
    p2.month = DATE_FORMAT(p.created_time, '%m.%Y') 
    AND p2.max_length=p.message_length
ORDER BY p.message_length DESC
QUERY;


        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function name(): string {
        return 'Longest Post By Character Length Per Month';
    }
}
