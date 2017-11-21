<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notification;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('Seller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('products.index')->with('products',Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')->with( 'categories',Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'required|max:180',
           'description'=>'required|max:180',
           'price' =>'required|max:7',
           'image'=>'required|image|max:2000',
            'category'=>'required|max:50',
            'code'=>'required|max:50'
        ]);
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        //file name
        $filename = pathinfo($filenameWithExt,PATHINFO_BASENAME);
        //get the ext
        $extension = $request->file('image')->getClientOriginalExtension();
        //file name to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        $path = $request->file('image')->storeAs('/public/cover_images',$fileNameToStore);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = (double)$request->price;
        $product->image = "/storage/cover_images/".$fileNameToStore;
        $product->category_id = $request->category;
        $product->code = $request->code;
        $product->Seller_id = Auth::id();

        $product->save();
        return redirect()->back()->with('success','Product created.');

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
        return view('products.edit')->with([
            'product'=>Product::find($id),
            'categories'=>Category::all()
        ]);
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
            'name'=>'required|max:180',
            'description'=>'required|max:180',
            'price' =>'required|max:18',
            'image'=>'nullable|image|max:2000',
            'category'=>'required|max:50',
            'code'=>'required|max:50'
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category;
        $product->code = $request->code;
        if($request->hasFile('image')){
            Storage::delete('public/cover_images/'.$product->image);
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            //file name
            $filename = pathinfo($filenameWithExt,PATHINFO_BASENAME);
            //get the ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //file name to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('cove_image')->storeAs('public/cover_images',$fileNameToStore);
            $product->image = "/storage/cover_images/".$fileNameToStore;
        }

        $product->save();
        return redirect()->back()->with('success','Product '.$product->name.' has been updated');
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
        Storage::delete('public/cover_images/'.$product->image);
        return redirect()->back()->with('success','product deleted !');
    }
}
