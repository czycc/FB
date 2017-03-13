<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        @foreach ($imgs as $img)
            <img src="{{$img->img }}" alt="{{$img->title}}">
        @endforeach
    </body>
</html>
