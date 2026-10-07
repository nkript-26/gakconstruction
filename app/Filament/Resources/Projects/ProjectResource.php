<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Information')
                    ->schema([
                        Forms\Components\TextInput::make('project_name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('location')
                            ->required()
                            ->placeholder('e.g., Colombo, Sri Lanka'),

                        Forms\Components\Select::make('category')
                            ->options([
                                'Residential' => 'Residential',
                                'Commercial' => 'Commercial',
                                'Industrial' => 'Industrial',
                                'Infrastructure' => 'Infrastructure',
                            ])
                            ->searchable(),

                        Forms\Components\DatePicker::make('completion_date')
                            ->native(false),

                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->directory('projects')
                            ->imageEditor()
                            ->maxSize(5120)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_featured')
                            ->default(false)
                            ->label('Featured on Homepage'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->square()
                    ->size(80),

                Tables\Columns\TextColumn::make('project_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->icon('heroicon-o-map-pin'),

                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'Residential',
                        'success' => 'Commercial',
                        'warning' => 'Industrial',
                        'danger' => 'Infrastructure',
                    ]),

                Tables\Columns\TextColumn::make('completion_date')
                    ->date('M Y')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Residential' => 'Residential',
                        'Commercial' => 'Commercial',
                        'Industrial' => 'Industrial',
                        'Infrastructure' => 'Infrastructure',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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