<?php
declare(strict_types=1);

namespace Barya\Stats\Metric\MySql;


abstract class Metric
{
    protected \PDO $db;

    public function __construct(\PDO $pdo) {
        $this->db = $pdo;
    }
}
