@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Checkout</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="index.html">Home</a> / <span>Checkout</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">

        <form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="row">
                {{-- @if(Session::has('thongbao')){{Session::get('thongbao')}} @endif --}}
                @if ($message = Session::get('success'))
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('success');?>
                @endif

                @if ($message = Session::get('error'))
                <div class="custom-alerts alert alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                    {!! $message !!}
                </div>
                <?php Session::forget('error');?>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <h4>Checkout</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="name">Full name*</label>
                        @if(Auth::check())
                            <input type="text" id="name" value="{{Auth::user()->name}}" name="name" required>
                        @endif
                    </div>

                    <div class="form-block">
                        <label for="gender">Gender*</label>
                        <input type="radio" id="gender" class="input-radio"  name="gender" value="nam" checked="checked" style="width: 10%">
                        <span style="margin-right: 10%">Nam</span>
                        <input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width:10%"/><span>Nữ</span>
                    </div>

                    <div class="form-block">
                        <label for="company">Email*</label>
                        @if(Auth::check())
                             <input type="email" id="email" name="email" value="{{Auth::user()->email}}" required placeholder="example@gmail.com">
                        @endif
                    </div>

                    <div class="form-block">
                        <label for="adress">Address*</label>
                        <input type="text" id="address" name="address" value="{{Auth::user()->address}}" placeholder="Địa chỉ" required>

                    </div>

                    <div class="form-block">
                        <label for="phone">Phone*</label>
                        <input type="text" id="phone_number" name="phone_number" value="{{Auth::user()->phone}}" required>
                    </div>

                    <div class="form-block">
                        <label for="notes">Order notes</label>
                        <textarea id="note" name="note"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Your Order</h5></div>
                        <div class="your-order-body">
                            <div class="your-order-item">
                                <div>
                                    @if(Session::has('cart'))
                                    @foreach ($product_cart as $cart)


                                <!--  one item	 -->
                                    <div class="media">
                                        <img width="25%" src="source/image/product/{{$cart['item']['image']}}" alt="" class="pull-left">
                                        <div class="media-body">
                                            <p class="font-large">{{$cart['item']['name']}}</p>
                                            <span class="color-gray your-order-info">Đơn giá: {{number_format($cart['price'])}} đồng</span>
                                            <span class="color-gray your-order-info">Số lượng: {{$cart['qty']}}</span>

                                        </div>
                                    </div><br/>
                                <!-- end one item -->
                                @endforeach
                                @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Quantity Total:</p></div>
                                <div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{$totalQty}} @else 0 @endif</h5></div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Total:</p></div>
                                <div class="pull-right"><h5 class="color-black">@if(Session::has('cart')){{number_format($totalPrice)}} @else 0 @endif đồng</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="your-order-head"><h5>Payment Method</h5></div>

                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment" value="Cash" checked="checked" data-order_button_text="">
                                    <label for="payment_method_bacs">Thanh toán khi nhận hàng</label>
                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                        Cửa hàng sẽ gửi đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                                    </div>
                                </li>

                                <li class="payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment" value="cheque" data-order_button_text="">
                                    <label for="payment_method_cheque">Vnpay</label>
                                    <div class="payment_box payment_method_cheque" style="display: none;">
                                        Chuyển khoản đến tài khoản sau:
                                          <br/>- Số tài khoản: 123 456 789
                                          <br/>-Chủ TK: Hồ Thị Khưa
                                          <br/>- Ngân hàng Vietcombank, chi nhánh Đà Nẵng
                                    </div>
                                </li>

                                <li class="payment_method_paypal">
                                    <input id="payment_method_paypal" type="radio" class="input-radio" name="payment" value="paypal" data-order_button_text="Proceed to PayPal">

                                    <label for="payment_method_paypal">PayPal</label>

                                    <!--Paypal-->
                                    {{-- <div id="paypal-button"></div> --}}
                                </li>
                            </ul>
                        </div>

                        <div class="text-center"><button type="submit" class="beta-btn primary" href="#"> Checkout <i class="fa fa-chevron-right"></i></button></div>
                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
        <form action="{{route('in')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <h2>
                In hóa đơn
            </h2>
            <button type="submit" class="beta-btn primary" href="#"> In <i class="fa fa-chevron-right"></i></button>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
