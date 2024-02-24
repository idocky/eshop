@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <!-- Заголовок страницы -->
            <section class="content-header">
                <h1>Перечень тэгов</h1>
            </section>
            <!-- Основной контент -->
            <section class="content">
                <div class="form-group">
                    <a href="{{ url('admin/tags/create') }}" class="btn btn-success">Добавить тэг</a>
                </div>
                <!-- Таблица со списком категорий -->
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название тэга</th>
                        <th>Цвет</th>
                        <th class="text-right">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{$tag->title_ru}}</td>
                        @if(isset($tag->color))
                        <td>
                            <div style="width: 50px; height: 50px; background-color: {{ $tag->color }};"></div>
                        </td>
                        @else
                            <td>Без цвета</td>
                        @endif
                        <td class="text-right">
                            <button><a href="{{ route('tags.edit', $tag->id) }}"><i class="fa fa-pencil" style="color:black;"></i></a></button>
                            {!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'delete']) !!}
                            <button onclick="return confirm('Are you sure?')" type="submit" class="delete">
                                <a><i class="fa fa-trash"></i></a>
                            </button>
                            {!! Form::close() !!}
                        </td>



                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
@endsection
