@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Редактирование товара</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => ['items.update', $item->id], 'files' => true, 'enctype' => 'multipart/form-data', 'method' => 'put']) !!}
            <div class="form-group">
                @include('admin.errors')

                <div class="container">
                    <div class="block">
                        <p>Данные на украинском:</p>
                        <label for="category-name">Назва товару:</label>
                        <input type="text" class="form-control" id="category-name" name="title_ua" value="{{ $item->title_ua }}">

                        <label for="category-name">Опис товару:</label>
                        <textarea id="text" class="form-control" rows="10" name="description" >{{ $item->description_ua }}</textarea>

                        <div class="container">
                            <div class="block">
                                <label for="category-name">Цена:</label>
                                <input type="number" class="form-control" id="category-name" name="price" value="{{ $item->price }}">
                            </div>
                            <div class="block">
                                <label for="category-name">Скидка:</label>
                                <input type="number" class="form-control" id="category-name"  name="discount" value="{{ $item->discount }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>
                                Продается:
                            </label>
                            <label>
                                {!! Form::checkbox('is_published', 1, $item->is_published); !!}
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <img src="/public/storage/uploads/{{ $item->photo }}" width="150px">
                            <input type="file" id="exampleInputFile" name="photo">

                        </div>

                        <div class="form-group">
                            <label>Категория</label>
                            {{ Form::select(
                                'size',
                                $categories,
                                $item->categories_id,
                                ['class' => 'form-control select2',
                                 'name' => 'categories_id',

                                ]
                            ) }}
                        </div>

                        <div class="form-group">
                            <label>Сезон</label>
                            {{ Form::select(
                                'size',
                                $seasons,
                                $item->season_id,
                                ['class' => 'form-control select2',
                                 'name' => 'season_id']
                            ) }}
                        </div>

                        <div class="form-group">
                            <label>Коллекция</label>
                            {{ Form::select(
                                'size',
                                $collections,
                                $item->collection_id,
                                ['class' => 'form-control select2',
                                 'name' => 'collection_id']
                            ) }}
                        </div>

                        <div class="form-group">
                            <label>Цвет</label>
                            {{ Form::select(
                                'size',
                                $colors,
                                $item->color_id,
                                ['class' => 'form-control select2',
                                 'name' => 'color_id']
                            ) }}
                        </div>

                        <div class="form-group">
                            <label>Состав</label>
                            {{ Form::select(
                                'size',
                                $composition,
                                $item->composition_id,
                                ['class' => 'form-control select2',
                                 'name' => 'composition_id']
                            ) }}
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            {{ Form::select(
                                'size',
                                $tags,
                                $item->tags->pluck('id')->all(),
                                ['class' => 'form-control tags-select',
                                 'multiple' => 'multiple',
                                 'data-placeholder' => "Выберите теги",
                                 'name' => 'tags_id[]']
                            ) }}
                        </div>

                        <div class="form-group">
                            <label>Размеры</label>
                            {{ Form::select(
                                'size',
                                $sizes,
                                $item->sizes->pluck('id')->all(),
                                ['class' => 'form-control tags-select',
                                 'multiple' => 'multiple',
                                 'data-placeholder' => "Выберите размеры",
                                 'name' => 'sizes_id[]']
                            ) }}
                        </div>



                        <div class="form-group">
                            <label>Галлерея изображений</label>
                            {!! Form::file('gallery[]', $attributes = ['multiple']) !!}
                        </div>

                        @foreach($galleryPhoto as $gPhoto)
                            <img src="/public/storage/uploads/{{ $gPhoto }}" width="100px">
                        @endforeach

                    </div>
                    <div class="block">
                        <p>Данные на русском:</p>
                        <label for="category-name">Название товара:</label>
                        <input type="text" class="form-control" name="title_ru" value="{{ $item->title_ru }}">

                        <label for="category-name">Описание товару:</label>
                        <textarea id="text" class="form-control" rows="10" name="description_ru">{{ $item->description_ru }}</textarea>
                    </div>
                </div>
            </div>
            <div class="button-group">
                <div>
                    <a class="btn btn-default" href="{{ route('items.index') }}">Назад</a>

                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>


            {!! Form::close() !!}
        </div>

    </div>
@endsection
