@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Редактирование категории</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => ['banners.update', $banners->id], 'method' => 'put']) !!}
                <div class="form-group">
                    <label for="category-name">Редактирование баннера:</label>
                    <input type="text" class="form-control" readonly id="category-name" name="type" value="{{ $banners->type }} ">
                    <label for="category-name">Изображение баннера:</label>
                    <img src="/public/img/{{ $banners->photo }}" width="500px"> <br/><br/>
                    <input type="text" class="form-control" id="category-name" name="photo" value="{{ $banners->photo }}">
                    <small>Путь идет в папку public/img/</small>
                </div>
                <div class="button-group">
                    <div>
                        <a class="btn btn-default" href="{{ route('banners.index') }}">Назад</a>

                    </div>
                    <div class="text-right">
                        <button class="btn btn-success pull-right">Изменить</button>
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

    </div>
@endsection
