<?php

namespace App\Http\Controllers;

use App\Models\Recording;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;
use App\Http\Requests\RecordingRequest;
use Carbon\Carbon;

class RecordingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $recordings = $user->recordings()->latest()->get();
        $sums = [];

        $sums['Доход'] = $recordings->where('type' , 'Доход')->sum('sum');
        $sums['Расход'] = $recordings->where('type' , 'Расход')->sum('sum');

        return view('pages.index' , [
            'recordings' => $recordings,
            'sums' => $sums,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $income = $user->categories()->where('type' , 'Доход')->get();
        $expence = $user->categories()->where('type' , 'Расход')->get();

        $categories = ['income' => $income, 'expence' => $expence];

        // fixed

        return view('pages.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecordingRequest $request)
    {
        $recording = new Recording();

        $recording->sum = $request->input('sum') * 100;
        $recording->message = $request->input('message');
        $recording->category_id = $request->input('category');
        $recording->type = Category::find($request->input('category'))->type;
        $recording->user_id = $request->user()->id;
        if($request->input('date') != null)
        {
            $recording->date = $request->input('date');
        } else {
            $recording->date = Carbon::now(+5);
        }

        $recording->save();

        return redirect()->route('recording.index')->withSuccess('Запись успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function show(Recording $recording)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function edit(Recording $recording)
    {
        $user = auth()->user();
        $income = $user->categories()->where('type' , 'Доход')->select('title')->get();
        $expence = $user->categories()->where('type' , 'Расход')->select('title')->get();

        $categories = ['income' => $income, 'expence' => $expence];
        return view('pages.edit' , [
            'recording' => $recording,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function update(RecordingRequest $request, Recording $recording)
    {
        $recording->sum = $request->input('sum');
        $recording->message = $request->input('message');
        $recording->category_id = $request->input('category');
        $recording->type = Category::find($request->input('category'))->type;

        $recording->save();

        return redirect()->route('recording.index')->withSuccess('Запись успешна обновлена!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recording  $recording
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recording $recording)
    {
        $recording->delete();

        return redirect()->route('recording.index')->withError('Запись удалена!');
    }
}
