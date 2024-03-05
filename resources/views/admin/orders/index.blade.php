@extends('admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="content">
        <!-- Заголовок страницы -->
        <section class="content-header">
            <h1>Перечень заказов</h1>
        </section>
        <!-- Основной контент -->
        <section class="content">
{{--            <div class="form-group">--}}
{{--                <a href="{{ url('admin/orders/create') }}" class="btn btn-success">Добавить заказ</a>--}}
{{--            </div>--}}
            <!-- Таблица со списком категорий -->
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 45%;">Товар</th>
                    <th style="width: 15%;">Клиент</th>
                    <th style="width: 20%;">Статус</th>
                    <th style="width: 10%;">Дата</th>
                    <th class="text-right" style="width: 5%;">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        <table>
                    @foreach($order->items as $item)
                        <tr>
                            <td class="table-td"><img src="/public/storage/uploads/{{ $item->photo }}" width="75px"></td>
                            <td class="table-td">{{  $item->title_ru }}</td>
                            <td class="table-td">
                                <div class="">Цена:</div>
                                <div>
                                    @if($item->discount)
                                        <span class="product-page__new-price item_price">{{ $item->price - $item->discount }} грн.</span>
                                    @else
                                        <span class="item_price">{{ $item->price }} грн</span>
                                    @endif
                                </div>

                            </td>
                            <td class="table-td">
                                <div>Размер:</div>
                                {{ $item->findSize($item->pivot->size_id) }}
                            </td>
                            <td class="table-td">
                                <div>Количество: </div>
                                <div class="quantity">{{ $item->pivot->quantity }}</div>
                            </td>
                        </tr>

                        @endforeach
                        </table>
                    </td>
                    <td>
                        <div class="for-order d-flex">
                            <div class="block">
                                <div>ФИО: {{ $order->full_name }}</div>
                                <div>Номер телефона: {{ $order->phone }}</div>
                                <div>Город: {{ $order->town }}</div>
                                <div>Отделение: {{ $order->department }}</div>
                            </div>
                            <div class="block">
                                @if($order->commentary)
                                    Комментарий: </br>
                                    {{ $order->commentary }}
                                @endif
                            </div>
                        </div>

                    </td>

                    <td>
                        <div class="status-container">
                            <select class="status-select" id="selectedStatus" name="status" data-custom-attribute="{{ $order->id }}">
                                <option value="1" {{ $order->status->id == 1 ? 'selected' : '' }}>Заказ в обработке</option>
                                <option value="2" {{ $order->status->id == 2 ? 'selected' : '' }}>Заказ принят</option>
                                <option value="3" {{ $order->status->id == 3 ? 'selected' : '' }}>Заказ отменен</option>
                                <option value="4" {{ $order->status->id == 4 ? 'selected' : '' }}>Заказ выполнен</option>
                            </select>
                            <div class="status-options">
                                <!-- Сюда необходимо добавить скрытый блок для обработки кликов, как в предыдущем примере -->
                            </div>
                        </div>
                    </td>

                    <td>
                        {{ $order->created_at->format('d.m.Y')}}
                    </td>


                    <td class="text-right">
{{--                        <button><a href="{{ route('orders.edit', $order->id) }}"><i class="fa fa-pencil" style="color:black;"></i></a></button>--}}
                        {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                        <button onclick="return confirm('Are you sure?')" type="submit" class="delete">
                            <a><i class="fa fa-trash"></i></a>
                        </button>
                        {!! Form::close() !!}
                        <button class="np-btn-open-modal" data-order-id="{{ $order->id }}">НП</button>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
        </section>
        </div>

    </div>
    <div id="np-modal" class="np-modal">
        <div class="np-modal-content">
            <!-- Здесь будет контент модального окна -->
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Обработчик изменения значения в combobox
        $(".status-select").change(function () {
            let changeUrl = window.location.origin + "/order/changeStatus"
            var data = {
                statusId: $(this).val(),
                orderId: $(this).data('custom-attribute')
            };
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: changeUrl,
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

    const openModalButtons = document.querySelectorAll('.np-btn-open-modal');
    const modal = document.getElementById('np-modal');

    // Добавляй обработчики событий для кнопок
    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Открывай модальное окно
            modal.style.display = 'block';
        });
    });

    // Добавь обработчик события для закрытия модального окна
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>
@endsection
