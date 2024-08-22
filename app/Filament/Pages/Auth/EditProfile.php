<?php

namespace App\Filament\Pages\Auth;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Support\Enums\Alignment;
use Illuminate\Support\Facades\Storage;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar_url')
                    ->label(' ')
                    ->avatar()
                    ->maxSize(2048) // Limit file size to 2MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']) // Restrict to image files
                    ->getUploadedFileNameForStorageUsing(function (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file): string {
                        return (string) str($file->hashName()); // Use a hashed name for the file
                    })->alignment(Alignment::Center)
                    ->columnSpanFull(true),
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255)
                ->columnSpan(2),
                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan(2),

                $this->getEmailFormComponent()->columnSpan(4),
                $this->getPasswordFormComponent()->columnSpanFull(true),
                $this->getPasswordConfirmationFormComponent()->columnSpanFull(true),


            ])->columns(4);

    }

}
