<?php

use App\Cart;
use App\Order;
use App\Address;
use App\Customer;
use App\PromoCode;
use Intervention\Image\Facades\Image;

#Start RMS
if (!function_exists('createCustomerRms')) {
    function createCustomerRms($id)
    {
        $customer = Customer::find($id);
        $myBody1 = [
            "id" => $customer->id,
            "full_name" => $customer->full_name,
            "email" => $customer->email,
            "phone" => $customer->phone,
            "deviceType" => $customer->deviceType,
            "address" => 'address',
            "address2" => 'address',
        ];


        \Log::info('create customer to rms');

        \Log::info(print_r($myBody1, true));

        $client = new \GuzzleHttp\Client();
        $link = 'http://41.33.56.19/api/create_customer.php';
        $response = $client->request(
            'post',
            $link,
            ['form_params' => $myBody1]
        );
        $data = json_decode($response->getBody()->getContents());
        \Log::info(print_r($data, true));



        //  \Log::info( $data );
        // dd($link);

    }  ///end of  customerUpdate
} //end of createCustomerRms


if (!function_exists('createOrderRms')) {
    function createOrderRms($id)
    {
        $order = Order::find($id);
        $body = array(
            'id' => $order->id,
            'total' => $order->total,
            'address_id' => $order->address_id,
            'customer_name' => $order->customer_name,
            'customer_address' => $order->customer_address,
            'customer_phone' => $order->customer_phone,
            'customerid' => $order->customer_id,
            'customer_email' => $order->customer_email,
            'payment_method' => $order->payment_method,
            'payment_status' => $order->payment_status,
            'promocode' => $order->promocode,
            'device_type' => $order->device_type,
            'date' => date($order->created_at),
            'order_details' => array()
        );

        //  \Log::info('data from order to push to rms');

         \Log::info(print_r($body , true));
        foreach ($order->orderDetails as $key => $orderDetail) {

            $body['order_details'][] =
                array(
                    "id" => $orderDetail->id,
                    "product_idRms" => $orderDetail->product->idRms,
                    "product_title" => $orderDetail->product->title,
                    "qty" => $orderDetail->qty,
                    "price" => $orderDetail->price,
                    "type" => $orderDetail->type,
                );
        }

        //   dd($body);
        $client = new \GuzzleHttp\Client();
        $link = 'http://41.33.56.19/api/create_order.php';
        $response = $client->request(
            'post',
            $link,
            ['form_params' => $body]
        );
        $data = json_decode($response->getBody()->getContents());

        \Log::info(print_r($data, true));
        //   dd($data);
    }  ///end of  customerUpdate
} //end of createOrderRms

if (!function_exists('createAddressRms')) {
    function createAddressRms($id)
    {

        // try{
        $addr = Address::find($id);
        $customer = Customer::find($addr->customer_id);
        $body = array(
            'id' => $addr->id,
            'customer_id' => $addr->customer_id,
            'frirstName' => $addr->frirstName,
            'lastName' => $addr->lastName,
            'phone' => $addr->phone,
            'city_id' => $addr->city_id,
            'customer_region' => $addr->customer_region,
            'street' => $addr->street,
            'home_number' => $addr->home_number,
            'floor_number' => $addr->floor_number,
            'postal_code' => $addr->postal_code,
            'address' => $addr->address,
            'notes' => $addr->notes,
        );

        \Log::info(print_r($body, true));
        //   dd($body);
        $client = new \GuzzleHttp\Client();
        $link = 'http://41.33.56.19/api/create_address.php';
        $response = $client->request(
            'post',
            $link,
            ['form_params' => $body]
        );

        // \Log::info(print_r($response , true));
        // dd($response);
        // dd($response->getBody()->getContents());
        $data = json_decode($response->getBody()->getContents());
        \Log::info('create or update address ');
        \Log::info(print_r($data, true));
        // dd($data);
        // }catch(\Exception $e){
        //   \Log::info($e);
        // }

        //   dd($data);
    }  ///end of  customerUpdate
} //end of createOrderRms

#END RMS


////////////////////
if (!function_exists('x_api_key')) {
    function x_api_key()
    {
        return 'JL6JVGgz.tCpQS5RJa1t7DehpK4XioMkBvtwmBRpo';
    }
} //end of x_api_key
if (!function_exists('comunityId')) {
    function comunityId()
    {
        return 'YBZyk2k';
    }
} //end of comunityId
if (!function_exists('variable_amount_id')) {
    function variable_amount_id()
    {
        return 81;
    }
} //end of ApiPaymentId



