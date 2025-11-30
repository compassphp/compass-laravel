<?php

declare(strict_types=1);

namespace App\Database;

use App\Data\DatabaseDTO;
use App\Data\TableDTO;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Collection;

class SQLiteInformationResolver
{
    public function __construct(private readonly SQLiteConnection $connection)
    {

    }

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Data\DatabaseDTO>
     */
    public function listDatabases(): Collection
    {
        $databases = $this->connection->select('PRAGMA database_list');

        return collect($databases)->map(fn (\stdClass $db) => new DatabaseDTO($db->name));
    }

    /**
     * @return \Illuminate\Support\Collection<array-key, TableDTO>
     */
    public function listTables(): Collection
    {
        $tables = $this->connection->select('SELECT name FROM sqlite_master WHERE type="table" ORDER BY name');

        return collect($tables)->map(fn (\stdClass $table) => new TableDTO($table->name));
    }
}
