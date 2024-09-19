<?php

namespace Modules\FeedsXML\Admin\Pages;

use Modules\FeedsXML\Admin\FeedsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFeeds extends CreateRecord
{
    protected static string $resource = FeedsResource::class;
}
