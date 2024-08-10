<?php

namespace App\Providers;

use Filament\Tables\Table;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Alignment;
use Illuminate\Support\Facades\Blade;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Facades\FilamentView;
use Filament\Support\Facades\FilamentColor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Notifications\Livewire\Notifications;
use Guava\FilamentKnowledgeBase\Filament\Panels\KnowledgeBasePanel;
class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook(
            'panels::body.end',
            fn (): string => Blade::render("@vite('resources/js/app.js')")
        );
        
        
        KnowledgeBasePanel::configureUsing(
            fn(KnowledgeBasePanel $panel) => $panel
                ->disableBackToDefaultPanelButton()
                ->brandName('My Docs')
                ->viteTheme('resources/css/filament/app/theme.css') // your filament vite theme path here
                
        );
        
    }


    public function boot(): void
    {
        Model::unguard();


        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            //$panelSwitch->simple();
            $panelSwitch
                ->modalWidth('sm')
                ->slideOver()
                //->iconSize(16)
                ->labels([
                    'admin' => 'Admin Panel',
                    'app' => ('App Home'),
                    'knowledge-base' => ('Knowledge Base'),
                ])
                ->icons([
                    'admin' => 'heroicon-s-shield-check',
                    'app' => 'heroicon-s-home',
                    'knowledge-base' => 'heroicon-s-book-open',
                ], $asImage = false);
            //$panelSwitch->slideOver();
        });
        //-----------------------Notifications-----------------------//

        Notifications::alignment(Alignment::Center);
        Notifications::verticalAlignment(VerticalAlignment::Start);

        //-----------------------Date and Time Formats-----------------------//

        DatePicker::configureUsing(function (DatePicker $datePicker) {
            $datePicker
                ->displayFormat('m/d/Y');
        });

        DateTimePicker::configureUsing(function (DateTimePicker $dateTimePicker) {
            $dateTimePicker
                ->displayFormat('m/d/Y h:i A')
                ->seconds(false);
        });

        TextColumn::configureUsing(function (TextColumn $column) {
            if ($column->isDateTime()) {
                $column
                    ->dateTime('m/d/Y h:i A');
            }
        });

        //-----------------------Tables-----------------------//
        Table::configureUsing(function (Table $table): void {
            $table
                //->filtersLayout(FiltersLayout::AboveContentCollapsible)
                //->paginationPageOptions([10, 25, 50])
                ->striped();
        });

        //-----------------------Selects-----------------------//

        /*

        Select::configureUsing(function (Select $select) {
            $select->native(false);
        });

        */

        //-----------------------Colors-----------------------//

        /**
         * https://tailwindcss.com/docs/customizing-colors
         * https://filamentphp.com/docs/3.x/support/colors#customizing-the-default-colors
         * Slate, Gray, Zinc, Neutral, Stone, Lime, Red, Orange, Amber,
         * Yellow, Lime, Green, Emerald, Teal, Cyan, Sky, Blue, Indigo,
         * Violet, Purple, Fuchsia, Pink, Rose
         */

        /*
        FilamentColor::register([
            'danger' => Color::Red,
            'gray' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Amber,
            'success' => Color::Green,
            'warning' => Color::Amber,
        ]);
        */
    }
}
