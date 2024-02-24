<!DOCTYPE html>
<html>
<head>
    <style>
        .container-fluid {
            background-color: #f4f4f4;
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card-header {
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .card-body {
            margin-bottom: 20px;
        }

        .checkout p {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .checkout table {
            width: 100%;
        }

        .thanks-table-td {
            display: table-cell;
            padding: 10px;
            vertical-align: middle;
        }

        .thanks-table-td img {
            max-width: 75px;
        }

        .card-footer {
            border-top: 1px solid #e0e0e0;
            padding-top: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }

    </style>
    <title>Order # {{$order->id}} Confirmation</title>
</head>
<body>
<h1>Order Confirmation</h1>
<p>Thank you for your order {{$order->id}}!</p>

<div class="container-fluid d-flex justify-content-center align-items-center">
    <div class="card">
        <div class="card-header">
            <img src="https://anionclothes.com/public/img/anion.png" width="150px">
            <h5 class="card-title">№{{ $order->id }}</h5>
            @lang('main.date') {{ $order->created_at }}
        </div>
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
                <table>

                    @foreach($order->items as $item)
                        <tr>
                            <td class="thanks-table-td"><img src="https://anionclothes.com/public/storage/uploads/{{ $item->photo }}"
                                                             width="75px"></td>
                            <td class="thanks-table-td">{{  $item->{'title_' . $locale} }}</td>
                            <td class="thanks-table-td">
                                <div class="">@lang('main.price'):</div>
                                <div>
                                    @if($item->discount)
                                        <span class="product-page__new-price item_price">{{ $item->price - $item->discount }} грн</span>
                                    @else
                                        <span class="item_price">{{ $item->price }} грн</span>
                                    @endif
                                </div>

                            </td>
                            <td class=thanks-table-td">
                                <div>@lang('main.size'):</div>
                                {{ $item->findSize($item->pivot->size_id) }}
                            </td>
                            <td class="thanks-table-td">
                                <div>@lang('main.quantity'):</div>
                                <div class="quantity">{{ $item->pivot->quantity }}</div>
                            </td>
                            <td class="thanks-table-td">
                                <div>@lang('main.sum'):</div>
                                @if($item->discount)
                                    <div class="total_price">{{ $item->pivot->quantity * ($item->price - $item->discount) }}</div>
                                @else
                                    <div class="total_price">{{ $item->pivot->quantity * $item->price }}</div>
                                @endif

                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>

        </div>
        <div class="card-footer d-flex justify-content-end">
            @lang('main.total'): {{ $order->total_price }} грн
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('.cart-item').each(function () {
            var price = $(this).find('.product-page__new-price').text() || $(this).find('.cart-item-price').text();
            price = parseFloat(price.replace(/[^\d\.]/g, ''));
            var quantity = parseInt($(this).find('input[name="quantity"]').val());
            var total = (price * quantity).toFixed(2);
            $(this).find('.total_item').text(total + ' грн');
        });

        var items = document.getElementsByClassName('table-td');
        for (var i = 0; i < items.length; i += 6) {
            var item_price = parseInt(items[i + 2].getElementsByClassName('item_price')[0].innerText);
            var quantity = parseInt(items[i + 4].getElementsByClassName('quantity')[0].innerText);
            var total_price = item_price * quantity;
            items[i + 5].getElementsByClassName('total_price')[0].innerText = total_price + ' грн';
        }

    });


</script>
</body>
</html>
