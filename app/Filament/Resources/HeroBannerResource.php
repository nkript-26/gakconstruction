<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HeroBannerResource\Pages;
use App\Models\HeroBanner;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class HeroBannerResource extends Resource
{
    protected static ?string $model = HeroBanner::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected static \UnitEnum | string | null $navigationGroup = 'Website Content';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Hero Banner Details')
                    ->schema([
                        Select::make('page_url')
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

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('order')
                            ->numeric()
                            ->default(0),

                        Textarea::make('subtitle')
                            ->rows(3)
                            ->columnSpanFull(),

                        FileUpload::make('image')
    ->image()
    ->required()
    ->disk('public')
    ->directory('hero-banners')
    ->imageEditor()
    ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->default(true)
                            ->label('Active'),
                    ])
                    ->columns(2),
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
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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