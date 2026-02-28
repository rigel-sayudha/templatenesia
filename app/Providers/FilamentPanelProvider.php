<?php

namespace App\Providers;

use Filament\Panel;
use Filament\PanelProvider as BasePanelProvider;
use Filament\Support\Facades\FilamentAsset;
use Filament\Http\Middleware\Authenticate;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;

class FilamentPanelProvider extends BasePanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->brandName('Admin')
            ->path('admin')
            ->login()
            ->favicon('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjRzyTdfjkBugSP3Ew_vmkaeMQKl0XnZVR83kFV0LtKJXC4gVF_WTGPS57iCampIjdlGU09l_Ct0hw_2Tx51GiHj5uWr6fTYqzJirf8qpAKhwW0AsM-pYcam74_l25KpFvShEYQdkJ-UnuJQsuiP7qa7Ek85k0MWaF0X0pHGmJZ2imL8IQK9ip5M9s2sW0/s16000/Templatenesia%20Logo.jpg')
            ->discoverResources(
                app_path('Filament/Resources'),
                app()->getNamespace() . 'Filament\\Resources',
            )
            ->discoverPages(
                app_path('Filament/Pages'),
                app()->getNamespace() . 'Filament\\Pages',
            )
            ->discoverWidgets(
                app_path('Filament/Widgets'),
                app()->getNamespace() . 'Filament\\Widgets',
            )
            ->widgets([
                \Filament\Widgets\AccountWidget::class,
                \Filament\Widgets\FilamentInfoWidget::class,
                \App\Filament\Widgets\MonthlySalesChart::class,
            ])
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
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn () => new HtmlString('<style>
                    .fi-modal-window { max-height: 90vh !important; display: flex !important; flex-direction: column !important; }
                    .fi-modal-content { overflow-y: auto !important; max-height: 70vh !important; }
                    .fi-modal-footer { flex-shrink: 0 !important; }
                </style>')
            )
            ->default();
    }
}
