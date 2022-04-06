<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

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
    }
}
