<?php

declare(strict_types=1);

namespace App\Database;

use Illuminate\Database\Connection;
use Illuminate\Database\SQLiteConnection;

class ConnectionResolver
{
    public static function resolve(Connection $connectionInstance)
    {
        if ($connectionInstance instanceof SQLiteConnection) {
            return new SQLiteInformationResolver($connectionInstance);
        }

        throw new \Exception('Unsupported connection type');
    }
}
