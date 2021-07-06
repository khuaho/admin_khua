@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <br/>
            <h3 align="center" >Product Data</h3>
            <br/>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
            </div>
        @endif
            <div align="right">
                <a href="{{route('product.create')}}" class="btn btn-primary">Add</a>
            </div>
            <br/><br/>
            <table class="table table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Type_id</th>
                    <th>Description</th>
                    <th>Unit price</th>
                    <th>promotion price</th>
                    <th>Image</th>
                    <th>Unit</th>
                    <th>New</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($products as $row)
                    <tr>
                        <td>{{$row['name']}}</td>
                        <td>{{$row['id_type']}}</td>
                        <td>{{$row['description']}}</td>
                        <td>{{$row['unit_price']}}</td>
                        <td>{{$row['promotion_price']}}</td>
                        <td><img src='source/image/product/{{$row['image']}}' width="200px" height="100px"/></td>
                        <td>{{$row['unit']}}</td>
                        <td>{{$row['new']}}</td>
                        <td><a href="{{action('ProductController@edit',$row['id'])}}" class="btn btn-warning">Edit</a></td>
                        <td>
                            <form method="post" class="delete_form" action="{{action('ProductController@destroy',$row['id'])}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE"/>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{-- <div class="row">{{$products->links()}}</div> --}}
    <script>
        $(document).ready(function(){
            $('.delete_form').on('submit',function(){
                if(confirm("Are you sure you want to delete it?"))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            });
        });
    </script>
@endsection