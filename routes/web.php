<?php

use App\Services\ConnectionsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

Route::get('/', function (ConnectionsService $service): View {
    return view('index', [
        'connections' => $service->connections(),
        'breadcrumb' => [
            [
                'label' => 'Connections',
                'url' => route('home'),
            ],
        ],
    ]);
})
    ->name('home');

Route::get('/{connection}/', function (ConnectionsService $service, string $connection): View|RedirectResponse {
    /** @var \App\Data\ConnectionDTO $connectionDTO */
    $connectionDTO = $service->connections()->firstWhere('name', $connection);
    abort_if($connectionDTO === null, 404);

    $databases = $service->databases($connectionDTO);
    if ($databases->count() === 1) {
        return to_route('database.show', [$connectionDTO->name, $databases->first()->name]);
    }

    return view('connection', [
        'connection' => $connectionDTO,
        'breadcrumb' => [
            [
                'label' => 'Connections',
                'url' => route('home'),
            ],
            [
                'label' => $connectionDTO->name,
                'url' => route('connection.show', $connectionDTO->name),
            ],
        ],
        'connections' => $service->connections(),
        'databases' => $databases,
    ]);
})
    ->where('connection', '[a-zA-Z_-]+')
    ->name('connection.show');

Route::get('/{connection}/{database}', function (ConnectionsService $service, string $connection, string $database): View {
    /** @var \App\Data\ConnectionDTO $connectionDTO */
    $connectionDTO = $service->connections()->firstWhere('name', $connection);
    abort_if($connectionDTO === null, 404);

    $databases = $service->databases($connectionDTO);
    $databaseDTO = $databases->firstWhere('name', $database);

    return view('database', [
        'connection' => $connectionDTO,
        'database' => $databaseDTO,
        'breadcrumb' => [
            [
                'label' => 'Connections',
                'url' => route('home'),
            ],
            [
                'label' => $connectionDTO->name,
                'url' => route('connection.show', $connectionDTO->name),
            ],
            [
                'label' => $databaseDTO->name,
                'url' => route('database.show', [$connectionDTO->name, $databaseDTO->name]),
            ],
        ],
        'connections' => $service->connections(),
        'databases' => $databases,
        'tables' => $service->tables($connectionDTO, $databaseDTO),
    ]);
})
    ->where('connection', '[a-zA-Z_-]+')
    ->where('database', '[a-zA-Z0-9_-]+')
    ->name('database.show');
