@extends('layouts.main-layouts')

@section('title' , 'Добавить запись')

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Добавить запись:</h3></br>
            <form action="{{route('recording.store')}}" method="post">
            @csrf
                <div class="mb-3">
                    <div class="form-group">
                        <label for="inputDate">Введите дату:</label>
                        <input type="date" name="created_at" class="form-control">
                    </div>
                </div>
                <div class="mb-3">
                <select class="form-select" name="category" id="category" aria-label="Default select example">
                    @foreach($types as $type)
                        <optgroup label="{{$type->title}}">
                        @foreach($type->category()->where('user_id' , auth()->id())->get() as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                        @endforeach
                        </optgroup>
                    @endforeach
                </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Сумма : </label>
                    <input type="text" class="form-control" name="sum" id="sum" placeholder="напишите сумму">
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Комментарий :</label>
                    <textarea class="form-control" name="message" id="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>

@endsection