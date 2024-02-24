@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
        <!-- Заголовок страницы -->
        <section class="content-header">
            <h1>Перечень товаров слайдера</h1>
        </section>
        <!-- Основной контент -->
        <section class="content">
            <div class="form-group">
                <a href="{{ url('admin/slider/create') }}" class="btn btn-success">Добавить товар</a>
            </div>

            <!-- Таблица со списком категорий -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Фото</th>
                    <th>Название</th>
                    <th class="text-right">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($slider_items as $slider_item)
                <tr>
                    <td>{{ $slider_item->id }}</td>
                    <td><img src="{{ env('STORAGE_PATH') . $slider_item->item->photo }}" width="150px"></td>
                    <td>{{ $slider_item->item->title_ru }}</td>
                    <td class="text-right">
                        {!! Form::open(['route' => ['slider.destroy', $slider_item->id], 'method' => 'delete']) !!}
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
