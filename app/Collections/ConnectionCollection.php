<?php

declare(strict_types=1);

namespace App\Collections;

use App\Data\ConnectionDTO;
use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 *
 * @extends Collection<array-key, ConnectionDTO>
 *
 * @implements \ArrayAccess<TKey, ConnectionDTO>
 * @implements \Illuminate\Support\Enumerable<TKey, ConnectionDTO>
 */
class ConnectionCollection extends Collection
{
    public function default(): ?ConnectionDTO
    {
        return $this->first(fn (ConnectionDTO $connection) => $connection->default);
    }
}
