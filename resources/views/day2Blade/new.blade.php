<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @php
    $var1 = "mahesh";
    $var2 = "Cloudtech";
    $var3 = 10;
    @endphp
</head>
<body>
    @if($var3 > 12)
        <h3> Var is greater than 12</h3>
    @else
        <h3>Var is not greater than 12 </h3>
    @endif
    <h1>Hello from blade PHP </h1>
    <h1>Also, Hello from {{$var1}} and {{$var2}} </h1>
    @for($i=0;$i<$var3;$i++)
    <h4> {{ $i}}</h4>

    @endfor
</body>
</html>

