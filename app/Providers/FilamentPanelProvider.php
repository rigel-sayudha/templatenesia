<?php

namespace App\Providers;

use Filament\Panel;
use Filament\PanelProvider as BasePanelProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;

class FilamentPanelProvider extends BasePanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->brandName('Admin')
            ->path('admin')
            ->login()
            ->discoverResources(
                app_path('Filament/Resources'),
                app()->getNamespace() . 'Filament\\Resources',
            )
            ->discoverPages(
                app_path('Filament/Pages'),
                app()->getNamespace() . 'Filament\\Pages',
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationGroups([
                'Management Product',
                'Management Order',
                'Management Store',
                'Management Website',
            ])
            ->default();
    }
}
