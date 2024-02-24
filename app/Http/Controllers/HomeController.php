<?php

namespace App\Http\Controllers;

use App\Models\admin\Banner;
use App\Models\admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Services\NovaPochtaService;

class HomeController extends Controller
{
    protected $novaPochtaService;

    public function __construct(NovaPochtaService $novaPochtaService)
    {
        $this->novaPochtaService = $novaPochtaService;
    }

    public function index()
    {

        $banners = Banner::pluck('photo');
        $slider = Slider::all();
        $locale = (session('locale') == 'ua') ? 'ua' : 'ru';

        return view('main', ['banners' => $banners, 'slider' => $slider, 'locale' => $locale]);
    }

    public function changeLocale($locale)
    {
        session(['locale' => $locale]);
        App::setLocale($locale);
        $currentLocale = App::getLocale();
        return redirect()->back();
    }

    public function about()
    {
        return view('footer.about', []);
    }

    public function delivery()
    {
        return view('footer.delivery', []);
    }

    public function payment()
    {
        return view('footer.payment', []);
    }

    public function return()
    {
        return view('footer.return', []);
    }

    public function sizes()
    {
        return view('footer.sizes', []);
    }

    public function conferent()
    {
        return view('footer.conferent', []);
    }

    public function test()
    {
        $text = [
        "CityName" => "київ",
        "Limit" => "10",
        "Page" => "1"
        ];

        $response = $this->novaPochtaService->findCity($text);
        $response = $response['data'][0]['Addresses'];
        $newArray = [];
        foreach ($response as $array => $town) {
            foreach ($town as $key => $value) {
                if ($key === "Present" || $key === "Area" || $key === "Ref") {
                    $newArray[$array][$key] = $value;
                }
            }

        }

        return dd($newArray);
    }

}
