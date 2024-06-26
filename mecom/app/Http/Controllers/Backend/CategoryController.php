<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function AllCategory(){
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function AddCategory(){
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request){

        if($request->file('category_image')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('category_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('category_image'));
            $img = $img->resize(120,120);
            $img->save('upload/category/'.$name_gen);
            $save_url = 'upload/category/'.$name_gen;

            Category::insert([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);
        }

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.category')->with($notification);
    }


    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    
    }
    
    public function UpdateCategory(Request $request){
        $category_id = $request->id;
        $old_img = $request->old_image;
    
        if($request->file('category_image')){
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$request->file('category_image')->getClientOriginalExtension();
            $img = $manager->read($request->file('category_image'));
            $img = $img->resize(120,120);
            $img->save('upload/category/'.$name_gen);
            $save_url = 'upload/category/'.$name_gen;
    
            if(file_exists($old_img)){
                unlink($old_img);
            }
    
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);
    
            $notification = array(
                'message' => 'Category Updated with image Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.category')->with($notification);
        }else{
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);
    
            $notification = array(
                'message' => 'Category Updated without image Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.category')->with($notification);
        }
    }
    
    public function DeleteCategory($id){
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink($img);
    
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}


   
    

