@extends('layout')

@section('title')
    {{ $name }} | Anion.ua
@endsection

@section('content')

    <div class="container">
        <div class="profile-container">
            <div class="profile-sidebar">
                <ul>
{{--                    <li class="profile-link"><a onclick="changeUrlParam('type', 'user')">Данные пользователя</a></li>--}}
                    <li class="profile-link"><a onclick="changeUrlParam('type', 'orders')">@lang('main.my_orders')</a></li>
                    <li class="profile-link"><a onclick="changeUrlParam('type', 'wishlist')">@lang('main.wish_list')</a></li>
                    <li ><button class="btn btn-danger"><a class="nav-link text-white"href="{{ url('logout') }}" >@lang('main.exit')</a></button></li>

                </ul>
            </div>
            <div class="profile-main-content">
                @if($request->input('type') == 'user')
                    <div class="checkout">
                        <div class="profile-box">
                            <div class="text-center">
                                <img src="https://kin.jut.su/uploads/attachment/2021-12/1639687766_img_20211204_131136.jpg" class="img-circle" alt="Avatar" width="150" height="150">
                            </div>
                        </div>
                        <div class="profile-box-second">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4">

                                    <h2 class="">{{ $name }}</h2>
                                    <form class="p-3" action="/submit-order" method="POST">
                                        <div class="form-group">
                                            <label for="fullname">ФИО:</label>
                                            <input class="form-control" type="text" id="fullname" name="fullname" value="{{ $name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Телефон:</label>
                                            <input class="form-control" type="tel" id="phone" name="phone" required>
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
                                        <div id="novaposhta-fields" style="display:none">
                                            <div class="form-group">
                                                <label for="city">@lang('main.city'):</label>
                                                <input class="form-control" type="text" id="city" name="city">
                                            </div>
                                            <div class="form-group">
                                                <label for="postoffice">Отделение:</label>
                                                <input class="form-control" type="text" id="postoffice" name="postoffice">
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

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($request->input('type') == 'orders')
                    <div class="detailed-pc">
                        @foreach($orders as $order)
                            <div class="comment-section container-fluid d-flex justify-content-center align-items-center flex-fill">
                                <div class="card flex-fill">

                                    <div class="comment-header">
                                        <table class="w-100 " style="height: 80px;">
                                            <tr>
                                                <td style="width: 3%;">
                                                    <div style="height: 80%; width: 8px; background-color: {{ $order->status->color }};"></div>
                                                </td>
                                                <td style="width: 22%;">
                                                    <h5 class="card-title">№{{ $order->id }}</h5>
                                                    <div>@lang('main.date'): {{ $order->created_at }}</div>
                                                    <div>@lang('main.status'): {{ $order->status->{'title_' . $locale} }} </div>
                                                </td>
                                                <td>
                                                    <div>@lang('main.sum'): </div>
                                                    {{ $order->total_price }}грн
                                                </td>
                                                <td style="width: 50%; text-align: right;">
                                                    <div >
                                                        @foreach($order->items as $item)
                                                            <img src="{{ env('STORAGE_PATH') . $item->photo }}" width="65px">
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="flex-fill justify-content-end">

                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="arrow-icon"></div>
                                                </td>

                                            </tr>
                                        </table>




                                    </div>
                                    <div class="comment-body" style="display: none;">
                                        <div class="card-body checkout">

                                            <div>
                                                <p class="card-text">@lang('main.order_info'):</p>
                                                <div>
                                                    @lang('main.department'): {{ $order->town }}
                                                    {{ $order->department }}
                                                </div>
                                                <div>
                                                    @lang('main.full_name'): {{ $order->full_name }}
                                                </div>
                                            </div>
                                            <div>
                                                <table >

                                                    @foreach($order->items as $item)
                                                        <tr>
                                                            <td class="table-td"><img src="{{ env('STORAGE_PATH') . $item->photo }}" width="75px"></td>
                                                            <td class="table-td">{{  $item->{'title_' . $locale} }}</td>
                                                            <td class="table-td">
                                                                <div class="">@lang('main.price'):</div>
                                                                <div>
                                                                    @if($item->discount)
                                                                        <span class="product-page__new-price item_price">{{ $item->price - $item->discount }} грн.</span>
                                                                        <span class="product-page__discount-price">{{ $item->price }} грн.</span>
                                                                    @else
                                                                        <span class="item_price">{{ $item->price }} грн</span>
                                                                    @endif
                                                                </div>

                                                            </td>
                                                            <td class="table-td">
                                                                <div>@lang('main.size'):</div>
                                                                {{ $item->findSize($item->pivot->size_id) }}
                                                            </td>
                                                            <td class="table-td">
                                                                <div>@lang('main.quantity'): </div>
                                                                <div class="quantity">{{ $item->pivot->quantity }}</div>
                                                            </td>
                                                            <td class="table-td">
                                                                <div>@lang('main.sum'): </div>
                                                                <div class="total_price"></div>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                                </table>
                                            </div>

                                        </div>
                                        <div class="card-footer d-flex justify-content-end">
                                            @lang('main.total'): {{ $order->total_price }} грн.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="detailed-mobile">
                        @foreach($orders as $order)
                            <div class="order-card">
                                <div class="order-card-header">
                                    <h2>@lang('main.order') {{ $order->id }}</h2>
                                     <p>@lang('main.status'): <span style="color: {{ $order->status->color }}">{{ $order->status->{'title_' . $locale} }}</span></p>
                                    <p>@lang('main.date'): {{ $order->created_at }}</p>
                                </div>

                                <div class="order-details">
                                    <h3>@lang('main.order_info')</h3>
                                    @foreach($order->items as $item)
                                        <div class="order-item">
                                            <img src="{{ env('STORAGE_PATH') . $item->photo }}" alt="Product 1">
                                            <div>
                                                <p>{{ $item->{'title_' . $locale} }}</p>
                                                <p>@lang('main.size'): {{ $item->findSize($item->pivot->size_id) }}</p>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>

                                <div class="order-summary">
                                    <p>@lang('main.total'): {{ $order->total_price }} грн</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @endif
            </div>
        </div>
    </div>




    <script>
        const commentHeaders = document.querySelectorAll('.comment-header');

        commentHeaders.forEach((commentHeader) => {
            const commentBody = commentHeader.nextElementSibling;

            commentHeader.addEventListener('click', () => {
                commentBody.style.display = commentBody.style.display === 'none' ? 'block' : 'none';
            });
        });



        function changeUrlParam(key, value) {
            // Получаем текущий URL
            var url = window.location.href;

            // Разбиваем URL на части до знака вопроса и после
            var urlParts = url.split('?');
            var baseUrl = urlParts[0];
            var queryParams = '';

            // Если есть параметры в запросе, сохраняем их в переменную
            if (urlParts.length > 1) {
                queryParams = urlParts[1];
            }

            // Разбиваем параметры на части и ищем параметр с заданным ключом
            var queryParts = queryParams.split('&');
            var found = false;
            for (var i = 0; i < queryParts.length; i++) {
                var paramParts = queryParts[i].split('=');
                if (paramParts[0] == key) {
                    // Если найден, заменяем его значение
                    queryParts[i] = key + '=' + value;
                    found = true;
                    break;
                }
            }

            // Если параметр не найден, добавляем его в конец
            if (!found) {
                queryParts.push(key + '=' + value);
            }

            // Собираем новый URL из базового адреса и параметров запроса
            var newUrl = baseUrl;
            if (queryParts.length > 0) {
                newUrl += '?' + queryParts.join('&');
            }

            // Перенаправляем на новый URL
            window.location.href = newUrl;
        }

        var items = document.getElementsByClassName('table-td');
        for (var i = 0; i < items.length; i += 6) {
            var item_price = parseInt(items[i+2].getElementsByClassName('item_price')[0].innerText);
            var quantity = parseInt(items[i+4].getElementsByClassName('quantity')[0].innerText);
            var total_price = item_price * quantity;
            items[i+5].getElementsByClassName('total_price')[0].innerText = total_price + ' грн';
        }

    </script>





@endsection
