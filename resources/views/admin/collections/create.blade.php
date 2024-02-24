@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Создание коллекции</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => 'collections.store']) !!}
                <div class="form-group">
                    @include('admin.errors')
                    <label for="category-name">Название коллекции (укр):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ua" placeholder="Введите укр название коллекции">

                    <label for="category-name">Название коллекции (рус):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ru" placeholder="Введите ру название коллекции">
                </div>
                <div class="button-group">
                    <div>
                        <a class="btn btn-default" href="{{ route('collections.index') }}">Назад</a>

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
