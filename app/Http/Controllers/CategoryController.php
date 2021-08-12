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
        if($user->categories()->where('title' , $request->title)->exists())
            return redirect()->back()->withErrors(['title' => 'Category already exists!']);

        foreach($request->input('title') as $title)
            $user->categories()->insert(
                ['title' => $title,
                'type_id' => $request->input('type')],
            );

        return redirect()->route('category.create')->withSuccess('категории успешно добавлены');
    }
}
