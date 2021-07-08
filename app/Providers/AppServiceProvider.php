<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ProductType;
use App\Cart;
use App\Wishlist;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header',function($view){
            $loai_sp = ProductType::all();

            $view->with('loai_sp',$loai_sp);
        });
        view()->composer('header',function($view){
                if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
                }
        });

        view()->composer('header',function($view){
            $user_id='';
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }
            $count_wishlist = Wishlist::select(['wishlist.*'])
                    ->where('user_id', '=',  $user_id)
                    ->count();
            $wishlist = DB::table('wishlist')->join('users', 'wishlist.user_id', '=', 'users.id')->join('products','wishlist.product_id','=','products.id')->where('users.id', '=', $user_id)->get();
    
            $view->with(['wishlist'=>$wishlist,'count_wishlist'=>$count_wishlist]);
        });
    }
}
