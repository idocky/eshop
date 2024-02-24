@extends('layout')

@section('title')
    Оформление заказа
@endsection

@section('content')

    <div class="container">
        {!! Form::open(['route' => 'order.create', 'method' => 'post']) !!}
        <div class="checkout">
            <div class="half">
                    <div class="form-group">
                        <label for="fullname">ФИО:</label>
                        @auth
                            <input class="form-control" type="text" id="full_name" name="full_name" value="{{ $name }}" required>
                        @endauth
                        @guest
                            <input class="form-control" type="text" id="full_name" name="full_name" required>
                        @endguest
                    </div>
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input class="form-control phone" type="tel" id="phone" name="phone" pattern="[0-9()+ -]*" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" type="text" id="email" name="email" required>
                </div>

                <div class="form-group">
                        <label>Выберите способ доставки:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="delivery-novaposhta" name="delivery" value="novaposhta" required>
                            <label class="form-check-label" for="delivery-novaposhta">Новая почта</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="delivery-ukrposhta" name="delivery" value="ukrposhta" required>
                            <label class="form-check-label" for="delivery-ukrposhta">Укрпочта</label>
                        </div>
                    </div>

                <div id="novaposhta-fields" style="display: none;">
                    <div class="form-group">
                        <label for="town">Город:</label>
                        <input class="form-control" type="text" id="town" name="town">
                        <!-- Скрытое поле для хранения значения Ref -->
                        <input type="hidden" id="town-ref" name="town_ref">
                        <!-- Скрытое поле для хранения значения Area -->
                        <input type="hidden" id="town-area" name="area">
                        <!-- Контейнер для отображения результатов -->
                        <div id="town-list" class="town-list"></div>
                    </div>
                    <div class="form-group">
                        <label for="department">Отделение:</label>
                        <input class="form-control" type="text" id="department" name="department">
                        <div id="department-list"></div>
                    </div>
                </div>

                <div class="form-group">
                        <label>Выберите способ оплаты:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="payment-cash" name="payment" value="cash" required>
                            <label class="form-check-label" for="payment-cash">Послеплата</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="payment-card" name="payment" value="card" required>
                            <label class="form-check-label" for="payment-card">Оплата картой</label>
                        </div>
                    </div>
                    <div class="comment-section">
                        <div class="comment-header">
                            Оставить комментарий
                            <div class="arrow-icon"></div>
                        </div>
                        <div class="comment-body" style="display: none;">
                            <textarea class="form-control" id="comments" rows="7" name="commentary"></textarea>
                        </div>
                    </div>

            </div>
            <div class="half p-4">
                @if(isset($cart) && $cart != null)

                    @foreach($cart as $name => $item)
                        <div class="cart-item">
                            <a href="{{ url('cart/remove/' . $name) }}"><div class="cart-item-close"></div></a>
                            <img src="{{ env('STORAGE_PATH') . $item['product']->photo }}" alt="Product Image">
                            <div class="cart-item-info">
                                <div class="cart-item-name">{{ $item['product']->{'title_' . $locale} }}</div>
                                @if($item['product']->discount)
                                    <span class="product-page__new-price">{{ $item['product']->price - $item['product']->discount }} грн.</span>
                                    <span class="product-page__discount-price">{{ $item['product']->price }} грн.</span>
                                @else
                                    <div class="cart-item-price">{{ $item['product']->price }} грн.</div>
                                @endif
                                <div class="cart-item-size">Размер: {{ $item['product']->findSize($item['size']) }}</div>
                            </div>
                            <span class="mr-3 total_item text-center"></span>
                            <div class="cart-item-quantity">
                                <input type="number" class="quantity" name="quantity"  min="1" value="{{ $item['quantity'] }}" data-item="{{ $name }}">
                            </div>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-end total">

                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn" type="submit" style="background-color: #f2f2f2;">Оформить заказ</button>
                    </div>
                @else
                    <div class="d-flex justify-content-center mt-5">
                        Корзина пуста
                    </div>

                @endif
            </div>
        </div>

        {!! Form::close() !!}





    </div>
    <script>


        $(document).ready(function() {

            $(document).ready(function() {
                $('.cart-item').each(function() {
                    var price = $(this).find('.product-page__new-price').text() || $(this).find('.cart-item-price').text();
                    price = parseFloat(price.replace(/[^\d\.]/g, ''));
                    var quantity = parseInt($(this).find('input[name="quantity"]').val());
                    var total = (price * quantity).toFixed(2);
                    $(this).find('.total_item').text(total + ' грн');
                    updateTotal();
                });

            });

            $(document).ready(function() {
                $('input[name="quantity"]').on('change', function() {
                    var cartItem = $(this).closest('.cart-item');
                    var price = cartItem.find('.product-page__new-price').text() || cartItem.find('.cart-item-price').text();
                    price = parseFloat(price.replace(/[^\d\.]/g, ''));
                    var quantity = parseInt($(this).val());

                    var inputElement = cartItem[0].querySelector('input.quantity');
                    var itemValue = inputElement.dataset['item'];
                    var itemQuantity = inputElement.value;

                    var total = (price * quantity).toFixed(2);
                    cartItem.find('.total_item').text(total + ' грн');
                    updateTotal();

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    var data = {
                        name: itemValue,
                        quantity: itemQuantity
                    };

                    $.ajax({
                        url: '{{ url("cart/changeQuantity") }}',
                        method: 'POST',
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // добавляем заголовок с токеном CSRF
                        },
                        success: function(response) {
                            // Обрабатываем успешный ответ от сервера
                            console.log(response);
                        },
                        error: function(error) {
                            // Обрабатываем ошибку при запросе
                            console.log(error);
                        }
                    });

                });
            });

            function updateTotal()
            {

                var totalSum = 0; // переменная для хранения суммы

                $('.total_item').each(function() {
                    var value = parseInt($(this).text()); // извлекаем число из текста и преобразуем его в число
                    if (!isNaN(value)) {
                        totalSum += value; // добавляем значение к сумме
                    }
                });

                $('.total').text('Всего: ' + totalSum + ' грн.'); // записываем сумму в блок total

            }


            // Показать поля "novaposhta-fields" при изменении значения радио-кнопки "delivery"
            $('input[name="delivery"]').on('change', function() {
                $('#novaposhta-fields').show();
            });

            // Обновить общую сумму после загрузки страницы
            updateTotal();

            // Обновить общую сумму при изменении количества товара
            $(document).on('change', 'input[name="quantity"]', function() {
                updateCartItemTotal($(this));
            });

            // Показать/скрыть комментарий по клику на заголовок
            $('.comment-header').click(function() {
                $('.comment-body').toggle();
            });

            // Открыть/закрыть список городов при клике на поле ввода "town"
            $('#town').click(function(event) {
                event.stopPropagation(); // Предотвращаем закрытие списка при клике на поле ввода
                toggleTownList();
            });

            // Закрыть список городов при клике вне поля ввода или списка
            $(document).click(function(event) {
                if (!$(event.target).closest('#town').length && !$(event.target).closest('#town-list').length) {
                    closeTownList();
                }
            });

            // // Открыть/закрыть список отделов при клике на поле ввода "department"
            // $('#department').click(function(event) {
            //     event.stopPropagation(); // Предотвращаем закрытие списка при клике на поле ввода
            //     toggleDepartmentList();
            // });

            // Закрыть список отделов при клике вне поля ввода или списка
            $(document).click(function(event) {
                if (!$(event.target).closest('#department').length && !$(event.target).closest('#department-list').length) {
                    closeDepartmentList();
                }
            });

            // AJAX-запрос для поиска города при вводе в поле "town"
            $('#town').keyup(function() {
                var query = $(this).val();
                if (query.length >= 3) {
                    searchCity(query);
                } else {
                    $('#town-list').html('').hide();
                }
            });

            // Обработка выбора города из списка результатов
            $(document).on('click', '.result', function() {
                var ref = $(this).data('ref');
                var area = $(this).data('area');
                $('#town').val($(this).text());
                $('#town-ref').val(ref);
                $('#town-area').val(area);
                $('#town-list').html('').hide();
                searchDepartments(ref);
            });

            $('#department').keyup(function() {
                var ref = $("#town-ref").val();
                var query = $(this).val();
                searchDepartments(ref, query);

            });

            // Обработка выбора отдела из списка результатов
            $(document).on('click', '.department-result', function() {
                $('#department').val($(this).text());
                $('#department-list').hide();
            });
        });

        // Открыть/закрыть список городов
        function toggleTownList() {
            $('#town-list').toggle();
        }

        // Закрыть список городов
        function closeTownList() {
            $('#town-list').hide();
        }

        // Открыть/закрыть список отделов
        function toggleDepartmentList() {
            $('#department-list').toggle();
        }

        // Закрыть список отделов
        function closeDepartmentList() {
            $('#department-list').hide();
        }

        // Обновление общей суммы
        function updateTotal() {
            var totalSum = 0;
            $('.total_item').each(function() {
                var value = parseFloat($(this).text().replace(/[^\d\.]/g, ''));
                if (!isNaN(value)) {
                    totalSum += value;
                }
            });
            $('.total').text('Всего: ' + totalSum.toFixed(2) + ' грн.');
        }

        // Обновление суммы товара
        function updateCartItemTotal(input) {
            var cartItem = input.closest('.cart-item');
            var price = parseFloat(cartItem.find('.product-page__new-price, .cart-item-price').text().replace(/[^\d\.]/g, ''));
            var quantity = parseInt(input.val());
            var total = (price * quantity).toFixed(2);
            cartItem.find('.total_item').text(total + ' грн');
            updateTotal();

            // Отправить данные на сервер
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var itemValue = input.data('item');
            var itemQuantity = input.val();
            $.ajax({
                url: '{{ url("cart/changeQuantity") }}',
                method: 'POST',
                data: {
                    _token: csrfToken,
                    name: itemValue,
                    quantity: itemQuantity
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Поиск города по запросу
        function searchCity(query) {
            $.ajax({
                url: '/findCity',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    town: query
                },
                success: function(response) {
                    var results = response.data;
                    var list = '';
                    results.forEach(function(result) {
                        list += '<div class="result" data-ref="' + result.Ref + '" data-area="' + result.Area +'">' + result.Present +'</div>';
                    });
                    $('#town-list').html(list).show();
                }
            });
        }

        // Поиск отделов для выбранного города
        function searchDepartments(ref, query = '') {
            $.ajax({
                url: '/getDepartments',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ref: ref,
                    query: query
                },
                success: function(response) {
                    var results = response.data;
                    var list = '';
                    results.forEach(function(result) {
                        list += '<div class="department-result">' + result.Description + '</div>';
                    });
                    $('#department-list').html(list).show();


                }
            });
        }






    </script>


    </script>




@endsection
