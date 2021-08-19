@extends('layouts.main-layouts')

@section('title' , 'Добавить запись')

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Обновить запись:</h3></br>
            <form action="{{route('recording.update' , $recording->id)}}" method="post">
            @csrf
                @method('PATCH')
                <div class="mb-3">
                    <div class="form-group">
                        <label for="inputDate">Дата добления:</label>
                        <h2>{{$recording->date}}</h2>
                    </div>
                </div>
                <div class="mb-3">
                <select class="form-select" name="category" id="category" aria-label="Default select example">
                    <optgroup label="Доход">
                        @foreach($categories['income'] as $category)
                            <option value="{{$category->id}}" @if ($category->id == $recording->category_id) selected @endif">{{$category->title}}</option>
                        @endforeach
                    </optgroup>
                    <optgroup label="Расход">
                        @foreach($categories['expence'] as $category)
                            <option value="{{$category->id}}" @if ($category->id == $recording->category_id) selected @endif">{{$category->title}}</option>
                        @endforeach
                    </optgroup>
                </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Сумма : </label>
                    <input type="text" class="form-control" name="sum" id="sum" value="{{$recording->sum}}" placeholder="напишите сумму">
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Комментарий :</label>
                    <textarea class="form-control" name="message" id="message" rows="3">{{$recording->message}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
        </div>
    </div>

@endsection
