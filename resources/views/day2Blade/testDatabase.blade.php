<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach($users as $user)
    <h1> {{$user->name}}</h1>
    <h2> {{$user->email}}</h2>
    <h2> {{$user->Registered}}</h2>
    @endforeach
</body>
</html>