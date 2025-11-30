<?php
/**
 * @param \App\Data\ConnectionDTO $connection
 * @param \App\Data\ConnectionDTO|null $selected
 */
?><div class="{{ $selected?->name === $connection->name ? 'font-bold' : '' }}">
    <a href="{{ route('connection.show', $connection->name) }}" class="flex items-center gap-1 hover:underline underline-offset-2">
        <x-connections.connection-icon :connection="$connection"/>
        {{ $connection->name }}
    </a>
</div>
