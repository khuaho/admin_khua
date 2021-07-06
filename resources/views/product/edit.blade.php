@extends('master')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <br/>
        <h3 align="center">Edit Record</h3>
        <br/>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
            </div>
        @endif
        <form method="post" enctype="multipart/form-data"  action="{{action('ProductController@update','$id')}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH"/>
            <div class="form-group">
                <input type="text" name="name" class="form-control" value="{{$products->name}}" placeholder="Enter name"/>
            </div>
            <div class="form-group">
                <input type="text" name="id_type" class="form-control" value="{{$products->id_type}}" placeholder="Enter type"/>
            </div>
            <div class="form-group">
                <input type="text" name="description" class="form-control" value="{{$products->description}}" placeholder="Enter description"/>
            </div>
            <div class="form-group">
                <input type="text" name="unit_price" class="form-control" value="{{$products->unit_price}}" placeholder="Enter unit price"/>
            </div>
            <div class="form-group">
                <input type="text" name="promotion_price" class="form-control" value="{{$products->promotion_price}}" placeholder="Enter promotion"/>
            </div>
            <div class="form-group">
                <img src="source/image/product/{{$products->image}}" height="100px" width="100px"/>
                <input type="file" name="image" class="form-control" value="{{$products->image}}" placeholder="Enter image"/>
            </div>
            <div class="form-group">
                <input type="text" name="unit" class="form-control" value="{{$products->unit}}" placeholder="Enter unit"/>
            </div>
            <div class="form-group">
                <input type="text" name="new" class="form-control" value="{{$products->new}}" placeholder="Enter new"/>
            </div>
            <div class="form-group">
                <input type="submit" name="new" class="btn btn-primary" value="Edit"/>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection