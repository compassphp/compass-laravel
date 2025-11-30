<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ConnectionRepositoryInterface
{
    /**
     * @return \App\Collections\ConnectionCollection<\App\Data\ConnectionDTO>
     */
    public function all(): Collection;

    public function listTables(\App\Data\ConnectionDTO $connectionDTO, \App\Data\DatabaseDTO $databaseDTO);
}
