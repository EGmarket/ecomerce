<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Categorey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
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
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_img->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'images/brand/';
        $last_img = $up_location.$img_name;
        $brand_img->move($up_location,$img_name);

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
}
