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
    <div class="title m-b-m">
        {{__('messages.Doctor').' '.$doctor->name}}
    </div>
    <div class="alert alert-success" id="success_msg" style="display:none">save done successfully</div>
    <div class="alert alert-danger" id="success_msg" style="display:none">save didnt done successfully</div>

    <table class="table mt-5">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('messages.Name')}}</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($services)&&$services->count()>0)
        @foreach($services as $service)
            <tr class="Row{{$service->id}}">
                <th scope="row">{{$service->id}}</th>
                <td>{{$service->name}}</td>
            </tr>
        @endforeach
            @endif
        </tbody>
    </table>
    <br><br>
    <form method="post" action="{{route('save.services')}}">
        @csrf
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('messages.Doctor')}}</label>
            <select name="doctor_id" id="" class="form-control">
                @foreach($doctors as $doctor)
                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">{{__('messages.Service')}}</label>
            <select name="Service_id[]" id="" class="form-control" multiple>
            @foreach($all_services as $service)
                <option value="{{$service->id}}">{{$service->name}}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{__('messages.save')}}</button>
    </form>
</div>
@include('includes.AppJS')
</body>
</html>
