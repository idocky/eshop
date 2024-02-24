@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Редактирование категории</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'put']) !!}
                <div class="form-group">
                    <label for="category-name">Редактирование категории:</label>
                    <input type="text" class="form-control" id="category-name" name="title_ua" value="{{ $category->title_ua }}">

                    <label for="category-name">Название категории (рус):</label>
                    <input type="text" class="form-control" id="category-name" name="title_ru" value="{{ $category->title_ru }}">
                </div>
                <div class="button-group">
                    <div>
                        <a class="btn btn-default" href="{{ route('categories.index') }}">Назад</a>

                    </div>
                    <div class="text-right">
                        <button class="btn btn-success pull-right">Изменить</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
