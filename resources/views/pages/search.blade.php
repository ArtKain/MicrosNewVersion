@extends('layouts.main-layouts')

@section('title' , 'Список Записей')

@section('content')
        @if(count($categories) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Тип</th>
                <th scope="col">Категория</th>
                <th scope="col">Сумма</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                @foreach($category->recording as $recording)
                    <tr>
                        <td>{{$recording->type['title']}}</td>
                        <td>{{$recording->category['title']}}</td>
                        <td>{{number_format($recording->sum, 2 , '.' , ' ')}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{route('recording.edit', $recording)}}">
                                <i class="fas fa-pencil-alt"></i>
                                    Редактировать 
                            </a>
                            <form action="{{route('recording.destroy' , $recording->id)}}" method="POST" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                        <i class="fas fa-trash"></i>
                                            Удалить
                                    </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
        @else
        <div class="row">
            <div class="col-lg-4 mx-auto">
                Записи не найдены
            </div>
        </div>
        @endif
@endsection