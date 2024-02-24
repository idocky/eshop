@extends('layout')

@section('title')
    @lang('main.cart') | ANION
@endsection

@section('content')
    <div class="container">

            <h3>@lang('main.cart')</h3>



        @if(isset($cart) && $cart != null)

            <div class="d-flex justify-content-end">
                {!! Form::open(['route' => 'cart.clear', 'method' => 'get']) !!}
                <button class="btn mb-3"type="submit" style="background-color: #f2f2f2">@lang('main.cart_clear')</button>
                {!! Form::close() !!}
            </div>

                @foreach($cart as $name => $item)
                <div class="cart-item">
                    <a href="{{ url('cart/remove/' . $name) }}"><div class="cart-item-close"></div></a>
                    <img src="/public/storage/uploads/{{ $item['product']->photo }}" alt="Product Image">
                    <div class="cart-item-info">
                        <div class="cart-item-name">{{ $item['product']->{'title_' . $locale} }}</div>
                        @if($item['product']->discount)
                            <span class="product-page__new-price">{{ $item['product']->price - $item['product']->discount }} грн.</span>
                            <span class="product-page__discount-price">{{ $item['product']->price }} грн.</span>
                        @else
                            <div class="cart-item-price">{{ $item['product']->price }} грн.</div>
                        @endif
                        <div class="cart-item-size">@lang('main.size'): {{ $item['product']->findSize($item['size']) }}</div>
                    </div>
                    <span class="mr-3 total_item text-center"> грн</span>
                    <div class="cart-item-quantity">
                        <input type="number" class="quantity" name="quantity"  min="1" value="{{ $item['quantity'] }}" data-item="{{ $name }}">
                    </div>
                </div>
                @endforeach
            <div class="d-flex justify-content-end">
                @lang('main.total')
            </div>
            <div class="d-flex justify-content-end total">
            </div>
                <div class="d-flex justify-content-end mt-3">
                    <a class="btn" href="{{ url('checkout') }}" style="background-color: #f2f2f2;">@lang('main.create_order')</a>

                </div>
        @else
            <div class="d-flex justify-content-center mt-5">
                @lang('main.empty_cart')
            </div>

        @endif
    </div>


    <script>
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

                $('.total').text(totalSum + ' грн.'); // записываем сумму в блок total

        }







    </script>

@endsection
