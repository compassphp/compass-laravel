<?php
/**
 * @param \Illuminate\Support\Collection<\App\Data\ConnectionDTO> $connections
 * @param \App\Data\ConnectionDTO|null $selected
 */
?><div class="flex flex-col">
    @foreach($connections as $connection)
        <x-connections.connection :connection="$connection" :selected="$selected ?? null"/>
    @endforeach
</div>
