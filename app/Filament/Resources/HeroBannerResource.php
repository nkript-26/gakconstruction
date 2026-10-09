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
    protected static \UnitEnum|string|null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Banner Details')
                    ->schema([
                        Forms\Components\Select::make('page_url')
                            ->label('Target Page / Path')
                            ->options([
                                '/' => 'Home Page (/)',
                                '/about' => 'About Us (/about)',
                                '/services' => 'Services (/services)',
                                '/projects' => 'Projects (/projects)',
                                '/contact' => 'Contact Us (/contact)',
                            ])
                            ->searchable()
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Textarea::make('subtitle')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->directory('hero-banners')
                            ->imageEditor()
                            ->columnSpanFull(),

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

                Tables\Columns\TextColumn::make('page_url')
                    ->label('Page')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->defaultSort('order', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('page_url')
                    ->label('Filter by Page')
                    ->options([
                        '/' => 'Home Page',
                        '/about' => 'About Us',
                        '/services' => 'Services',
                        '/projects' => 'Projects',
                        '/contact' => 'Contact Us',
                    ]),
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