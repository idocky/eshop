@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Создание тэга</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => 'tags.store']) !!}
                <div class="form-group">
                    @include('admin.errors')
                    <label for="category-name">Название тэга (укр):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ua" placeholder="Введите укр название категории">

                    <label for="category-name">Название тэга (рус):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ru" placeholder="Введите рус название категории">

                    <label for="category-name">Цвет:</label>
                    <input type="text" class="form-control" id="category-name" name="color" placeholder="Введите HEX цвета">
                    <small>пример #b04a4a</small>

                    <label for="category-name">Цвет текста:</label>
                    <input type="text" class="form-control" id="category-name" name="text_color" placeholder="Введите HEX цвета">
                    <small>белый: #e8e8e8 / черный: #000000</small>
                </div>
                <div class="button-group">
                    <div>
                        <button class="btn btn-default"><a href="{{ route('tags.index') }}">Назад</a></button>

                    </div>
                    <div class="text-right">
                        <button class="btn btn-success pull-right">Добавить</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
