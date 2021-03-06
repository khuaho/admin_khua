<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Product;
use App\Slide;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use App\Comment;
use App\Wishlist;
use Hash;
use Auth;
use PDF;
class PageController extends Controller
{
    public function getIndex()
    {
      $slide = Slide::all();
      $new_product = Product::where('new',1)->paginate(4);
      $top_product = Product::where('promotion_price','<>','0')->paginate(8);
      return view('page.trangchu', compact('new_product','slide','top_product','top_product'));
    }

    public function getLoaiSp($type){
        //Lay san pham hien thi theo loai
        $sp_theoloai = Product::where('id_type',$type)->get();
        //Lay san pham hien thi khac loai
        $sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        //Lay ten loai san pham moi khi chung ta chon danh muc loai san pham
        $loai = ProductType::all();
        $loai_sp = ProductType::where('id',$type)->first();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChitiet(Request $req){
        $pro = Product::where('promotion_price','<>','0')->paginate(4);
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);
        $new_product = Product::where('new',1)->paginate(4);
        $comment = Comment::where('product_id', $req->id)->get();
        $count_comment = Comment::select(['comments.*'])
                    ->where('product_id', '=', $req->id)
                    ->count();
        $users = DB::table('comments')->join('users', 'comments.user_id', '=', 'users.id')->join('products','comments.product_id','=','products.id')->where('products.id', '=', $req->id)->get();

        return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','new_product','pro', 'comment','users','count_comment'));
    }
    public function getGioiThieu(){
        return view('page.about');
    }

    public function getLienHe(){
        return view('page.lienhe');
    }
    public function getThongKe(){
        //sale in a month
        $range = \Carbon\Carbon::now()->subDays(30);
        $month = DB::table('bills')->where('created_at', '>=', $range)->sum('total');
        $monthavg = DB::table('bills')->where('created_at', '>=', $range)->avg('total');
        $monthorder = Bill::select(['bills.*'])->where('created_at', '>=', $range)->count();
        //Sale in 1 week
         $rangeweek = \Carbon\Carbon::now()->subDays(7);
         $week = DB::table('bills')->where('created_at', '>=', $rangeweek)->sum('total');
         $weekavg = DB::table('bills')->where('created_at', '>=', $rangeweek)->avg('total');
         $weekorder = Bill::select(['bills.*'])->where('created_at', '>=', $rangeweek)->count();
         //Sale in 1 day
         $rangeday = \Carbon\Carbon::now()->subDays(1);
         $day = DB::table('bills')->where('created_at', '>=', $rangeday)->sum('total');
         $dayavg = DB::table('bills')->where('created_at', '>=', $rangeday)->avg('total');
         $dayorder = Bill::select(['bills.*'])->where('created_at', '>=', $rangeday)->count();
        //Th???ng k?? user
        $users = User::select(['users.*'])
                    ->count();
        //Th???ng k?? t???ng doanh thu
        $doanhthutong = DB::table("bills")->get()->sum("total");
        $tongbill = Bill::select(['bills.*'])
                    ->count();
        $doanhthuTB = DB::table('bills')->avg('total');
        //Th???ng k?? s??? l?????ng s???n ph???m
        $products = Product::select(['products.*'])
        ->count();
        return view('page.thongke',compact('users','doanhthutong','tongbill','doanhthuTB','month','monthavg','monthorder','week','weekavg','weekorder','day','dayavg','dayorder','products'));
    }
    public function getAddToWishList(Request $req){

        $user_id='';
            if(Auth::check()){
                $user_id = Auth::user()->id;
            }

        $wishlist = DB::table('wishlist')->join('users', 'wishlist.user_id', '=', 'users.id')->join('products','wishlist.product_id','=','products.id')->where('users.id', '=', $user_id)->where('products.id','=',$req->product_id)->first();
            if($wishlist){
                return redirect()->back()->with('thanhcong','S???n ph???m n??y ???? t???n t???i trong wishlist c???a b???n');
            }
            else{
                $wish = new Wishlist;
                $wish->product_id = $req->product_id;
                $wish->user_id = $req->user_id;
                $wish->save();
                return redirect()->back()->with('thanhcong','Th??m v??o wishlist th??nh c??ng');
            }
    }
    public function getDelItemWishlist($id){
        $user_id = null;
        if (Auth::user()->id){
            $user_id = Auth::user()->id;
        }
        // dd($user_id);
        $wishlist =Wishlist::where('product_id',$id)->where('user_id',$user_id)->first();

    if ($wishlist != null) {
        $wishlist->delete();
        return redirect()->back()->with('thanhcong','S???n ph???m y??u th??ch ???? ???????c x??a');
    }

    return redirect()->back()->with('thanhcong','Wrong ID');

    }
    public function getAddtoCart(Request $req, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }

