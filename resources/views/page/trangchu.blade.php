@extends('master')
@section('content')
@if(Session::has('thanhcong'))
    <div class="alert alert-success"><p>{{Session::get('thanhcong')}}</p></div>
@endif
<div class="rev-slider">
	<div class="fullwidthbanner-container">
		<div class="fullwidthbanner">
			<div class="bannercontainer" >
			<div class="banner" >
					<ul>
						<!-- THE FIRST SLIDE -->
						@foreach ( $slide as $row)
						<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
						<div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
										<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="source/image/slide/{{$row['image']}}"  data-src="source/image/slide/{{$row['image']}}"  style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('source/image/slide/{{$row['image']}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
										</div>
									</div>
					</li>
					@endforeach
					</ul>
				</div>
			</div>

			<div class="tp-bannertimer"></div>
		</div>
	</div>
	<!--slider-->
</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left"> {{count($new_product)}} styles found</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach ($new_product as $row)
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
												<span class="flash-sale">{{number_format($row['unit_price'])}}??</span>
												@else
												<span class="flash-del">{{number_format($row['unit_price'])}}??</span>
												<span class="flash-sale">{{number_format($row['promotion_price'])}}??</span>
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
							<div class="row">{{$new_product->links()}}</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Top Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($top_product)}} styles found</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach ($top_product as $row)


								<div class="col-sm-3">
									<div class="single-item">
										@if($row['promotion_price']!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham',$row['id'])}}"><img src="source/image/product/{{$row['image']}}" height="270px" width="320px" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$row['name']}}</p><br/>
											<p class="single-item-price" style="font-size: 18px">
												@if($row['promotion_price']==0)
												<span class="flash-sale">{{number_format($row['unit_price'])}}??</span>
												@else
												<span class="flash-del">{{number_format($row['unit_price'])}}??</span>
												<span class="flash-sale">{{number_format($row['promotion_price'])}}??</span>
												@endif
											</p>
										</div>
										<br/>
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
									</div><br/>
								</div><br/>
								@endforeach
							</div>
							<div class="row">{{$top_product->links()}}</div>
							<div class="space40">&nbsp;</div>

						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
    @endsection
