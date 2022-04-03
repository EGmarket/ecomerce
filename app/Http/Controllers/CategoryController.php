<?php

namespace App\Http\Controllers;

use App\Models\Categorey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function AllCat(){
        return view('admin.category.index');
    }

    public function AddCat (Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categoreys|max:255',
        ],
        [
            'category_name.required' => 'This filed is required'
        ]
        );

//        // Eloquent ORM insert Model
//        Categorey::insert([
//            'category_name' => $request->category_name,
//            'user_id' => Auth::user()->id,
//            'created_at' => Carbon::now()
//
//
//        ]);

        // Another Method
        $category = new Categorey;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
    }
}
