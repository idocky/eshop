@extends('layout')

@section('title')
    @lang('main.nav_collection') ANION
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="mb-3">
                    <a class="nav-link" href="{{ url('collection') }}">
                        <div class="card-header mb-4 d-flex justify-content-center ">
                            <div class="margin-r"><img src="public/img/icon-refresh.png"  width="25px"></div>@lang('main.refresh')
                        </div>
                    </a>

                    <div class="card-header">
                        @lang('main.categories')
                    </div>
                    <ul class="list-group list-group-flush categories">
                        @foreach($categories as $category)
                        <li class="list-group-item"><a class="nav-link element" href="?categories={{$category->slug}}">{{ $category->{'title_' . $locale} }}</a></li>
                        @endforeach
                    </ul>

                    <div class="card-header ">
                        @lang('main.nav_collection')
                    </div>
                    <ul class="list-group list-group-flush collections">
                        @foreach($collections as $collection)
                        <li class="list-group-item"><a class="nav-link element" href="?collections={{ $collection->slug }}">{{ $collection->{'title_' . $locale} }}</a></li>
                        @endforeach
                    </ul>
                    <div class="card-header">
                        @lang('main.tags')
                    </div>
                    <ul class="list-group list-group-flush mt-2 tags">
                        <div>
                            @foreach($tags as $tag)
                                <div class="tag-card" style="background-color: {{ $tag->color }}; color: {{ $tag->text_color }};">
                                    <a class="nav-link element" href="?tags={{ $tag->slug }}"><h5 class="tag-card-title">{{ $tag->{'title_' . $locale} }}</h5></a>
                                </div>

                            @endforeach
                        </div>
                    </ul>
                </div>

            </div>

            <div class="col-md-9">

{{--                <div class="d-flex justify-content-end my-dropdown">--}}
{{--                    <div class="btn-group">--}}
{{--                        <button class="btn btn-sm dropdown-toggle my-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            @lang('main.sort')--}}
{{--                        </button>--}}
{{--                        <ul class="dropdown-menu my-dropdown-menu">--}}
{{--                            <li><a class="nav-link my-dropdown-item" href="#">@lang('main.cheap')</a></li>--}}
{{--                            <li><a class="nav-link my-dropdown-item" href="#">@lang('main.expensive')</a></li>--}}
{{--                            <li><a class="nav-link my-dropdown-item" href="#">@lang('main.new')</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}


                <br/>

                <div class="row">

                    @foreach($items as $item)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <a class="nav-link" href="{{ url('/collection/' . $item->slug) }}">
                                    <img class="card-img-top" src="public/storage/uploads/{{ $item->photo }}" alt="Товар 1">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ $item->{ 'title_' . $locale} }}</h4>

                                            <div>
                                                @if($item->discount)
                                                    <span class="text-danger">{{ $item->price - $item->discount }} грн.</span>
                                                    <span class="text-muted">{{ $item->price }} грн.</span>
                                                @else
                                                    <span class="text-dark">{{ $item->price }} грн.</span>
                                                @endif
                                            </div>

                                        <div>
                                            @foreach($item->tags as $tag)
                                                <div class="tag-card" style="background-color: {{ $tag->color }}; color: {{ $tag->text_color }};">
                                                    <h5 class="tag-card-title">{{ $tag->{'title_' . $locale} }}</h5>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                {{-- Кнопка "Previous" --}}
                                @if ($items->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">@lang('main.back')</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $items->previousPageUrl() }}">@lang('main.back')</a></li>
                                @endif

                                {{-- Номера страниц --}}
                                @for ($i = 1; $i <= $items->lastPage(); $i++)
                                    <li class="page-item {{ $items->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link {{ $items->currentPage() == $i ? 'bg-black text-white' : '' }}" href="{{ $items->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Кнопка "Next" --}}
                                @if ($items->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $items->nextPageUrl() }}">@lang('main.forward')</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">@lang('main.forward')</span></li>
                                @endif
                            </ul>
                        </nav>



                </div>
            </div>
        </div>
    </div>





@endsection
