<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/login" method="POST">
     @csrf
    <input type="email" placeholder="email" id="email" name="email"> </input>
    <input type="password" placeholder="password" id="password" name="name"> </input>
    <button type="submit">Submit</button>
    </form>
</body>
</html>