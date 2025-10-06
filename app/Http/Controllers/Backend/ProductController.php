<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function productCreate()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $subCategories = SubCategory::orderBy('name', 'asc')->get();

        return view('backend.product.create', compact('categories', 'subCategories'));
    }

    public function productStore (Request $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->cat_id = $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->sku_code = $request->sku_code;
        $product->qty = $request->qty;
        $product->buying_price = $request->buying_price;
        $product->regular_price = $request->regular_price;
        $product->discount_price = $request->discount_price;
        $product->product_type = $request->product_type;
        $product->description = $request->description;
        $product->product_policy = $request->product_policy;

        if(isset($request->image)){
            $imageName = rand().'-product-'.'.'.$request->image->extension(); //12345-product-.webp
            $request->image->move('backend/images/product/', $imageName);

            $product->image = $imageName;

        }

        $product->save();

        // Add Color..
        if(isset($request->color_name) && $request->color_name[0] != null){
            
            foreach($request->color_name as $singleColor){ //green
                $color = new Color();
                $color->color_name = $singleColor;
                $color->slug = Str::slug($singleColor);
                $color->product_id = $product->id;
                $color->save();
            }
        }

        // Add Size..
        if(isset($request->size_name) && $request->size_name[0] != null){
            
            foreach($request->size_name as $singleSize){ //M
                $size = new Size();
                $size->size_name = $singleSize;
                $size->slug = Str::slug($singleSize);
                $size->product_id = $product->id;
                $size->save();
            }
        }

        //GalleryImage..
        if(isset($request->gallery_image)){
            foreach($request->gallery_image as $singleImage){
                $galleryImage = new GalleryImage();

                $galleryImage->product_id = $product->id;

                $imageName = rand().'-galleryImage'.'.'.$singleImage->extension(); //948094-galleryImage.jpg
                $singleImage->move('backend/images/galleryimage/',$imageName);

                $galleryImage->image = $imageName;
                $galleryImage->save();
            }
        }

        return redirect('/admin/product/list');
    }
    public function ProductList()
    {
        $products = Product::with('Category', 'SubCategory')->get();
        return view('backend.product.list', compact('products'));
    }
    public function ProductDelete($id)
    {
        $product = Product::find($id);

         if($product->image && file_exists('backend/images/product/'.$product->image)){
            unlink('backend/images/product/'.$product->image);
        }

        // Color Delete...
        $colors = Color::where('product_id',  $product->id)->get(); 
        foreach($colors as $color){
            $color->delete();
        }

        //Size Delete...
        $sizes = Size::where('product_id', $product->id)->get();
        foreach($sizes as $size){
            $size->delete();
        }

        //GalleryImage Delete...
        $galleryimages = GalleryImage::where('product_id',$product->id)->get();
        foreach($galleryimages as $singleImage){

             if($singleImage->image && file_exists('backend/images/galleryimage/'.$singleImage->image)){
                unlink('backend/images/galleryimage/'.$singleImage->image);
        }
            $singleImage->delete();
        }

        $product->delete();
        return redirect()->back();
    }

    public function ProductEdit($id)
    {
        $product = Product::where('id', $id)->with('color','size','GalleryImage')->first();
        $categories = Category::all();
        $subCategories = SubCategory::all();
       return view('backend.product.edit', compact('product', 'categories', 'subCategories'));
    }
  public function ProductUpdate( Request $request, $id)
{
    $product = Product::find($id);

    $product->name = $request->name;
    $product->slug = Str::slug($request->name); // এখানে name এর পরে slug দেওয়া উচিত
    $product->sku_code = $request->sku_code;
    $product->qty = $request->qty;
    $product->buying_price = $request->buying_price;
    $product->regular_price = $request->regular_price;
    $product->discount_price = $request->discount_price;
    $product->product_type = $request->product_type;
    $product->description = $request->description;
    $product->product_policy = $request->product_policy;

    if(isset($request->image)){
        if($product->image && file_exists('backend/images/product/'.$product->image)){
            unlink('backend/images/product/'.$product->image);
        }

        $imageName = rand().'-productup-'.'.'.$request->image->extension(); 
        $request->image->move('backend/images/product/', $imageName);
        $product->image = $imageName;
    }

    $product->save();

    // Update Color
    if(isset($request->color_name) && $request->color_name[0] != null){
        Color::where('product_id', $product->id)->delete();

        foreach($request->color_name as $singleColor){
            $color = new Color();
            $color->color_name = $singleColor;
            $color->slug = Str::slug($singleColor);
            $color->product_id = $product->id;
            $color->save();
        }
    }

    // Update Size
    if(isset($request->size_name) && $request->size_name[0] != null){
        Size::where('product_id', $product->id)->delete();

        foreach($request->size_name as $singleSize){
            $size = new Size();
            $size->size_name = $singleSize;
            $size->slug = Str::slug($singleSize);
            $size->product_id = $product->id;
            $size->save();
        }
    }
    // Update galleryImage
      if(isset($request->gallery_image)){

            $galleryImages = GalleryImage::where('product_id', $product->id)->get();

            foreach($galleryImages as $singleImage){

                if($singleImage->image && file_exists('backend/images/galleryimage/'.$singleImage->image)){
                    unlink('backend/images/galleryimage/'.$singleImage->image);
                }

                $singleImage->delete();
            }

            foreach($request->gallery_image as $singleImage){
                $galleryImage = new GalleryImage();

                $galleryImage->product_id = $product->id;

                $imageName = rand().'-galleryImage'.'.'.$singleImage->extension(); //948094-galleryImage.jpg
                $singleImage->move('backend/images/galleryimage/',$imageName);

                $galleryImage->image = $imageName;
                $galleryImage->save();
            }
        }

    return redirect('/admin/product/list');
    }
    // Color Delete
    public function colorDelete($id)
    {
        $color = Color::find($id);
        $color->delete();

        return redirect()->back();
    }

    // Size Delete
    public function sizeDelete($id)
    {
        $size = Size::find($id);
        $size->delete();

        return redirect()->back();
    }

    // Gallery Image Delete
   public function galleryImageDelete($id)
   {
    $galleryImage = GalleryImage::find($id);
    $galleryImage->delete();

    return redirect()->back();
   }

   //Gallery Image Edit
   public function galleryImageEdit($id)
   {
    $galleryImage = GalleryImage::with('Product')->where('id', $id)->first();
    return view('backend.product.edit-galleryimage', compact('galleryImage'));
   }

//    Gallery Image Update
   public function galleryImageUpdate(Request $request, $id)
   {
    $galleryImage = GalleryImage::find($id);
    if($request->image){

         if($galleryImage->image && file_exists('backend/images/galleryimage/'.$galleryImage->image)){
            unlink('backend/images/galleryimage/'.$galleryImage->image);
        }
        
         $imageName = rand().'-galleryImage'.'.'. $request->image->extension(); //948094-galleryImage.jpg
            $request->image->move('backend/images/galleryimage/',$imageName);
        }

        $galleryImage->image = $imageName;

        $galleryImage->save();
        return redirect('/admin/product/edit/'.$galleryImage->product_id);
   }
}