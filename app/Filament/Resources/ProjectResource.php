<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office-2';
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->schema([
                        Forms\Components\TextInput::make('project_name')->required()->maxLength(255),
                        Forms\Components\TextInput::make('location')->required(),
                        Forms\Components\Select::make('category')->options([
                            'Residential' => 'Residential', 'Commercial' => 'Commercial',
                            'Industrial' => 'Industrial', 'Infrastructure' => 'Infrastructure',
                        ]),
                        Forms\Components\DatePicker::make('completion_date')->native(false),
                        Forms\Components\Textarea::make('description')->rows(4)->columnSpanFull(),
                        Forms\Components\FileUpload::make('image')->image()->required()->directory('projects')->imageEditor()->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square()->size(80),
                Tables\Columns\TextColumn::make('project_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('location')->searchable(),
                Tables\Columns\TextColumn::make('completion_date')->date('M Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([ Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make(), ])
            ->bulkActions([ Tables\Actions\BulkActionGroup::make([ Tables\Actions\DeleteBulkAction::make(), ]), ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}

