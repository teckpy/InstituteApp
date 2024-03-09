<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
</head>
<body>
    <p>
        <b>Hii {{ $data['name'] }}</b>,Your Test({{ $data['exam_name'] }}) Review Passed !
        So now you can check your marks !
    </p>
    <a href="{{ $data['url'] }}">Click here to go on result page</a>
</body>
</html>