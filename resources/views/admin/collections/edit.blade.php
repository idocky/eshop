@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Редактирование коллекции</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => ['collections.update', $collections->id], 'method' => 'put']) !!}
                <div class="form-group">
                    <label for="category-name">Название коллекции (укр):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ua" value="{{ $collections->title_ua }}">

                    <label for="category-name">Название коллекции (ру):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ru" value="{{ $collections->title_ru }}">
                </div>
                <div class="button-group">
                    <div>
                        <a class="btn btn-default" href="{{ route('collections.index') }}">Назад</a>

                    </div>
                    <div class="text-right">
                        <button class="btn btn-success pull-right">Изменить</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
