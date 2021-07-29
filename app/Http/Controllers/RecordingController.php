<?php

namespace App\Http\Controllers;

use App\Models\Recording;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Category;
use App\Http\Requests\RecordingRequest;

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
        $recordings = $user->recording()->orderBy('created_at' , 'desc')->get();
        $type = Type::all();
        $sums = [];

        foreach($type as $types) {
            $sum = $types->recording()->where('user_id' , auth()->id())->sum('sum');
            $sums[$types->title] = $sum;
        }

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
        $types = Type::all();
        return view('pages.create' , compact('types'));
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

        $recording->sum = $request->sum;
        $recording->message = $request->message;
        $recording->category_id = $request->category;
        $recording->type_id = Category::find($request->category)->type_id;
        $recording->user_id = $request->user()->id;
        if(isset($request->created_at))
        {
            $recording->created_at = $request->created_at;
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
        $types = Type::all();
        return view('pages.edit' , [
            'recording' => $recording,
            'types' => $types,
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
        $recording->sum = $request->sum;
        $recording->message = $request->message;
        $recording->category_id = $request->category;
        $recording->type_id = Category::find($request->category)->type_id;

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
