<?php

namespace App\Console\Commands;

use App\Inbox;
use App\Location;
use App\Product;
use App\ProductLocation;
use App\ProductTranslation;
use Carbon\Carbon;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Log;


class UpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update Stauts of inbox';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //$this->create();
        
        \Log::info("every hour"); 
        $this->rmsApiGetItems();
        $this->updateStockRms();
    }

    public function rmsApiGetItems()
    {
        // return 'Please Contact With Developer ';
        $myBody1 = [];
        $client = new \GuzzleHttp\Client();
         $lastTime = Carbon::now()->subHour()->toDateTimeString();
        //  2021-06-27 16:21:50

         
       
         $link = 'http://41.33.56.19/api/get_items.php?lastupdated=' .$lastTime ;
        $response = $client->request(
            'get',
            $link,
            ['json' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        
     
        //  \Log::info(print_r($data->message, true));
         
        foreach ($data as $items) {
            
             

            foreach ($items  as $RmsProduct) {

          
                if(!$RmsProduct->ID){continue;}
                
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
            //  return 'Data Saved Correctly ';
        }
    } //end of  rmsApiGetItems



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
