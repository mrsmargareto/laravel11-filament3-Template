<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Filament\Auth\Login;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Kenepa\Banner\BannerPlugin;
use Joaopaulolndev\FilamentWorldClock\FilamentWorldClockPlugin;



class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel

    {
        return $panel

            ->id('admin')
            ->path('admin')
            ->profile()
            ->login(Login::class)
            ->sidebarFullyCollapsibleOnDesktop()
            ->unsavedChangesAlerts()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->plugins([
                FilamentWorldClockPlugin::make()
                    ->timezones([
                        'America/Chicago', // Central Time
                        'America/New_York', // Eastern Time
                        'America/Los_Angeles', // Pacific Time
                        'Asia/Manila', // Philippines
                        'Asia/Kolkata', // India
                        'Asia/Tokyo', // Japan
                    ])
                    ->setQuantityPerRow(3) //Optional quantity per row default is: 1
                    ->setTimeFormat('H:i') //Optional time format default is: 'H:i'
                    ->shouldShowTitle(false) //Optional show title default is: true
                    ->setTitle('Hours') //Optional title default is: 'World Clock'
                    //->setDescription('Different description') //Optional description default is: 'Show hours around the world by timezone'
                    ->setColumnSpan('full') //Optional column span default is: '1/2'
                    ->setSort(10),
                BannerPlugin::make()
                    ->navigationIcon('heroicon-o-megaphone')
                    ->navigationLabel('Banners'),
                FilamentEditProfilePlugin::make()
                    ->shouldRegisterNavigation(false)
                    ->shouldShowAvatarForm(
                        directory: 'avatars',
                    ),


            ])->userMenuItems([
                'profile' => MenuItem::make()
                    ->label(fn() => auth()->user()->name)
                    ->url(fn(): string => EditProfilePage::getUrl())
                    ->icon('heroicon-m-user-circle')
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                //Widgets\AccountWidget::class,
                //Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->viteTheme('resources/css/filament/app/theme.css');
    }
}
