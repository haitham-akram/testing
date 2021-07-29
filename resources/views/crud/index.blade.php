{{--<!doctype html>--}}
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--    @include('includes.AppStyle')--}}
{{--</head>--}}
{{--<body>--}}
{{--@include('includes.nav')--}}
{{--<div class="container">--}}
{{--<table class="table mt-5">--}}
{{--    <thead>--}}
{{--    <tr>--}}
{{--        <th scope="col">#</th>--}}
{{--        <th scope="col">{{__('messages.Name')}}</th>--}}
{{--        <th scope="col">{{__('messages.Price')}} </th>--}}
{{--        <th scope="col">{{__('messages.Details')}}</th>--}}
{{--    </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}
{{--        @foreach($offers as $offer)--}}
{{--    <tr>--}}
{{--        <th scope="row">{{$offer->id}}</th>--}}
{{--        <td>{{$offer->name}}</td>--}}
{{--        <td>{{$offer->price}}</td>--}}
{{--        <td>{{$offer->details}}</td>--}}
{{--    </tr>--}}
{{--        @endforeach--}}
{{--    </tbody>--}}

{{--</table>--}}
{{--</div>--}}
{{--@include('includes.AppJS')--}}
{{--</body>--}}
{{--</html>--}}
    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="@if(LaravelLocalization::getCurrentLocale()=='ar')
rtl
@else
 ltr
@endif
">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('includes.AppStyle')
</head>
<body>
@include('includes.nav')
<div class="container">
    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('error')}}
        </div>
    @endif
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
    <table class="table mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Name')}}</th>
            <th scope="col">{{__('messages.Price')}} </th>
            <th scope="col">{{__('messages.Details')}}</th>
            <th scope="col">{{__('messages.img')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr>
                <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td><img style="height: 50px;width: 50px" src="{{asset('Images/Offers/'.$offer->img)}}"></td>
                <td><a class="btn btn-success" href="{{url('offer/edit/'.$offer->id)}}" role="button">{{__('messages.edit')}}</a>

                <a class="btn btn-danger" href="{{route('offer.delete',$offer->id)}}" role="button">{{__('messages.delete')}}</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
</div>
@include('includes.AppJS')
</body>
</html>
