<?php

namespace Modules\FeedsXML\Admin\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use SimpleXMLElement;

class XMLGeneratorService
{

    public function generateXml()
    {
        $productsData = Product::select()
            ->get()
            ->toArray();

        $categoriesData = Category::select()
            ->get()
            ->toArray();

        $deliveryData = [
            ['id' => '1', 'type' => 'address', 'carrier' => 'slf', 'cost' => '60', 'freeFrom' => '1000', 'city' => 'Київ'],
            ['id' => '2', 'type' => 'warehouse', 'carrier' => 'UP', 'cost' => '35'],
            ['id' => '3', 'type' => 'warehouse', 'carrier' => 'NP', 'cost' => 'null'],
            ['id' => '4', 'type' => 'pickup', 'cost' => '0'],
        ];

        $feedFields = DB::table('feed_fields')->get();

        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><price></price>');

        if ($feedFields->where('id', 1)[0]->is_visible) {
            $xml->addChild('date', now());
        }
        if ($feedFields->where('id', 2)[1]->is_visible) {
            $xml->addChild('firmName', Setting::where('key', 'company_name')->value('value'));
        }
        if ($feedFields->where('id', 3)[2]->is_visible) {
            $xml->addChild('firmId', Setting::where('key', 'firm_id')->value('value'));
        }

        $deliveriesNode = $xml;

        foreach ($deliveryData as $delivery) {
            $deliveryNode = $deliveriesNode->addChild('delivery');

            if (isset($delivery['id'])) {
                $deliveryNode->addAttribute('id', $delivery['id']);
            }
            if (isset($delivery['type'])) {
                $deliveryNode->addAttribute('type', $delivery['type']);
            }
            if (isset($delivery['carrier'])) {
                $deliveryNode->addAttribute('carrier', $delivery['carrier']);
            }
            if (isset($delivery['cost'])) {
                $deliveryNode->addAttribute('cost', $delivery['cost']);
            }
            if (isset($delivery['freeFrom'])) {
                $deliveryNode->addAttribute('freeFrom', $delivery['freeFrom']);
            }
            if (isset($delivery['city'])) {
                $deliveryNode->addAttribute('city', $delivery['city']);
            }
        }

        $categoriesNode = $xml->addChild('categories');

        foreach ($categoriesData as $category) {
            $categoryNode = $categoriesNode->addChild('category');

            foreach ($feedFields as $field) {
                if ($field->is_visible) {
                    $xmlTag = $field->XML_tag;
                    $categoryField = $field->category_field;

                    if (isset($category[$categoryField])) {
                        $categoryNode->addChild($xmlTag, $category[$categoryField]);
                    }
                }
            }
        }

        $itemsNode = $xml->addChild('items');

        foreach ($productsData as $product) {
            $itemNode = $itemsNode->addChild('item');

            foreach ($feedFields as $field) {
                if ($field->is_visible) {
                    $xmlTag = $field->XML_tag;
                    $productField = $field->product_field;

                    if (str_contains($field->name, 'param_')) {
                        $string = $field->name;

                        $startPos = strpos($string, 'param_');
                        $endPos = strpos($string, '_', $startPos + strlen('param_'));

                        $result = substr($string, $startPos + strlen('param_'), $endPos - ($startPos + strlen('param_')));
                        if (isset($product[$productField])) {
                            $itemNode->$result->addAttribute($xmlTag, $product[$productField]);
                        }
                    } else {
                        if (isset($product[$productField])) {
                            $itemNode->addChild($xmlTag, $product[$productField]);
                        }
                    }
                }
            }
        }

        Header('Content-type: text/xml');
        return $xml->asXML();
    }
}
