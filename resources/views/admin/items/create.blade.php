@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Создание товара</h1>

            {!! Form::open(['route' => 'items.store', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    @include('admin.errors')

                    <div class="container">
                        <div class="block">
                            <p>Данные на украинском:</p>
                            <label for="category-name">Назва товару:</label>
                            <input type="text" class="form-control" id="category-name" name="title_ua" placeholder="Введите украинское название категории">

                            <label for="category-name">Опис товару:</label>
                            <textarea id="text" class="form-control" rows="10" name="description_ua"></textarea>

                            <div class="container">
                                <div class="block">
                                    <label for="category-name">Цена:</label>
                                    <input type="number" class="form-control" id="category-name" name="price" placeholder="Введите цену">
                                </div>
                                <div class="block">
                                    <label for="category-name">Скидка:</label>
                                    <input type="number" class="form-control" id="category-name"  value="0" name="discount" placeholder="Введите украинское название категории">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>
                                    Продается:
                                </label>
                                <label>
                                    {!! Form::checkbox('is_published', 1, true); !!}
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Лицевая картинка</label>
                                <input type="file" id="exampleInputFile" name="photo">
                                <br/><small>800 x 800</small>

                            </div>

                            <div class="form-group">
                                <label>Категория</label>
                                {{ Form::select(
                                    'size',
                                    $categories,
                                    '-----',
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
                                    '0',
                                    ['class' => 'form-control select2',
                                     'name' => 'season_id']
                                ) }}
                            </div>

                            <div class="form-group">
                                <label>Коллекция</label>
                                {{ Form::select(
                                    'size',
                                    $collections,
                                    null,
                                    ['class' => 'form-control select2',
                                     'name' => 'collection_id']
                                ) }}
                            </div>

                            <div class="form-group">
                                <label>Цвет</label>
                                {{ Form::select(
                                    'size',
                                    $colors,
                                    null,
                                    ['class' => 'form-control select2',
                                     'name' => 'color_id']
                                ) }}
                            </div>

                            <div class="form-group">
                                <label>Состав</label>
                                {{ Form::select(
                                    'size',
                                    $composition,
                                    null,
                                    ['class' => 'form-control select2',
                                     'name' => 'composition_id']
                                ) }}
                            </div>

                            <div class="form-group">
                                <label>Теги</label>
                                {{ Form::select(
                                    'size',
                                    $tags,
                                    null,
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
                                    null,
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


                        </div>
                        <div class="block">
                            <p>Данные на русском:</p>
                            <label for="category-name">Название товара:</label>
                            <input type="text" class="form-control" id="category-name" name="title_ru" placeholder="Введите русское название категории">

                            <label for="category-name">Описание товару:</label>
                            <textarea id="text" class="form-control" rows="10" name="description_ru"></textarea>
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
