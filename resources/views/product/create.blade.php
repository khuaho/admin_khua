@extends('master')
@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <br/>
        <h3 aling="center">Add Data</h3>
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
        <form method="post" enctype="multipart/form-data" action="{{url('product')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Enter product name"/>
            </div>
            <div class="form-group">
                <input type="number" name="id_type" class="form-control" placeholder="Enter id type"/>
            </div>
            <div class="form-group">
                <input type="text" name="description" class="form-control" placeholder="Enter product's description"/>
            </div>
            <div class="form-group">
                <input type="text" name="unit_price" class="form-control" placeholder="Enter unit price"/>
            </div>
            <div class="form-group">
                <input type="text" name="promotion_price" class="form-control" placeholder="Enter promotion price"/>
            </div>
            <div class="form-group">
                <input type="file" name="image" class="form-control" placeholder="Enter product's image"/>
            </div>
            <div class="form-group">
                <input type="text" name="unit" class="form-control" placeholder="Enter unit "/>
            </div>
            <div class="form-group">
                <input type="text" name="new" class="form-control" placeholder="Enter new"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary"/>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
</div>

@endsection