<!DOCTYPE html>
<html lang="en">

<head>
    <title>MGH || E-mail</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <style>
        /*********************************************************************************/
        /*********************************************************************************/
        /*********************************************************************************/
        /*********************************************************************************/
        /*********************************************************************************/
        /*********************************************************************************/
        /*********************************************************************************/

        /* .top_lines {

}
.top_lines > div {
  position: absolute;
}
.top_lines .left_line {
  left: 0;
  width: 50%;
  height: 50%;
}
.top_lines .right_line {
  right: 0;
} */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif !important;
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
        }

        a {
            text-decoration: none;
            margin: 0;
        }

        .invoice_page {
            padding: 1rem;
            background-color: #fff;
            background-image: url(../imgs/logo.png);
            background-repeat: no-repeat;
            background-size: 90%;
            background-position-x: 50%;
            background-position-y: 80%;
            position: relative;
            z-index: 1;
            margin: 0 auto;
            width: 1000px;
        }

        .invoice_page::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.92);
            z-index: -1;
        }

        .invoice_page .logo {
            margin-top: 1rem;
            margin-bottom: 2rem;
        }

        .invoice_page .logo img {
            max-height: 100px;
            margin: auto;
            display: block;
        }

        .head_invoice {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #98d5dd;
            color: #1b3383;
            padding: 1rem 2rem;
            position: relative;
        }

        .head_invoice::before {
            /* content: ""; */
            width: 100%;
            height: 15px;
            position: absolute;
            top: -11px;
            left: 0;
            background-color: #fff;
            /*z-index: -1;
  */
            transform: rotate(-1deg);
            -webkit-transform: rotate(-1deg);
            -moz-transform: rotate(-1deg);
            -ms-transform: rotate(-1deg);
            -o-transform: rotate(-1deg);
        }

        .head_invoice img {
            max-height: 30px;
            margin-right: .5rem;
        }

        .head_invoice div {
            font-size: 1rem;
            display: flex;
            align-items: center;
        }

        .head_invoice div.left {
            /* margin-bottom: -11px; */
        }

        .head_invoice strong {
            font-weight: bold;
        }

        .head_invoice .name {
            font-weight: normal;
        }

        .head_invoice .price {
            font-weight: bold;
            color: #f00;
        }

        .head_invoice_info {
            display: flex;
            /* align-items: center; */
            justify-content: space-between;
            width: 70%;
            padding: 1rem 2rem;
        }

        .footer_invoice p,
        .head_invoice_info p {
            color: #1b3383;
            padding: .2rem 0;
        }

        .footer_invoice strong,
        .head_invoice_info .user_info strong {
            font-weight: bold;
        }

        .footer_invoice {
            padding: 1rem 2rem;
        }


        /* DivTable.com */
        .divTable {
            display: table;
            width: 100%;
        }

        .divTableRow {
            display: table-row;
            text-align: center;
        }

        .divTableCell,
        .divTableHead {
            border: 1.5px solid #c7c7c7;
            display: table-cell;
            padding: 1rem;
        }

        .divTableHeading {
            background-color: transparent;
            display: table-header-group;
            font-weight: bold;
            padding: .5rem 1rem;
            color: #1b3383;
            font-weight: bold;
        }

        .divTableFoot {
            background-color: #EEE;
            display: table-footer-group;
            font-weight: bold;
        }

        .divTableBody {
            display: table-row-group;
            font-weight: 600;
            color: #1b3383;
        }

        .divTableBody a {
            font-weight: 600;
            color: var(--blueColor);
            display: -webkit-inline-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 140px;
        }

        .table_invoice .img_tb {
            height: 70px;
            width: 90px;
            display: inline-block;
        }

        .table_invoice .img_tb img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .footer_txt {
            background-color: #98d5dd;
            text-align: center;
            padding: 1rem;
            margin-top: 1.5rem;
        }

        .footer_txt p {
            margin: 0;
            font-size: 1.2rem;
            color: #1b3383;
            font-weight: bold;
        }

        .logo-2 {
            text-align: center;
            margin-bottom: 1rem;
        }

        .logo-2 img {
            max-height: 300px;
        }

    </style>

</head>

