<?php

namespace Modules\FeedsXML\Admin;

use Modules\FeedsXML\Admin\Pages;
use Modules\FeedsXML\Models\Feeds;
use App\Models\Setting;
use Filament\Forms\Form;
use App\Services\Schema;
use App\Services\TableSchema;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\FeedsXML\Admin\Services\XMLGeneratorService;
use Modules\FeedsXML\Admin\RelationsManagers\FeedfieldsRelationManager;

class FeedsResource extends Resource
{
    protected static ?string $model = Feeds::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Schema::getReactiveName(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TableSchema::getName(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Template')
                    ->slideOver()
                    ->icon('heroicon-o-cog')
                    ->fillForm(function (): array {
                        return [
                            'firm_id' => setting(config('settings.FeedsXML.firm_id'), ''),
                        ];
                    })
                    ->action(function (array $data): void {
                        setting([
                            config('settings.FeedsXML.firm_id') => $data['firm_id'],
                        ]);
                        Setting::updatedSettings();
                    })
                    ->form(function ($form) {
                        return $form
                            ->schema([
                                TextInput::make('firm_id')
                                    ->label(__('Firm ID'))
                                    ->required(),
                            ]);
                    }),
                Tables\Actions\Action::make('Hotline xml')->action(function () {
                    FeedsResource::generateXml();
                }),
            ])

            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function generateXml()
    {
        $genreator = new XMLGeneratorService();

        $xml = $genreator->generateXml();

        file_put_contents(public_path('new.xml'), $xml);
    }


    public static function getRelations(): array
    {
        return [
            FeedfieldsRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeeds::route('/'),
            'create' => Pages\CreateFeeds::route('/create'),
            'edit' => Pages\EditFeeds::route('/{record}/edit'),
        ];
    }
}
