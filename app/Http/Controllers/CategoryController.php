<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('pages.category.create', compact('categories'));
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
        {
            $category = Category::query()->create(['title' => $title, 'type' => $request->input('type')]);
            $user->categories()->attach($category);
        }

        return redirect()->route('category.create')->withSuccess('категории успешно добавлены');
    }

    public function tag(Request $request)
    {
        $request->validate([
            'tag' => 'required|array',
            'tag.*' => 'required|string'
        ]);

        $user = auth()->user();
        if($user->categories()->where('title' , $request->input('tag'))->exists())
            return redirect()->back()->withErrors(['tag' => 'Category already exists!']);

            $user->categories()->attach($request->input('tag'));

        return redirect()->route('category.create')->withSuccess('категории успешно добавлены');
    }

}
