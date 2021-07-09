@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Thống kê</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="index.html">Home</a> / <span>Thống kê</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container-fluid">
	<div class="dashboardheader">
		REPORT
		<div class="float-right rangeselector">
			<div class="input-group input-group-sm mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-calendar"></i></span>
				</div>
				<input type="text" class="form-control" placeholder="Select date range">
			</div>
		</div> <!-- https://www.daterangepicker.com/#example4 -->
		<div class="float-right action-buttons">
			<a href="#" class="period">Today</a>
			<a href="#" class="period">Week</a>
			<a href="#" class="period">1 month</a>
			<a href="#" class="period">3 month</a>
		</div>
    </div><!-- dashboardheader -->
	<div class="d-flex">
	  <div class="box a">
	    <div class="label">Sale this year</div>
	    <div class="digits"><div class="count" data-stop="{{$doanhthutong}}" >0</div><span>VND</span></div>
	    <div class="label-footer">Average <b>{{number_format($doanhthuTB)}}</b> VND / <b>{{$tongbill}}</b> orders</div>
	  </div>
	  <div class="box a">
	    <div class="label">Sale a month</div>
	    <div class="digits"><div class="count" data-stop="{{$month}}">0</div><span>VND</span></div>
	    <div class="label-footer">Average <b>{{number_format($monthavg)}}</b> VND / <b>{{$monthorder}}</b> orders</div>
	  </div>
	  <div class="box b">
	    <div class="label">Sales<span>1 week</span></div>
	    <div class="digits"><div class="count" data-stop="{{$week}}">0</div><span>VND</span></div>
	    <div class="label-footer">Average <b>{{number_format($weekavg)}}</b> VND / <b>{{$weekorder}}</b> orders</div>
	  </div>
	  <div class="box b">
	    <div class="label">Sales<span>1 day</span></div>
	    <div class="digits"><div class="count" data-stop="{{$day}}">0</div><span>VND</span></div>
	    <div class="label-footer">Average <b>{{number_format($dayavg)}}</b> VND / <b>{{$dayorder}}</b> orders</div>
	  </div>

	  <div class="box c">
	    <div class="label">User</div>
	    <div class="digits"><div class="count" data-stop="{{$users}}">{{$users}}</div></div>
	    <div class="label-footer">In progress</div>
	  </div>
	  <div class="box c">
	    <div class="label">Production<span>tag:Product</span></div>
	    <div class="digits"><div class="count" data-stop="{{$products}}">0</div></div>
	    <div class="label-footer">In progress</div>
	  </div>
	  <div class="box c">
	    <div class="label">Production<span>tag:Supplier 2</span></div>
	    <div class="digits"><div class="count" data-stop="8">0</div></div>
	    <div class="label-footer">In progress</div>
	  </div>
	</div>
	<div class="row">
		<div class="col-lg-12">
		  <div class="card">
			<div class="card-header border-0">
			  <div class="d-flex justify-content-between">
				<h3 class="card-title">Online Store Visitors</h3>
				<a href="javascript:void(0);">View Report</a>
			  </div>
			</div>
			<div class="card-body">


			  <div class="position-relative mb-4">
				<canvas id="visitors-chart" height="200"></canvas>
			  </div>

			  <div class="d-flex flex-row justify-content-end">
				<span class="mr-2">
				  <i class="fas fa-square text-primary"></i> This Week
				</span>

				<span>
				  <i class="fas fa-square text-gray"></i> Last Week
				</span>
			  </div>
			</div>
		  </div>
		  <!-- /.card -->
		</div>
</div> <!--container-fluid--><!-- .container -->
@endsection
