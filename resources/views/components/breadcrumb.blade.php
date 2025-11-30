<?php
/**
 * @param array<array-key, array{label: string, url: string}> $breadcrumb
 */
?><ul class="flex gap-2">
    @foreach($breadcrumb as $item)
        <li><a href="{{ $item['url'] }}">{{ $item['label'] }}</a></li>
        <li>&gt;</li>
    @endforeach
</ul>
