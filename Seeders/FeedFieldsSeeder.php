<?php

namespace Modules\FeedsXML\Seeders;

use Illuminate\Database\Seeder;
use Modules\FeedsXML\Models\FeedFields;
use phpDocumentor\Reflection\Types\ArrayKey;

class FeedFieldsSeeder extends Seeder
{
   public function run(): void
   {
      $tags = ['date'=>'date', 'firmName'=>'firmName', 'firmId'=>'firmId', 'rate'=>'rate', 'deliveryId'=>'id', 'deliveryType'=>'type', 'deliveryCost'=>'cost', 'deliveryFreeFrom'=>'freeFrom', 'deliveryCity'=>'city', 'deliveryCarrier'=>'carrier', 'categoryId'=>'id', 'categoryName'=>'name', 'categoryParentId'=>'parentId', 'storeId'=>'id', 'storeName'=>'name', 'storeAdress'=>'address', 'storeCoordintes'=>'coordinates', 'storeWorkdays_from'=>'workdays_from', 'storeWorkdays_to'=>'workdays_to', 'storeMon_from'=>'mon_from', 'storeMon_to'=>'mon_to', 'storeSat_from'=>'sat_from', 'storeSat_to'=>'sat_to', 'storeTel'=>'tel', 'itemId'=>'id', 'itemCategoryId'=>'categoryId', 'itemCode'=>'code', 'itemBarcode'=>'barcode', 'itemVendor'=>'vendor', 'itemName'=>'name', 'itemDescription'=>'description', 'itemUrl'=>'url', 'itemImage'=>'image', 'itemPriceRUAH'=>'priceRUAH', 'itemPriceRUSD'=>'priceRUSD', 'itemStock'=>'stock', 'param_guarantee_unit'=>'unit', 'param_guarantee_type'=>'type', 'guarantee'=>'guarantee', 'region'=>'region', 'shipping'=>'shipping', 'shippingWorkdays'=>'workdays', 'shippingSunday'=>'sunday', 'shippingSaturday'=>'sunday', 'param'=>'param', 'param_param_name'=>'name', 'condition'=>'condition', 'custom'=>'custom', 'payment'=>'payment', 'param_payment_type'=>'type', 'paymentDiscount'=>'discount', 'param_payment_fee'=>'fee'];

      $category = ['1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', ];

      $product = ['1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', ];

      $is_req = ['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', '0', '0', '1', '1', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0'];

      $int = 0;
      foreach($tags as $key=>$value){
         FeedFields::query()->create([
            'feed_id' => '2',
            'name' => $key,
            'XML_tag' => $value,
            'is_visible' => true,
            'is_req' => $is_req[$int],
            'isProduct' => $product[$int],
            'is_category' => $category[$int],
         ]);
         $int++;
      }
   }
}
