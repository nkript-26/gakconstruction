<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('project_name')
                    ->required(),
                TextInput::make('location')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->image()
                    ->required(),
                TextInput::make('category'),
                DatePicker::make('completion_date'),
                Toggle::make('is_featured')
                    ->required(),
            ]);
    }
}
