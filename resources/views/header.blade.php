<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href=""><i class="fa fa-home"></i> 101B Lê Hữu Trác, Phước Mỹ, Sơn Trà, Đà Nẵng</a></li>
                    <li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">

                    @if(Auth::check())
                        <li><img src="profile/{{Auth::user()->images}}" width="50px" height="50px"/></li>
                        <li><a href="">Chào bạn {{Auth::user()->name}}</a></li>
                        <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                    @else
                        <li><a href="{{route('signup')}}">Đăng kí</a></li>
                        <li><a href="{{route('login')}}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="index.html" id="logo"><img src="source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
            </div>
            <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="post" id="searchform" action="{{route('search')}}">
                        {{ csrf_field() }}
                        <input type="text" value="" name="key" id="key" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>

                <div class="beta-comp">
                    @if(Session::has('cart'))
                    <div class="cart">
                        <div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng(@if(Session::has('cart')) {{Session('cart')->totalQty}}
                            @else Trong @endif) <i class="fa fa-chevron-down"></i></div>
                        <div class="beta-dropdown cart-body">

                            @foreach($product_cart as $product)
                            <div class="cart-item">
                                <a class="cart-item-delete" href="{{route('xoagiohang',$product['item']['id'])}}"><i class="fa fa-times"></i></a>
                                <div class="media">
                                    <a class="pull-left" href="#"><img src="source/image/product/{{$product['item']['image']}}" alt=""></a>
                                    <div class="media-body">
                                        <span class="cart-item-title">{{$product['item']['name']}}</span>
                                        <span class="cart-item-options">Size: XS; Colar: Navy</span>
                                        <span class="cart-item-amount">{{$product['qty']}}*<span> @if($product['item']['promotion_price']==0){{number_format($product['item']['unit_price'])}} @else {{number_format($product['item']['promotion_price'])}} @endif</span></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="cart-caption">
                                <div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format(Session('cart')->totalPrice)}} đồng</span></div>
                                <div class="clearfix"></div>

                                <div class="center">
                                    <div class="space10">&nbsp;</div>
                                    <a href="{{route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .cart -->
                    @endif
                </div>
                <!--wishlist-->
                <div class="beta-comp ">
                    <div class="wishlist dropdown">
                        <div class="beta-select " data-toggle="dropdown"><i class="fa fa-heart"></i> Sản phẩm yêu thích({{$count_wishlist}}) <i class="fa fa-chevron-down"></i></div>
                        <div class="beta-dropdown wishlist-body dropdown-menu">

                            @foreach($wishlist as $product)
                            <div class="wishlist-item dropdown-item">

                                <a class="wishlist-item-delete" href="{{route('xoayeuthich',$product->id)}}"><i class="fa fa-times"></i></a>
                                <a class="add-to-cart pull-left" href="{{route('themgiohang',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<a class="btn btn-warning" href="{{route('chitietsanpham',$product->id)}}">Details <i class="fa fa-chevron-right"></i></a>
                                <div class="media">
                                    <a class="pull-left" href="#"><img src="source/image/product/{{$product->image}}" alt=""></a>
                                    <div class="media-body">
                                        <span class="wishlist-item-title">{{$product->name}}</span>
                                        <span class="wishlist-item-amount"><span> @if(($product->promotion_price)==0){{number_format($product->unit_price)}}đ @else {{number_format($product->promotion_price)}}đ @endif</span></span>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div> <!-- .wishlist -->


                </div>
            </div>

            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-body -->
    <div class="header-bottom" style="background-color: #0277b8;">
        <div class="container">
            <a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
            <div class="visible-xs clearfix"></div>
            <nav class="main-menu">
                <ul class="l-inline ov">
                    <li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
                    <li><a href="#">Sản phẩm</a>
                        <ul class="sub-menu">
                            @foreach ($loai_sp as $loai )
                            <li><a href="{{route('loaisanpham',$loai->id)}}">{{$loai->name}}</a></li>
                            @endforeach


                        </ul>
                    </li>
                    <li><a href="{{route('gioithieu')}}">Giới thiệu</a></li>
                    <li><a href="{{route('lienhe')}}">Liên hệ</a></li>
                    <li><a href="{{route('thongke')}}">Thống kê</a></li>
                </ul>
                <div class="clearfix"></div>
            </nav>
        </div> <!-- .container -->
    </div> <!-- .header-bottom -->
</div> <!-- #header -->
