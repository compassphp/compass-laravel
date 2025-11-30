<?php
/**
 * @param \App\Collections\ConnectionCollection<array-key, \App\Data\ConnectionDTO> $connections
 * @param array<array-key, array{label: string, url: string}> $breadcrumb
 */
?><x-sidebar-layout>
    <div class="flex">
        <aside>
            <x-connections :connections="$connections" :selected="null" />
        </aside>
        <main>
            <header>
                <x-breadcrumb :breadcrumb="$breadcrumb" />
            </header>

            CONTENT
        </main>
    </div>
</x-sidebar-layout>
