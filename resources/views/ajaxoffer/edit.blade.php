
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    @include('includes.AppStyle')
</head>
<body>
@include('includes.nav')
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="alert alert-success" id="success_msg" style="display:none">save done successfully</div>
        <div class="title m-b-md">
            {{__('messages.title edit')}}
        </div>
        <form method="post" id="FormUpdate" action="" enctype="multipart/form-data">
            @csrf
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
            @endif
            <div class="form-group">
                <input type="hidden"  class="form-control" id="exampleInputEmail1"
                       name="id" value="{{$offer->id}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Name_ar')}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__('messages.Name_ar')}}"
                       name="name_ar" value="{{$offer->name_ar}}">
                @error('name_ar')
                <small  class="form-text text-danger">{{$message}}</small>

                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Name_en')}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__('messages.Name_en')}}"
                       name="name_en" value="{{$offer->name_en}}">
                @error('name_en')
                <small  class="form-text text-danger">{{$message}}</small>

                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.img')}}</label>
                <input type="file" class="form-control" placeholder="{{__('messages.img')}}"
                       name="img" value="{{$offer->img}}">
                @error('img')
                <small  class="form-text text-danger">{{$message}}</small>

                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Price')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="{{__('messages.Price')}}" name="price"  value="{{$offer->price}}">
                @error('price')
                <small  class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Details_ar')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="{{__('messages.Details_ar')}}" name="details_ar"  value="{{$offer->details_ar}}">
                @error('details_ar')
                <small  class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Details_en')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="{{__('messages.Details_en')}}" name="details_en" value="{{$offer->details_en}}">
                @error('details_en')
                <small  class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button id="update" class="btn btn-primary">{{__('messages.edit')}}</button>
        </form>

    </div>
</div>
@include('includes.AppJS')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- here is a delete with ajax--}}
<script>
    $(document).on('click','#update',function (e){
        e.preventDefault();
        var FormUpdate = new FormData($('#FormUpdate')[0]);
        $.ajax({
            type:'post',
            url:"{{route('Ajax.Update')}}",
            enctype:'multipart/form-data',
            data:FormUpdate,
            processData:false,
            contentType:false,
            cache:false,
            success: function (data){
                if (data.status==true){
                    $('#success_msg').show();
                   // $('.Row'+data.id).update();
                }
            },
            error:function(reject){

            }
        });
    });
</script>
</body>
</html>
