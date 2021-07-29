<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Recording;

class SearchController extends Controller
{
    public function search(Request $request) 
    {
        $search = $request->search;
        $categories = Category::where('title' , 'LIKE' , '%'.$search.'%')->get();

        //dd($categories);
        return view('pages.search' , compact('categories'));
    }
}
