@extends('layout')

@section('title')
    @lang('main.size_tables')
@endsection

@section('content')
    <div class="container">
        <h2>@lang('main.size_tables')</h2>
        <br/>
        <h4>@lang('main.oversize_hoodie')</h4>
        <div class="row">
            <div class="col-md-6">
                <!-- Ваш первый блок -->
                <div class="block1">
                    <table class="size_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>А</th>
                            <th>B</th>
                            <th>C</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>M</td>
                            <td>62,5</td>
                            <td>73,5</td>
                            <td>84,4</td>
                        </tr>
                        <tr>
                            <td>L</td>
                            <td>65,5</td>
                            <td>76</td>
                            <td>85,7</td>
                        </tr>
                        <tr>
                            <td>XL</td>
                            <td>68,5</td>
                            <td>78,8</td>
                            <td>88</td>
                        </tr>
                        <tr>
                            <td>XXL</td>
                            <td>71,5</td>
                            <td>81,5</td>
                            <td>90,3</td>
                        </tr>
                        </tbody>
                    </table>
                    <small>* @lang('main.rukav')</small>

                </div>
            </div>
            <div class="col-md-6">
                <!-- Ваш второй блок -->
                <div class="block2">
                    <img src="public/img/Hoodie.png">
                </div>
            </div>
        </div>
        <br/>
        <h4>@lang('main.oversize_tshirt')</h4>
        <div class="row">
            <div class="col-md-6">
                <!-- Ваш первый блок -->
                <div class="block1">
                    <table class="size_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>А</th>
                            <th>B</th>
                            <th>C</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>M</td>
                            <td>54</td>
                            <td>73,5</td>
                            <td>39</td>
                        </tr>
                        <tr>
                            <td>L</td>
                            <td>56</td>
                            <td>75</td>
                            <td>41</td>
                        </tr>
                        <tr>
                            <td>XL</td>
                            <td>58</td>
                            <td>76.5</td>
                            <td>42</td>
                        </tr>
                        <tr>
                            <td>XXL</td>
                            <td>60</td>
                            <td>78</td>
                            <td>43</td>
                        </tr>
                        </tbody>
                    </table>
                    <small>* @lang('main.rukav')</small>

                </div>
            </div>
            <div class="col-md-6">
                <!-- Ваш второй блок -->
                <div class="block2">
                    <img src="public/img/Tshirt.png">
                </div>
            </div>
        </div>

        </div>

@endsection
