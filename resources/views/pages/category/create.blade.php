@extends('layouts.main-layouts')

@section('title' , 'Добавить категорию')

@section('content')
    <div class="row">
        <div class="col-lg-4 mx-auto">
            <h3>Добавить Категорию:</h3></br>
            <form action="{{route('category.store')}}" method="post">
            @csrf
                <div class="mb-3">
                <select class="form-select" name="type" id="type" aria-label="Default select example">
                    @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                    @endforeach
                </select>
                </div>
                <label class="form-label">Категория : </label>
                <div id="categories">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="title[]" id="title" placeholder="Введите категорию">
                    </div>
                </div>
                <div class="mb-3">
                <button type="button" class="btn btn-primary" id="addCategory">Ещё</button>
                </div>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>

<script>
        document.getElementById('addCategory').addEventListener('click', function () {
        let div = document.createElement('div');
        div.classList.add('mb-3');
        let input = document.createElement('input');
        input.type = 'text';
        input.name = 'title[]';
        input.placeholder = 'Введите категорию';
        input.classList.add('form-control');
        div.appendChild(input);

        document.getElementById('categories').appendChild(div);
        })
</script>

@endsection