@extends('layouts.app')
@section('content')
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            {{__('messages.title')}}
        </div>
        <div class="alert alert-success" id="success_msg" style="display:none">save done successfully</div>
        <form method="post" id="offerForm" action="" enctype="multipart/form-data">
            @csrf

{{--                <div class="alert alert-success" role="alert">--}}
{{--                </div>--}}

            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Name_ar')}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__('messages.Name_ar')}}"
                       name="name_ar">
                <small id="name_ar_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.Name_en')}}</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="{{__('messages.Name_en')}}"
                       name="name_en">
                <small id="name_en_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('messages.img')}}</label>
                <input type="file" class="form-control" placeholder="{{__('messages.img')}}"
                       name="img">
                <small id="img_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Price')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="{{__('messages.Price')}}" name="price">
                <small id="price_error" class="form-text text-danger"></small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Details_ar')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="{{__('messages.Details_ar')}}" name="details_ar">

                <small id="details_ar_error" class="form-text text-danger"></small>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">{{__('messages.Details_en')}}</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="{{__('messages.Details_en')}}" name="details_en">
                <small id="details_en_error"  class="form-text text-danger"></small>
            </div>
            <button id="save" class="btn btn-primary">{{__('messages.save')}}</button>
        </form>

    </div>
</div>
@stop
@section('scripts')
    <script>
        $(document).on('click','#save',function (e){
            e.preventDefault();
            $('#name_ar_error').text('');
            $('#name_en_error').text('');
            $('#details_ar_error').text('');
            $('#details_en_error').text('');
            $('#price_error').text('');
            $('#img_error').text('');
            var formData = new FormData($('#offerForm')[0]);
        $.ajax({
            type:'post',
            url:"{{Route('Ajax.store')}}",
            enctype:'multipart/form-data',
            data: formData,
            processData:false,
            contentType:false,
            cache:false,
            success: function (data){
               if (data.status==true){
                   $('#success_msg').show();
                   //alert(data.message)
               }
            },
            error:function(reject){
            var response = $.parseJSON(reject.responseText);
            $.each(response.errors,function (key,val){
                $("#"+key+"_error").text(val[0]);
            });
            }
        });
        });
    </script>
    @stop
