<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Auth;


class VendorProductController extends Controller
{
    public function VendorAllProduct(){
        $id = Auth::user()->id;
        $products = Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all',compact('products'));
    } // End Method 

    public function VendorAddProduct(){
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('vendor.backend.product.vendor_product_add', compact('brands','categories'));
    } 

    public function VendorGetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcat);

    }// End Method 

    public function VendorStoreProduct(Request $request){

        if($request->file('product_thumbnail')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('product_thumbnail')->getClientOriginalExtension();
            $img = $manager->read($request->file('product_thumbnail'));
            $img = $img->resize(120,120);
            $img->save('upload/products/thumbnail/'.$name_gen);
            $save_url = 'upload/products/thumbnail/'.$name_gen;

            $product_id = Product::insertGetId([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
    
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags' => $request->product_tags,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
    
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description, 
    
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals, 
    
                'product_thumbnail' => $save_url,
                'vendor_id' => Auth::user()->id,
                'status' => 1,
                'created_at' => Carbon::now(), 
            ]);

        }

        if($request->file('multi_img')){
            $manager = new ImageManager(new Driver());
            foreach($request->file('multi_img') as $multi_img){
                $make_name = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
                $uploadPath = 'upload/products/multi-image/'.$make_name;
                $img = $manager->read($multi_img);
                $img = $img->resize(800,800);
                $img->save('upload/products/multi-image/'.$make_name);
                $save_url = 'upload/products/multi-image/'.$make_name;
            
                MultiImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(), 
                ]); 
            }
        }
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('vendor.all.product')->with($notification); 
    }

    public function VendorEditProduct($id){
        $multiImgs = MultiImg::where('product_id',$id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('vendor.backend.product.vendor_product_edit',compact('brands','categories','products','subcategory','multiImgs'));
    }// End Method 

    public function VendorUpdateProduct(Request $request){

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

       'brand_id' => $request->brand_id,
       'category_id' => $request->category_id,
       'subcategory_id' => $request->subcategory_id,
       'product_name' => $request->product_name,
       'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

       'product_code' => $request->product_code,
       'product_qty' => $request->product_qty,
       'product_tags' => $request->product_tags,
       'product_size' => $request->product_size,
       'product_color' => $request->product_color,

       'selling_price' => $request->selling_price,
       'discount_price' => $request->discount_price,
       'short_description' => $request->short_description,
       'long_description' => $request->long_description, 

       'hot_deals' => $request->hot_deals,
       'featured' => $request->featured,
       'special_offer' => $request->special_offer,
       'special_deals' => $request->special_deals, 

       'status' => 1,
       'created_at' => Carbon::now(), 

   ]);


    $notification = array(
       'message' => 'Product Updated Without Image Successfully',
       'alert-type' => 'success'
   );

   return redirect()->route('vendor.all.product')->with($notification); 

}// End Method 

    public function VendorUpdateProductThumbnail(Request $request){
        $pro_id = $request->id;
        $oldImage = $request->old_img;
        $manager = new ImageManager(new Driver());
        $name_gen = hexdec(uniqid()).'.'.$request->file('product_thumbnail')->getClientOriginalExtension();
        $img = $manager->read($request->file('product_thumbnail'));
        $img = $img->resize(800,800);
        $img->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([
            'product_thumbnail'=>$save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Image Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }

    public function VendorUpdateProductMultiimage (Request $request){
        $manager = new ImageManager(new Driver());
        if($request->multi_img!=null){
            $multi_img = $request->multi_img;
            foreach($multi_img as $id => $img){
                $imgDel = MultiImg::findOrFail($id);
                unlink($imgDel->photo_name);
    
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                $uploadPath = 'upload/products/multi-image/'.$make_name;
                $image = $manager->read($img);
                $image = $image->resize(800,800);
                $image->save('upload/products/multi-image/'.$make_name);
                $save_url = 'upload/products/multi-image/'.$make_name;
    
                MultiImg::where('id', $id)->update([
                    'photo_name'=> $uploadPath,
                    'updated_at'=> Carbon::now(),
                ]);
    
            }
            $notification = array(
                'message' => 'Product Image Updated Successfully',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Select an image first',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification); 
    }

    public function VendorMultiImageDelete($id){
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function VendorProductInactive($id){

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 


      public function VendorProductActive($id){

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// End Method 

    public function VendorProductDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->back()->with($notification);
    }

}
