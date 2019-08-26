<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminBrandController extends Controller
{
    //display create brand form
    public function createBrandForm(){
        return view("admin.createBrandForm");
    }

    //store new brand to database
    public function sendCreateBrandForm(Request $request){
        $name =  $request->input('name');
        $slug =  $request->input('slug');
        $description =  $request->input('description');

        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();
        $ext =  $request->file("image")->getClientOriginalExtension();
        $stringImageReFormat = str_replace(" ","",$request->input('name'));

        $imageName = $stringImageReFormat.".".$ext; //blackdress.jpg
        $imageEncoded = File::get($request->image);
        Storage::disk('local')->put('public/brand_images/'.$imageName, $imageEncoded);
        $newBrandArray = array("name"=>$name, "slug"=>$slug,"description"=> $description,"image"=> $imageName);

        $created = DB::table("brands")->insert($newBrandArray);

        if($created){
            return redirect()->route("brandsPanel");
        }else{
           return "Бренд не был создан";
        }
    }

    //brands control panel (display all brands)
    
    public function brandsPanel(){
    
      $brandsAdmin = Brand::paginate(10);
      return view('admin.brandsPanel', ["brandsAdmin" => $brandsAdmin]);
    }

    public function deleteBrand(Request $request, $id){

      $deleted =  DB::table('brands')->where("id",$id)->delete();    
      if($deleted){ 
         return redirect()->back()->with('brandDeletionStatus', 'Бренд был успешно удален');   
      }else{

        return redirect()->back()->with('brandDeletionStatus', 'Бренд не удалось удалить');   
      }

    }

    //display edit brand form
    public function editBrandForm($id){
       
          $brand =  Brand::where("id",$id)->firstOrFail();
        
          return view('admin.editBrandForm',['brand'=>$brand]);

    }

    //update brand fields
    public function updateBrand(Request $request,$id){

       $name =  $request->input('name');
       $slug = $request->input('slug');
       $description = $request->input('description');

       $updateArray = array("name"=>$name, "slug"=>$slug, "description"=>$description);

        DB::table('brands')->where('id',$id)->update($updateArray);

        return redirect()->route("brandsPanel");
    }

    //display edit brand image form
    public function editBrandImageForm($id){
        $brand = Brand::find($id);
        return view('admin.editBrandImageForm',['brand'=>$brand]);
    }

    //update product Image
    public function updateBrandImage(Request $request,$id){


        Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();


        if($request->hasFile("image")){

          $brand = Brand::find($id);
          $exists = Storage::disk('local')->exists("public/brand_images/".$brand->image);

          //delete old image
          if($exists){
             Storage::delete('public/brand_images/'.$brand->image);

          }

          //upload new image
            $ext = $request->file('image')->getClientOriginalExtension(); //jpg

            $request->image->storeAs("public/brand_images/",$brand->image);

            $arrayToUpdate = array('image'=>$brand->image);
            DB::table('brands')->where('id',$id)->update($arrayToUpdate);


            return redirect()->route("brandsPanel");

        }else{

           $error = "Не было выбрано ни одного файла";
           return $error;

        }
    }                   
}
