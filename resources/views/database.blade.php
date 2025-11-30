<?php
/**
 * @param \App\Collections\ConnectionCollection<array-key, \App\Data\ConnectionDTO> $connections
 * @param \App\Data\ConnectionDTO $connection
 * @param \App\Data\DatabaseDTO $database
 * @param array<array-key, array{label: string, url: string}> $breadcrumb
 * @param \Illuminate\Support\Collection<array-key, \App\Data\DatabaseDTO> $databases
 * @param \Illuminate\Support\Collection<array-key, \App\Data\TableDTO> $tables
 */
?><x-sidebar-layout>
    <div class="flex">
        <aside>
            <x-connections :connections="$connections" :selected="$connection" />
        </aside>
        <main>
            <header>
                <x-breadcrumb :breadcrumb="$breadcrumb" />
            </header>

            <h1>{{ $database->name }}</h1>

            @foreach ($databases as $db)
                <p>{{ $db->name }}</p>
            @endforeach

            <h2>Tables</h2>

            @foreach ($tables as $table)
                <p>{{ $table->name }}</p>
            @endforeach
        </main>
    </div>
</x-sidebar-layout>
