<?php

namespace Modules\FeedsXml\Providers;
use Illuminate\Support\ServiceProvider;


class FeedsXmlServiceProvider extends ServiceProvider{

   public function boot(): void
   {
       $this->mergeConfigFrom(
           module_path('FeedsXML', 'config/settings.php'),
           'settings'
       );
   }

}
