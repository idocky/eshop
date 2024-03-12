<?php

namespace App\Http\Controllers;

use App\Jobs\CreationOrderEmailJob;
use App\Models\Order;
use App\Services\NovaPochtaService;
use Illuminate\Http\Request;
use App\Services\TelegramService;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService, NovaPochtaService $novaPochtaService)
    {
        $this->telegramService = $telegramService;
        $this->novaPochtaService = $novaPochtaService;
    }

    public function createOrder(Request $request)
    {
        $order = Order::add($request->all());
        $order->setStatus(1);
        $order->addUserId();
        $order->calculateTotalPrice();
        $order->setItems();
        session(['cart' => []]);


        //Отправка почтового уведомления о заказе
        //$this->dispatch(new CreationOrderEmailJob($order));
        Mail::to($order->email)->send(new OrderPlaced($order));

        //Отправка сообщения в тг о заказе
        $chatId = '610366027';
        $message = 'Новый заказ оформлен!';

        $this->telegramService->sendMessage($chatId, $message);



        return redirect()->route('order.thanks', ['id' => $order->id]);
    }

    public function thankspage($id)
    {
        $order = Order::find($id);
        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';

        return view('thankspage', ['order' => $order, 'locale' => $locale]);
    }

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();


        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('orders.index');
    }

    public function changeStatus(Request $request)
    {
        $order = Order::find(intval($request->orderId));
        $order->setStatus(intval($request->statusId));
    }

    public function findCity(Request $request)
    {
        $methodProperties = [
            "CityName" => $request->input('town'),
            "Limit" => "50",
            "Page" => "1"
        ];

        $response = $this->novaPochtaService->findCity($methodProperties);

        $result = $this->novaPochtaService->sortCities($response);

        return response()->json(['data' => $result]);
    }

    public function getDepartments(Request $request)
    {
        $result = $this->novaPochtaService->getDepartments($request->input('ref'), $request->input('query'));

        return response()->json(['data' => $result]);
    }
}
