<?php

namespace Modules\FeedsXML\Admin\Pages;

use Modules\FeedsXML\Admin\FeedsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeeds extends ListRecords
{
    protected static string $resource = FeedsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
