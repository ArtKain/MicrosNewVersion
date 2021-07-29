@extends('layouts.main-layouts')

@section('title' , 'Список Записей')

@section('content')
        @if(count($recordings) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">Тип</th>
                <th scope="col">Категория</th>
                <th scope="col">Сумма</th>
                </tr>
            </thead>
            <tbody>
            @foreach($recordings as $recording)
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
            </tbody>
        </table>

        @if(count($sums) > 0)
            @if(!isset($sums['Доход']))
                <div class="mb-3">
                    <p class="text-success">Доход : 0</p>
                    <p class="text-danger">Расход : -{{number_format($sums['Расход'], 2, '.', ' ')}}</p>
                </div>
                <p> Итог : {{number_format($sums['Расход'], 2, '.', ' ')}}</p>
                    @elseif(!isset($sums['Расход']))
                    <div class="mb-3">
                        <p class="text-danger">Расход : 0</p>
                        <p class="text-success">Доход : +{{number_format($sums['Доход'], 2, '.', ' ')}}</p>
                    </div>
                        <p> Итог : {{number_format($sums['Доход'], 2, '.', ' ')}}</p>
                @else
                <div class="mb-3">
                    <p class="text-success">Доход : +{{number_format($sums['Доход'], 2, '.', ' ')}}</p>
                    <p class="text-danger">Расход : -{{number_format($sums['Расход'], 2, '.', ' ')}}</p>
                </div>
                    @php 
                        $outcome = $sums['Доход'] - $sums['Расход'];
                    @endphp 
                    <p>Итог : {{number_format($outcome, 2, '.', ' ')}}</p> 
                        
            @endif
        @endif
        @else
        <div class="row">
            <div class="col-lg-4 mx-auto">
                для записей перейдите к <a href="{{route('recording.create')}}">Создание записей</a>
            </div>
        </div>
        @endif
@endsection