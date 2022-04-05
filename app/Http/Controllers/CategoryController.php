<?php

namespace App\Http\Controllers;

use App\Models\Categorey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function AllCat(){
        // Using Eloquent ORM
        $categories = Categorey::latest()->paginate(5);
        //using Query Builder
//        $categories = DB::table('categoreys')->latest()->paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function AddCat (Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categoreys|max:255',
        ],
        [
            'category_name.required' => 'This filed is required'
        ]
        );

        // Eloquent ORM insert Model
        Categorey::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()


        ]);

        return Redirect()->back()->with('success','Category successfully inserted');

//        // Another Method
//        $category = new Categorey;
//        $category->category_name = $request->category_name;
//        $category->user_id = Auth::user()->id;
//        $category-> save();
    }
}
