<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App as AppFacade;

use App\Http\Middleware\InjectAdminThemeScript;
use Filament\Facades\Filament;
use App\Services\FontteWhatsappService;
use App\Notifications\Channels\FontteWhatsappChannel;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (class_exists(\App\Providers\FilamentPanelProvider::class)) {
            $this->app->register(\App\Providers\FilamentPanelProvider::class);
        }

        // Register Fonnte WhatsApp Service
        $this->app->singleton(FontteWhatsappService::class, function ($app) {
            return new FontteWhatsappService();
        });
    }

    public function boot(): void
    {
        // Register Fonnte WhatsApp Notification Channel
        if ($this->app->has('Illuminate\Notifications\ChannelManager')) {
            $this->app->make('Illuminate\Notifications\ChannelManager')->extend('whatsapp', function ($app) {
                return new FontteWhatsappChannel($app->make(FontteWhatsappService::class));
            });
        }

        // Force CSRF token generation immediately
        csrf_token();
        
        // Share CSRF token with all views
        \Illuminate\Support\Facades\View::share('csrf_token', function () {
            return \Illuminate\Support\Facades\Session::token();
        });

        // Ensure session is started
        if (function_exists('session') && !session()->isStarted()) {
            session()->start();
        }
    
        try {
            $router = $this->app->make('router');
            $router->pushMiddlewareToGroup('web', InjectAdminThemeScript::class);
        
            $router->pushMiddlewareToGroup('panel', InjectAdminThemeScript::class);
        } catch (\Throwable $e) {
       
        }

        if (class_exists(Filament::class)) {
            Filament::serving(function () {
                // Inject CSRF meta tag into Filament panel head
                Filament::registerRenderHook(\Filament\View\PanelsRenderHook::HEAD_END, function () {
                    $token = csrf_token();
                    return '<meta name="csrf-token" content="' . $token . '" />';
                });
                
                // Inject JavaScript to ensure Livewire gets the token
                Filament::registerRenderHook(\Filament\View\PanelsRenderHook::BODY_START, function () {
                    $token = csrf_token();
                    return <<<'JS'
                    <script>
                        window.livewireCSRFToken = function() {
                            return document.querySelector('meta[name="csrf-token"]')?.content || '';
                        };
                    </script>
                    JS;
                });
                
                Filament::registerRenderHook(\Filament\View\PanelsRenderHook::TOPBAR_END, function () {
                    return view('filament.components.theme-toggle');
                });
            });
        }

        if (class_exists(\Filament\Support\Facades\FilamentView::class)) {
            \Filament\Support\Facades\FilamentView::registerRenderHook(\Filament\View\PanelsRenderHook::HEAD_END, function () {
                $token = csrf_token();
                return '<meta name="csrf-token" content="' . $token . '" />';
            });
            
            \Filament\Support\Facades\FilamentView::registerRenderHook(\Filament\View\PanelsRenderHook::BODY_START, function () {
                $token = csrf_token();
                return <<<'JS'
                <script>
                    window.livewireCSRFToken = function() {
                        return document.querySelector('meta[name="csrf-token"]')?.content || '';
                    };
                </script>
                JS;
            });
            
            \Filament\Support\Facades\FilamentView::registerRenderHook(\Filament\View\PanelsRenderHook::TOPBAR_END, function () {
                return view('filament.components.theme-toggle');
            });
        }

        
    }
}
