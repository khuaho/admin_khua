@extends('master')
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Search</h4>
                        <div class="beta-products-details">
                            <p class="pull-left"> {{count($product)}} styles found</p>
                            <div class="clearfix"></div>
                        </div>

                        <div class="row">
                            @foreach ($product as $row)
                            <div class="col-sm-3">
                                <div class="single-item">
                                    @if($row['promotion_price']!=0)
                                    <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                                    @endif
                                    <div class="single-item-header">
                                        <a href="{{route('chitietsanpham',$row['id'])}}"><img src="source/image/product/{{$row['image']}}" height="270px" width="320px" alt=""></a>
                                    </div>
                                    <div class="single-item-body">
                                        <p class="single-item-title">{{$row['name']}}</p>
                                        <p class="single-item-price" style="font-size: 18px">
                                            @if($row['promotion_price']==0)
                                            <span class="flash-sale">{{number_format($row['unit_price'])}}đ</span>
                                            @else
                                            <span class="flash-del">{{number_format($row['unit_price'])}}đ</span>
                                            <span class="flash-sale">{{number_format($row['promotion_price'])}}đ</span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="single-item-caption">
                                        <a class="add-to-cart pull-left" href="{{route('themgiohang',$row['id'])}}"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="beta-btn primary" href="{{route('chitietsanpham',$row['id'])}}">Details <i class="fa fa-chevron-right"></i></a>
                                        <form action="{{route('addwishlist')}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                            <input type="hidden" name="product_id" value="{{$row->id}}"/>
                                            @if(Auth::check())
                                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                            @endif
                                            <button class="btn btn-warning" type="submit">Wishlist</i></button>
                                        </form>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <br/><br/>

                    </div> <!-- .beta-products-list -->


                </div>
            </div> <!-- end section with sidebar and main content -->


        </div> <!-- .main-content -->
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection
