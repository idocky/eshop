@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
        <!-- Заголовок страницы -->
        <section class="content-header">
            <h1>Перечень товаров</h1>
        </section>
        <!-- Основной контент -->
        <section class="content">
            <div class="form-group">
                <a href="{{ url('admin/items/create') }}" class="btn btn-success">Добавить товар</a>
            </div>

            <!-- Таблица со списком категорий -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Колекция</th>
                    <th>Категория</th>
                    <th>Фото</th>
                    <th class="text-right">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{$item->title_ru}}</td>
                    <td>{{$item->getCollectionTitleRu()}}</td>
                    <td>{{$item->getCategoryTitleRu()}}</td>
                    <td><img src="/public/storage/uploads/{{ $item->photo }}" width="150px"></td>
                    <td class="text-right">
                        <button><a href="{{ route('items.edit', $item->id) }}"><i class="fa fa-pencil" style="color:black;"></i></a></button>
                        {!! Form::open(['route' => ['items.destroy', $item->id], 'method' => 'delete']) !!}
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
