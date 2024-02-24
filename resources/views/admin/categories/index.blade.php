@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
        <!-- Заголовок страницы -->
        <section class="content-header">
            <h1>Перечень категорий</h1>
        </section>
        <!-- Основной контент -->
        <section class="content">
            <div class="form-group">
                <a href="{{ url('admin/categories/create') }}" class="btn btn-success">Добавить категорию</a>
            </div>
            <!-- Таблица со списком категорий -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название категории</th>
                    <th class="text-right">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{$category->title_ru}}</td>
                    <td class="text-right">
                        <button><a href="{{ route('categories.edit', $category->id) }}"><i class="fa fa-pencil" style="color:black;"></i></a></button>
                        {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
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
