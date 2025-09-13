<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\RouteServiceProvider::class, // ← має бути
];
