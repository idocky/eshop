@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
        <!-- Заголовок страницы -->
        <section class="content-header">
            <h1>Перечень баннеров</h1>
        </section>
        <!-- Основной контент -->
        <section class="content">

            <!-- Таблица со списком категорий -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название баннера</th>
                    <th>Картинка</th>
                    <th class="text-right">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{$banner->type}}</td>
                    <td><img width="250px" src="/public/img/{{$banner->photo}}"></td>
                    <td class="text-right">
                        <button><a href="{{ route('banners.edit', $banner->id) }}"><i class="fa fa-pencil" style="color:black;"></i></a></button>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </section>
        </div>
    </div>

@endsection
