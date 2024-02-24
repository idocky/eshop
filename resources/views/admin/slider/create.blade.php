@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <h1>Создание товара для слайдера</h1>

            <!-- Основной контент -->

            <!-- Форма создания категории -->
            {!! Form::open(['route' => 'slider.store']) !!}
                <div class="form-group">
                    @include('admin.errors')
                    <label for="category-name">Item ID:</label>
                    <input type="number" class="form-control" id="category-name" name="item_id" placeholder="Введите id товара">

                </div>
            <div class="button-group">
                <div>
                    <button class="btn btn-default"><a href="{{ route('slider.index') }}">Назад</a></button>

                </div>
                <div class="text-right">
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>

    </div>

    <script>
        const selectElement = document.querySelector('select');
        const imageElement = document.querySelector('img');

        selectElement.addEventListener('change', (event) => {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const imageSrc = selectedOption.getAttribute('data-image');
            imageElement.setAttribute('src', imageSrc);
        });
    </script>
@endsection