        return redirect()->back();
    }
    public function getCheckout(){
        if(Session::get('cart')){
        $cart = Session::get('cart');

       $product_cart = $cart->items;
       $totalPrice = $cart->totalPrice;
       $totalQty = $cart->totalQty;
       return view('page.thanhtoan',compact('cart','product_cart','totalPrice','totalQty'));
    }
    else

        return view('page.thanhtoan');

    }
    public function postCheckout(Request $req){
        $cart = Session::get('cart');
        //dd($cart);
        $this->validate($req,
        [
            'name'=>'required',
            'gender'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'phone_number'=>'required'
        ],
        [
            'name.required'=>'B???n ch??a nh???p t??n c???a b???n v??o',
            'email.required'=>'Vui l??ng nh???p email c???a b???n v??o',
            'email.email'=>'Kh??ng ????ng ?????nh d???ng email',
            'phone_number.required'=>'B???n ch??a nh???p s??? ??i???n tho???i c???a b???n v??o',
        ]
        );

        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone_number;
        $customer->note = $req->note;
        $customer->save();

        //L??u id c???a customer
        $id_cus = $customer->id;

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->note = $req->note;
        $bill->save();

        //L???y id c???a bill
        $id_bill = $bill->id;

        foreach($cart->items as $key =>$value){
        $bill_detail = new BillDetail;
        $bill_detail->id_bill = $bill->id;
        $bill_detail->id_product = $key;

        $bill_detail->quantity = $value['qty'];
        $bill_detail->unit_price = ($value['price']/$value['qty']);
        $bill_detail->save();
        }

        $message = [
            'type'=>'G???i th??ng tin ????n h??ng c???a b???n',
            'thanks' => 'Ch??o b???n '.$customer->name.',',
            'content' => 'Ch??ng t??i t??? Khua Cake Store g???i cho b???n ????n h??ng m?? b???n ???? ?????t, ch??ng t??i ???? ghi nh???n th??ng tin c???a b???n l?? ?????a ch??? '.$customer->address.' v?? note:'.$customer->note.''
            ];

        $file = public_path('orders/order.pdf');

        SendEmail::dispatch($message, $customer->email ,$file)->delay(now()->addMinute(1));
        $cart = Session::get('cart');

        $totalPrice = $cart->totalPrice;
        $total = $totalPrice / 23.01365 / 1000;

        if($bill->payment==='paypal'){
            return view('paywithpaypal', compact('total'));
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','?????t h??ng th??nh c??ng');

    }
    public function sendingEmail($name, $email, $address, $note){
        $message = [
                'type'=>'G???i th??ng tin ????n h??ng c???a b???n',
                'thanks' => 'Ch??o b???n '.$name.',',
                'content' => 'Ch??ng t??i t??? Khua Cake Store g???i cho b???n ????n h??ng m?? b???n ???? ?????t, ch??ng t??i ???? ghi nh???n th??ng tin c???a b???n l?? ?????a ch??? '.$address.' v?? note:'.$note.''
                ];

        $file = public_path('orders/order.pdf');

        SendEmail::dispatch($message, $email ,$file)->delay(now()->addMinute(1));
        return redirect()->back()->with('thongbao','?????t h??ng th??nh c??ng');
    }
    public function pdf(){
        $cart = Session::get('cart');
        $data['title'] = 'Hoa don';
        $data['product_cart'] = $cart->items;
        $data['totalPrice'] = $cart->totalPrice;
        $data['totalQty'] = $cart->totalQty;
        $data['cart'] = $cart;

        $pdf = PDF::loadView('page.pdf', $data);

        return $pdf->download('order.pdf');
       }
    public function getLogin(){
        return view('page.login');
    }
    public function postLogin(Request $request){
        $this->validate($request,
        [
            'email'=>'required|email|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui long nhap email',
            'email.email'=>'Khong dung dinh dang emal',
            'password.required'=>'Vui long nhap mat khau',
            'password.min'=>'Mat khau it nhat 6 ki tu',
            'password.max'=>'Mat khau khong qua 20 ki tu'
        ]
        );
        $credentials = array('email'=>$request->email,'password'=>$request->password);
        if(Auth::attempt($credentials)){
            return redirect()->back()->with(['flag'=>'success','message'=>'????ng nh???p th??nh c??ng']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'????ng nh???p kh??ng th??nh c??ng']);
        }
    }
    public function getSignup(){
        return view('page.signup');
    }
    public function postSignup(Request $request){
        $this->validate($request,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password',
                'address'=>'required',
                'phone'=>'required',
                'images'=>'required'
            ],
            [
                'email.required'=>'Vui long nhap email',
                'email.email'=>'Khong dung dinh dang emal',
                'email.unique'=>'Email da co nguoi su dung',
                'password.required'=>'Vui long nhap mat khau',
                're_password.same'=>'Mat khau khong giong nhau',
                'password.min'=>'Mat khau it nhat 6 ki tu',
                'address.required'=>'B???n c???n nh???p ?????a ch???',
                'phone.required'=>'Vui l??ng nh???p s??? ??i???n tho???i',
                'images.required'=>'Nh???p h??nh ???nh c???a b???n'
            ]
            );
            if($request->hasFile('images')){
                $file = $request->file('images');
                $fileName = $file->getClientOriginalName('images');
                $file->move('profile',$fileName);
                dd($fileName);
            }
            $file_name = null;
             if($request->file('images')!=null){
                $file_name = $request->file('images')->getClientOriginalName();
           }
        //    dd($file_name);
            $user = new User();
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->address = $request->address;
            $user->images = $request->images;
            $user->phone = $request->phone;
            $user->save();
            return redirect()->back()->with('thanhcong','T???o t??i kho???n th??nh c??ng');
    }
    public function getSearch(Request $req){
        $product = Product::where('name','like','%'.$req->key.'%')
                        ->orwhere('unit_price',$req->key)
                        ->get();
                    // dd($product);
                        return view('page.search',compact('product'));
    }
    public function postLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    public function postComment(Request $request){
        $this->validate($request,
        [
            'content'=>'required',
        ],
        [
            'content.required'=>'Vui l??ng nh???p n???i dung comment',
        ]
        );
        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->product_id = $request->product_id;
        $comment->content = $request->content;
        $comment->save();
        return redirect()->back()->with('thanhcong','Comment th??nh c??ng');
    }

}
