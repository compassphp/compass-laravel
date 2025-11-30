<?php

declare(strict_types=1);

namespace App\Data;

final readonly class ConnectionDTO
{
    private function __construct(
        public string $name,
        public string $driver,
        public string $database,
        public string $prefix = '',
        public bool $default = false,
    ) {}

    public static function fromConfig(string $name, array $config, bool $default = false): self
    {
        return new self(
            name: $name,
            driver: $config['driver'],
            database: $config['database'],
            prefix: $config['prefix'] ?? '',
            default: $default,
        );
    }
}
