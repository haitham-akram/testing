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
        <div class="title m-b-md">
            Video Viewer ({{$video->viewers}})
        </div>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/enLdIJ_Sx2s" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
</div>
@include('includes.AppJS')
</body>
</html>
