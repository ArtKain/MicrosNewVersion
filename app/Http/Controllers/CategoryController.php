<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create() 
    {
        $types = Type::all();
        return view('pages.category.create' , compact('types'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required|array',
            'title.*' => 'required|string', 
        ]);

        $user = auth()->user();
        if($user->category()->where('title' , $request->title)->exists())
            return redirect()->back()->withErrors(['title' => 'Category already exists!']);


        foreach($request->title as $categories)
        {
            $category = new Category();
            $category->title = $categories;
            $category->type_id = $request->type;
            $category->user_id = $request->user()->id;
            $category->save(); 
        }

        return redirect()->route('category.create')->withSuccess('категории успешно добавлены');
    }
}
