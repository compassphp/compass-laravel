<?php
/**
 * @param \App\Collections\ConnectionCollection<array-key, \App\Data\ConnectionDTO> $connections
 * @param \App\Data\ConnectionDTO $connection
 * @param array<array-key, array{label: string, url: string}> $breadcrumb
 * @param \Illuminate\Support\Collection<array-key, \App\Data\DatabaseDTO> $databases
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

            @foreach ($databases as $database)
                <p>{{ $database->name }}</p>
            @endforeach
        </main>
    </div>
</x-sidebar-layout>
