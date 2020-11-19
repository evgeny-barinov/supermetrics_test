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
SELECT p.id, p.message_length, p.month FROM posts AS p 
INNER JOIN ( 
    SELECT MAX(p1.`message_length`) AS max_length, month 
    FROM posts p1 GROUP BY month 
) AS p2 
ON 
	p2.month = p.month 
    AND p2.max_length=p.message_length 
ORDER BY p.message_length DESC
QUERY;


        return $this->db->query($query)->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function name(): string {
        return 'Longest Post By Character Length Per Month';
    }
}
