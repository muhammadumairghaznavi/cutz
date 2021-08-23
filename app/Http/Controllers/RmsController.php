<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Location;
use App\LocationTranslation;
use App\Product;
use App\ProductLocation;
use App\ProductTranslation;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class RmsController extends Controller
{
    public function updateRms()
    {
        return 'Please Contact With Developer ';
        $rmsId = [
            2005001000000, 2005002000000,  2005010000000, 2005014000000, 2005015000000, 2005041000000, 2005049000000, 2007018000000, 2007020000000, 2007021000000, 2007045000000, 2007049000000, 2007051000000, 2007035000000, 2007036000000, 2007037000000, 2007039000000, 2007040000000, 2007041000000, 2007042000000, 2007005000000, 2007006000000, 2007007000000, 2007009000000, 2007011000000, 2019001000000, 2019002000000, 2019008000000, 2019010000000, 2019012000000, 2019013000000, 2019014000000, 2019015000000, 2019016000000, 2019017000000, 2019018000000, 2019019000000, 2019020000000, 2019021000000, 2019022000000, 2019027000000, 2019028000000, 67735055585351, 67735055585375, 67735055585405, 67735055585412, 67735055585429, 67735055585443, 2001041000000, 2001042000000, 2001043000000, 2001044000000, 2001045000000, 2001046000000, 2001051000000, 2001052000000, 2001053000000, 2001054000000, 2001003000000, 2001004000000, 2001006000000, 2001007000000, 2001008000000, 2001010000000, 2001011000000, 2001014000000, 2001017000000, 2001019000000, 2001020000000, 2001021000000, 2001022000000, 2001023000000, 2001024000000, 2001036000000, 2001037000000, 2001038000000, 2002002000000, 2002004000000, 2002007000000, 2002008000000, 2002009000000, 2002010000000, 2002011000000, 2002012000000, 2002013000000, 2002015000000, 2002016000000, 2002017000000, 2002018000000, 2002019000000, 2002020000000, 2002025000000, 2002032000000, 2002033000000, 2002034000000, 2002035000000, 2002036000000, 2002042000000, 2002043000000, 2002044000000, 2002045000000, 2002047000000, 2002048000000, 2002049000000, 2002050000000, 2002051000000, 2002052000000, 2008002000000, 2008003000000, 2008007000000, 2008008000000, 2008011000000, 2008012000000, 2018019000000, 2018025000000, 2018007000000, 2001009000000, 2002037000000, 2002053000000, 2004003000000, 2004004000000, 2004005000000, 2004006000000, 2004007000000, 2004008000000, 2004009000000, 2004010000000, 2004011000000, 2004013000000, 2004015000000, 2004016000000, 2004017000000, 2004018000000, 2004019000000, 2004020000000, 2004022000000, 2004023000000, 2004024000000, 2008015000000, 2008016000000, 67735055580028, 67735055580011, 67735055580004
        ];
        $product_id = [
            248, 249, 257, 261, 262, 288, 296, 304, 306, 307, 323, 327, 329, 338, 339, 340, 342, 343, 344, 345, 350, 351, 352, 354, 356, 712, 713, 719, 721, 723, 724, 725, 726, 727, 728, 729, 730, 731, 732, 733, 738, 739, 776, 777, 780, 781, 782, 784, 62, 63, 64, 65, 66, 67, 82, 83, 84, 85, 106, 107, 109, 110, 111, 113, 114, 102, 88, 90, 91, 92, 72, 73, 74, 77, 78, 79, 130, 132, 135, 154, 155, 156, 140, 141, 142, 144, 145, 146, 125, 126, 127, 149, 115, 116, 117, 118, 119, 136, 137, 138, 139, 160, 161, 162, 163, 164, 165, 376, 377, 381, 382, 385, 386, 675, 681, 704, 112, 120, 166, 225, 226, 227, 228, 229, 230, 231, 232, 233, 235, 237, 238, 239, 240, 241, 242, 244, 245, 246, 358, 359, 772, 771, 770
        ];
        for ($i = 0; $i <= count($rmsId); $i++) {
            //  dd($rmsId[$i], $product_id[$i]);
            Product::where('id', $product_id[$i])->update([
                'idRms' => $rmsId[$i]
            ]);
        }
    } //end of updateRms
    public function rmsApiGetItems()
    {
        // return 'Please Contact With Developer ';
        $myBody1 = [];
        $client = new \GuzzleHttp\Client();
        $date = Carbon::now();
        // $link = 'http://41.33.56.19/api/get_items.php';
        $link = 'http://41.33.56.19/api/get_items.php?lastupdated=' . $date->toDateTimeString();
        $response = $client->request(
            'get',
            $link,
            ['json' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $items) {
            foreach ($items  as $RmsProduct) {
                $check = Product::where('idRms', $RmsProduct->ID)->where('sku', $RmsProduct->sku)->first();
                // dd($RmsProduct->ID);
                if (!$check) {
                    $create = Product::where('idRms', '!=', $RmsProduct->ID)->create(
                        [
                            'idRms' =>  $RmsProduct->ID, 'section_id' =>  14, 'category_id' =>  15, 'subCategory_id' => 138, 'status' =>  'not_active', 'ifram' =>  'RMS NEW ', 'sku' =>  $RmsProduct->sku, 'price' =>  $RmsProduct->MainPrice, 'discount' =>  $RmsProduct->SalePrice,
                            'ar' => [
                                'title' => $RmsProduct->title,
                                'description'  => $RmsProduct->title,
                                'short_description' => $RmsProduct->title,
                            ],
                            'en' => [
                                'title' => $RmsProduct->title,
                                'description'  => $RmsProduct->title,
                                'short_description'
                                => $RmsProduct->title,
                            ],
                        ]
                    );
                    $create->save();
                } else {
                    Product::where('idRms', $RmsProduct->ID)->update(
                        [
                            'idRms' =>  $RmsProduct->ID,
                            'sku' =>  $RmsProduct->sku,
                            'price' =>  $RmsProduct->MainPrice,
                            'discount' =>  $RmsProduct->SalePrice,
                        ]
                    ); //end of update product
                    // ProductTranslation::where('product_id', $check->id)->where('locale', 'en')->update([
                    //     'title' => $RmsProduct->title,
                    // ]);
                    // ProductTranslation::where('product_id', $check->id)->where('locale', 'ar')->update([
                    //     'title' => $RmsProduct->arabic_title,
                    // ]);
                }
            }
            //dd($items);
            return 'Data Saved Correctly ';
        }
    } //end of  rmsApiGetItems
    public function updateApiRms()
    {
        $myBody1 = [];
        $client = new \GuzzleHttp\Client();
        //  $link = 'http://41.33.56.19/api/get_items.php';
        $date = Carbon::now();
        // $link = 'http://41.33.56.19/api/get_items.php';
        $link = 'http://41.33.56.19/api/get_items.php?lastupdated=' . $date->toDateTimeString();
        $response = $client->request(
            'get',
            $link,
            ['json' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $items) {
            $chunks = array_chunk($items, 200);
            // dd($items);
            foreach ($chunks as $chunk) {
                foreach ($chunk  as $RmsProduct) {
                    $product_find = Product::where('idRms', $RmsProduct->ID)->first();
                    if ($product_find) {
                        Product::where('idRms', $RmsProduct->ID)->update(
                            [
                                'idRms' =>  $RmsProduct->ID,
                                'sku' =>  $RmsProduct->sku,
                                'price' =>  $RmsProduct->MainPrice,
                                'discount' =>  $RmsProduct->SalePrice,
                            ]
                        ); //end of update product
                        ProductTranslation::where('product_id', $product_find->id)->where('locale', 'en')->update([
                            'title' => $RmsProduct->title,
                        ]);
                        ProductTranslation::where('product_id', $product_find->id)->where('locale', 'ar')->update([
                            'title' => $RmsProduct->arabic_title,
                        ]);
                    } //end if product_find
                    else {
                    }
                }
            }
            return 'Data Saved Correctly ';
        }
    } //end of  updateApiRms
    public function customerRms($id)
    {
        $customer = Customer::find($id);
        $myBody1 = [
            "full_name" => $customer->full_name,
            "email" => $customer->email,
            "phone" => $customer->phone,
            "deviceType" => $customer->deviceType,
            "address" => $customer->customer_address ?? '',
            "address2" => $customer->customer_region ?? '',
        ];
        $client = new \GuzzleHttp\Client();
        $link = 'http://41.33.56.19/api/create_customer.php';
        $response = $client->request(
            'post',
            $link,
            ['json' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        dd("created");
    }  ///end of  customerUpdate
    public function updateStroresRms()
    {
        // return 'Please Contact With Developer ';
        $myBody1 = [];
        $client = new \GuzzleHttp\Client();
        $link = 'http://41.33.56.19/api/get_stores.php';
        $response = $client->request(
            'get',
            $link,
            ['json' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        foreach ($data as $items) {
            foreach ($items  as $rmsItem) {
                $check = Location::where('idRms', $rmsItem->ID)->first();
                if (!$check) {
                    $create = Location::where('idRms', '!=', $rmsItem->ID)->create(
                        [
                            'idRms' =>  $rmsItem->ID,
                            'ar' => [
                                'title' => $rmsItem->Name,
                            ],
                            'en' => [
                                'title' => $rmsItem->Name,
                            ],
                        ]
                    );
                    $create->save();
                } else {
                    $location = Location::where('idRms', $rmsItem->ID)->update(
                        [
                            'idRms' =>  $rmsItem->ID,
                        ]
                    ); //end of update location
                    LocationTranslation::where('location_id', $check->id)->where('locale', 'en')->update([
                        'title' => $rmsItem->Name,
                    ]);
                    LocationTranslation::where('location_id', $check->id)->where('locale', 'ar')->update([
                        'title' => $rmsItem->Name,
                    ]);
                }
            }
            //dd($items);
            return 'Data Saved Correctly ';
        }
    } //end of  updateStroresRms
    public function updateStockRms()
    {
        $myBody1 = [];
        $client = new \GuzzleHttp\Client();
        $link = 'http://41.33.56.19/api/get_stocks.php';
        $response = $client->request(
            'get',
            $link,
            ['json' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        // dd($data);
        foreach ($data as $items) {
            foreach ($items  as $rmsItem) {
                $product = Product::where('idRms', $rmsItem->itemid)->first();
                $location = Location::where('idRms', $rmsItem->storeid)->first();
                if ($product) {
                    $check = ProductLocation::where('location_id', $location->id)->where('product_id', $product->id)->where('stock', $rmsItem->quantity)->first();
                    if ($check) {
                        ProductLocation::where('location_id', $location->id)->where('product_id', $product->id)->update([
                            'stock' =>  $rmsItem->quantity,
                        ]);
                    } else {
                        $create = ProductLocation::create(
                            [
                                'product_id' =>  $product->id,
                                'location_id' =>  $location->id,
                                'stock' =>  $rmsItem->quantity,
                            ]
                        );
                        $create->save();
                    }
                }
            }
            return 'Data Saved Correctly ';
        }
    } //end of  updateStockRms



}
