<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use App\Slide;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        //$new_product = Product::where('new',1)->get()->toArray();
        $new_product = Product::where('new',1)->paginate(4);
        $count = count($new_product);
        //$top_product = Product::where('new',0)->get()->toArray();
        $top_product = Product::where('promotion_price','<>','0')->paginate(8);
        $count_top = count($top_product);
        $slide = Slide::all()->toArray();
        return view('page.trangchu', compact('new_product','slide','top_product','count','count_top'));
    }
    
    public function getAbout(){
        return view('page.about');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.about');
    }

    /*public function getLoaiSp($type){
        //Lay san pham hien thi theo loai
        $sp_theoloai = Product::where('id_type',$type)->limit(3)->get();
        //Lay san pham  hien thi khac <> loai
        $sp_khac = Product::where('id_type','<>',$type)->limit(3)->get();
        //Lay san pham hien thi theo loai typeproduct cho menu ben trai
        //$loai = ProductType::all();
        //return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai'));
    }*/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $new_product = Product::find($id);
        return view('page.chitiet_sanpham', compact('new_product','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
