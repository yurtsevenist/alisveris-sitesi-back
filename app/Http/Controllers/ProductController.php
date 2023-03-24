<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categori;
use App\Models\Photo;
use App\Models\Size;


class ProductController extends Controller
{

    public function index()
    {
        $urunler=Product::orderBy('name','ASC')->get();
        return view('urunpages.urunler',compact('urunler'));
    }
    public function deleteAllProduct()
    {
        // $urunler=Product::orderBy('name','ASC')->get();
        // foreach($urunler as $urun)
        // {
        //     $urun->delete();
        // }
         Product::truncate();
         Photo::truncate();
        toastr()->info('Ürünler başarılı bir şekilde silindi','Bilgilendirme');
        return redirect()->back();
    }
    public function deleteProduct(Request $request)
    {
        $urun=Product::whereId($request->id)->first();
        $photos=Photo::where('urun_id',$request->id)->get();
        foreach($photos as $p)
        {
            $p->delete();
        }
        $urun->delete();
        toastr()->info('Ürün başarılı bir şekilde silindi','Bilgilendirme');
        return redirect()->back();
    }
    public function urun($id)
    {
        if($id!=0)
        {
            $categori=Categori::get();
            $sizes=Size::get();
            $urun=Product::whereId($id)->with('getPhoto')->first();
        }
        else
        {
            $urun=[];
        }
        return view('urunpages.urun',compact('urun','categori','sizes'));
    }
    public function photoDelete(Request $request)
    {
        $filename =  $request->get('filename');
        Photo::where('urun_id',$request->id)->where('name',$filename)->delete();
        $path=public_path().'/images/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
    public function photoAdd(Request $request)
    {

        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        $url='images/'.$imageName;
        $imageUpload = new Photo;
        $imageUpload->name = $imageName;
        $imageUpload->urun_id=$request->id;
        $imageUpload->url=$url;
        $imageUpload->save();
    }
    public function productUpdate(Request $request)
    {
        if($request->id!=0)
        {
            //güncelle
            toastr()->info('Ürün başarılı bir şekilde güncellendi','Bilgilendirme');
        }
        else
        {
            //ekle
            toastr()->info('Ürün başarılı bir şekilde eklendi','Bilgilendirme');
        }

        return redirect()->back();
    }
}
