<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::resource('page', 'HomeController');

Route::resource('product', 'ProductController');

Route::get('/contact', 'EmailController@index');

Route::post('/sendemail/send', 'EmailController@send');


Route::get('index', [
    'as' => 'trang-chu',
    'uses' => 'PageController@getIndex'
    ]);

    Route::get('loai-san-pham/{type}', [
        'as' => 'loaisanpham',
        'uses' => 'PageController@getLoaiSp'
        ]);
        Route::get('chi-tiet-san-pham/{id}', [
            'as' => 'chitietsanpham',
            'uses' => 'PageController@getChitiet'
            ]);

        Route::get('gioi-thieu', [
            'as' => 'gioithieu',
            'uses' => 'PageController@getGioiThieu'
            ]);

            Route::get('lien-he', [
                'as' => 'lienhe',
                'uses' => 'PageController@getLienHe'
                ]);
                //Thêm vào giỏ hàng
                Route::get('add-to-cart/{id}', [
                    'as' => 'themgiohang',
                    'uses' => 'PageController@getAddtoCart'
                    ]);
                    Route::get('del-cart/{id}', [
                        'as' => 'xoagiohang',
                        'uses' => 'PageController@getDelItemCart'
                        ]);
                        //Thêm vào add to list

                        Route::post('addwishlist', [
                            'as' => 'addwishlist',
                            'uses' => 'PageController@getAddToWishList'
                            ]);
                            Route::get('del-wishlist/{id}', [
                                'as' => 'xoayeuthich',
                                'uses' => 'PageController@getDelItemWishlist'
                                ]);
                        //Đặt hàng
                        Route::get('dat-hang', [
                            'as' => 'dathang',
                            'uses' => 'PageController@getCheckout'
                            ]);

                            Route::post('dat-hang', [
                                'as' => 'dathang',
                                'uses' => 'PageController@postCheckout'
                                ]);
                                //In hóa đơn
                                Route::post('in', [
                                    'as' => 'in',
                                    'uses' => 'PageController@pdf'
                                    ]);
                                    //Tìm kiếm sản phẩm
                                Route::post('search', [
                                    'as' => 'search',
                                    'uses' => 'PageController@getSearch'
                                    ]);
                                    //Đăng nhập
                                    Route::post('dang-nhap', [
                                        'as' => 'login',
                                        'uses' => 'PageController@postLogin'
                                        ]);
                                        Route::get('dang-nhap', [
                                            'as' => 'login',
                                            'uses' => 'PageController@getLogin'
                                            ]);
                                            //Đăng ký
                                        Route::get('dang-ki', [
                                            'as' => 'signup',
                                            'uses' => 'PageController@getSignup'
                                            ]);
                                            Route::post('dang-ki', [
                                                'as' => 'signup',
                                                'uses' => 'PageController@postSignup'
                                                ]);
                                                //Comment
                                                Route::post('comment', [
                                                    'as' => 'comment',
                                                    'uses' => 'PageController@postComment'
                                                    ]);
                                                //Đăng xuất
                                                Route::get('dang-xuat', [
                                                    'as' => 'logout',
                                                    'uses' => 'PageController@postLogout'
                                                    ]);
                                                    //Hóa đơn
                                                    Route::get('hoa_don', [
                                                        'as' => 'hoadon',
                                                        'uses' => 'PageController@pdf'
                                                        ]);

                                                       //Paypal

                                                        Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'PaypalController@payWithPaypal',));
                                                        Route::post('paypal', array('as' => 'paypal','uses' => 'PaypalController@postPaymentWithpaypal',));
                                                        Route::get('paypal', array('as' => 'status','uses' => 'PaypalController@getPaymentStatus',));
