<?php

namespace Modules\FeedsXML\Admin\Pages;

use Modules\FeedsXML\Admin\FeedsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFeeds extends EditRecord
{
    protected static string $resource = FeedsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
