@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">{{$sanpham->name}}Product </h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{route('trang-chu')}}">Home</a> / <span>Product Detail</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-sm-4">
                        <img src="source/image/product/{{$sanpham->image}}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-title"><h2>{{$sanpham->name}}</h2></p>
                            <p class="single-item-price">
                                @if($sanpham->promotion_price==0)
									<span class="flash-sale">{{number_format($sanpham->unit_price)}}đ</span>
								@else
								    <span class="flash-del">{{number_format($sanpham->unit_price)}}đ</span>
								    <span class="flash-sale">{{number_format($sanpham->promotion_price)}}đ</span>
								@endif
                            </p>
                        </div>

                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>

                        <div class="single-item-desc">
                            <p>{{$sanpham->description}}</p>
                        </div>
                        <div class="space20">&nbsp;</div>

                        <p>Options:</p>
                        <div class="single-item-options">

                            <select class="wc-select" name="color">
                                <option>Qty</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="space40">&nbsp;</div>
                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#tab-description">Description</a></li>
                        <li><a href="#tab-reviews">Reviews (0)</a></li>
                    </ul>

                    <div class="panel" id="tab-description">
                        <p>{{$sanpham->description}}</p>
                    </div>
                    <div class="panel" id="tab-reviews">
                        <div>
                            <h3>Các comment về sản phẩm {{$sanpham->name}}:</h3>
                        </div>
                        @foreach ($comment as $com)
                            <ul class="top-details menu-beta l-inline">
                                <li>{{$com->user_id}}</li>
                                {{-- @foreach ($user_comment as $user)
                                 <li><img src="profile/{{$user->images}}" width="50px" height="50px"/></li>
                                @endforeach

                                <li></li> --}}
                            </ul>
                            <ul class="top-details menu-beta l-inline">
                                <li>{{$com->content}}</li>
                            </ul>
                        @endforeach
                        <form action="{{route('comment')}}" method="post" >
                            @if(Session::has('thanhcong'))
                                <div class="alert alert-success"><p>{{Session::get('thanhcong')}}</p></div>
                            @endif
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            @if(Auth::check())
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                            @endif
                            <input type="hidden" name="product_id" value="{{$sanpham->id}}"/>
                            <p>Bạn có thể comment sản phẩm</p>
                            <textarea name="content" style="height: 50px"></textarea>
                            <div class="text-left"><button type="submit" class="btn btn-info" href="#">Post</button></div>
                        </form>
                    </div>
                </div>
                <div class="space50">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>Related Products</h4>

                    <div class="row">
                       @foreach ($sp_tuongtu as $sptt)

                        <div class="col-sm-4">
                            <div class="single-item">
                                <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>

                                <div class="single-item-header">
                                    <a href="#"><img src="source/image/product/{{$sptt->image}}" height="250px" width="370px"  alt=""></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$sptt->name}}</p>
                                    <p class="single-item-price" style="font-size: 18px">
                                        @if($sptt->promotion_price==0)
												<span class="flash-sale">{{number_format($sptt->unit_price)}}đ</span>
												@else
												<span class="flash-del">{{number_format($sptt->unit_price)}}đ</span>
												<span class="flash-sale">{{number_format($sptt->promotion_price)}}đ</span>
												@endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="#"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="#">Details <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <br/>
                    <div class="row">{{$sp_tuongtu->links()}}</div>
                </div> <!-- .beta-products-list -->
            </div>
            <div class="col-sm-3 aside">
                <div class="widget">
                    <h3 class="widget-title">Best Sellers</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach ( $pro as $p)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="product.html"><img src="source/image/product/{{$p->image}}" alt=""></a>
                                <div class="media-body">
                                    {{$p->name}}
                                    <span class="beta-sales-price">{{number_format($p->unit_price)}}đ</span>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div> <!-- best sellers widget -->
                <div class="widget">
                    <h3 class="widget-title">New Products</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach ($new_product as $new )
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="product.html"><img src="source/image/product/{{$new->image}}" alt=""></a>
                                <div class="media-body">
                                    {{$new->name}}
                                    <span class="beta-sales-price">{{number_format($new->unit_price)}}đ</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- best sellers widget -->
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
