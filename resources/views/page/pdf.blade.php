!DOCTYPE html>
<html lang="vi">
<head>
  <title>Bán hàng</title>
  <base href="{{asset('')}}"></base>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
<div class="container">

    <table class="table table-bordered" id="laravel_crud">
        <thead>
           <tr>
              <th>Sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Giá </th>
              <th>Số lượng</th>
           </tr>
        </thead>
        <tbody>
           @foreach($product_cart as $cart)
           <tr>
              <td><img width="25%" src="source/image/product/{{$cart['item']['image']}}" alt="" class="pull-left"></td>
              <td>{{$cart['item']['name']}}</td>
              <td>{{number_format($cart['price'])}}</td>
              <td>{{$cart['qty']}}</td>
           </tr>
           @endforeach
        </tbody>
        <h3>Tổng số lượng: {{$totalQty}}</h3>
       <h3>Tổng tiền: {{number_format($totalPrice)}}</h3>
       </table>

</div>

</body>
</html>

