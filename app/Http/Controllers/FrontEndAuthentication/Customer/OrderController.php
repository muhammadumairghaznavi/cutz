<?php

namespace App\Http\Controllers\FrontEndAuthentication\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\PromoCodeRequest;
use App\Order;
use App\Invoice;
use App\PromoCode;
use App\Ticket;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {

        if (!$this->session_get_order_id()) {
            return redirect()->route('home');
        }
        $order = Order::find($this->session_get_order_id());
        if (!$order) {
            return redirect()->route('home');
        }
        return view('frontend.customer.profile.orders.index', compact('order'));
    } //end of index

    public function website_create(Request $request)
    {
        $info = $request->item_info;
        $info_period  = $info[0] . $info[1];     // get  mo OR yr
        $info_price = substr($info, 2);          // trim   mo OR yr
        $order = Order::create([
            'customer_country' => session()->get('country'),
            'package_id' => null,
            'service_id' => null,
            'product_id' =>  $request->product_id,
            'customer_id' => authCustomer()->id,
            'payment_type' => $info_period == 'mo' ? 'Monthly' : 'Yearly',
            'payment_method' => 'Online',
            'payment_status' => 'Not completed',
            'item_price' => $info_price,
            'total' => $info_price,
            'discount' => null,
            'fees' => null,
        ]);
        //save order and redirect to next page
        $this->session_create_order_id($order->id);

        // $ifram = $this->payOrderPage();


        //return view('frontend.customer.profile.orders.index', compact('order'));
        return redirect()->route('customer.order.index');
    } //end of website_create
    public function service_create(Request $request)
    {
        $info_period  = $request->info_period;     // get  mo OR yr Or once
        $info_price = $request->item_price;          // trim   mo OR yr
        $order = Order::create([
            'customer_country' => session()->get('country'),
            'package_id' => null,
            'service_id' => $request->service_id,
            'title_service_details' => $request->title_service_details,
            'product_id' =>  null,
            'customer_id' => authCustomer()->id,
            'payment_type' => $info_period,  //monthly - yealry
            'payment_method' => 'Online',
            'payment_status' => 'Not completed',
            'item_price' => $info_price,
            'total' => $info_price,
            'discount' => null,
            'fees' => null,
        ]);
        //save order and redirect to next page
        $this->session_create_order_id($order->id);

        return redirect()->route('customer.order.index');
    } //end of service_create
    public function app_create(Request $request)
    {
        $info_period  = $request->info_period;     // get  mo OR yr Or once
        $info_price = $request->item_price;          // trim   mo OR yr
        $order = Order::create([
            'customer_country' => session()->get('country'),
            'package_id' => $request->product_id,
            'service_id' => null,
            'title_service_details' => $request->title_service_details,
            'product_id' =>  null,
            'customer_id' => authCustomer()->id,
            'payment_type' => $info_period == 'month_short' ? 'Monthly' : 'Yearly',  //monthly - yealry
            'payment_method' => 'Online',
            'payment_status' => 'Not completed',
            'item_price' => $info_price,
            'total' => $info_price,
            'discount' => null,
            'fees' => null,
        ]);
        //save order and redirect to next page
        $this->session_create_order_id($order->id);

        return redirect()->route('customer.order.index');
    } //end of app-packages


    public function payment_method(Request  $request)
    {

        if ($request->payment_method == 'visa') {
            $ifram = $this->payOrderPage();
            return view('frontend.customer.profile.orders.payment.visa', compact('ifram'));
        } elseif ($request->payment_method == 'paypal') {
        } else {
            dd('not avaliable this method');
        }
    }



    public function payOrderPage()
    {
        // "variable_amount_id"=>42, //stage
        $order = Order::find($this->session_get_order_id());

        if (session()->get('coupon')['discount']) {
            $total = $order->totalWithDiscount(session()->get('coupon')['discount']);
        } else {
            $total = $order->total();
        }



        // $url = "https://community.xpay.app/api/v1/payments/pay/variable-amount";

        $url = "https://staging.xpay.app/api/v1/payments/pay/variable-amount";


        $client = new \GuzzleHttp\Client();
        // $success_url = 'https://woowegypt.com/en/customer/paymentSuccess';
        $success_url = 'http://127.0.0.1:8000/customer/order/success';

        $headers = [
            'Authorization' => 'x-api-key' . x_api_key(),
            'Accept'        => 'application/json',
        ];

        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'json' => [
                "billing_data" => [
                    "name" => authCustomer()->full_name,
                    "email" =>  $order->id . 'info@customer.com',
                    "phone_number" => "+201112117402"
                ],
                "amount" => $total,
                "currency" => "USD", // EGP  USD
                "variable_amount_id" => 68,
                "community_id" => comunityId(),
                "pay_using" => "card",
                "custom_fields" => [
                    [
                        "field_label" => 'order id',
                        "field_value" => $this->session_get_order_id()
                    ], [
                        "field_label" => 'customer id',
                        "field_value" => authCustomer()->id
                    ],
                    // [
                    //     "field_label" => 'coupon name',
                    //     "field_value" => session('coupon')['name'] ?? "not_found"
                    // ],
                ]

            ]
        ]);

        // $response = $response->getBody()->getContents();
        $data =  json_decode($response->getBody()->getContents());

        $iframe_url = $data->data->iframe_url;
        $transaction_uuid = $data->data->transaction_uuid;
        //dd($iframe_url);

        //  $order->update(['transaction_uuid' => $transaction_uuid]);

        $ifram = "<iframe src=" . $iframe_url . " width='100%' height='1000px'></iframe>";
        session()->flash('success', __('site.Success Operation'));
        $order = authCustomer()->orders()->latest()->first();

        return $ifram;
        //  return view('customer.payment', compact('order', 'session_id', 'ifram'));
    } // end of payOrderPage



    public function session_create_order_id($order_id)
    {
        session(['order_id' => $order_id]);
    } //end of session_create_order_id
    public function session_get_order_id()
    {
        return session()->get('order_id');
    } //end of session_order_id

    public function promoCode(PromoCodeRequest $request)
    {
        $promocode = PromoCode::where('code', $request->code)->first();
        $invoice = Order::where('id', $this->session_get_order_id())->where('customer_id', authCustomer()->id)->first();
        if ($invoice) {
            session()->put('coupon', [
                'name' => $promocode->code,
                'discount' => $promocode->discount($invoice->total),
                'subtotal' => $promocode->subtotal($invoice->total),
            ]);
            session()->flash('success', 'Done Successfuly');
        }
        return redirect()->back();
    } //end of promoCode

    public function removePromocode(Request $request)
    {
        $this->forget_session();
        return redirect()->back();
    } //end of update
    public function IncreasePromoUser($code)
    {
        PromoCode::where('code', $code)->increment('used');
    } //end IncreasePromoUser

    public function due_date($payment_type, $created_at)
    {
        if ($payment_type == 'Yearly') {
            $due_date = $created_at->addYear();
        } elseif ($payment_type == 'Monthly') {
            $due_date = $created_at->addMonth();
        } else {
            $due_date = null;
        } //end of if
        return $due_date;
    } //end of  due_date




    public function create_invoice()
    {
        $invoic = Order::find($this->session_get_order_id());
        $payment_type = $invoic->payment_type;  // Monthly  ==  Yearly  == Once
        $created_at = $invoic->created_at;
        $due_date = $this->due_date($payment_type, $created_at);
        $discount = session()->get('coupon')['discount'];
        $coupon_code = session()->get('coupon')['name'];

        Invoice::create([
            'order_id' => $this->session_get_order_id(),
            'invoice_number' =>  Invoice_slug() . $this->session_get_order_id(),
            'invoice_date' => $invoic->created_at,
            'due_date' => $due_date,
            'discount' => $discount,
            'coupon_code' => $coupon_code,
            'payment_status' => 'completed',
            'customer_country' => $invoic->customer_country,
            'package_id' => $invoic->package_id,
            'service_id' => $invoic->service_id,
            'title_service_details' => $invoic->title_service_details,
            'product_id' => $invoic->product_id,
            'customer_id' => $invoic->customer_id,
            'payment_type' =>  $invoic->payment_type,  //monthly - yealry
            'payment_method' => $invoic->payment_method,

            'item_price' => $invoic->item_price,
            'total' => $invoic->total,
            'fees' =>  $invoic->fees,


        ]);
    } //end of create_invoice
    public function create_ticket()
    {
        Ticket::create([
            'customer_id' => authCustomer()->id,
            'message' => '',
            'reply' => ticket_message(),
            'section' => 'order Support',
        ]);
    } //end of create_ticket
    public function orderSuccess()
    {
        $invoic = Order::find($this->session_get_order_id());
        $payment_type = $invoic->payment_type;  // Monthly  ==  Yearly  == Once
        $created_at = $invoic->created_at;
        $due_date = $this->due_date($payment_type, $created_at);
        $discount = session()->get('coupon')['discount'];
        $coupon_code = session()->get('coupon')['name'];

        $order = Order::where('id', $this->session_get_order_id())->update(
            [
                'invoice_number' => Invoice_slug() . $this->session_get_order_id(),
                'invoice_date' => $invoic->created_at,
                'due_date' => $due_date,
                'discount' => $discount,
                'coupon_code' => $coupon_code,
                'payment_status' => 'completed',
            ]
        );

        $this->create_ticket(); //create_ticket
        $this->create_invoice(); //create invoice
        $this->IncreasePromoUser(session()->get('coupon')['name']);  //increament count user coupon

        session()->flash('success', 'Done Successfuly');
        return redirect()->route('customer.order.congratulation');
    } //end of orderSuccess


    public function congratulation()
    {
        //  $order_id =  Invoice_slug() . $this->session_get_order_id();
        $order_id =   $this->session_get_order_id();
        //forget session
        $this->forget_session();
        return view('frontend.customer.profile.orders.done', compact('order_id'));
    }
    public function order_delete($id)
    {
        $item = Order::where('invoice_number', null)->find($id);
        if ($item) {
            $item->delete();
            $this->forget_session();
        }
        return redirect()->route('home');
    } //end of order_delete
    public function forget_session()
    {
        // session()->forget('order_id');
        session()->forget('coupon');
        session()->flash('success', __('session forgeted'));
    } //end of forget_session
}