////////////////////
if (!function_exists('currncy')) {
    function currncy()
    {
        return 'pound';
    }
} //end of currncy
if (!function_exists('Invoice_slug')) {
    function Invoice_slug()
    {
        return '#INV-NO';
    }
} //end of Invoice_slug
if (!function_exists('pages_name')) {
    function pages_name()
    {
        $items = [
            'greenFeed',
            'convenientVacuum',
            'internationalQualityCertificates',
            'professionalCutting',
            'polices',
            'privacies',
            'whystart'
        ];
        return  $items;
    }
} //end of pages_name
if (!function_exists('status_order')) {
    function status_order()
    {

        $status = ['pendding', 'inShipment', 'onDelivery', 'completed', 'canceled'];
        return  $status;
    }
} //end of status_order
if (!function_exists('status_invoice')) {
    function status_invoice()
    {
        $status = ['pending', 'completed', 'Renovated', 'Not renewed', 'cancel'];
        return  $status;
    }
} //end of status_invoice
if (!function_exists('ticket_status')) {
    function ticket_status()
    {
        $status = ['pending',   'completed', 'cancel'];
        return  $status;
    }
} //end of ticket_status
if (!function_exists('ticket_option')) {
    function ticket_option()
    {
        $status = [
            'Technical Support',
            'Services Support',
            'Apps Support',
            'installation Support',
            'order Support',
            'Customer Services',
            'others',
        ];
        return  $status;
    }
} //end of ticket_option
if (!function_exists('ticket_type')) {
    function ticket_type()
    {
        $status = [
            'Normal',
            'medium',
            'high',
            'Emergency',
        ];
        return  $status;
    }
} //end of ticket_option
if (!function_exists('ticket_message')) {
    function ticket_message()
    {
        return  'اهلا بك عزيزي العميل ، تم فتح تذكرة خاصة بك لمساعدتك وتقلي كافة طلباتك';
    }
} //end of ticket_message
if (!function_exists('check_vaild_date_promoCode')) {
    function check_vaild_date_promoCode()
    {
        //if date expired make code not active
        PromoCode::whereDate('endDate', '<', now()->toDateString())->update(['status' => 'notActive']);
    }
} //end of check_vaild_date_promoCode
if (!function_exists('authCustomer')) {
    function authCustomer()
    {
        return auth()->guard('customer')->user();
    }
}
if (!function_exists('authCustomerApi')) {
    function authCustomerApi()
    {
        return auth()->guard('customer-api')->user();
    }
}

if (!function_exists('size_brands')) {
    function size_brands()
    {
        $size = "Recommended Dimension=   350 X 244 px";
        return $size;
    }
} //end of size_brands
if (!function_exists('make_slug')) {
    function make_slug($string)
    {
        $text = html_entity_decode(mb_strtolower($string), ENT_QUOTES, 'UTF-8');
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        return $text;
    } //end of make slug


    if (!function_exists('upload_file')) {
        function upload_file($request, $path)
        {
            $fileName = time() . '.' . $request->extension();
            $request->move(public_path($path), $fileName);
            return $fileName;
        }
    } //end of upload_file


    #upload file
    if (!function_exists('uploadFile')) {
        function uploadFile($req, $path, $deleteOldFile)
        {
            // delete old image
            // if ($deleteOldFile != 'default.png') {
            //   DeleteImage(public_path('uploads/' . $path . $deleteOldFile));
            // } //end of inner if

            $fileName = time() . rand(1, 100) . '.' . $req->getClientOriginalExtension();

            $req->move(public_path('uploads/' . $path), $fileName);
            return   $fileName;
        }
    }

    if (!function_exists('upload_img')) {
        function upload_img($request, $path, $resize)
        {
            Image::make($request)
                ->resize($resize, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path($path . $request->hashName()));
            return $request->hashName();
        }
    } //end of upload_img
    if (!function_exists('MultipleUploadImages')) {
        function MultipleUploadImages($requests, $path, $resize)
        {
            $data = [];
            foreach ($requests as  $attach) {
                Image::make($attach)
                    ->resize($resize, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    // ->save(public_path($path . $request->hashName()));
                    ->save(public_path($path . $attach->hashName()));
                $data[] = $attach->hashName();
            }
            return $data;
        }
    } //end multiple upload image

    if (!function_exists('sum_cart')) {
        function sum_cart($customer_id)
        {
            $carts = Cart::where('customer_id', $customer_id)->get();
            $sumCart = 0;
            $sumAdditionCart = 0;
            foreach ($carts as $cart) {
                if (!$cart->productWeight_id) {
                    $product_price_total = $cart->product->total;
                } else {

                    $product_price_total = $cart->productWeight->price;
                }

                // if ($cart->type == "per_unit") {
                //     $product_price_total = $cart->product->total;
                // } else {
                //     $product_price_total = $cart->product->total / 2;
                // }


                $sumCart += $product_price_total * $cart->qty;
                foreach ($cart->cart_detials as $cart_detial) {
                    $sumAdditionCart += $cart_detial->addtion->price * $cart_detial->qty;
                }

                $TotalCartWithAddtions = $sumCart + $sumAdditionCart;
            }
            return $TotalCartWithAddtions;
        }
    }

    if (!function_exists('getModels')) {
        function getModels()
        {
            $modules = [
                /////
                'orders',
                'carts',
                'inbox',
                'reviews',
                
                'careers',



                'sections',
                'categories',
                'subCategories',
                'products',
                'additions',
                'pieces',
                'instructions',
                'category_galleries',
                'galleries',
                'rates',

                // 'wishlists',
                // 'addresses',
                'collections',
                'ads',
                // 'notifications',
                ////

                // 'invoices',
                'customers',
                //'quotes',
                //'tickets',
                'promocodes',
                'subscribe',
                //'services',
                // 'plans',
                //'packages',
                'tags',
                //'clients',
                // 'testimonails',
                'sliders',
                'abouts',
                'provenances',
                //'brands',
                //'site_options',
                'countries',
                'cities',
                'states',
                'weights',

                ///
                'locations',
                'productLocations',

                //  'productWeights',


                'parteners',
                'blogs',
                'pages',
                'socail',
                'settings',
                'users',
                'roles',
            ];
            // Log::info($modules);
            return $modules;
        }
    }
}


if (!function_exists('getCurrencyBlade')) {
    function getCurrencyBlade()
    {

        return '';
        $html = __('site.' . config('site_options.currency'));

        return $html;
    }
}
