@extends('layout')

@section('title')
     {{$item->{'title_'.$locale} }}
@endsection


@section('content')
    <div class="container">

        <div class="detailed-pc">
            <div class="product-page">
                <div class="product-page__images">
                    <div class="product-page__gallery">
                        @foreach($galleryPhoto as $gal)
                            <img class="product-page__gallery-image" src="{{ env('STORAGE_PATH') . $gal }}"
                                 alt="Product Name" data-image-src="{{ env('STORAGE_PATH') .$gal }}">
                        @endforeach
                    </div>

                    <img class="product-page__main-image" src="{{ env('STORAGE_PATH') . $item->photo }}"
                         alt="Product Name">

                </div>


                <div class="product-page__info">
                    <h1 class="product-page__title">{{ $item->{'title_' . $locale} }}</h1>
                    <p class="product-page__price">
                        @if($item->discount)
                            <span class="product-page__new-price">{{ $item->price - $item->discount }} грн.</span>
                            <span class="product-page__discount-price">{{ $item->price }} грн.</span>
                        @else
                            <span class="ml-2">{{ $item->price }} грн.</span>
                        @endif


                    </p>
                    <div class="size-options">
                        @foreach($item_sizes as $is)
                            <div class="size-option" data-size="{{ $is->id }}">{{$is->name}}</div>
                        @endforeach
                    </div>
                    <div class="size-chart-wrapper">
                        <a href="{{ url('sizes') }}" class="size-chart-trigger">@lang('main.size_tables')</a>
                    </div>


                    <h5>@lang('main.our_delivery'):</h5>
                    <div class="card-group">

                        <div class="card-post">
                            <img src="https://media.interfax.com.ua/media/thumbs/images/2021/06/q9VUeKB-TNOI.png"
                                 alt="Картинка 1">
                        </div>
                        <div class="card-post">
                            <img src="https://roz.otg.dp.gov.ua/storage/app/sites/19/uploaded-files/ukr-2.jpg"
                                 alt="Картинка 2">
                        </div>
                    </div>

                    {!! Form::open(['route' => ['cart.add', $item->id], 'onsubmit' => 'return validateForm()']) !!}
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary"
                                            onclick="changeQuantity(-1)">-
                                    </button>
                                </div>
                                <input type="hidden" name="size" id="hidden_size" value="0">
                                <input type="number" name="quantity" id="quantity" min="1" value="1"
                                       class="form-control order-quantity" size="1" style="text-align: center;"
                                       inputmode="numeric">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" onclick="changeQuantity(1)">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto mt-2">
                            <input type="submit" value="@lang('main.add_to_bag')"
                                   class="product-page__add-to-cart btn btn-primary add-to-cart">
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>
    <div class="detailed-mobile">

            <div class="slider-detailed">
                    @foreach($galleryPhoto as $gal)
                        <div class="slide">
                            <img class="mobile-slide" src="{{ env('STORAGE_PATH') . $gal }}"
                                 alt="Product Name" data-image-src="/public/storage/uploads/{{ $gal }}">
                        </div>

                    @endforeach
            </div>

        <div class="m-3">
            <h1 class="product-page__title">{{ $item->{'title_' . $locale} }}</h1>
            <p class="product-page__price">
                @if($item->discount)
                    <span class="product-page__new-price">{{ $item->price - $item->discount }} грн.</span>
                    <span class="product-page__discount-price">{{ $item->price }} грн.</span>
                @else
                    <span class="ml-2">{{ $item->price }} грн.</span>
                @endif


            </p>
            <div class="size-options">
                @foreach($item_sizes as $is)
                    <div class="size-option" data-size="{{ $is->id }}">{{$is->name}}</div>
                @endforeach
            </div>



            <h5>@lang('main.our_delivery'):</h5>
            <div class="card-group">

                <div class="card-post">
                    <img src="https://media.interfax.com.ua/media/thumbs/images/2021/06/q9VUeKB-TNOI.png"
                         alt="Новая почта">
                </div>
                <div class="card-post">
                    <img src="https://roz.otg.dp.gov.ua/storage/app/sites/19/uploaded-files/ukr-2.jpg"
                         alt="Укр почта">
                </div>
            </div>

            {!! Form::open(['route' => ['cart.add', $item->id], 'onsubmit' => 'return validateForm()']) !!}
            <div class="form-row align-items-center">
                <div class="col-auto">
                    Количество
                    <div class="input-group ">
                        <input type="number" name="quantity" id="quantity" min="1" value="1"
                               class="form-control order-quantity" size="1" style="text-align: center;"
                               inputmode="numeric">
                    </div>
                </div>
                <input type="hidden" name="size" id="hidden_size" value="0">
                <div class="col-auto mt-2">
                    <input type="submit" id="add-to-cart" value="@lang('main.add_to_bag')"
                           class="product-page__add-to-cart btn btn-primary add-to-cart">
                </div>
            </div>
            {!! Form::close() !!}

            <script>
                $(document).ready(function () {
                    $('.add-to-cart').on("click", function () {
                        console.log('dfdfd');
                        var input = $('#quantity');
                        var currentValue = parseInt(input.val(), 10) || 0;
                        window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag("event", "add_to_cart", {
                            value: {{ $item->price }},
                            currency: "UAH",
                            items: [
                                {
                                    item_id: "SKU_{{ $item->id }}",
                                    item_name: "{{ $item->title_ru }}",
                                    discount: {{ $item->discount }},
                                    item_category: "{{ $item->category->title_ru }}",
                                    quantity: currentValue
                                }
                            ]
                        });
                    });
                });


            </script>

        </div>

    </div>


    <div class="product-features">
        <p class="product-description">{{ $item->{'description_' . $locale} }}</p>
        <table class="product-specifications">
            <tbody>
            @if($item->composition->{'composition_' . $locale})
                <tr>
                    <td>@lang('main.composition'):</td>
                    <td>{{ $item->composition->{'composition_' . $locale} }}</td>
                </tr>
            @endif
            @if($item->color->{'title_' . $locale})
                <tr>
                    <td>@lang('main.color'):</td>
                    <td>{{ $item->color->{'title_' . $locale} }}</td>
                </tr>
            @endif
            @if($item->season->{'title_' . $locale})
                <tr>
                    <td>@lang('main.season'):</td>
                    <td>{{ $item->season->{'title_' . $locale} }}</td>
                </tr>
            @endif
            @if($item->collection->{'title_' . $locale})
                <tr>
                    <td>@lang('main.collection'):</td>
                    <td>{{ $item->collection->{'title_' . $locale} }}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <div>
        <h4>@lang('main.can_like')</h4>
    </div>
    <br/>
    <div class="container">

        <div class="slider-container">
            <div class="slider-wrapper">
                <a class="prev"><img class="detailed-pc" src="/public/img/icon-left-arrow.png"></a>
                <div class="slider">
                    @foreach($slider as $slide)
                        <div class="slide">
                            <a href="{{ url('collection/' . $slide->item->slug) }}" class="nav-link">
                                <img src="/public/storage/uploads/{{ $slide->item->photo }}" alt="Product 1">
                                <h3>{{ $slide->item->{'title_' . $locale} }}</h3>
                                @if($slide->item->discount)
                                    <span class="text-muted">{{ $slide->item->price }} грн.</span>
                                    <span class="text-danger ml-2">{{ $slide->item->price - $slide->item->discount }} грн.</span>
                                @else
                                    <span class="text-dark">{{ $slide->item->price }} грн.</span>
                                @endif
                            </a>

                        </div>
                    @endforeach
                </div>
            </div>

            <a class="next"><img class="detailed-pc" src="/public/img/icon-right-arrow.png"></a>
        </div>
    </div>




    <script>
        if (window.innerWidth > 1040) {
            const mainImage = document.querySelector('.product-page__main-image');
            const galleryImages = document.querySelectorAll('.product-page__gallery-image');

            galleryImages.forEach((image) => {
                image.addEventListener('click', () => {
                    // меняем основную картинку
                    const imageSrc = image.getAttribute('data-image-src');
                    mainImage.setAttribute('src', imageSrc);
                    // меняем текущий слайд в слайдере
                    const index = Array.from(galleryImages).indexOf(image);
                    currentSlideIndex = index;
                    // обновляем слайдер
                    updateSlider();
                });
            });


            const mainImageScope = document.querySelector('.product-page__main-image');
            const galleryImagesScope = document.querySelectorAll('.product-page__gallery-image');
            const newSlider = document.createElement('div');
            const sliderWrapper = document.createElement('div');
            const sliderContent = document.createElement('div');
            const overlay = document.createElement('div');

            newSlider.classList.add('new-slider');
            sliderWrapper.classList.add('new-slider__wrapper');
            sliderContent.classList.add('new-slider__content');
            overlay.classList.add('overlay');

            for (let i = 0; i < galleryImagesScope.length; i++) {
                const newSlide = document.createElement('div');
                const image = document.createElement('img');
                newSlide.classList.add('new-slide');
                image.src = galleryImagesScope[i].dataset.imageSrc;
                image.alt = galleryImagesScope[i].alt;
                newSlide.appendChild(image);
                sliderContent.appendChild(newSlide);
            }

            sliderWrapper.appendChild(sliderContent);
            newSlider.appendChild(sliderWrapper);
            document.body.appendChild(newSlider);
            document.body.appendChild(overlay);

            mainImageScope.addEventListener('click', function () {
                newSlider.classList.add('new-slider--active');
                overlay.classList.add('overlay--active');
                const currentImageSrc = mainImageScope.src;
                const currentSlide = document.querySelector(`[data-image-src="${currentImageSrc}"]`);
                const newSlides = newSlider.querySelectorAll('.new-slide');
                newSlides.forEach((slide) => {
                    slide.classList.remove('new-slide--active');
                });
                currentSlide.parentNode.classList.add('new-slide--active');
            });

            overlay.addEventListener('click', function () {
                newSlider.classList.remove('new-slider--active');
                overlay.classList.remove('overlay--active');
            });

            const closeButton = document.createElement('button');
            closeButton.classList.add('new-slider__close-button');
            closeButton.innerHTML = '<img src="/public/img/close-icon.png" width="40px">';
            newSlider.appendChild(closeButton);

            closeButton.addEventListener('click', function () {
                newSlider.classList.remove('new-slider--active');
                overlay.classList.remove('overlay--active');
            });

            const prevButton = document.createElement('button');
            prevButton.classList.add('new-slider__prev-button');
            prevButton.innerHTML = '&lt;';
            newSlider.appendChild(prevButton);

            const nextButton = document.createElement('button');
            nextButton.classList.add('new-slider__next-button');
            nextButton.innerHTML = '&gt;';
            newSlider.appendChild(nextButton);

            let currentSlideIndex = 0;
            const newSlides = newSlider.querySelectorAll('.new-slide');

            prevButton.addEventListener('click', function () {
                currentSlideIndex--;
                if (currentSlideIndex < 0) {
                    currentSlideIndex = newSlides.length - 1;
                }
                updateSlider();
            });

            nextButton.addEventListener('click', function () {
                currentSlideIndex++;
                if (currentSlideIndex >= newSlides.length) {
                    currentSlideIndex = 0;
                }
                updateSlider();
            });

            function updateSlider() {
                const slideWidth = newSlides[0].getBoundingClientRect().width;
                sliderContent.style.transform = `translateX(-${currentSlideIndex * slideWidth}px)`;
            }


        }



        $(document).ready(function () {
            $('.slider').slick({
                dots: true, // показывать точки навигации
                infinite: true, // зациклить слайдер
                speed: 500, // скорость анимации
                slidesToShow: 4, // количество слайдов, которые отображаются одновременно
                slidesToScroll: 1, // количество слайдов, которые прокручиваются за один раз
                prevArrow: $('.slider-container .prev'), // Стрелка влево
                nextArrow: $('.slider-container .next'), // Стрелка вправо
                responsive: [
                    {
                        breakpoint: 768, // при ширине экрана менее 768 пикселей
                        settings: {
                            slidesToShow: 2 // отображать 2 слайда
                        }
                    },
                    {
                        breakpoint: 480, // при ширине экрана менее 480 пикселей
                        settings: {
                            slidesToShow: 1 // отображать 1 слайд
                        }
                    }
                ]
            });
        });

        $(document).ready(function () {
            $('.slider-detailed').slick({
                dots: true, // показывать точки навигации
                infinite: true, // зациклить слайдер
                speed: 500, // скорость анимации
                slidesToShow: 3, // количество слайдов, которые отображаются одновременно
                slidesToScroll: 3, // количество слайдов, которые прокручиваются за один раз
                responsive: [
                    {
                        breakpoint: 1040,
                        settings: {
                            slidesToShow: 2, // отображать 2 слайда
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 560, // при ширине экрана менее 480 пикселей
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });


        function validateForm() {
            var selectedSize = document.getElementById('hidden_size').value;

            // Проверка, выбран ли размер
            if (selectedSize == 0) {
                alert('Please select a size before adding to the bag.');
                return false; // Отмена отправки формы
            }

            return true; // Отправка формы, если размер выбран
        }

        const sizeOptions = document.querySelectorAll('.size-option');


        sizeOptions.forEach((option) => {
            option.addEventListener('click', () => {
                const selectedSize = option.getAttribute('data-size');
                let input = document.getElementById("hidden_size");
                input.value = selectedSize;

                // Remove 'selected' class from all options
                sizeOptions.forEach(otherOption => otherOption.classList.remove('selected'));

                // Add 'selected' class to the clicked option
                option.classList.add('selected');
            });
        });


        sizeOptions.forEach(option => {
            option.addEventListener('click', () => {
                sizeOptions.forEach(otherOption => otherOption.classList.remove('selected'));
                option.classList.add('selected');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var sizeOptions = document.querySelectorAll('.size-option');

            sizeOptions.forEach(function(option) {
                option.addEventListener('click', function() {
                    var selectedSize = this.getAttribute('data-size');
                    document.getElementById('hidden_size').value = selectedSize;
                });
            });
        });







        function changeQuantity(delta) {
            var input = document.getElementById('quantity');
            var currentValue = parseInt(input.value, 10) || 0;
            var newValue = currentValue + delta;

            if (newValue < 1) {
                newValue = 1;
            }

            input.value = newValue;
        }


    </script>

@endsection
