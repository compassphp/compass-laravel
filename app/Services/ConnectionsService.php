<?php

declare(strict_types=1);

namespace App\Services;

use App\Collections\ConnectionCollection;
use App\Contracts\ConnectionRepositoryInterface;
use App\Data\ConnectionDTO;
use App\Data\DatabaseDTO;
use Illuminate\Support\Collection;

class ConnectionsService
{
    public function __construct(private readonly ConnectionRepositoryInterface $connectionRepository) {}

    /**
     * @return \App\Collections\ConnectionCollection<string, \App\Data\ConnectionDTO>
     */
    public function connections(): ConnectionCollection
    {
        return $this->connectionRepository->all();
    }

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\DatabaseDTO>
     * @throws \Exception
     */
    public function databases(ConnectionDTO $connection): Collection
    {
        return $this->connectionRepository->listDatabases($connection->name);
    }

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\TableDTO>
     * @throws \Exception
     */
    public function tables(ConnectionDTO $connectionDTO, DatabaseDTO $databaseDTO): Collection
    {
        return $this->connectionRepository->listTables($connectionDTO, $databaseDTO);
    }
}
