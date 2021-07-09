<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bán hàng</title>
  <base href="{{asset('')}}"></base>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <link rel="stylesheet" href="source/assets/dest/css/font-awesome.min.css">
	<link rel="stylesheet" href="source/assets/dest/vendors/colorbox/example3/colorbox.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/settings.css">
	<link rel="stylesheet" href="source/assets/dest/rs-plugin/css/responsive.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/style.css">
    {{-- <link rel="stylesheet" title="style" href="source/assets/dest/css/admintle.css">
    <link rel="stylesheet" title="style" href="source/assets/dest/css/all.min.css"> --}}
	<link rel="stylesheet" href="source/assets/dest/css/animate.css">
	<link rel="stylesheet" title="style" href="source/assets/dest/css/huong-style.css">
</head>
<body>
@include('header');
<div >
     @yield('content')
</div>
<br/><br/>
@include('footer');
@include('script');
</body>
</html>
