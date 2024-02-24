@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Создание категории</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => 'categories.store']) !!}
                <div class="form-group">
                    @include('admin.errors')
                    <label for="category-name">Название категории (укр):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ua" placeholder="Введите украинское название категории">

                    <label for="category-name">Название категории (рус):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ru" placeholder="Введите русское название категории">
                </div>
            <div class="button-group">
                <div>
                    <button class="btn btn-default"><a href="{{ route('categories.index') }}">Назад</a></button>

                </div>
                <div class="text-right">
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
