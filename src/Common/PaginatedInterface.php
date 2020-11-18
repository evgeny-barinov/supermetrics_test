<?php
declare(strict_types=1);

namespace Barya\Stats\Common;


interface PaginatedInterface
{
    public function getPage(): int;

    public function setPage(int $page): void;

    public function reset(): void;
}
