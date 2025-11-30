<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Collections\ConnectionCollection;
use App\Contracts\ConnectionRepositoryInterface;
use App\Data\ConnectionDTO;
use App\Database\ConnectionResolver;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;

class ConnectionsRepository implements ConnectionRepositoryInterface
{
    private readonly DatabaseManager $databaseManager;

    private readonly Collection $connections;

    public function __construct(Container $container)
    {
        $config = $container->make('config');

        $defaultConnection = $config->get('database.default');
        $connections = $config->get('database.connections');
        $this->connections = new ConnectionCollection(
            collect($connections)
                ->map(
                    fn (array $connection, string $name) => ConnectionDTO::fromConfig($name, $connection, $defaultConnection === $name)
                )
        );

        $this->databaseManager = $container->make('db');
    }

    public function all(): Collection
    {
        return $this->connections;
    }

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\DatabaseDTO>
     * @throws \Exception
     */
    public function listDatabases(string $connection): Collection
    {
        $connection = $this->databaseManager->connection($connection);

        return ConnectionResolver::resolve($connection)->listDatabases();
    }

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\DatabaseDTO>
     * @throws \Exception
     */
    public function listTables(\App\Data\ConnectionDTO $connectionDTO, \App\Data\DatabaseDTO $databaseDTO): Collection
    {
        $connection = $this->databaseManager->connection($connectionDTO->name);

        return ConnectionResolver::resolve($connection)->listTables();
    }
}
