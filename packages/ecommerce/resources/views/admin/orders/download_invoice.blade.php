<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            html, body {
                background-color: #fff;
                color: #313131;
                font-family: DejaVu Sans, sans-serif;
                font-weight: 100;
                margin: 0;
            }
            .container{
                width: 100%;
                margin: 0 auto;
                padding: 20px;
                box-sizing: border-box;
                border: 1px solid #ddd;
                margin: 50px;
            }
            .default{
                width: 100%;
            }
            .header .logo{
                width: 200px;
                display: inline-block;
            }
            .header img{
                width: 100%;
                padding-top: 15px;
            }
            .header .created{
                width: 300px;
                margin-top: 15px;
                margin-left: 50px;
                box-sizing: border-box;
                display: inline-block;
            }
            .header .created p{
                line-height: 10px;
                width: 100%;
                display: block;
            }
            .infomation{
                margin-top: 20px;
            }
            .infomation p{
                font-weight: bold;
                line-height: 16px;
            }
            .payment-method{
                margin-top: 20px;
            }
            .payment-method table{
                width: 100%;
                border-collapse: collapse;
            }
            .payment-method thead{
                background: #f1f1f1;
                border-bottom: 1px solid #ddd;
            }
            .payment-method th{
                text-align: left;
                font-size: 18px;
                padding: 10px;
                box-sizing: border-box;
            }
            .payment-method td{
                padding: 10px;
                box-sizing: border-box;
            }
            .info-product{
                margin-top: 10px;
                border-bottom: 1px solid #ddd;
            }
            .info-product table{
                width: 100%;
            }
            .info-product th{
                text-align: left;
                font-size: 18px;
                padding: 10px;
                box-sizing: border-box;
            }
            .info-product td{
                padding: 10px;
                box-sizing: border-box;
            }
            .total-price {
                margin-top: 20px;
            }
            .total-price p{
                font-weight: bold;
                font-size: 18px;
                line-height: 20px;
                text-align: right;
            }
            tbody th{
                font-weight: normal;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header default">
                <div class="logo">
                    <img src="https://sudospaces.com/sudovn/2020/06/logo.png" alt="">
                </div>
                <div class="created">
                    <p>Invoice: {!! $order->code??'' !!}</p>
                    <p>Created: {!! date('Y-m-d H:i:s', strtotime($order->created_at)) !!}</p>
                </div>
            </div>
            <div class="infomation default">
                <p>{!! $customer->name??'' !!}</p>
                <p>{!! $customer->address??'' !!}</p>
                <p>{!! $customer->email??'' !!}</p>
                <p>{!! $customer->phone??'' !!}</p>
            </div>
            <div class="payment-method default">
                <table>
                    <thead>
                        <tr>
                            <th>@lang('Phương thức thanh toán')</th>
                            <th>@lang('Trạng thái thanh toán')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{!! config('SudoOrder.payment_method')[$order->payment_method] !!}</td>
                            <th>{!! __(config('SudoOrder.payment_status')[$order->payment_status]) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="info-product default">
                <table>
                    <thead>
                        <tr>
                            <th>@lang('Sản phẩm')</th>
                            <th>@lang('Giá')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($order_detail as $value)
                        @php
                            $products = DB::table('products')->where('id', $value->product_id)->first();
                            $total = $total + $value->price*$value->quantity;
                        @endphp
                        <tr>
                            <th>{!! $products->name??'' !!}</th>
                            <th>
                                {!! number_format($value->price * $value->quantity) !!}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total-price default">
                <p>@lang('Tổng tiền'): {!! number_format($total) !!}</p>
            </div>
        </div>
    </body>
</html>