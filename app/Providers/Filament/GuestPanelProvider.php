<?php

namespace App\Providers\Filament;

use App\Http\Middleware\ForceGuestMiddleware;
use Filament\Http\Middleware\Authenticate;
use Filament\Panel;

class GuestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('guest')
            ->path('guest')
            ->login(null)
            ->middleware([
                ForceGuestMiddleware::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->discoverResources(in: app_path('Filament/Guest/Resources'), for: 'App\\Filament\\Guest\\Resources')
            ->discoverPages(in: app_path('Filament/Guest/Pages'), for: 'App\\Filament\\Guest\\Pages')
            ->discoverWidgets(in: app_path('Filament/Guest/Widgets'), for: 'App\\Filament\\Guest\\Widgets');
    }
}
