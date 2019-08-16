<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminCategoryController extends Controller
{
    //display create category form
    public function createCategoryForm(){
        return view("admin.createCategoryForm");
    }

    //store new category to database
    public function sendCreateCategoryForm(Request $request){
    	$parent_id = 0;
        if($request->input('category_id') !== 'Корневая') {
        	$parent_id = $request->input('category_id');
        }
        
        $name =  $request->input('name');
        $slug =  $request->input('slug');
        $description =  $request->input('description');

        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();
        $ext =  $request->file("image")->getClientOriginalExtension();
        $stringImageReFormat = str_replace(" ","",$request->input('name'));

        $imageName = $stringImageReFormat.".".$ext; //blackdress.jpg
        $imageEncoded = File::get($request->image);
        Storage::disk('local')->put('public/category_images/'.$imageName, $imageEncoded);

        $newCategoryArray = array("parent_id"=>$parent_id,"name"=>$name, "slug"=>$slug,"description"=> $description,"image"=> $imageName);

        $created = DB::table("categories")->insert($newCategoryArray);

        if($created){
            return redirect()->route("categoriesPanel");
        }else{
           return "Категория не была создана";
        }
    }

    //categories control panel (display all categories)
    
    public function categoriesPanel(){
    
      $categoriesAdmin = Category::with('parent')->paginate(10);
      return view('admin.categoriesPanel', ["categoriesAdmin" => $categoriesAdmin]);
    } 

    //delete category
    public function deleteCategory($id){

      $category = Category::find($id);

      $exists =  Storage::disk("local")->exists("public/category_images/".$category->image);

      //if old image exists
      if($exists){
          //delete it
          Storage::delete('public/category_images/'.$category->image);
      }
      Category::destroy($id);
      return redirect()->back()->with('categoryDeletionStatus', 'Категория была успешно удалена');

    }

    //display edit category image form
    public function editCategoryImageForm($id){
        $category = Category::find($id);
        return view('admin.editСategoryImageForm',['category'=>$category]);
    }

    //update category Image
    public function updateCategoryImage(Request $request,$id){


        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();


        if($request->hasFile("image")){

          $category = Category::find($id);
          $exists = Storage::disk('local')->exists("public/category_images/".$category->image);

          //delete old image
          if($exists){
             Storage::delete('public/category_images/'.$category->image);

          }

          //upload new image
            $ext = $request->file('image')->getClientOriginalExtension(); //jpg

            $request->image->storeAs("public/category_images/",$category->image);

            $arrayToUpdate = array('image'=>$category->image);
            DB::table('categories')->where('id',$id)->update($arrayToUpdate);


            return redirect()->route("categoriesPanel");

        }else{

           $error = "Не было выбрано ни одного файла";
           return $error;

        }
    }

    //display edit category form
    public function editCategoryForm($id){
       
          $category =  Category::where("id",$id)->firstOrFail();
        
          return view('admin.editCategoryForm',['category'=>$category]);

    }

    //update category fields
    public function updateCategory(Request $request,$id){

       $name =  $request->input('name');
       $slug = $request->input('slug');
       $description = $request->input('description');

       $updateArray = array("name"=>$name, "slug"=>$slug, "description"=>$description);

        DB::table('categories')->where('id',$id)->update($updateArray);

        return redirect()->route("categoriesPanel");
    }                             
}
