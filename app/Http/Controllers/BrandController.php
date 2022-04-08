<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categorey;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index',compact('brands'));
    }

    public function AddBrand(Request $request){
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_img' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Brand Name is required'
            ]
        );
        $brand_img = $request->file('brand_img');



//        $name_gen = hexdec(uniqid());
//        $img_ext = strtolower($brand_img->getClientOriginalExtension());
//        $img_name = $name_gen.'.'.$img_ext;
//        $up_location = 'images/brand/';
//        $last_img = $up_location.$img_name;
//        $brand_img->move($up_location,$img_name);

        $name_gen = hexdec(uniqid()).'.'.$brand_img->getClientOriginalExtension();
        Image::make($brand_img)->resize(300,200)->save('images/brand/'.$name_gen);

        $last_img = 'images/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_img' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Brand added successfully');
    }

    public function Edit($id){
        $brands= Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request,$id){

        $validated = $request->validate([
            'brand_name' => 'required|max:255',

        ],
            [
                'brand_name.required' => 'Brand Name is required'
            ]
        );
        $old_img = $request->old_img;
        $brand_img = $request->file('brand_img');

        if($brand_img){
            $name_gen = hexdec(uniqid());
            $img_ext = strtolower($brand_img->getClientOriginalExtension());
            $img_name = $name_gen.'.'.$img_ext;
            $up_location = 'images/brand/';
            $last_img = $up_location.$img_name;
            $brand_img->move($up_location,$img_name);

            unlink($old_img);
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_img' => $last_img,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success','Brand updated successfully');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with('success','Brand updated successfully');
        }




//        $update = Brand::find($id)->update([
//            'brand_name' => $request->brand_name,
//            'user_id' => Auth::user()->id
//        ]);
//        return Redirect()->route('all.brand')->with('success','Category successfully updated');
    }

    public function Delete($id){
        $img = Brand::find($id);
        $old_image = $img->brand_img;
        unlink($old_image);
        Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand Deleted successfully');
    }

    // Multi pic uploaded method

    public function MultiPic(){
        $images = Multipic::all();
        return view('admin.multipic.index',compact('images'));
    }

    public function StoreImg(Request $request){
        $image = $request->file('image');

        foreach($image as $multi_img){
            $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
            Image::make($multi_img)->resize(300,200)->save('images/multi/'.$name_gen);

            $last_img = 'images/multi/'.$name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }
        //end foreach Loop



        return Redirect()->back()->with('success','Brand added successfully');
    }

    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }
}
