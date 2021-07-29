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
    <div class="alert alert-success" id="success_msg" style="display:none">save done successfully</div>
    <div class="alert alert-danger" id="success_msg" style="display:none">save didnt done successfully</div>

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
            <tr class="Row{{$offer->id}}">
                <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->details}}</td>
                <td><img style="height: 50px;width: 50px" src="{{asset('Images/Offers/'.$offer->img)}}"></td>
                <td><a class="btn btn-success" href="{{url('offer/edit/'.$offer->id)}}" role="button">{{__('messages.edit')}}</a>
                <a class="btn btn-danger" href="{{route('offer.delete',$offer->id)}}" role="button">{{__('messages.delete')}}</a>
                <a class="btn btn-success" href="{{route('Ajax.edit',$offer->id)}}" id="edit_with_ajax" role="button">{{__('messages.edit with ajax')}}</a>
                <a class="delete_with_ajax btn btn-danger " offer_id="{{$offer->id}}" href=""  role="button">{{__('messages.delete with ajax')}}</a>
                </td>
            </tr>
        @endforeach
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
