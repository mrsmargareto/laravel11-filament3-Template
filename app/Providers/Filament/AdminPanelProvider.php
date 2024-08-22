<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Filament\Auth\Login;
use Kenepa\Banner\BannerPlugin;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Rmsramos\Activitylog\ActivitylogPlugin;
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
use Joaopaulolndev\FilamentWorldClock\FilamentWorldClockPlugin;



class AdminPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel

    {
        return $panel

            ->id('admin')
            ->path('admin')
            ->profile(EditProfile::class)
            ->login(Login::class)
            ->sidebarFullyCollapsibleOnDesktop()
            //->databaseNotifications()
            ->unsavedChangesAlerts()
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->discoverClusters(in: app_path('Filament/Admin/Clusters'), for: 'App\\Filament\\Admin\\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->plugins([

                //https://filamentphp.com/plugins/rmsramos-activitylog#installation
                ActivitylogPlugin::make(),
                \Awcodes\Curator\CuratorPlugin::make(),
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
