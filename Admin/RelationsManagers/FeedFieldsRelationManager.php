<?php

namespace Modules\FeedsXML\Admin\RelationsManagers;

use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class FeedfieldsRelationManager extends RelationManager
{
    protected static string $relationship = 'fields';

    protected static ?string $recordTitleAttribute = 'name';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Field Name'),
                TextColumn::make('XML_tag')->label('XML'),
                ToggleColumn::make('is_visible')->label('is_visible')->disabled(fn ($record) => $record->is_req),
                SelectColumn::make('product_field')
                ->options(['id'=>'id', 'name'=>'name', 'sku'=>'sku', 'category_id'=>'category_id', 'price'=>'price'])
                ->default(fn ($record) => $record ? $record->type : null)
                ->disabled(fn ($record) => $record->isProduct),
                SelectColumn::make('category_field')
                ->options(['id'=>'id', 'name'=>'name', 'parent_id'=>'parent_id'])
                ->default(fn ($record) => $record ? $record->type : null)
                ->disabled(fn ($record) => $record->is_category),
            ]);
    }
}
