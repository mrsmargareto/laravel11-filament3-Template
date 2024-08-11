<?php

namespace App\Filament\Fabricator\PageBlocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\TextInput;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class CTA extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('c-t-a')
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->placeholder('Enter the title'),
                TextInput::make('name')
                    ->label('Name')
                    ->placeholder('Enter the name'),
            ]);
    }

    public static function mutateData(array $data): array
    {
        return $data;
    }
}
