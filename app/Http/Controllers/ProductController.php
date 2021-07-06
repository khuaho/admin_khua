<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all()->toArray();
        //$car=...
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'id_type'=>'required',
            'description'=>'required',
            'unit_price'=>'required',
            'promotion_price'=>'required',
            'image'=>'required',
            'unit'=>'required',
            'new'=>'required'
        ]);


             $file_name = null;
            if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName('image');
            $file->move('source/image/product',$fileName);
        }

         if($request->file('image')!=null){

            $file_name = $request->file('image')->getClientOriginalName();

       }
        $product = new Product([
            'name'=>$request->get('name'),
            'id_type'=>$request->get('id_type'),
            'description'=>$request->get('description'),
            'unit_price'=>$request->get('unit_price'),
            'promotion_price'=>$request->get('promotion_price'),
            'image'=>$file_name,
            'unit'=>$request->get('unit'),
            'new'=>$request->get('new')
        ]);
        $product->save();
        return redirect()->route('product.index')->with('success','Data Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('product.edit', compact('products','id'));
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
        $this->validate($request,[
            'name'=>'required',
            'id_type'=>'required',
            'description'=>'required',
            'unit_price'=>'required',
            'promotion_price'=>'required',
            'image'=>'required',
            'unit'=>'required',
            'new'=>'required'
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName('image');
            $file->move('source/image/product',$fileName);
        }
        $file_name = null;
         if($request->file('image')!=null){
            $file_name = $request->file('image')->getClientOriginalName();
       }

        $products = Product::find($id);
        $products->name = $request->get('name');
        $products->id_type = $request->get('id_type');
        $products->description = $request->get('description');
        $products->unit_price = $request->get('unit_price');
        $products->promotion_price = $request->get('promotion_price');
        $products->image = $file_name;
        $products->unit = $request->get('unit');
        $products->new = $request->get('new');

        $products->save();
        return redirect()->route('product.index')->with('success','Data Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success','Data Deleted');
    }
}
