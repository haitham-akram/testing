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
    <div class="title m-b-md">
        {{__('messages.Hospitals')}}
    </div>
    <div class="alert alert-success" id="success_msg" style="display:none">save done successfully</div>
    @if(Session::has('error'))
        <div class="alert alert-success" role="alert">
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
            <th scope="col">{{__('messages.Address')}} </th>
            <th scope="col">{{__('messages.Doctors')}}</th>
            <th scope="col">{{__('messages.operation')}}</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($hospitals)&&$hospitals->count()>0)
        @foreach($hospitals as $hospital)
            <tr class="Row{{$hospital->id}}">
                <th scope="row">{{$hospital->id}}</th>
                <td>{{$hospital->name}}</td>
                <td>{{$hospital->address}}</td>
                <td><a class="btn btn-info" href="{{url('doctors/'.$hospital->id)}}" role="button">{{__('messages.Doctors')}}</a></td>
                <td>
{{--                <a class="btn btn-success" href="{{url('offer/edit/'.$hospital->id)}}" role="button">{{__('messages.edit')}}</a>--}}
                <a class="btn btn-danger" href="{{route('hospital.delete',$hospital->id)}}" role="button">{{__('messages.delete')}}</a>
                </td>
            </tr>
        @endforeach
            @endif
        </tbody>

    </table>
</div>
@include('includes.AppJS')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- here is a delete with ajax--}}
<script>
    $(document).on('click','.delete_with_ajax',function (e){
        e.preventDefault();
        var offer_id = $(this).attr('offer_id');
        $.ajax({
            type:'post',
            url:"{{Route('Ajax.delete')}}",
            enctype:'multipart/form-data',
            data:{'_token':"{{csrf_token()}}",
            'id':offer_id,
            },
            success: function (data){
                if (data.status==true){
                    $('#success_msg').show();
                    $('.Row'+data.id).remove();
                }
            },
            error:function(reject){

            }
        });
    });
</script>

</body>
</html>
