<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBannerResource\Pages;
use App\Models\HeroBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroBannerResource extends Resource
{
    protected static ?string $model = HeroBanner::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Banner Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Building Your Dreams'),

                        Forms\Components\Textarea::make('subtitle')
                            ->rows(3)
                            ->placeholder('Enter banner description...')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->directory('hero-banners')
                            ->imageEditor()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->maxSize(5120)
                            ->helperText('Recommended size: 1920x1080px, Max 5MB')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower number appears first'),

                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label('Active'),
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

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->limit(50),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
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
            'index' => Pages\ListHeroBanners::route('/'),
            'create' => Pages\CreateHeroBanner::route('/create'),
            'edit' => Pages\EditHeroBanner::route('/{record}/edit'),
        ];
    }
}