<body class="">


    <!--section start-->
    <section class="faq-section section-big-py-space bg-light">
        <div class="container">
            <div class="invoice_page">
                <div class="top_lines">
                    <span class="left_line"></span>
                    <span class="right_line"></span>
                </div>
                <div class="logo-2"><img src="{{ asset('frontend/assets/thankyou.jpeg') }}" class="img-fluid" alt="">
                </div>
                <div class="head_invoice">
                    <div class="left"><img src="{{ asset('frontend/assets/hand-icon.png') }}" alt="">
                        <strong>Thanks:</strong> <span
                            class="name">{{ $order->customer_name ?? $order->customer->full_name }} </span>
                    </div>
                    <div class="right"><img src="{{ asset('frontend/assets/tota-icon.png') }}" alt="">
                        <strong>Total:</strong> <span class="price">{{ $order->total }}
                            {{ getCurrencyBlade() }}</span>
                    </div>
                </div>
                <div class="head_invoice_info">
                    <div class="user_info">
                        <p> <strong>Name:</strong> {{ $order->customer_name ?? $order->customer->full_name }} </p>
                        <p> <strong>Phone:</strong> {{ $order->customer_phone ?? $order->customer->phone }} </p>
                        <p> <strong>Address:</strong> {{ $order->customer_address }} </p>
                        {{-- <p> <strong>City:</strong> {{ $order->city->name ?? '' }}</p> --}}
                        <p> <strong>E-mail:</strong> {{ $order->customer_email ?? $order->customer->email }} </p>
                    </div>
                    <div class="order_info">
                        <p> <strong>@lang('site.coupon') :</strong> {{ $order->promocode }}  </p>
                        <p> <strong>Payment Methods:</strong> {{ __('site.' . $order->payment_method) }} </p>
                        <p> <strong>Date Creation:</strong> {{ date('d-m-Y', strtotime($order->created_at)) }} </p>
                        <p> <strong>Time:</strong> {{ Carbon\Carbon::parse($order->created_at)->format('h:i  A') }}
                        </p>
                    </div>

                    <div class="user_info">

                        <b> @lang('site.customer_address') </b>: {{ $order->customer_address }} <br>
                        <b> @lang('site.customer_region') : </b>{{ $order->customer_region }} <br>
                        <b> @lang('site.customer_street') : </b>{{ $order->customer_street }} <br>
                        <b> @lang('site.customer_home_number') : </b>{{ $order->customer_home_number }} <br>
                        <b> @lang('site.customer_floor_number') : </b>{{ $order->customer_floor_number }} <br>
                        <b> @lang('site.customer_appartment_number') : </b>{{ $order->customer_appartment_number }}
                        <br>
                        <b> @lang('site.notes') : </b>{{ $order->customer_comments_extra }} <br>
                    </div>

                </div>
                <div class="table_invoice">
                    <div class="divTable">
                        <div class="divTableHeading">
                            <div class="divTableRow">
                                <div class="divTableCell"> # </div>
                                <div class="divTableCell"> @lang('site.Purchases') </div>
                                <div class="divTableCell"> @lang('site.quantity') </div>
                                <div class="divTableCell"> @lang('site.price') </div>
                                <div class="divTableCell"> @lang('site.weights') </div>
                            </div>
                        </div>
                        <div class="divTableBody">
                            @foreach ($order->orderDetails as $key => $item)
                                <div class="divTableRow">
                                    <div class="divTableCell"> {{ $key + 1 }} </div>
                                    <div class="divTableCell">
                                        <div class="img_tb"><img src="{{ $item->image_path }}" class="img-fluid"
                                                alt="">
                                        </div> <a href="">{{ $item->product->title ?? '' }}</a>
                                    </div>
                                    <div class="divTableCell"> {{ $item->qty }} </div>
                                    <div class="divTableCell"> {{ $item->price }} </div>
                                    <div class="divTableCell"> {{ $item->type ? $item->type . ' GM' : '1 KG' }} </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                {{-- الاضافات  --}}
                @if($order->orderAddtions)
                <div class="table_invoice">
                    <div class="divTable">
                        <div class="divTableHeading">
                            <div class="divTableRow">
                                <div class="divTableCell"> # </div>
                                <div class="divTableCell"> @lang('site.Purchases') </div>
                                <div class="divTableCell"> @lang('site.total') </div>
                                <div class="divTableCell"> @lang('site.quantity') </div>
                                <div class="divTableCell"> @lang('site.price') </div>
                            </div>
                        </div>
                        <div class="divTableBody">
                            @foreach ($order->orderAddtions as $key => $item)
                                <div class="divTableRow">
                                    <div class="divTableCell"> {{ $key + 1 }} </div>
                                    <div class="divTableCell">

                                        </div> <a href="">{{ $item->addition->title ?? '' }}  </a>
                                    </div>
                                    <div class="divTableCell">{{ $item->addition->total ?? '' }} </div>
                                    <div class="divTableCell"> {{ $item->qty }} </div>
                                    <div class="divTableCell"> {{ $item->price }}  </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                @endif

                <div class="logo text-center mb-0"><img src="{{ $setting->image_logo }}" class="img-fluid" alt="">
                </div>
                <div class="footer_txt">
                    <p class="mb-0">Looks like you’ve made a great choice, you deserve it</p>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->


</body>

</html>
